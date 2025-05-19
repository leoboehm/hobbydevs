import { defineStore } from 'pinia'
import apiClient from '../services/axios'

export const useDeveloperStore = defineStore('developer', {
    state: () => ({
    }),

    getters: {
    },

    actions: {
        async actionGetDevelopersList() {
            try {
                const response = await apiClient.get('/developers')
                return response.data
            } catch (error) {
                console.error('Error while loading developers: ', error)
            }
        },
    },
})
