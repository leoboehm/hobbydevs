<template>
    <v-container class="fill-height d-flex justify-center align-center">
        <v-card elevation="2" max-width="500">
            <v-card-title>
                <span class="headline">Login</span>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                    <!-- Username -->
                    <v-text-field
                        v-model="username"
                        :rules="[rules.required]"
                        label="Username"
                        outlined
                        required
                    ></v-text-field>

                    <!-- Password -->
                    <v-text-field
                        v-model="password"
                        :rules="[rules.required]"
                        :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                        :type="showPassword ? 'text' : 'password'"
                        @click:append="showPassword = !showPassword"
                        label="Password"
                        outlined
                        required
                    ></v-text-field>
                </v-form>
            </v-card-text>
            <v-card-actions class="justify-end">
                <!-- Cancel Button -->
                <v-btn text color="red" @click="cancel">Cancel</v-btn>
                <!-- Login Button -->
                <v-btn color="primary" @click="submit" :disabled="!valid">
                    Login
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>
</template>

<script>
import { useAuthStore } from '../stores/auth'

export default {
    name: 'LoginView',

    data() {
        return {
            valid: false,
            username: '',
            password: '',
            showPassword: false,
            rules: {
                required: value => !!value || 'This field is required',
            },
            authStore: undefined,
        }
    },

    beforeMount() {
        this.authStore = useAuthStore()
    },

    methods: {
        submit() {
            if (this.$refs.form.validate()) {
                if (this.authStore) {
                    this.authStore.actionLogin({
                        username: this.username,
                        password: this.password,
                    })

                    this.$router.push({ name: 'Home' })
                } else {
                    alert('Login not possible. Try again later...')
                }
            }
        },
        cancel() {
            this.username = ''
            this.password = ''
            this.$refs.form.resetValidation()
        },
    },
}
</script>

<style scoped>
.fill-height {
    height: 100vh;
}
</style>


