<template>
    <nav class="bg-white shadow-sm border-b border-gray-200 fixed top-0 left-0 right-0 z-50">
      <div class="px-6 py-4">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div class="flex items-center space-x-3">
              <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
              </div>
              <h1 class="text-xl font-semibold text-gray-900">TaskFlow</h1>
            </div>
          </div>
  
          <div class="flex items-center space-x-4">
            <!-- Search -->
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </div>
              <input
                type="text"
                placeholder="Search tasks..."
                class="block w-64 pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
            </div>
  
            <!-- Notifications -->
            <button
              @click="toggleNotifications"
              class="relative p-2 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM12 18.5A2.5 2.5 0 1014.5 16H12v2.5zM9.8 21L12 18.8 14.2 21 12 23.2 9.8 21zM5 10a7 7 0 1114 0v6h1a1 1 0 011 1v1H3v-1a1 1 0 011-1h1v-6z"></path>
              </svg>
              <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                {{ unreadCount }}
              </span>
            </button>
  
            <!-- User Menu -->
            <div class="relative">
              <button
                @click="toggleUserMenu"
                class="flex items-center space-x-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg p-2"
              >
                <img
                  class="w-8 h-8 rounded-full"
                  :src="authStore.user?.avatar || '/api/placeholder/32/32'"
                  :alt="authStore.user?.name"
                >
                <span class="hidden md:block text-gray-700 font-medium">{{ authStore.user?.name }}</span>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>
  
              <!-- User Dropdown -->
              <div
                v-if="showUserMenu"
                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-1 z-50 border border-gray-200"
              >
                <router-link
                  to="/profile"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                  Your Profile
                </router-link>
                <router-link
                  to="/settings"
                  class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                  Settings
                </router-link>
                <div class="border-t border-gray-100"></div>
                <button
                  @click="logout"
                  class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                >
                  Sign out
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue'
  import { useAuthStore } from '@/stores/auth'
  import { useNotificationsStore } from '@/stores/notifications'
  
  const authStore = useAuthStore()
  const notificationsStore = useNotificationsStore()
  
  const showUserMenu = ref(false)
  const showNotifications = ref(false)
  
  const unreadCount = computed(() => {
    return notificationsStore.notifications.filter(n => !n.read).length
  })
  
  const toggleUserMenu = () => {
    showUserMenu.value = !showUserMenu.value
    showNotifications.value = false
  }
  
  const toggleNotifications = () => {
    showNotifications.value = !showNotifications.value
    showUserMenu.value = false
  }
  
  const logout = () => {
    authStore.logout()
    showUserMenu.value = false
  }
  
  // Close dropdowns when clicking outside
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.relative')) {
      showUserMenu.value = false
      showNotifications.value = false
    }
  })
  </script>