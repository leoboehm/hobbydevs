import { defineStore } from 'pinia'
import axios from '@/services/axios'  // Adjust according to your axios setup

export const useProfileStore = defineStore('profileStore', {
  state: () => ({
    user: null,
  }),

  actions: {
    async updateUser(userData) {
      try {
        // Retrieve token from localStorage or Vuex store
        const token = localStorage.getItem('auth_token')  // Adjust according to your token storage method

        if (!token) {
          throw new Error('No token found')
        }

        // Send the request with the Authorization header
        const res = await axios.put('/user', userData, {
          headers: {
            Authorization: `Bearer ${token}`,  // Attach token to the request
          },
        })
        return res.data
      } catch (error) {
        console.error('Failed to update profile:', error)
        throw error  // Re-throw error to handle it in the component
      }
    },
  },
})
