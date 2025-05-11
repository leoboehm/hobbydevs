import { defineStore } from 'pinia'
import apiClient from '@/services/axios'

import { useAuthStore } from './auth'

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

            if (authStore.getUserIsDeveloper) {
                try {
                    const response = await apiClient.get(
                        '/sent-applications/' + authStore.getUser.id,
                    )
                    this.applications = response.data
                } catch (err) {
                    console.error('Failed to fetch sent applications', err)
                }
            } else if (authStore.getUserIsProjectOwner) {
                try {
                    const response = await apiClient.get(
                        '/received-applications/' + authStore.getUser.id,
                    )
                    this.applications = response.data
                } catch (err) {
                    console.error('Failed to fetch received applications', err)
                }
            }
        },
    },
})
