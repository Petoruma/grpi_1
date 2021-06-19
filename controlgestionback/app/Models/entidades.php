<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class entidades extends Model
{
    // use HasFactory, SoftDeletes;
    
    protected $table="entidades";
    protected $primaryKey = 'entidadfederativaid';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entidadfederativaid',
        'entidadfederativanombre',
        'entidadfederativaabreviacion'
      ];

    public function scopeSearch($query, $search)
    {
        return $query->when(! empty ($search), function ($query) use ($search) {

            return $query->where(function($q) use ($search)
            {
                if (isset($search) && !empty($search)) {
                    $q->where('entidadfederativanombre', 'like', '%' . $search . '%');
                    $q->orWhere('entidadfederativaabreviacion', 'like', '%' . $search . '%');
                    $q->orWhere('entidadfederativaid', 'like', '%' . $search . '%');
                }
            });
        });
    }
}
