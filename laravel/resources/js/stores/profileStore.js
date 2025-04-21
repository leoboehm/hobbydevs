import { defineStore } from 'pinia'
import axios from '@/services/axios'

export const useProfileStore = defineStore('profileStore', {
  state: () => ({
    user: null,
  }),

  actions: {
    async updateUser(userData) {
      try {
        const res = await axios.put('/user', userData)
        return res.data
      } catch (error) {
        console.error('Failed to update profile:', error)
        throw error
      }
    },
  },
})
