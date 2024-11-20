import axios from 'axios'

// Fetch and set the CSRF token as a default header for future requests
async function fetchCsrfToken() {
    await axios.get('/sanctum/csrf-cookie')  // Ensure CSRF token is set in cookies
}

await fetchCsrfToken()

const apiClient = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        Accept: 'application/json',
    },
    withCredentials: true,
})

// Fetch CSRF token before making requests
fetchCsrfToken().then(() => {
    // Once the CSRF token is fetched, set the header
    apiClient.defaults.headers['X-CSRF-TOKEN'] = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content')
})


export default apiClient
