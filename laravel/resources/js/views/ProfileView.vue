<template>

  <v-container class="py-10">
    <v-card elevation="2" class="pa-6" max-width="800" mx-auto>
      <v-card-title>
        <span class="text-h5 font-weight-medium">My Profile</span>
        <v-spacer />
        <v-btn color="primary" @click="editMode = true" v-if="!editMode">Edit</v-btn>
      </v-card-title>

      <v-divider class="my-4"></v-divider>

      <v-tabs v-model="activeTab" background-color="grey lighten-4" centered>
        <v-tab>Profile Info</v-tab>
        <v-tab>Applications</v-tab>
      </v-tabs>

      <v-tab-items v-model="activeTab">
        <!-- Profile Edit Tab -->
        <v-tab-item>
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
        </v-tab-item>

        <!-- Applications Tab -->
        <v-tab-item>
          <v-card-text>
            <div v-if="authStore.getUserIsDeveloper">

              <p><strong>Developer Applications</strong></p>
              <v-list two-line>
                <v-list-item v-for="app in applicationStore.applications" :key="app.id">
                  <v-list-item-content>
                    <v-list-item-title>{{ app.project.title }}</v-list-item-title>
                    <v-list-item-subtitle>Status: {{ app.status }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </div>
            <div v-else-if="authStore.getUserIsProjectOwner">
              <p><strong>Received Applications</strong></p>
              <v-list two-line>
                <v-list-item v-for="app in applicationStore.applications" :key="app.id">
                  <v-list-item-content>
                    <v-list-item-title>
                      {{ app.user.firstname }} {{ app.user.lastname }} applied to "{{ app.project.title }}"
                    </v-list-item-title>
                    <v-list-item-subtitle>Status: {{ app.status }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </div>
            <div v-else>
              <p>No applications available for this user.</p>
            </div>
          </v-card-text>
        </v-tab-item>
      </v-tab-items>
    </v-card>
  </v-container>
</template>

<script>
import { useAuthStore } from '@/stores/auth'
import { useApplicationStore } from '@/stores/applicationStore'
import { useProfileStore } from '@/stores/profileStore'

import { onMounted } from 'vue'

export default {
  name: 'ProfileView',

  setup() {
    const authStore = useAuthStore()
    const applicationStore = useApplicationStore()
    const profileStore = useProfileStore()

    const loadApplications = async () => {
      if (authStore.getUserIsDeveloper) {
        await applicationStore.fetchSentApplications()
      } else if (authStore.getUserIsProjectOwner) {
        await applicationStore.fetchReceivedApplications()
      }
    }

    onMounted(() => {
      loadApplications()
    })

    return {
      authStore,
      applicationStore,
      profileStore,
    }
  },

  data() {
    return {
      activeTab: 0,
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
      const updatedUser = await this.profileStore.updateUser(this.userData)
      this.authStore.setUser(updatedUser)
      this.originalUser = { ...updatedUser }
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