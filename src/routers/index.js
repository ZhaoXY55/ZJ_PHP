import Vue from 'vue'
import Router from 'vue-router'

import Index from '@/pages/index.vue'
import Detail from '@/pages/detail.vue'
import Admin from '@/pages/admin.vue'
import Add from '@/components/add.vue'
import Change from '@/components/change.vue'
import Delete from '@/components/delete.vue'

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
      redirect: 'Add',
      children: [
        {
          path: '/Add',
          name: 'Add',
          component: Add,
        },
        {
          path: '/Change',
          name: 'Change',
          component: Change,
        },
        {
          path: '/Delete',
          name: 'Delete',
          component: Delete,
        },
      ]
    },
  ]
})