import axios from 'axios'

// Fetch and set the CSRF token as a default header for future requests
async function fetchCsrfToken() {
    const response = await axios.get('/sanctum/csrf-cookie')
    return response.data.csrf_token
}

fetchCsrfToken()

const apiClient = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': fetchCsrfToken(),
        Accept: 'application/json',
    },
    withCredentials: true,
})

export default apiClient
