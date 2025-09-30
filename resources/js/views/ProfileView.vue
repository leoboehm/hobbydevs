<template>
    <v-container class="py-10">
        <v-card elevation="2" class="pa-6" max-width="800" mx-auto>
            <v-card-title class="d-flex justify-space-between align-center">
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
                <v-tab value="three" v-if="authStore.getUserIsProjectOwner"
                    >Your Projects</v-tab
                >
                <v-tab value="four">Credit</v-tab>
            </v-tabs>

            <v-tabs-window v-model="activeTab">
                <!-- Profile Info Tab -->
                <v-tabs-window-item value="one">
                    <v-card-text>
                        <v-form ref="formRef" v-model="valid" lazy-validation>
                            <v-row dense>
                                <v-col cols="6">
                                    <v-text-field
                                        v-model="userData.firstname"
                                        label="First Name"
                                        :readonly="!editMode"
                                        :rules="[rules.required]"
                                        outlined
                                        dense
                                /></v-col>
                                <v-col cols="6">
                                    <v-text-field
                                        v-model="userData.lastname"
                                        label="Last Name"
                                        :readonly="!editMode"
                                        :rules="[rules.required]"
                                        outlined
                                        dense /></v-col
                            ></v-row>
                            <v-row dense>
                                <v-col cols="6">
                                    <v-text-field
                                        v-model="userData.username"
                                        label="Username"
                                        :readonly="!editMode"
                                        :rules="[rules.required]"
                                        outlined
                                        dense
                                /></v-col>
                                <v-col cols="6">
                                    <v-text-field
                                        v-model="userData.email"
                                        label="Email"
                                        disabled
                                        outlined
                                        dense
                                /></v-col>
                            </v-row>
                            <template v-if="authStore.getUserIsDeveloper">
                                <v-textarea
                                    v-model="userData.bio"
                                    label="Bio"
                                    auto-grow
                                    rows="2"
                                    :readonly="!editMode"
                                    outlined
                                    dense
                                />
                                <v-text-field
                                    v-model="userData.experience"
                                    label="Past experience"
                                    :readonly="!editMode"
                                    outlined
                                    dense
                                />
                                <v-textarea
                                    v-model="userData.interests"
                                    label="Interests"
                                    auto-grow
                                    rows="1"
                                    :readonly="!editMode"
                                    outlined
                                    dense
                                />
                                <v-select
                                    v-model="userData.skills"
                                    :items="skills"
                                    label="Skills"
                                    outlined
                                    dense
                                    multiple
                                    chips
                                    :readonly="!editMode"
                                ></v-select>
                            </template>
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
                                <template v-if="authStore.getUserIsDeveloper">
                                    <v-list-item-title>{{
                                        app.project.title
                                    }}</v-list-item-title>
                                    <v-list-item-subtitle>
                                        Status: {{ app.status }}
                                    </v-list-item-subtitle>
                                </template>
                                <template
                                    v-else-if="authStore.getUserIsProjectOwner"
                                >
                                    <v-list-item-title>
                                        {{ app.user.firstname }}
                                        {{ app.user.lastname }} applied to your
                                        project "{{ app.project.title }}"
                                    </v-list-item-title>
                                    <v-list-item-subtitle
                                        >Status:
                                        {{ app.status }}</v-list-item-subtitle
                                    >
                                </template>
                                <v-btn
                                    @click="viewProjectDetail(app.project_id)"
                                    class="text-primary"
                                    outlined
                                    >Go to project
                                    <v-icon class="ml-2"
                                        >mdi-arrow-right</v-icon
                                    >
                                </v-btn>
                            </v-list-item>
                        </v-list>
                    </v-card-text>
                </v-tabs-window-item>

                <!-- Owned Projects Tab -->
                <v-tabs-window-item value="three">
                    <v-card-text>
                        <div v-if="!ownedProjects.length">
                            No projects so far.
                            <router-link to="/projects/post"
                                >Click here</router-link
                            >
                            to post your first project.
                        </div>
                        <v-row
                            dense
                            v-for="project in ownedProjects"
                            :key="project.id"
                        >
                            <v-col cols="12">
                                <v-card class="elevation-2">
                                    <v-card-title
                                        class="text-h6 font-weight-bold"
                                        >{{ project.title }}</v-card-title
                                    >
                                    <v-card-subtitle class="text-subtitle-2"
                                        >Category:
                                        {{ project.category }}</v-card-subtitle
                                    >

                                    <v-card-actions>
                                        <v-spacer />
                                        <v-btn
                                            @click="
                                                viewProjectDetail(project.id)
                                            "
                                            class="text-primary"
                                            outlined
                                            >Project detail
                                            <v-icon class="ml-2"
                                                >mdi-arrow-right</v-icon
                                            >
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-tabs-window-item>

                <!-- Available Credit Tab -->
                <v-tabs-window-item value="four">
                    <v-card-text>
                        <div>
                            <p class="text-h6 font-weight-bold">
                                Available credit: {{ userData.credits }}
                            </p>
                            <p>
                                You can use this credit to post projects and
                                hire developers.
                            </p>
                            <p class="text-h6 font-weight-bold">
                                Transfer credit
                            </p>
                            <p>
                                You can transfer credit to other users. Please
                                enter the email of the user you want to transfer
                                credit to.
                            </p>
                            <v-form ref="formRef" v-model="valid">
                                <v-text-field
                                    v-model="userData.transferEmail"
                                    label="Email"
                                    :rules="[rules.email]"
                                    outlined
                                    dense
                                />
                                <v-text-field
                                    v-model="userData.transferAmount"
                                    label="Amount"
                                    type="number"
                                    min="1"
                                    :rules="[rules.required]"
                                    outlined
                                    dense
                                />
                                <v-btn
                                    color="green"
                                    @click="transferCredit"
                                    :disabled="!valid"
                                    >Transfer</v-btn
                                >
                            </v-form>
                        </div>
                    </v-card-text>
                </v-tabs-window-item>
            </v-tabs-window>
        </v-card>
    </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'
import { useProfileStore } from '@/stores/profile'
import { useSkillStore } from '../stores/skill'
import { useProjectStore } from '../stores/project'
import { useCreditStore } from '../stores/credit'

const router = useRouter()
const authStore = useAuthStore()
const profileStore = useProfileStore()
const projectStore = useProjectStore()
const skillStore = useSkillStore()
const creditStore = useCreditStore()

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

const skills = ref([])

const ownedProjects = ref([])

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
            await profileStore.updateUser(userData.value)
            router.go()
        } catch (error) {
            console.error('Failed to update profile:', error)
            alert('Something went wrong while saving.')
        }
    }
}
const transferCredit = async () => {
    if (formRef.value?.validate()) {
        try {
            await creditStore.transferCredits(
                userData.value.transferEmail,
                userData.value.transferAmount,
            )
            alert('Credit transferred successfully.')
            userData.value.transferEmail = ''
            userData.value.transferAmount = ''
        } catch (error) {
            console.error('Failed to transfer credit:', error)
            alert('Something went wrong while transferring credit.')
        }
    }
}


const viewProjectDetail = id => {
    router.push({ name: 'ProjectDetail', params: { id } })
}

onMounted(async () => {
    loadUser()
    await profileStore.loadApplications()
    await creditStore.fetchCredits()

    ownedProjects.value = await projectStore.actionGetProjectsByUser(
        originalUser.value.id,
    )

    await skillStore.fetchSkills()
    if (!skillStore.getSkillsLoading) {
        skills.value = skillStore.getSkills
    }
})
</script>

<style scoped>
.v-card-title {
    align-items: center;
}
</style>
