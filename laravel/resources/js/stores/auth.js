import { defineStore } from 'pinia'
import apiClient from '../services/axios'

export const useAuthStore = defineStore('authStore', {
    state: () => ({
        user: null,
        error: null,
    }),
    actions: {
        // register new user
        async actionRegisterNewUser(userData) {
            try {
                const response = await apiClient.post('/register', userData)
            } catch (error) {
                this.error = error.response
                    ? error.response.data.message
                    : 'An error occurred'
            }
        },
        // login user
        async login(email, password) {
          try {
            await axios.post('/api/login', { email, password });
            this.user = { email };
          } catch (error) {
            console.error('Login failed', error);
          }
        },
        // logout user
        async logout() {
          try {
            await axios.post('/api/logout');
            this.user = null;
          } catch (error) {
            console.error('Logout failed', error);
          }
        },
    },
})