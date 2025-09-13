import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// In development, Vite proxy will handle the requests
// In production, requests go directly to the same origin
if (import.meta.env.DEV) {
    // Development: use relative URLs, Vite proxy will handle them
    window.axios.defaults.baseURL = '';
} else {
    // Production: use the same origin
    window.axios.defaults.baseURL = window.location.origin;
}
window.axios.defaults.withCredentials = true;
