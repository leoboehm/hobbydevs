import { defineStore } from 'pinia'
import apiClient from '../services/axios'
import { useAuthStore } from './auth'

export const useProjectStore = defineStore('projectStore', {
    state: () => ({
        error: null,
    }),
    actions: {
        async applyToProject(applicationData) {
            try {
                await apiClient.post('/apply', applicationData)
            } catch (error) {
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred during application submission'
            }
        },

        async enlistProject(projectData) {
            try {
                const authStore = useAuthStore()

                projectData.owner_id = authStore.getUser.id
                await apiClient.post('/project', projectData)
            } catch (error) {
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred while saving the project'
            }
        },

        async fetchAllProjects() {
            try {
                let projects = await apiClient.get('/project')
                return projects.data.sort(function (a, b) {
                    const key1 = a.updated_at;
                    const key2 = b.updated_at;

                    if (key1 < key2) {
                        return 1;
                    } else if (key1 == key2) {
                        return 0;
                    } else {
                        return -1;
                    }
                });
            } catch (error) {
                console.error(error)
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred during fetching of project list'
                return null
            }
        },

        async fetchProjectsByUser(owner_id) {
            try {
                const projects = await this.fetchAllProjects()
                return projects.filter(item => item.owner_id == owner_id)
            } catch (error) {
                console.error(error)
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred during fetching of project list'
                return null
            }
        },

        async fetchProjectByID(id) {
            try {
                const project = await apiClient.get(`/project/${id}`)
                return project.data
            } catch (error) {
                console.error('Error fetching project by ID:', error)
                this.error = error.response
                    ? error.response.data.message
                    : `An error occurred during fetching of project with ID: ${id}`
                return null
            }
        },

        async updateProject(projectData) {
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
