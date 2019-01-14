const state = {
  user: {}
}

const getters = {
  user: state => state.user
}

const mutations = {
  'SET_USER' (state, data) {
    state.user = data
  }
}

const actions = {
  setUser ({ commit }, data) {
    commit('SET_USER', data)
  }
}

export default {
  state,
  getters,
  mutations,
  actions
}
