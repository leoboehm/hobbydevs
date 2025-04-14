import { defineStore } from 'pinia'
import apiClient from '../services/axios'

export const useAuthStore = defineStore('authStore', {
    state: () => ({
        user: null,
        error: null,
        isAuthenticated: false,
    }),
    getters: {
        getIsAuthenticated: state => state.isAuthenticated,
        getUser: state => state.user,
        getUserType: state => state.user ? state.user.type : null
    },
    actions: {
        async fetchUser() {
            try {
                const response = await apiClient.get('/user')

                if (response.status == 200) {
                    this.user = response.data
                    this.isAuthenticated = true
                }
            } catch (error) {
                this.user = null
                this.isAuthenticated = false
            }
        },
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
                const response = await apiClient.post('/login', credentials)

                if (response.status == 200) {
                    await this.fetchUser()

                    
                }
            } catch (error) {
                console.error('Login-Error:', error)
            }
        },
        // logout user
        async actionLogout() {
            try {
                // Make POST request for logout
                const response = await apiClient.post('/logout')

                if (response.status === 200) {
                    this.user = null
                    this.isAuthenticated = false
                }
            } catch (error) {
                console.error('Logout-Error:', error)
            }
        },
    },
})
