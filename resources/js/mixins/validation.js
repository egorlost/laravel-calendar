export default {
  computed: {
    formIsNotValid () {
      for (let property in this.fields) {
        if (this.fields[property].invalid) {
          return true
        }
      }

      return false
    }
  },
  methods: {
    classFor (field) {
      if (Object.keys(this.fields).length === 0) {
        return ''
      }

      if (this.fields[field].touched && this.fields[field].invalid) {
        return 'has-error'
      }

      if (this.fields[field].untouched) {
        return ''
      }

      if (this.fields[field].touched && this.fields[field].valid) {
        return 'has-success'
      }
    },
    handleError (error, delimiter) {
      let errorBag = []

      for (let property in error.response.data.errors) {
        errorBag.push(error.response.data.errors[property].map(mapping => mapping))
      }

      return errorBag.join(delimiter)
    }
  }
}
