<template>
    <v-container v-if="project">
        <h1 v-if="!editMode" class="d-flex justify-space-between align-center">
            {{ project.title }}
            <v-btn
                color="primary"
                @click="editMode = true"
                v-if="!editMode && isOwner"
            >
                <v-icon left class="mr-2">mdi-pencil</v-icon>Edit
            </v-btn>
        </h1>

        <v-divider class="my-4"></v-divider>

        <v-form ref="formRef" v-model="valid" lazy-validation>
            <v-text-field
                v-if="editMode"
                v-model="projectData.title"
                label="Title"
                :rules="[rules.required]"
                outlined
                dense
            ></v-text-field>

            <v-textarea
                v-model="projectData.description"
                label="Description"
                :rules="[rules.required]"
                :readonly="!editMode"
                outlined
                dense
            ></v-textarea>

            <v-select
                v-model="projectData.category"
                :items="categories"
                label="Category"
                outlined
                dense
                required
                :rules="[rules.required]"
                :readonly="!editMode"
            ></v-select>

            <v-select
                v-model="projectData.skills"
                :items="skills"
                label="Skills"
                outlined
                dense
                multiple
                required
                chips
                :rules="[rules.required]"
                :readonly="!editMode"
            ></v-select>

            <v-text-field
                v-model="projectData.salary_range"
                label="Salary Range"
                :rules="[rules.required]"
                :readonly="!editMode"
                outlined
                dense
            ></v-text-field>

            <v-text-field
                v-model="projectData.duration"
                label="Duration"
                :rules="[rules.required]"
                :readonly="!editMode"
                outlined
                dense
            ></v-text-field>

            <!-- <v-row dense>
                <v-col cols="5" class="mr-8">
                    <DatePicker
                        v-model="projectData.start_date"
                        label="Start Date"
                        :min="today"
                    />
                </v-col>
                <v-col cols="5">
                    <DatePicker
                        v-model="projectData.deadline"
                        label="Deadline"
                        :min="projectData.start_date"
                    />
                </v-col>
            </v-row>

            <v-row dense>
                <v-col cols="5" class="mr-8">
                    <DatePicker
                        v-model="projectData.application_start_date"
                        label="Start Date"
                        :min="project.start_date"
                    />
                </v-col>
                <v-col cols="5">
                    <DatePicker
                        v-model="projectData.application_deadline"
                        label="End Date"
                        :min="projectData.application_start_date"
                    />
                </v-col>
            </v-row> -->
        </v-form>

        <v-row v-if="editMode">
            <v-spacer />
            <v-btn text color="red" @click="cancelEdit">Cancel</v-btn>
            <v-btn color="green" @click="saveEdit" :disabled="!valid"
                >Save</v-btn
            >
        </v-row>

        <v-alert type="error" v-if="errorMessage" class="mt-4">
            {{ errorMessage }}
        </v-alert>
    </v-container>

    <div v-else>
        <p>Loading...</p>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useDate } from 'vuetify'
import { useProjectStore } from '@/stores/project'
import { useAuthStore } from '@/stores/auth'
import { useCategoryStore } from '../stores/category'
import { useSkillStore } from '../stores/skill'

import DatePicker from '../components/DatePicker.vue'

const router = useRouter()
const route = useRoute()
const projectStore = useProjectStore()
const authStore = useAuthStore()
const categoryStore = useCategoryStore()
const skillStore = useSkillStore()

const date = useDate()

// Reactive references
const editMode = ref(false)
const valid = ref(false)
const formRef = ref(null)

const isOwner = ref(false)
const project = ref(null)
const projectData = ref({
    title: '',
    description: '',
    category: '',
    salary_range: '',
    duration: '',
    skills: [],
    start_date: '',
    deadline: '',
    application_start_date: '',
    application_deadline: '',
})

const categories = ref([])
const skills = ref([])

const errorMessage = ref(null)

const rules = {
    required: v => !!v || 'This field is required',
}

// Fetch project data on mount
const fetchProject = async () => {
    try {
        const projectResponse = await projectStore.actionGetProjectByID(
            route.params.id,
        )

        project.value = { ...projectResponse }
        projectData.value = { ...projectResponse }

        isOwner.value = authStore.getUser.id == project.value.id
    } catch (error) {
        console.error('Error fetching project:', error)
        errorMessage.value = 'Error fetching project data.'
    }
}

onMounted(async () => {
    await fetchProject()

    await categoryStore.fetchCategories()
    if (!categoryStore.getCategoriesLoading) {
        categories.value = categoryStore.getCategories
    }

    await skillStore.fetchSkills()
    if (!skillStore.getSkillsLoading) {
        skills.value = skillStore.getSkills
    }
})

// Submit updated project
const saveEdit = async () => {
    if (formRef.value?.validate()) {
        try {
            await projectStore.actionUpdateProject(projectData.value)
            router.go()
        } catch (error) {
            console.error('Update failed:', error)
            errorMessage.value =
                error.response?.data?.message || 'Failed to update project.'
        }
    }
}

// Cancel and go back
const cancelEdit = () => {
    projectData.value = { ...project.value }
    editMode.value = false
    formRef.value?.resetValidation()
}

// Computed
const today = new Date()
</script>
