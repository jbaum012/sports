import Vue from 'vue'
import Router from 'vue-router'
import AppLayout from '../views/layouts/AppLayout.vue'

Vue.use(Router)

const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }

const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/app',
      component: AppLayout,
      children: [
        {
          path: '',
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
        }
      ]
    },
    { path: '/foo', component: Foo },
    { path: '/bar', component: Bar }
  ]
})

export default router
