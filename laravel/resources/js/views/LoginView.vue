<template>
    <v-container class="fill-height d-flex justify-center align-center">
        <v-card elevation="2" max-width="500">
            <v-card-title>
                <span class="headline">Login</span>
            </v-card-title>
            <v-card-text>
                <!-- Not signed up yet message -->
                <v-alert v-if="!isSignedIn" type="info" class="mb-4" dense>
                    Not signed up yet?
                    <v-btn text color="blue" @click="goToSignUp"
                        >Click here</v-btn
                    >
                    to sign up.
                </v-alert>

                <v-form ref="form" v-model="valid" lazy-validation>
                    <!-- Email -->
                    <v-text-field
                        v-model="email"
                        :rules="[rules.required, rules.email]"
                        label="Email"
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
            email: '',
            password: '',
            showPassword: false,
            rules: {
                required: value => !!value || 'This field is required',
                email: value =>
                    /.+@.+\..+/.test(value) || 'E-mail must be valid',
            },
            authStore: undefined,
        }
    },

    beforeMount() {
        this.authStore = useAuthStore()
    },

    computed: {
        isSignedIn() {
            // Check if the user is signed in through authStore
            return this.authStore && this.authStore.getUserLoggedIn
        },
    },

    methods: {
        submit() {
            if (this.$refs.form.validate()) {
                if (this.authStore) {
                    this.authStore.actionLogin({
                        email: this.email,
                        password: this.password,
                    })

                    this.$router.push({ name: 'Home' })
                } else {
                    alert('Login not possible. Try again later...')
                }
            }
        },
        cancel() {
            this.email = ''
            this.password = ''
            this.$refs.form.resetValidation()
        },
        goToSignUp() {
            // Redirect to the sign-up page if user is not signed in
            this.$router.push({ name: 'SignUp' })
        },
    },
}
</script>

<style scoped>
.fill-height {
    height: 100vh;
}
</style>
