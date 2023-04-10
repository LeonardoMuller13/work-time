import Vue from 'vue'
import VueRouter from 'vue-router'
import Worktime from '@/views/Worktime/Worktime.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'worktime',
    component: Worktime
  }
]

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router
