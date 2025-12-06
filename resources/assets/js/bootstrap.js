import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import '../vendor/bootstrap/dist/js/bootstrap.bundle.min.js';
import './dark.js';



import './functions.js';

import.meta.glob(['../assets/images/**',]);