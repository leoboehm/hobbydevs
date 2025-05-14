import { defineStore } from 'pinia'
import apiClient from '@/services/axios'

import { useAuthStore } from './auth'
import { useProjectStore } from './project'

export const useProfileStore = defineStore('profileStore', {
    state: () => ({
        applications: [],
    }),

    getters: {
        getApplications: state => state.applications,
    },

    actions: {
        async updateUser(userData) {
            try {
                const res = await apiClient.put('/user', userData)
                return res.data
            } catch (error) {
                console.error('Failed to update profile:', error)
                throw error
            }
        },

        async loadApplications() {
            const authStore = useAuthStore()
            const projectStore = useProjectStore()

            if (authStore.getUserIsDeveloper) {
                try {
                    var response = await apiClient.get(
                        '/sent-applications/' + authStore.getUser.id,
                    )

                    for(let item in response.data) {
                        const project = await apiClient.get('/project/' + response.data[item].project_id)
                        response.data[item].project = project.data
                    }

                    this.applications = response.data
                } catch (err) {
                    console.error('Failed to fetch sent applications', err)
                }
            } else if (authStore.getUserIsProjectOwner) {
                try {
                    var response = await apiClient.get(
                        '/received-applications/' + authStore.getUser.id,
                    )
                    
                    for(let item in response.data) {
                        const project = await apiClient.get('/project/' + response.data[item].project_id)
                        response.data[item].project = project.data
                    }

                    this.applications = response.data
                } catch (err) {
                    console.error('Failed to fetch received applications', err)
                }
            }
        },
    },
})
