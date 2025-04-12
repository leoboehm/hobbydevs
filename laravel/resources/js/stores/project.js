import { defineStore } from 'pinia'
import apiClient from '../services/axios'

export const useProjectStore = defineStore('projectStore', {
    state: () => ({
        error: null,
    }),
    actions: {
        // Apply for project
        async actionApplyForProject(applicationData) {
            try {
                await apiClient.post('/apply', applicationData)
            } catch (error) {
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred during application submission'
            }
        },
        // Publish project
        async actionPublishProject(projectData) {
            try {
                await apiClient.post('/project', projectData)
            } catch (error) {
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred during project publishment'
            }
        },
        // Get project list
        async actionGetAllProjects() {
            try {
                let projects = await apiClient.get('/project')
                return projects
            } catch (error) {
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred during fetching of project list'
                return null
            }
        },
        // Get project by ID
        async actionGetProjectByID(id) {
            try {
              const project = await apiClient.get(`/project/${id}`)
              console.log('Project data:', project) // Log project data
              return project
            } catch (error) {
              console.error('Error fetching project by ID:', error) // Log error
              this.error = error.response
                ? error.response.data.message
                : `An error occurred during fetching of project with ID: ${id}`
              return null
            }
          },                   
    },
})
