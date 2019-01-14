<template>
    <div v-if="$auth.ready()">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="/">
                    Laravel
                </a>
            </div>
        </nav>
        <main class="py-4">
            <div v-if="$auth.check()">
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

    export default {
        components: {
            PulseLoader,
            Dashboard,
        }
    }
</script>

<style lang="scss">
</style>
