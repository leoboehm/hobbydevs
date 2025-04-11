<template>
    <v-container>
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
  
        <v-btn type="submit" color="primary">Update Project</v-btn>
      </v-form>
    </v-container>
  </template>
  
  <script>
  import { useProjectStore } from '@/stores/project'
  import { useRouter } from 'vue-router'
  
  export default {
    name: 'EditProjectView',
    data() {
      return {
        project: {
          title: '',
          description: '',
          category: '',
          salary_range: '',
          duration: '',
          // add any other fields you want to edit here
        },
        rules: {
          required: value => !!value || 'This field is required',
        }
      }
    },
    async created() {
      const projectId = this.$route.params.id
      try {
        const fetchedProject = await this.$store.dispatch('getProject', projectId)
        this.project = fetchedProject
      } catch (error) {
        console.error('Error fetching project:', error)
      }
    },
    methods: {
      async updateProject() {
        try {
          // Send updated data to your backend API
          await this.$store.dispatch('updateProject', this.project)
          this.$router.push(`/projects/${this.project.id}`)
        } catch (error) {
          console.error('Error updating project:', error)
        }
      }
    }
  }
  </script>
  