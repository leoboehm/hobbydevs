import { defineStore } from 'pinia'
import apiClient from '../services/axios'
import { webClient } from '../services/axios'

export const useAuthStore = defineStore('authStore', {
  state: () => ({
    user: null,
    error: null,
    isAuthenticated: false,
  }),

  getters: {
    getIsAuthenticated: state => state.isAuthenticated,
    getUser: state => state.user,
    getUserType: state => state.user?.type ?? null,
    getUserIsDeveloper: state => state.user?.type === 'Developer',
    getUserIsProjectOwner: state => state.user?.type === 'Project Owner',
  },

  actions: {
    async loadUserToStore() {
      try {
        const { data } = await webClient.get('/user')
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

    async login(credentials) {
      try {
        await webClient.get('/sanctum/csrf-cookie')
        await webClient.post('/login', credentials)
        await this.loadUserToStore()
      } catch (error) {
        this.error = error.response?.data?.message ??
          'No user found with these credentials. Please try again.'
        console.error('Login-Error:', error)
      }
    },

    async logout() {
      try {
        await webClient.post('/logout')
        this.user = null
        this.isAuthenticated = false
      } catch (error) {
        console.error('Logout-Error:', error)
      }
    },

    async registerUser(userData) {
      try {
        await apiClient.post('/user', userData)
      } catch (error) {
        this.error =
          error.response?.data?.message ??
          'An error occurred while registering. Please try again.'
      }
    },

    async updateUser(userData) {
      try {
        await apiClient.put('/user', userData)

        await this.loadUserToStore()
      } catch (error) {
        console.error('Failed to update user:', error)
        throw error
      }
    },

    async fetchUserById(id) {
      try {
        const response = await apiClient.get('/user/' + id)
        return response.data
      } catch (error) {
        console.error('Error while loading user: ', error)
      }
    }
  },
})
