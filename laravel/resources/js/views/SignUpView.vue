<template>
    <v-container fluid class="py-4">
        <v-row justify="center">
            <v-col cols="6">
                <v-card class="elevation-2 rounded-lg">
                    <v-card-title class="headline text-center py-6">
                        Sign Up
                    </v-card-title>

                    <v-card-text>
                        <v-form ref="form" v-model="valid" lazy-validation>
                            <!-- Account Type -->
                            <v-select
                                v-model="accountType"
                                :items="accountTypes"
                                label="Account Type"
                                :rules="[rules.required]"
                                outlined
                                required
                                class="mb-4"
                            ></v-select>

                            <!-- First Name -->
                            <v-text-field
                                v-model="firstname"
                                :rules="[rules.required]"
                                label="First Name"
                                outlined
                                required
                                class="mb-4"
                            ></v-text-field>

                            <!-- Last Name -->
                            <v-text-field
                                v-model="lastname"
                                :rules="[rules.required]"
                                label="Last Name"
                                outlined
                                required
                                class="mb-4"
                            ></v-text-field>

                            <!-- Username -->
                            <v-text-field
                                v-model="username"
                                :rules="[rules.required, rules.minLength(3)]"
                                label="Username"
                                outlined
                                required
                                class="mb-4"
                            ></v-text-field>

                            <!-- Email -->
                            <v-text-field
                                v-model="email"
                                :rules="[rules.required, rules.email]"
                                label="Email"
                                outlined
                                required
                                class="mb-4"
                            ></v-text-field>

                            <!-- Password -->
                            <v-text-field
                                v-model="password"
                                :rules="[rules.required, rules.minLength(6)]"
                                :append-icon="
                                    showPassword ? 'mdi-eye' : 'mdi-eye-off'
                                "
                                :type="showPassword ? 'text' : 'password'"
                                @click:append="showPassword = !showPassword"
                                label="Password"
                                outlined
                                required
                                class="mb-4"
                            ></v-text-field>

                            <!-- Confirm Password -->
                            <v-text-field
                                v-model="confirmPassword"
                                :rules="[rules.required, rules.matchPassword]"
                                :append-icon="
                                    showConfirmPassword
                                        ? 'mdi-eye'
                                        : 'mdi-eye-off'
                                "
                                :type="
                                    showConfirmPassword ? 'text' : 'password'
                                "
                                @click:append="
                                    showConfirmPassword = !showConfirmPassword
                                "
                                label="Confirm Password"
                                outlined
                                required
                                class="mb-4"
                            ></v-text-field>
                        </v-form>
                    </v-card-text>

                    <v-card-actions class="justify-end py-4">
                        <!-- Cancel Button -->
                        <v-btn text color="red" @click="cancel" class="mr-4">
                            Cancel
                        </v-btn>

                        <!-- Sign Up Button -->
                        <v-btn
                            color="primary"
                            @click="submit"
                            :disabled="!valid"
                        >
                            Sign Up
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
    name: 'SignUpView',

    data() {
        return {
            valid: false,
            accountType: '',
            firstname: '',
            lastname: '',
            username: '',
            email: '',
            password: '',
            confirmPassword: '',
            showPassword: false,
            showConfirmPassword: false,
            accountTypes: ['Developer', 'Project Owner'],
            rules: {
                required: value => !!value || 'This field is required',
                email: value =>
                    /.+@.+\..+/.test(value) || 'E-mail must be valid',
                minLength: min => value =>
                    value.length >= min || `Must be at least ${min} characters`,
                matchPassword: value =>
                    value === this.password || 'Passwords must match',
            },

            // authentification store
            authStore: undefined,
        }
    },

    beforeMount() {
        // init auth store
        this.authStore = useAuthStore()
    },

    methods: {
        submit() {
            if (this.$refs.form.validate()) {
                if (this.authStore != undefined) {
                    this.authStore.actionRegisterNewUser({
                        email: this.email,
                        firstname: this.firstname,
                        lastname: this.lastname,
                        password: this.password,
                        type: this.accountType,
                        username: this.username,
                    })

                    this.$router.push({ name: 'Login' })
                    // if (response.error == null) {
                    //     console.log(
                    //         'Error during registration: ' + response.error,
                    //     )
                    //     alert('An error has occurred during registration...')
                    // } else {
                    //     this.$router.push({ name: 'login' })
                    // }
                } else {
                    alert('Registration not possible. Try again later...')
                }
            }
        },
        cancel() {
            this.accountType = ''
            this.firstname = ''
            this.lastname = ''
            this.username = ''
            this.email = ''
            this.password = ''
            this.confirmPassword = ''
            this.$refs.form.resetValidation()
        },
    },
}
</script>

<style scoped>

</style>
