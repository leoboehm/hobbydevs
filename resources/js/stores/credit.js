import { defineStore } from 'pinia'
import apiClient from '../services/axios'
import { useAuthStore } from './auth'

export const useCreditStore = defineStore('creditStore',  {
    state: () => ({
        credits: 0,
        loading: false,
    }),

    getters: {
        getCredits: state => state.credits,
        getCreditsLoading: state => state.loading,
    },

    actions: {
        async fetchCredits() {
                    this.loading = true
                    try {
                        const response = await apiClient.get('/credit')
        
                        return response.data;
                    } catch (error) {
                        console.error('Error while loading credits: ', error)
                    } finally {
                        this.loading = false
                    }
                },
        async transferCredits(recipientEmail, amount) {
            try {
                const response = await apiClient.post('/credits/transfer', {
                    recipient_email: recipientEmail,
                    amount: amount,
                });
                this.credits = response.data.credits;
                return response.data;
            } catch (error) {
                throw error;
            }
        },
        /*async fetchCredits() {
            try {
                const credits = await apiClient.get(`/credits`)
                return credits.data
            } catch (error) {
                console.error('Error fetching project by ID:', error) // Log error
                this.error = error.response
                    ? error.response.data.message
                    : `An error occurred during fetching of project with ID: ${id}`
                return null
            }
            const data = await res.json();
            console.log(data);
            this.credits = data.credits;
        },*/
    },
})