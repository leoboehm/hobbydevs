<template>
  <v-container>
    <h1>Edit Project</h1>

    <v-form @submit.prevent="updateProject">
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

      <v-btn type="submit" color="primary" class="mr-2">Save Changes</v-btn>
      <v-btn color="grey" @click="cancelEdit">Cancel</v-btn>
    </v-form>

    <v-alert type="error" v-if="errorMessage" class="mt-4">
      {{ errorMessage }}
    </v-alert>
  </v-container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useProjectStore } from '@/stores/project'

const router = useRouter()
const route = useRoute()
const store = useProjectStore()

const project = ref({
  id: '',
  title: '',
  description: '',
  category: '',
  salary_range: '',
  duration: ''
})

const errorMessage = ref(null)
const successMessage = ref(null)
const isLoading = ref(false)

const rules = {
  required: value => !!value || 'This field is required',
}

// Fetch project data on mount
const fetchProject = async () => {
  const id = route.params.id
  try {
    const res = await store.actionGetProjectByID(id)
    console.log('Fetched project:', res.data)

    if (res && res.data) {
      project.value = res.data.project || res.data
    } else {
      errorMessage.value = 'No project data found.'
    }
  } catch (error) {
    console.error('Error fetching project:', error)
    errorMessage.value = 'Error fetching project data.'
  }
}

onMounted(() => {
  fetchProject()
})

// Submit updated project
const updateProject = async () => {
  isLoading.value = true

  const payload = {
    title: project.value.title,
    description: project.value.description,
    category: project.value.category,
    salary_range: project.value.salary_range,
    duration: project.value.duration
  }

  try {
    const response = await store.actionUpdateProject(project.value.id, payload)
    console.log('Update success:', response)
    successMessage.value = 'Project updated successfully!'
    router.push(`/projects/${project.value.id}`)
  } catch (error) {
    console.error('Update failed:', error)
    errorMessage.value = error.response?.data?.message || 'Failed to update project.'
  } finally {
    isLoading.value = false
  }
}

// Cancel and go back
const cancelEdit = () => {
  router.back()
}
</script>
