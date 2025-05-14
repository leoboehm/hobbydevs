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

            <v-tabs
                v-model="activeTab"
                background-color="grey lighten-4"
                centered
            >
                <v-tab value="one">Profile Info</v-tab>
                <v-tab value="two">Applications</v-tab>
            </v-tabs>

            <v-tabs-window v-model="activeTab">
                <!-- Profile Info Tab -->
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
                        <v-btn text color="red" @click="cancelEdit"
                            >Cancel</v-btn
                        >
                        <v-btn
                            color="green"
                            @click="saveEdit"
                            :disabled="!valid"
                            >Save</v-btn
                        >
                    </v-card-actions>
                </v-tabs-window-item>

                <!-- Applications Tab -->
                <v-tabs-window-item value="two">
                    <v-card-text>
                        <div v-if="!profileStore.getApplications.length">
                            No applications found.
                        </div>
                        <v-list two-line v-else>
                            <v-list-item
                                v-for="app in profileStore.getApplications"
                                :key="app.id"
                            >
                                <div v-if="authStore.getUserIsDeveloper">
                                    <v-list-item-title>{{
                                        app.project.title
                                    }}</v-list-item-title>
                                    <v-list-item-subtitle>
                                        Status: {{ app.status }}
                                    </v-list-item-subtitle>
                                </div>
                                <div
                                    v-else-if="authStore.getUserIsProjectOwner"
                                >
                                    <v-list-item-title>
                                        {{ app.user.firstname }}
                                        {{ app.user.lastname }} applied to your project "{{
                                            app.project.title
                                        }}"
                                    </v-list-item-title>
                                    <v-list-item-subtitle
                                        >Status:
                                        {{ app.status }}</v-list-item-subtitle
                                    >
                                </div>
                            </v-list-item>
                        </v-list>
                    </v-card-text>
                </v-tabs-window-item>
            </v-tabs-window>
        </v-card>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useProfileStore } from '@/stores/profile'

const authStore = useAuthStore()
const profileStore = useProfileStore()

const activeTab = ref('one')
const editMode = ref(false)
const valid = ref(false)
const formRef = ref(null)

const originalUser = ref(null)
const userData = ref({
    firstname: '',
    lastname: '',
    username: '',
    email: '',
})

const rules = {
    required: v => !!v || 'This field is required',
    email: v => /.+@.+\..+/.test(v) || 'Invalid email',
}

const loadUser = () => {
    const user = authStore.getUser
    originalUser.value = { ...user }
    userData.value = { ...user }
}

const cancelEdit = () => {
    userData.value = { ...originalUser.value }
    editMode.value = false
    formRef.value?.resetValidation()
}

const saveEdit = async () => {
    if (formRef.value?.validate()) {
        try {
            const updatedUser = await profileStore.updateUser(userData.value)
            authStore.setUser(updatedUser)
            originalUser.value = { ...updatedUser }
            editMode.value = false
            alert('Profile updated successfully!')
        } catch (error) {
            console.error('Failed to update profile:', error)
            alert('Something went wrong while saving.')
        }
    }
}

onMounted(async () => {
    loadUser()
    await profileStore.loadApplications()
})
</script>

<style scoped>
.v-card-title {
    align-items: center;
}
</style>
