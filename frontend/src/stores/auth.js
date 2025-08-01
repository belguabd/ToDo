// stores/auth.js
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
        echo: null, // Add echo instance to state
        initialized: false,
    }),

    getters: {

    },

    actions: {


        async initAuth() {
            console.log("user : ", this.user);
            if (this.initialized) return // Prevent multiple initializations

            this.loading = true
            console.log('Initializing authentication...')

            try {
                const token = localStorage.getItem('auth_token')

                if (token) {
                    // Token exists, validate it and fetch user data
                    this.token = token
                    await this.fetchUser()
                    this.isAuthenticated = true
                    console.log('User authenticated from stored token:', this.user)
                } else {
                    // No token, user is not authenticated
                    this.isAuthenticated = false
                    this.user = null
                    console.log('No token found, user not authenticated')
                }
            } catch (error) {
                console.error('Auth initialization failed:', error)
                // Token is invalid, clear it
                this.logout()
            } finally {
                this.loading = false
                this.initialized = true
                console.log('Auth initialization complete. Authenticated:', this.isAuthenticated)
            }
        },

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

                // Initialize Echo after successful login


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
                // Destroy Echo connection before clearing auth data


                this.token = null
                this.user = null
                this.isAuthenticated = false
                this.echo = null

                localStorage.removeItem('auth_token')
                router.push('/login')
            }
        },

        async fetchUser() {
            try {
                const response = await api.get('/auth/me')
                this.user = response.data.user || response.data
                return this.user
            } catch (error) {
                this.logout()
                throw error
            }
        },




    },
})