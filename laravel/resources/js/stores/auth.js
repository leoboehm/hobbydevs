import { defineStore } from 'pinia'
import apiClient from '../services/axios'

export const useAuthStore = defineStore('authStore', {
    state: () => ({
        user: null,
        error: null,
    }),
    getters: {
        getUserLoggedIn: state => (state.user == null ? false : true),
    },
    actions: {
        // register new user
        async actionRegisterNewUser(userData) {
            try {
                await apiClient.post('/register', userData)
            } catch (error) {
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred'
            }
        },
        // login user
        async actionLogin(credentials) {
            try {
                await apiClient.post('/login', credentials)
                this.user = credentials.email
            } catch (error) {
                console.error('Login failed', error)
            }
        },
        // logout user
        async actionLogout() {
            try {
                await apiClient.post('/logout')
                this.user = null
            } catch (error) {
                console.error('Logout failed', error)
            }
        },
    },
})
