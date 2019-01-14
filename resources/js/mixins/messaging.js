export default {
  methods: {
    alertMessage (message, title = 'Error', html = true) {
      this.$uiv_alert({
        title: title,
        content: message,
        okType: 'primary btn-block',
        html: html,
        dismissBtn: false
      })
    },
    notifyMessage (message, title = '', placement = 'bottom-right') {
      this.$uiv_notify({
        content: message,
        title: title,
        placement: placement
      })
    }
  }
}
