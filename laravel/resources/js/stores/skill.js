import { defineStore } from 'pinia'
import apiClient from '../services/axios'

export const useSkillStore = defineStore('skill', {
    state: () => ({
        skills: [],
        loading: false,
    }),

    getters: {
        getSkills: state => state.skills,
        getSkillsLoading: state => state.loading,
    },

    actions: {
        async fetchSkills() {
            this.loading = true
            try {
                const response = await apiClient.get('/skill')

                if(response.data.length > 0) {
                    response.data.forEach(skill => this.skills.push(skill.name))
                }
            } catch (error) {
                console.error('Error while loading skills: ', error)
            } finally {
                this.loading = false
            }
        },
    },
})
