import { defineStore } from 'pinia'
import axios from '@/services/axios'

export const useApplicationStore = defineStore('applicationStore', {
  state: () => ({
    applications: [],
  }),

  getters: {
    getApplications: (state) => state.applications,
  },

  actions: {
    async fetchSentApplications() {
      try {
        const res = await axios.get('/sent-applications')
        this.applications = res.data
      } catch (err) {
        console.error('Failed to fetch sent applications', err)
      }
    },

    async fetchReceivedApplications() {
      try {
        const res = await axios.get('/received-applications')
        this.applications = res.data
      } catch (err) {
        console.error('Failed to fetch received applications', err)
      }
    },
  },
})
