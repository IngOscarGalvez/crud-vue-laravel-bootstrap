import Vue from 'vue'
import Router from 'vue-router'
import excel from 'vue-excel-export'
import Crud from "./views/Crud";


Vue.use(Router)
Vue.use(excel)

export default new Router({
    routes: [

        {
            path: '/crud',
            name: 'crud',
            component: Crud
        },


    ],
    mode: 'history',

})
