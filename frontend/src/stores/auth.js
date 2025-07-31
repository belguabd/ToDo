import { defineStore } from 'pinia'
import api from '@/lib/api'
import router from '@/router'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        user: null,
        token: localStorage.getItem('auth_token'),
        isAuthenticated: !!localStorage.getItem('auth_token'),
        loading: false,
        error: null,
    }),

    actions: {
        async register(userData) {
            try {
                this.loading = true
                this.error = null

                const response = await api.post('/auth/register', userData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                })
                this.token = response.data.token
                this.user = response.data.user
                this.isAuthenticated = true

                localStorage.setItem('auth_token', this.token)

                return response.data
            } catch (error) {
                this.error = error.response?.data?.message || 'Registration failed'
                throw error
            } finally {
                this.loading = false
            }
        },

        async login(credentials) {
            try {
                this.loading = true
                this.error = null

                const response = await api.post('/auth/login', credentials)

                this.token = response.data.token
                this.user = response.data.user
                this.isAuthenticated = true

                localStorage.setItem('auth_token', this.token)

                return response.data
            } catch (error) {
                this.error = error.response?.data?.message || 'Login failed'
                throw error
            } finally {
                this.loading = false
            }
        },

        async logout() {
            try {
                if (this.token) {
                    await api.post('/auth/logout')
                }
            } catch (error) {
                console.error('Logout error:', error)
            } finally {
                this.token = null
                this.user = null
                this.isAuthenticated = false

                localStorage.removeItem('auth_token')
                router.push('/login')
            }
        },

        async fetchUser() {
            try {
                const response = await api.get('/auth/me')
                this.user = response.data
                return response.data
            } catch (error) {
                this.logout()
                throw error
            }
        },
    },
})