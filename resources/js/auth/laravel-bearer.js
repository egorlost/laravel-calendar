export default {
  request: function (req, token) {
    this.options.http._setHeaders.call(this, req, { Authorization: 'Bearer ' + token })
  },

  response: function (res) {
    if (res.data && res.data.access_token) {
      return res.data.access_token
    }
  }
}
