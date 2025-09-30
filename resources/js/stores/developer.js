import { defineStore } from 'pinia'
import apiClient from '../services/axios'

export const useDeveloperStore = defineStore('developer', {
    actions: {
        async actionGetDevelopersList() {
            try {
                const response = await apiClient.get('/developers')
                return response.data
            } catch (error) {
                console.error('Error while loading developers: ', error)
            }
        },
        async actionGetDeveloperById(id){
            try {
                const response = await apiClient.get('/developers/' + id)
                return response.data
            } catch (error) {
                console.error('Error while loading developer: ', error)
            }
        }
    },
})
