<template>
    <div>
        <div v-if="this.$route.name != 'login' && this.$route.name != 'register'">
            <b-navbar toggleable="md" type="dark" variant="info">
                <b-navbar-brand to="/">
                    <h3 v-text="appname"></h3>
                </b-navbar-brand>

                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

                <b-collapse id="nav-collapse" is-nav>
                    <b-navbar-nav >
                        <b-nav-item to="/home">Home</b-nav-item>
                        <template v-show="$store.state.auth">
                            <b-nav-item to="/clients">Clientes</b-nav-item>
                            <b-nav-item to="/concessionaires">Concesionarios</b-nav-item>
                        </template>
                    </b-navbar-nav>

                    <!-- Right aligned nav items -->
                    <template v-if="$store.state.auth">
                        <b-container>
                            <b-navbar-nav class="ml-auto">
                                <b-button variant="info" @click="logout()">Logout</b-button>
                                <!-- <b-nav-item @click="logout()">Logout</b-nav-item> -->
                            </b-navbar-nav>
                        </b-container>
                    </template>
                    <template v-if="$store.state.auth == false">
                        <b-container>
                            <b-navbar-nav class="ml-auto">
                                <b-nav-item to="/login">Login</b-nav-item>
                                <b-nav-item to="/register">Register</b-nav-item>
                            </b-navbar-nav>
                        </b-container>
                    </template>
                </b-collapse>
            </b-navbar>
        </div>
        <!-- {{ $route.name }} -->
        <router-view></router-view>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {},
                appname: "Automotriz"
            }
        },
        methods: {
            async logout() {
                this.$store.dispatch('logout').then(() => {
                    this.$router.push({ name: "login" });
                });
            }
        }
    }
</script>
