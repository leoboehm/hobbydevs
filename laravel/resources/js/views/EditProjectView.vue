<template>
  <v-container>
    <h1>Edit Project</h1>

    <!-- Add validation on the form -->
    <v-form ref="formRef" v-model="formIsValid" @submit.prevent="updateProject">
      <v-text-field
        v-model="project.title"
        label="Title"
        :rules="[rules.required]"
      ></v-text-field>

      <v-textarea
        v-model="project.description"
        label="Description"
        :rules="[rules.required]"
      ></v-textarea>

      <v-text-field
        v-model="project.category"
        label="Category"
        :rules="[rules.required]"
      ></v-text-field>

      <v-text-field
        v-model="project.salary_range"
        label="Salary Range"
        :rules="[rules.required]"
      ></v-text-field>

      <v-text-field
        v-model="project.duration"
        label="Duration"
        :rules="[rules.required]"
      ></v-text-field>

      <!-- Skills input as an array -->
      <v-text-field
        v-model="skillsInput"
        label="Required Skills (comma separated)"
        :rules="[rules.required]"
        hint="Enter skills separated by commas."
      ></v-text-field>

      <!-- Start Date field -->
      <v-text-field
        v-model="project.start_date"
        label="Start Date"
        :rules="[rules.required]"
        type="date"
      ></v-text-field>

      <!-- Deadline field -->
      <v-text-field
        v-model="project.deadline"
        label="Deadline"
        :rules="[rules.required]"
        type="date"
      ></v-text-field>

      <!-- Buttons -->
      <v-btn :loading="isLoading" :disabled="isLoading" type="submit" color="primary" class="mr-2">Save Changes</v-btn>
      <v-btn color="grey" @click="cancelEdit">Cancel</v-btn>
    </v-form>

    <!-- Error Message -->
    <v-alert type="error" v-if="errorMessage" class="mt-4">
      {{ errorMessage }}
    </v-alert>

    <!-- Success Message -->
    <v-alert type="success" v-if="successMessage" class="mt-4">
      {{ successMessage }}
    </v-alert>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useProjectStore } from '@/stores/project'
import apiClient from '@/services/axios'

const router = useRouter()
const route = useRoute()
const store = useProjectStore()

const project = ref({
  id: '',
  title: '',
  description: '',
  category: '',
  salary_range: '',
  duration: '',
  skills: [],
  start_date: '',  // Add start date to the project object
  deadline: ''     // Add deadline to the project object
})

const skillsInput = ref('') // Skills input as comma-separated string

const errorMessage = ref(null)
const successMessage = ref(null)
const isLoading = ref(false)
const formIsValid = ref(false)

const rules = {
  required: value => !!value || 'This field is required',
}

const fetchProject = async () => {
  const id = route.params.id
  try {
    const res = await store.actionGetProjectByID(id)
    console.log('Fetched project:', res)
    if (res && res.data) {
      project.value = res.data
      // Handle skills input
      if (Array.isArray(project.value.skills)) {
        skillsInput.value = project.value.skills.join(', ')
      } else if (typeof project.value.skills === 'string') {
        skillsInput.value = project.value.skills
      }
    } else {
      errorMessage.value = 'Failed to load project data. No data returned.'
    }
  } catch (error) {
    console.error('Error fetching project:', error)
    errorMessage.value = 'Error fetching project data.'
  }
}

const updateProject = async () => {
  // Check form validity
  if (!formIsValid.value) {
    console.log('Form is invalid')
    return
  }

  isLoading.value = true

  // Convert comma-separated skills input into an array
  const skillsArray = skillsInput.value.split(',').map(skill => skill.trim())

  const payload = {
    title: project.value.title,
    description: project.value.description,
    category: project.value.category,
    salary_range: project.value.salary_range,
    duration: project.value.duration,
    skills: skillsArray, // Send skills as an array
    start_date: project.value.start_date, // Send the start date
    deadline: project.value.deadline, // Send the deadline
  }

  console.log('Sending API request with payload:', payload)

  try {
    const response = await apiClient.put(`/project/${project.value.id}`, payload)
    console.log('API response:', response)
    successMessage.value = 'Project updated successfully!'
    router.push(`/projects/${project.value.id}`)
  } catch (error) {
    console.error('API error:', error)
    errorMessage.value = error.response?.data?.message || 'Failed to update project.'
  } finally {
    isLoading.value = false
  }
}

const cancelEdit = () => {
  router.push('/projects')
}

onMounted(() => {
  fetchProject()
})
</script>

