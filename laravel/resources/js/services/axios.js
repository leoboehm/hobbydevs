import axios from 'axios'

const apiClient = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        Accept: 'application/json',
    },
    withCredentials: true,
})

// Optional: CSRF Error Interception
apiClient.interceptors.response.use(
    response => response.data,
    (config) => {
        const token = localStorage.getItem('auth_token');
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }
        return config;
    },
    error => {
        if (error.response?.status === 419) {
            console.warn('CSRF token expired or missing')
            // Optional: Refresh page or retry logic
        }
        return Promise.reject(error)
    }
)

export async function initAuth() {
    // Muss aufgerufen werden, bevor POST/PUT/DELETE ausgeführt werden
    await axios.get('/sanctum/csrf-cookie', { withCredentials: true })
}

export default apiClient
