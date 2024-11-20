import { defineStore } from 'pinia'
import apiClient from '../services/axios'

export const useProjectStore = defineStore('projectStore', {
    state: () => ({
        user: null,
        error: null,
    }),
    actions: {
        // Apply for project
        async applyForProject(applicationData) {
            try {
                await apiClient.post('/apply', applicationData)
            } catch (error) {
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred during application submission'
            }
        },
        // Publish project
        async publishProject(projectData) {
            try {
                await apiClient.post('/publish', projectData)
            } catch (error) {
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred during project publishment'
            }
        }
    },
})
