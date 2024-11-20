import axios from 'axios'

// Fetch and set the CSRF token as a default header for future requests
async function fetchCsrfToken() {
    await axios.get('/sanctum/csrf-cookie')
}

const apiClient = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        Accept: 'application/json',
    },
    withCredentials: true,
})

apiClient.interceptors.response.use(
    response => response.data, // Return response data as usual
    error => {
      if (error.response && error.response.status === 419) {
        // If the CSRF token has expired (419 error), reload the page
        window.location.reload();
      }
      return Promise.reject(error); // Reject the error as usual
    }
  );
  
// Fetch CSRF token before making requests
fetchCsrfToken().then(() => {
    // Once the CSRF token is fetched, set the header
    apiClient.defaults.headers['X-CSRF-TOKEN'] = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute('content')
})


export default apiClient
