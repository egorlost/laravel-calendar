import Vue from 'vue'
import Router from 'vue-router'
import Dashboard from './components/Dashboard'
import Logout from './components/Auth/Logout'
import Login from './components/Auth/Login'

Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: Dashboard,
      meta: {
        auth: true
      }
    },
    {
      path: '/auth/logout',
      name: 'logout',
      component: Logout,
      meta: {
        auth: true
      }
    },
    {
      path: '/auth/login',
      name: 'login',
      component: Login,
      meta: { auth: false }
    },
  ]
})
