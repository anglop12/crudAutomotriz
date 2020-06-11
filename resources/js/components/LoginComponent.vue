<template>
    <b-container style="padding-top: 6%;">
        <b-row class="justify-content-md-center" align-v="center" no-gutters>
            <b-card class="text-center">
                <div>
                    <div class="vue-tempalte">
                        <br>
                        <br>
                        <h3>Iniciar Sesión</h3>

                        <template>
                            <div>
                            <b-form @submit.prevent="login">
                                <b-form-group id="input-group-1" label="Email:" label-for="input-1">
                                    <b-form-input id="input-1" v-model="form.email" type="email" required placeholder="Enter email"></b-form-input>
                                </b-form-group>

                                <b-form-group id="input-group-2" label="Password:" label-for="input-2">
                                    <b-form-input id="input-2" v-model="form.password" type="password" required placeholder="Enter password" ></b-form-input>
                                </b-form-group>

                                <b-button type="submit" block variant="primary">Aceptar</b-button>
                            </b-form>
                            </div>
                        </template>
                    </div>
                </div>
            </b-card>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        data() {
            return {
                user: {},
                form: {
                    email: 'admin@admin.com',
                    password: 'admin',
                }
            }
        },
        created() {
            //
        },
        methods: {
            async login() {
                this.$store.dispatch('login', this.form).then(() => {
                    this.$router.push({ name: "home" });
                });
            }
        }
    }
</script>