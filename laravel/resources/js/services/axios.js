import axios from 'axios'

const apiClient = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        Accept: 'application/json',
    },
})

apiClient.defaults.withCredentials = true // allow sending cookies

export default apiClient
