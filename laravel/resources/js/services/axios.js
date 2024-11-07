import axios from 'axios'

// Fetch and set the CSRF token as a default header for future requests
async function fetchCsrfToken() {
    await axios.get('/sanctum/csrf-cookie')
}

await fetchCsrfToken()

const apiClient = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        Accept: 'application/json',
    },
    withCredentials: true,
})

export default apiClient
