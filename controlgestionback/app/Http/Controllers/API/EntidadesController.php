<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntidadesFieldRequest;
use Illuminate\Http\Request;
use App\Models\entidades;
use Illuminate\Support\Facades\DB;

class EntidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $rowsPerPage = $request->rowsPerPage;
            $search = $request->input('search');
            $Entidades = entidades::search($search)->orderBy('ENTIDADFEDERATIVAID','asc')->paginate($rowsPerPage);
            return response()->json([
                'success' => true,
                'entidades' => $Entidades,
			]);
        }catch (\Exception $e) {
            DB::rollback();
			return response()->json([
				'success' => false,
				'message' => $e->getMessage()
			]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            $Entidades = new entidades();
            $Entidades->fill($request->all());
            $Entidades->save();
            DB::commit();

            return response()->json([
				'success' => true,
				'message' => 'Registro Almacenado correctamente',
			], 200);

        } catch (\Exception $e) {
            DB::rollback();
			return response()->json([
				'success' => false,
				'message' => $e->getMessage()
			]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $Entidades = entidades::where('ENTIDADFEDERATIVAID',$id)->first();
            return response()->json([
                'success' => true,
                'entidades' => $Entidades,
			]);
        }catch (\Exception $e) {
            DB::rollback();
			return response()->json([
				'success' => false,
				'message' => $e->getMessage()
			]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $Entidades = entidades::where('ENTIDADFEDERATIVAID',$id)->first();
            return response()->json([
                'success' => true,
                'entidades' => $Entidades,
			]);
        }catch (\Exception $e) {
            DB::rollback();
			return response()->json([
				'success' => false,
				'message' => $e->getMessage()
			]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            DB::beginTransaction();
            $Entidades = entidades::find($id);
            $Entidades->fill($request->all());
            $Entidades->save();
            DB::commit();

            return response()->json([
				'success' => true,
				'message' => '200'
			], 200);

        } catch (\Exception $e) {
            DB::rollback();
			return response()->json([
				'success' => false,
				'message' => $e->getMessage()
			]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            entidades::destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'OK' 
             ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
				'success' => false,
				'message' => $e->getMessage()
			]);
        }
        
    }


    //otros metodos

    public function ShowEntidadesAll(Request $request)
    {
        try {
            $Entidades = entidades::all(); 

            $datos = array(); 

            foreach ($Entidades as $i => $value) {
                $datos['data'][$i] = $value; 
            }

            return response()->json([
                'success' => true,
                'entidades_federativas' => $datos
			]);
        }catch (\Exception $e) {
            DB::rollback();
			return response()->json([
				'success' => false,
				'message' => $e->getMessage()
			]);
        }
    }
}
