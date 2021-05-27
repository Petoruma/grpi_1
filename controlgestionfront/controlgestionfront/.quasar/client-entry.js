/**
 * THIS FILE IS GENERATED AUTOMATICALLY.
 * DO NOT EDIT.
 *
 * You are probably looking on adding startup/initialization code.
 * Use "quasar new boot <name>" and add it there.
 * One boot file per concern. Then reference the file(s) in quasar.conf.js > boot:
 * boot: ['file', ...] // do not add ".js" extension to it.
 *
 * Boot files are your "main.js"
 **/

import 'quasar/dist/quasar.ie.polyfills.js'



import '@quasar/extras/fontawesome-v5/fontawesome-v5.css'

import '@quasar/extras/roboto-font/roboto-font.css'

import '@quasar/extras/material-icons/material-icons.css'




// We load Quasar stylesheet file
import 'quasar/dist/quasar.sass'




import 'src/css/app.sass'

import '@quasar/quasar-app-extension-qpdfviewer/src/component/pdfviewer.sass'


import Vue from 'vue'
import createApp from './app.js'




import qboot_Bootfilters from 'boot/filters'

import qboot_Booti18n from 'boot/i18n'

import qboot_Bootaxios from 'boot/axios'

import qboot_Bootpermissions from 'boot/permissions'

import qboot_Bootvuedraggable from 'boot/vue-draggable'

import qboot_Bootlodash from 'boot/lodash'

import qboot_Quasarquasarappextensionqpdfviewersrcbootqpdfviewerjs from '@quasar/quasar-app-extension-qpdfviewer/src/boot/qpdfviewer.js'

import qboot_Quasarappextensionvuelidaterulessrcbootregistervuelidaterulesjs from 'quasar-app-extension-vuelidate-rules/src/boot/register-vuelidate-rules.js'









console.info('[Quasar] Running SPA.')





const publicPath = `/`


async function start () {
  const { app, store, router } = await createApp()

  

  
  let hasRedirected = false
  const redirect = url => {
    hasRedirected = true
    const normalized = Object(url) === url
      ? router.resolve(url).route.fullPath
      : url

    window.location.href = normalized
  }

  const urlPath = window.location.href.replace(window.location.origin, '')
  const bootFiles = [qboot_Bootfilters,qboot_Booti18n,qboot_Bootaxios,qboot_Bootpermissions,qboot_Bootvuedraggable,qboot_Bootlodash,qboot_Quasarquasarappextensionqpdfviewersrcbootqpdfviewerjs,qboot_Quasarappextensionvuelidaterulessrcbootregistervuelidaterulesjs]

  for (let i = 0; hasRedirected === false && i < bootFiles.length; i++) {
    if (typeof bootFiles[i] !== 'function') {
      continue
    }

    try {
      await bootFiles[i]({
        app,
        router,
        store,
        Vue,
        ssrContext: null,
        redirect,
        urlPath,
        publicPath
      })
    }
    catch (err) {
      if (err && err.url) {
        window.location.href = err.url
        return
      }

      console.error('[Quasar] boot error:', err)
      return
    }
  }

  if (hasRedirected === true) {
    return
  }
  

  

    

    

    
      new Vue(app)
    

    

    

  

}

start()
