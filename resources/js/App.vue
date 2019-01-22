<template>
    <div v-if="$auth.ready()">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="/">
                    Calendar
                </a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul v-if="$auth.check()" class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <router-link :to="{ name: 'logout' }" class="nav-link">
                                Logout
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div v-if="$auth.check()">
                <router-view></router-view>
            </div>
            <router-view v-else></router-view>
        </main>
    </div>
    <div v-else class="text-center">
        <pulse-loader :loading="!$auth.ready()"></pulse-loader>
    </div>
</template>

<script>
    import PulseLoader from 'vue-spinner/src/PulseLoader'
    import Dashboard from './components/Dashboard'
    import Logout from "./components/Auth/Logout";

    export default {
        components: {
            Logout,
            PulseLoader,
            Dashboard,
        }
    }
</script>

<style lang="scss">
</style>
