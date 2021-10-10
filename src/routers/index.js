import Vue from 'vue'
import Router from 'vue-router'

import Index from '@/pages/index.vue'
import Detail from '@/pages/detail.vue'
import Admin from '@/pages/admin.vue'
import Add from '@/components/add.vue'
import Update from '@/components/update.vue'

Vue.use(Router)

export default new Router({
  routes: [{
      path: '/',
      name: '首页',
      component: Index,
    },
    {
      path: '/Detail',
      name: '商品详情',
      component: Detail,
    },
    {
      path: '/Admin',
      name: '商品管理',
      component: Admin,
    },
    {
      path: '/Add',
      name: '添加商品',
      component: Add,
    },
    {
      path: '/Update',
      name: '商品编辑',
      component: Update,
    },
  ]
})