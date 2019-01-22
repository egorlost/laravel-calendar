<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" data-vv-name="Email" v-validate="'required|email'" v-model="userLogin">
                                <span>{{ errors.first('email') }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" data-vv-name="Пароль" v-validate="'required'" v-model="userPassword">
                                <span>{{ errors.first('email') }}</span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button @click="login" type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import auth from '../../api/auth'
    import httpCodes from 'http-status-codes'
    import validation from '../../mixins/validation'

    export default {
        mixins: [ validation ],
        data() {
            return {
                userLogin: null,
                userPassword: null
            }
        },
        methods: {
            async login() {
                try {
                    let result = await auth.login(this.userLogin, this.userPassword)

                    if (result.status === httpCodes.OK) {
                        this.$router.push({name: 'dashboard'})
                    }
                } catch (e) {
                    this.alertMessage('Неправильный логин или пароль')
                }
            }
        }
    }
</script>

<style scoped lang="scss">
</style>
