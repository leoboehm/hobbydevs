import { defineStore } from 'pinia'
import apiClient from '../services/axios'

export const useAuthStore = defineStore('authStore', {
    state: () => ({
        user: null,
        error: null,
    }),
    actions: {
        async actionRegisterNewUser(userData) {
            try {
                const response = await apiClient.post('/register', userData)
            } catch (error) {
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred'
            }
        },
    },
})
