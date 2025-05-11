<template>
    <v-container fluid class="py-4">
        <v-row justify="center">
            <v-col cols="6">
                <v-card class="elevation-2 rounded-lg">
                    <v-card-title class="headline text-center py-6">
                        Sign Up
                        <hr class="mt-2" />
                    </v-card-title>

                    <v-row align="center" justify="center" class="mb-3">
                        <v-col class="text-center" cols="5">
                            <span class="font-weight-bold"
                                >Already have an Account?</span
                            ></v-col
                        >
                        <v-col class="text-center" cols="4">
                            <v-btn
                                color="primary"
                                to="/login"
                                dark
                                rounded
                                elevation="2"
                                width="200"
                            >
                                Go to Login
                            </v-btn></v-col
                        >
                    </v-row>

                    <v-card-text>
                        <v-form ref="formRef" v-model="valid" lazy-validation>
                            <!-- Account Type -->
                            <v-select
                                v-model="accountType"
                                :items="accountTypes"
                                label="Account Type"
                                :rules="[rules.required]"
                                outlined
                                required
                            ></v-select>

                            <!-- First Name -->
                            <v-text-field
                                v-model="firstname"
                                :rules="[rules.required]"
                                label="First Name"
                                outlined
                                required
                            ></v-text-field>

                            <!-- Last Name -->
                            <v-text-field
                                v-model="lastname"
                                :rules="[rules.required]"
                                label="Last Name"
                                outlined
                                required
                            ></v-text-field>

                            <!-- Username -->
                            <v-text-field
                                v-model="username"
                                :rules="[rules.required, rules.minLength(3)]"
                                label="Username"
                                outlined
                                required
                            ></v-text-field>

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
                                :rules="[rules.required, rules.minLength(6)]"
                                :append-icon="
                                    showPassword ? 'mdi-eye' : 'mdi-eye-off'
                                "
                                :type="showPassword ? 'text' : 'password'"
                                @click:append="showPassword = !showPassword"
                                label="Password"
                                outlined
                                required
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
                            ></v-text-field>
                        </v-form>
                    </v-card-text>

                    <v-card-actions class="justify-end">
                        <v-btn text color="red" @click="cancel" class="mr-4">
                            Cancel
                        </v-btn>

                        <v-btn
                            color="primary"
                            @click="submit"
                            :disabled="!valid"
                        >
                            Sign Up
                        </v-btn>
                        <!-- Error Message -->
                        <v-row v-if="authStore.error">
                            <v-col>
                                <v-alert type="error" dismissible>
                                    {{ authStore.error }}
                                </v-alert>
                            </v-col>
                        </v-row>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script setup>
import { ref } from 'vue'
import { useAuthStore } from '../stores/auth'
import { useRouter } from 'vue-router'

// Reactive state variables
const formRef = ref(null)
const valid = ref(false)
const accountType = ref('')
const firstname = ref('')
const lastname = ref('')
const username = ref('')
const email = ref('')
const password = ref('')
const confirmPassword = ref('')
const showPassword = ref(false)
const showConfirmPassword = ref(false)
const accountTypes = ref(['Developer', 'Project Owner'])

// Store for validation rules
const rules = {
    required: value => !!value || 'This field is required',
    email: value => /.+@.+\..+/.test(value) || 'E-mail must be valid',
    minLength: min => value =>
        value.length >= min || `Must be at least ${min} characters`,
    matchPassword: value => value === password.value || 'Passwords must match',
}

// Authentication store
const authStore = useAuthStore()

// Router instance
const router = useRouter()

// Submit method for form submission
const submit = async () => {
    const isValid = await formRef.value?.validate()
    if (isValid) {
        if (authStore) {
            try {
                await authStore.actionRegisterNewUser({
                    email: email.value,
                    firstname: firstname.value,
                    lastname: lastname.value,
                    password: password.value,
                    type: accountType.value,
                    username: username.value,
                })

                if (authStore.error) return

                router.push({ name: 'Login' })
            } catch (err) {
                console.error('Registration failed:', err)
            }
        } else {
            alert('Registration not possible. Try again later...')
        }
    }
}

// Cancel method to reset the form
const cancel = () => {
    accountType.value = ''
    firstname.value = ''
    lastname.value = ''
    username.value = ''
    email.value = ''
    password.value = ''
    confirmPassword.value = ''
    formRef.value?.resetValidation()
}
</script>
