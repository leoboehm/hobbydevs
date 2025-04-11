import axios from 'axios'
import Cookies from 'js-cookie'

const apiClient = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        Accept: 'application/json',
    },
})

apiClient.defaults.withCredentials = true // allow sending cookies

// apiClient.interceptors.request.use(async config => {
//     if (config.method.toLowerCase() !== 'get') {
//         // await apiClient.get('/sanctum/csrf-cookie').then()
//         // config.headers['X-XSRF-TOKEN'] = Cookies.get('XSRF-TOKEN')
//         await apiClient.get('/sanctum/csrf-cookie', { withCredentials: true })
//     }

//     return config
// })

// apiClient.interceptors.response.use(error => {
//     if (error.response?.status === 419) {
//         console.warn('CSRF token expired or missing')
//         // Optional: Refresh page or retry logic
//     }
//     return Promise.reject(error)
// })

// export async function initAuth() {
//     // Muss aufgerufen werden, bevor POST/PUT/DELETE ausgeführt werden
//     await apiClient.get('/sanctum/csrf-cookie', { withCredentials: true })
// }

export default apiClient
