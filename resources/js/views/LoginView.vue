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
              <span class="font-weight-bold">New to the platform?</span></v-col>
            <v-col class="text-center" cols="1">
              <v-icon large color="primary">mdi-account-plus</v-icon>
            </v-col>
            <v-col class="text-center" cols="7">
              <span>Create an account to enjoy all features and get started!</span>
            </v-col>
            <v-col class="text-center" cols="12">
              <v-btn color="primary" to="/signup" dark rounded elevation="2" width="200">
                Sign Up Now
              </v-btn></v-col>
          </v-row>
          <v-card-text>
            <v-form ref="form" v-model="valid" lazy-validation>
              <!-- Email -->
              <v-text-field v-model="email" :rules="[rules.required, rules.email]" label="Email" outlined
                required></v-text-field>

              <!-- Password -->
              <v-text-field v-model="password" :rules="[rules.required]"
                :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'" :type="showPassword ? 'text' : 'password'"
                @click:append="showPassword = !showPassword" label="Password" outlined required></v-text-field>
            </v-form>
          </v-card-text>

          <v-row v-if="authStore.error">
            <v-col>
              <v-alert type="error" dismissible>
                {{ authStore.error }}
              </v-alert>
            </v-col>
          </v-row>
          <v-card-actions class="justify-end mb-2">
            <v-btn text color="red" @click="cancel" class="mr-4">
              Cancel
            </v-btn>

            <v-btn color="primary" @click="submit" :disabled="!valid">
              Login
            </v-btn>
            <!-- Error Message -->
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { rules } from '@/utils/rules'

// Reactive state
const router = useRouter()
const authStore = useAuthStore()

const valid = ref(false)
const email = ref('')
const password = ref('')
const showPassword = ref(false)
const form = ref(null)

// Methods
async function submit() {
  if (form.value?.validate()) {
    try {
      await authStore.login({
        email: email.value,
        password: password.value,
      })

      if (authStore.error) return

      router.push({ name: 'Profile' })
    } catch (err) {
      console.error('Login failed:', err)
    }
  }
}

function cancel() {
  email.value = ''
  password.value = ''
  form.value?.resetValidation()
}
</script>

<style scoped>
.v-alert {
  border-radius: 8px;
  padding: 10px;
}
</style>
