import Vue from 'vue'
import Router from 'vue-router'
import AppLayout from '../views/layouts/AppLayout.vue'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: AppLayout,
      children: [
        {
          path: '/home',
          name: 'home',
          component: () => import('../views/Home.vue')
        },
        {
          path: '/week/:week',
          name: 'week',
          props: route => {
            const week = Number.parseInt(route.params.week, 10)
            if (Number.isNaN(week)) {
              return null
            }
            return { week }
          },
          component: () => import('../views/Week.vue')
        },
        {
          path: '/standings',
          name: 'standings',
          component: () => import('../views/Standings.vue')
        }
      ]
    }
  ]
})

export default router
