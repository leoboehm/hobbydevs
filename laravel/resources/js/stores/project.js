import { defineStore } from 'pinia'
import apiClient from '../services/axios'
import { useAuthStore } from './auth'

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
                const authStore = useAuthStore()

                projectData.id = authStore.getUser.id
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
                return projects.data
            } catch (error) {
                console.error(error)
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred during fetching of project list'
                return null
            }
        },
        // Get project list for specific user
        async actionGetProjectsByUser(owner_id) {
            try {
                const projects = await this.actionGetAllProjects()
                return projects.filter(item => item.owner_id == owner_id)
            } catch (error) {
                console.error(error)
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
                return project.data
            } catch (error) {
                console.error('Error fetching project by ID:', error) // Log error
                this.error = error.response
                    ? error.response.data.message
                    : `An error occurred during fetching of project with ID: ${id}`
                return null
            }
        },
        // Update project
        async actionUpdateProject(projectData) {
            try {
                const response = await apiClient.put(
                    `/project/${projectData.id}`,
                    projectData,
                )
                return response
            } catch (error) {
                console.error('Error updating project:', error)
                this.error =
                    error.response?.data?.message || 'Failed to update project.'
                throw error
            }
        },
    },
})
