export default function ({ $axios }) {
  $axios.defaults.baseURL = 'http://localhost/api/v1';
}