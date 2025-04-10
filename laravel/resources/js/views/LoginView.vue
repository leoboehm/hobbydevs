<template>
    <v-container fluid class="py-4">
        <v-row justify="center">
            <v-col cols="12" sm="8" md="6" lg="4">
                <v-card class="elevation-2 rounded-lg">
                    <v-card-title class="text-center py-6">
                        Login
                        <hr class="mt-2" />
                    </v-card-title>

                    <v-row align="center" justify="center" class="mb-3">
                        <v-col class="text-center" cols="12">
                            <span class="font-weight-bold"
                                >New to the platform?</span
                            ></v-col
                        >
                        <v-col class="text-center" cols="1">
                            <v-icon large color="primary"
                                >mdi-account-plus</v-icon
                            >
                        </v-col>
                        <v-col class="text-center" cols="7">
                            <span
                                >Create an account to enjoy all features and get
                                started!</span
                            >
                        </v-col>
                        <v-col class="text-center" cols="12">
                            <v-btn
                                color="primary"
                                to="/signup"
                                dark
                                rounded
                                elevation="2"
                                width="200"
                            >
                                Sign Up Now
                            </v-btn></v-col
                        >
                    </v-row>
                    <v-card-text>
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
                                :append-icon="
                                    showPassword ? 'mdi-eye' : 'mdi-eye-off'
                                "
                                :type="showPassword ? 'text' : 'password'"
                                @click:append="showPassword = !showPassword"
                                label="Password"
                                outlined
                                required
                            ></v-text-field>
                        </v-form>
                    </v-card-text>

                    <v-card-actions class="justify-end mb-2">
                        <v-btn text color="red" @click="cancel" class="mr-4">
                            Cancel
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="submit"
                            :disabled="!valid"
                        >
                            Login
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
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

    computed: {},

    methods: {
        submit() {
            if (this.$refs.form.validate()) {
                if (this.authStore) {
                    this.authStore.actionLogin({
                        email: this.email,
                        password: this.password,
                    })

                    this.$router.push({ name: 'Profile' })
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
    },
}
</script>

<style scoped>
.v-alert {
    border-radius: 8px;
    padding: 10px;
}
</style>
