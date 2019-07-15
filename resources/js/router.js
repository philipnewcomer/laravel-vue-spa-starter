import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './store'
import NotFound from './pages/NotFound'
import ForgotPassword from './pages/auth/ForgotPassword'
import Home from './pages/Home'
import Login from './pages/auth/Login'
import Register from './pages/auth/Register'
import ResetPassword from './pages/auth/ResetPassword'
import VerifyEmail from './pages/auth/VerifyEmail'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/forgotPassword',
      name: 'forgotPassword',
      component: ForgotPassword,
      meta: {
        auth: false
      }
    },
    {
      path: '/',
      name: 'home',
      component: Home,
      meta: {
        auth: true,
        requiresVerifiedEmail: true
      }
    },
    {
      path: '/login',
      name: 'login',
      component: Login,
      meta: {
        auth: false
      }
    },
    {
      path: '/register',
      name: 'register',
      component: Register,
      meta: {
        auth: false
      }
    },
    {
      path: '/resetPassword/:token',
      name: 'resetPassword',
      component: ResetPassword,
      meta: {
        auth: false
      }
    },
    {
      path: '/verifyEmail',
      name: 'verifyEmail',
      component: VerifyEmail,
      meta: {
        auth: true
      }
    },
    {
      path: '*',
      name: '404',
      component: NotFound
    }
  ]
})

router.beforeEach((to, from, next) => {

  if (store.state.status) {
    store.dispatch('clearStatus')
  }

  next()
})

export default router
