import Vue from 'vue'
import config from '../config/api'

export default {
  logout () {
    return Vue.auth.logout()
  },
  login (login, password) {
    return Vue.auth.login({
      data: {
        grant_type: 'password',
        client_id: config.clientId,
        client_secret: config.clientSecret,
        username: login,
        password: password,
        scope: config.clientScope
      }
    })
  }
}
