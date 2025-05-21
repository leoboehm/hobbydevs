import { defineStore } from 'pinia'
import apiClient from '../services/axios'

export const useAuthStore = defineStore('authStore', {
  state: () => ({
    user: null,
    error: null,
    isAuthenticated: false,
  }),

  getters: {
    getIsAuthenticated: (state) => state.isAuthenticated,
    getUser: (state) => state.user,
    getUserType: (state) => state.user?.type ?? null,
    getUserIsDeveloper: (state) => state.user?.type === 'Developer',
    getUserIsProjectOwner: (state) => state.user?.type === 'Project Owner',
  },

  actions: {
    async fetchUser() {
      try {
        const { data } = await apiClient.get('/user')
        this.user = data
        this.isAuthenticated = true
      } catch {
        this.user = null
        this.isAuthenticated = false
      }
    },

    setUser(updatedUser) {
      this.user = updatedUser
    },

    async actionRegisterNewUser(userData) {
      try {
        await apiClient.post('/register', userData)
      } catch (error) {
        this.error = error.response?.data?.message ??
          'An error occurred while registering. Please try again.'
      }
    },

    async actionLogin(credentials) {
      try {
        await apiClient.post('/login', credentials)
        await this.fetchUser()
      } catch (error) {
        console.error('Login-Error:', error)
      }
    },

    async actionLogout() {
      try {
        await apiClient.post('/logout')
        this.user = null
        this.isAuthenticated = false
      } catch (error) {
        console.error('Logout-Error:', error)
      }
    },
  },
})
