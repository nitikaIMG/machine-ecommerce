import axios from 'axios';
import { getAuthToken } from './cookie';

const request = axios.create({
  baseURL: process.env.MIX_APP_REST_API_URL,
  timeout: 30000,
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'Accept-Language': 'en-IN'
  },
});

request.interceptors.request.use(
  (config) => {
    const token = getAuthToken();
    config.headers = {
      ...config.headers,
      Authorization: `Bearer ${token ? token : ''}`,
    };
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

export default request;
