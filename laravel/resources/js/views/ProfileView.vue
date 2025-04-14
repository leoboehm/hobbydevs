<template>
    <v-container class="py-10">
      <v-card elevation="2" class="pa-6" max-width="800" mx-auto>
        <v-card-title>
          <span class="text-h5 font-weight-medium">My Profile</span>
          <v-spacer />
          <v-btn color="primary" @click="editMode = true" v-if="!editMode">Edit</v-btn>
        </v-card-title>
  
        <v-divider class="my-4"></v-divider>
  
        <v-card-text>
          <v-form ref="form" v-model="valid" lazy-validation>
            <v-text-field
              v-model="userData.firstname"
              label="First Name"
              :readonly="!editMode"
              :rules="[rules.required]"
              outlined
              dense
            />
            <v-text-field
              v-model="userData.lastname"
              label="Last Name"
              :readonly="!editMode"
              :rules="[rules.required]"
              outlined
              dense
            />
            <v-text-field
              v-model="userData.username"
              label="Username"
              :readonly="!editMode"
              :rules="[rules.required]"
              outlined
              dense
            />
            <v-text-field
              v-model="userData.email"
              label="Email"
              :readonly="!editMode"
              :rules="[rules.required, rules.email]"
              outlined
              dense
            />
          </v-form>
        </v-card-text>
  
        <v-card-actions v-if="editMode">
          <v-spacer />
          <v-btn text color="red" @click="cancelEdit">Cancel</v-btn>
          <v-btn color="green" @click="saveEdit" :disabled="!valid">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-container>
  </template>
  
  <script>
  import axios from '../services/axios'
  import { useAuthStore } from '@/stores/auth'
  
  export default {
    name: 'ProfileView',
    data() {
      return {
        editMode: false,
        valid: false,
        originalUser: null,
        userData: {
          firstname: '',
          lastname: '',
          username: '',
          email: '',
        },
        rules: {
          required: value => !!value || 'This field is required',
          email: value => /.+@.+\..+/.test(value) || 'Invalid email',
        },
      }
    },
    setup() {
      const authStore = useAuthStore()
      return { authStore }
    },
    mounted() {
      this.loadUser()
    },
    methods: {
      loadUser() {
        const user = this.authStore.user
        this.originalUser = { ...user }
        this.userData = { ...user }
      },
      cancelEdit() {
        this.userData = { ...this.originalUser }
        this.editMode = false
        this.$refs.form.resetValidation()
      },
      async saveEdit() {
        if (this.$refs.form.validate()) {
          try {
            const res = await axios.put('/user', this.userData)
            this.authStore.setUser(res.data) // update store
            this.originalUser = { ...res.data }
            this.editMode = false
            alert('Profile updated successfully!')
          } catch (error) {
            console.error('Failed to update profile:', error)
            alert('Something went wrong while saving.')
          }
        }
      },
    },
  }
  </script>
  
  <style scoped>
  .v-card-title {
    align-items: center;
  }
  </style>
  