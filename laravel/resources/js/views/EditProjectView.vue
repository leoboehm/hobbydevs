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
  duration: ''
})

const errorMessage = ref(null)

const rules = {
  required: value => !!value || 'This field is required',
}

const fetchProject = async () => {
  const id = route.params.id
  try {
    const res = await store.actionGetProjectByID(id)
    console.log('Fetched project:', res) // Log the response to inspect the data
    if (res && res.data) {
      project.value = res.data
    } else {
      errorMessage.value = 'Failed to load project data. No data returned.'
    }
  } catch (error) {
    console.error('Error fetching project:', error) // Log the error
    errorMessage.value = 'Error fetching project data.'
  }
}



const updateProject = async () => {
  try {
    await apiClient.put(`/project/${project.value.id}`, project.value)
    router.push(`/projects/${project.value.id}`)
  } catch (error) {
    errorMessage.value = error.response?.data?.message || 'Failed to update project.'
  }
}

const cancelEdit = () => {
  router.push('/projects')
}

onMounted(() => {
  fetchProject()
})
</script>
