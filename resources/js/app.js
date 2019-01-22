require('./bootstrap');

import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import VueAuth from '@websanova/vue-auth'
import VeeValidate from 'vee-validate'
import ru from 'vee-validate/dist/locale/ru'
import App from './App.vue'
import router from './router'
import store from './store/store';
import bearerAuth from './auth/laravel-bearer'
import * as uiv from 'uiv'
import VueTheMask from 'vue-the-mask'
import messaging from './mixins/messaging'

Vue.use(VueAxios, axios)

Vue.axios.defaults.baseURL = 'http://api.calendar'

Vue.router = router

Vue.use(VueAuth, {
    auth: bearerAuth,
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    authRedirect: {name: 'login'},
    loginData: {url: '/oauth/token', method: 'POST', fetchUser: true},
    fetchData: {url: 'api/users/current', method: 'GET', enabled: true},
    refreshData: {url: 'api/users/current', method: 'POST', enabled: false, interval: 5},
    logoutData: {url: 'api/users/current', method: 'DELETE', redirect: {name: 'login'}, makeRequest: true}
})

VeeValidate.Validator.localize({ru: ru})

Vue.use(VeeValidate, {
    locale: 'ru'
})

Vue.use(uiv, {prefix: 'uiv'})

Vue.use(VueTheMask)

Vue.mixin(messaging)

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
