import Vue    from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import Welcome from  '@pages/welcome/Welcome.vue';
import Page from  '@pages/page/Page.vue';


import Conocenos    from  '@pages/conocenos/Conocenos.vue';
import Servicios    from  '@pages/servicios/Servicios.vue';

import Registro     from  '@pages/registro/Registro.vue';
import Login        from     '@pages/login/Login.vue';

import AdminAccount from  '@pages/account/AdminAccount.vue';
import Home         from  '@pages/home';

import PageNotFound from  '@pages/404/NotFound.vue'



export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
      routes: [
        {
          path: '/',
          name: 'welcome',
          icon: 'bubble_chart',
          component: Welcome,
        },
        {
          path: '/page',
          name: 'page',
          icon: 'bubble_chart',
          component: Page,
        },
        {
          path: '/conocenos',
          name: 'conocenos',
          icon: 'bubble_chart',
          component: Conocenos,
        },
        {
          path: '/servicios',
          name: 'servicios',
          icon: 'bubble_chart',
          component: Servicios,
        },
        {
          path: '/registro',
          name: 'registro',
          icon: 'bubble_chart',
          component: Registro,
        },
        {
          path: '/login',
          name: 'login',
          icon: 'bubble_chart',
          component: Login,
        },

        {
          path: '/cuenta',
          name: 'cuenta',
          icon: 'bubble_chart',
          component: AdminAccount,
        },
        {
          path: '/home',
          name: 'home',
          icon: 'bubble_chart',
          component: Home,
        },
        { 
          path: "*", 
          name: 'notfound',
          component: PageNotFound 
        }


    ]
})


