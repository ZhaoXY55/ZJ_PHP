import Vue from 'vue'
import Router from 'vue-router'

import Index from '@/pages/index.vue'
import Detail from '@/pages/detail.vue'
import Admin from '@/pages/admin.vue'

Vue.use(Router)

export default new Router({
  routes: [{
      path: '/',
      name: 'Index',
      component: Index,
    },
    {
      path: '/Detail',
      name: 'Detail',
      component: Detail,
    },
    {
      path: '/Admin',
      name: 'Admin',
      component: Admin,
    },
  ]
})