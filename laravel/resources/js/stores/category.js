import { defineStore } from 'pinia'
import apiClient from '../services/axios'

export const useCategoryStore = defineStore('category', {
    state: () => ({
        categories: [],
        loading: false,
    }),

    getters: {
        getCategories: state => state.categories,
        getCategoriesLoading: state => state.loading,
    },

    actions: {
        async fetchCategories() {
            this.loading = true
            try {
                const response = await apiClient.get('/category')

                if(response.data.length > 0) {
                    response.data.forEach(category => this.categories.push(category.name))
                }
            } catch (error) {
                console.error('Error while loading categories: ', error)
            } finally {
                this.loading = false
            }
        },
    },
})
