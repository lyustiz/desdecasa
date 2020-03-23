import Vue    from 'vue'
import Router from 'vue-router'
Vue.use(Router)

import Banco from '~/pages/General/Banco/BancoList.vue'


export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
      routes: [
        {
          path: '/banco',
          name: 'banco',
          icon: 'bubble_chart',
          component: Banco,
        
        },
    ]
})


