<template>
    <v-container class="py-10">
        <v-card elevation="2" class="pa-6" max-width="800" mx-auto>
            <v-card-title>
                <span class="text-h5 font-weight-medium">My Profile</span>
                <v-spacer />
                <v-btn
                    color="primary"
                    @click="editMode = true"
                    v-if="!editMode"
                >
                    <v-icon left class="mr-2">mdi-pencil</v-icon>Edit
                </v-btn>
            </v-card-title>

            <v-divider class="my-4"></v-divider>

            <v-tabs v-model="activeTab" background-color="grey lighten-4" centered>
                <v-tab value="one">Profile Info</v-tab>
                <v-tab value="two">Applications</v-tab>
            </v-tabs>

            <v-tabs-window v-model="activeTab">
                <!-- Profile Edit Tab -->
                <v-tabs-window-item value="one">
                    <v-card-text>
                        <v-form ref="formRef" v-model="valid" lazy-validation>
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
                        <v-btn
                            color="green"
                            @click="saveEdit"
                            :disabled="!valid"
                        >Save</v-btn>
                    </v-card-actions>
                </v-tabs-window-item>

                <!-- Applications Tab -->
                <v-tabs-window-item value="two">
                    <v-card-text>
                        <div v-if="authStore.getUserIsDeveloper">
                            <p><strong>Developer Applications</strong></p>
                            <v-list two-line>
                                <v-list-item
                                    v-for="app in applicationStore.applications"
                                    :key="app.id"
                                >
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
                                <v-list-item
                                    v-for="app in applicationStore.applications"
                                    :key="app.id"
                                >
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
                </v-tabs-window-item>
            </v-tabs-window>
        </v-card>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useApplicationStore } from '@/stores/applicationStore'
import { useProfileStore } from '@/stores/profileStore'

const authStore = useAuthStore()
const applicationStore = useApplicationStore()
const profileStore = useProfileStore()

const activeTab = ref('one')
const editMode = ref(false)
const valid = ref(false)
const originalUser = ref(null)
const formRef = ref(null)

const userData = ref({
    firstname: '',
    lastname: '',
    username: '',
    email: '',
})

const rules = {
    required: value => !!value || 'This field is required',
    email: value => /.+@.+\..+/.test(value) || 'Invalid email',
}

const loadUser = () => {
    const user = authStore.user
    if (user) {
        originalUser.value = { ...user }
        userData.value = { ...user }
        valid.value = true  // Mark the form as valid if data is loaded
    }
}

const loadApplications = async () => {
    if (authStore.getUserIsDeveloper) {
        await applicationStore.fetchSentApplications()
    } else if (authStore.getUserIsProjectOwner) {
        await applicationStore.fetchReceivedApplications()
    }
}

const cancelEdit = () => {
    userData.value = { ...originalUser.value }
    editMode.value = false
    formRef.value?.resetValidation()
}

const saveEdit = async () => {
  try {
    if (formRef.value?.validate()) {
      // Call the updateUser method from profileStore
      const updatedUser = await profileStore.updateUser(userData.value)
      authStore.setUser(updatedUser)  // Update the auth store with the new user data
      originalUser.value = { ...updatedUser }
      editMode.value = false
      alert('Profile updated successfully!')
    } else {
      alert('Please correct the errors before saving.')
    }
  } catch (error) {
    console.error('Failed to update profile:', error)

    // Check if the error has a response property, meaning it was from the Axios call
    if (error.response) {
      // Log detailed response error data
      console.error('Response error:', error.response)

      // Handle Unauthorized Error (401)
      if (error.response.status === 401) {
        console.error('Unauthorized access: Token may have expired.')
        alert('Session expired. Please log in again.')
        window.location.href = '/login'  // Redirect to login page if token is invalid
      } else if (error.response.status === 400) {
        // Handle Bad Request (400) - Invalid data sent to the server
        alert('Invalid data. Please check the entered information.')
      } else {
        alert(`Something went wrong while updating your profile: ${error.response.data.message || error.message}`)
      }
    } else {
      // Network-related or other errors that don't come from a response
      alert('Network error or no response from the server. Please try again later.')
    }
  }
}


onMounted(() => {
    loadUser()
    loadApplications()
})
</script>

<style scoped>
.v-card-title {
    align-items: center;
}
</style>
