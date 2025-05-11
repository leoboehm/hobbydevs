import { defineStore } from 'pinia'
import apiClient from '@/services/axios'

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

        async fetchSentApplications() {
            try {
                const response = await apiClient.get('/applications/sent')
                this.applications = response.data
            } catch (err) {
                console.error('Failed to fetch sent applications', err)
            }
        },

        async fetchReceivedApplications() {
            try {
                const response = await apiClient.get('/applications/received')
                this.applications = response.data
            } catch (err) {
                console.error('Failed to fetch received applications', err)
            }
        },
    },
})
