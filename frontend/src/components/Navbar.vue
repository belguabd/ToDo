<template>
  <nav class="bg-white shadow-sm border-b border-gray-100 fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-8 py-4">
      <div class="flex items-center justify-between">
        <!-- Left side: Logo and Navigation -->
        <div class="flex items-center space-x-12">
          <!-- Logo -->
          <div class="flex items-center space-x-3">
            <div class="w-9 h-9 bg-gray-900 rounded-lg flex items-center justify-center">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
            </div>
            <h1 class="text-xl font-bold text-gray-900 tracking-tight">TaskFlow</h1>
          </div>

          <!-- Navigation Links -->
          <nav class="hidden lg:flex items-center space-x-1">
            <router-link
              to="/dashboard"
              class="relative px-4 py-2 text-sm font-medium transition-all duration-300 rounded-lg group"
              :class="$route.name === 'Dashboard' 
                ? 'text-gray-900' 
                : 'text-gray-500 hover:text-gray-900'"
            >
              <span class="relative z-10 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                </svg>
                <span>Dashboard</span>
              </span>
              <div 
                v-if="$route.name === 'Dashboard'"
                class="absolute bottom-0 left-0 right-0 h-0.5 bg-gray-900 rounded-full"
              ></div>
            </router-link>

            <router-link
              to="/tasks"
              class="relative px-4 py-2 text-sm font-medium transition-all duration-300 rounded-lg group"
              :class="$route.name === 'Tasks' 
                ? 'text-gray-900' 
                : 'text-gray-500 hover:text-gray-900'"
            >
              <span class="relative z-10 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span>Tasks</span>
                <span v-if="tasksStore.tasksCount > 0" class="ml-2 px-2 py-0.5 text-xs font-semibold text-gray-600 bg-gray-100 rounded-full">
                  {{ tasksStore.tasksCount }}
                </span>
              </span>
              <div 
                v-if="$route.name === 'Tasks'"
                class="absolute bottom-0 left-0 right-0 h-0.5 bg-gray-900 rounded-full"
              ></div>
            </router-link>

            <router-link
              to="/notifications"
              class="relative px-4 py-2 text-sm font-medium transition-all duration-300 rounded-lg group"
              :class="$route.name === 'Notifications' 
                ? 'text-gray-900' 
                : 'text-gray-500 hover:text-gray-900'"
            >
              <span class="relative z-10 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM5 12a7 7 0 1114 0v6l2 2H3l2-2v-6z"></path>
                </svg>
                <span>Notifications</span>
                <span v-if="unreadCount > 0" class="ml-2 px-2 py-0.5 text-xs font-semibold text-white bg-red-500 rounded-full">
                  {{ unreadCount }}
                </span>
              </span>
              <div 
                v-if="$route.name === 'Notifications'"
                class="absolute bottom-0 left-0 right-0 h-0.5 bg-gray-900 rounded-full"
              ></div>
            </router-link>
          </nav>
        </div>

        <!-- Right side: Notifications and User Menu -->
        <div class="flex items-center space-x-6">
          <!-- Quick Notifications Bell -->
          <button
            @click="toggleNotifications"
            class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM5 12a7 7 0 1114 0v6l2 2H3l2-2v-6z"></path>
            </svg>
            <span v-if="unreadCount > 0" class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full"></span>
          </button>

          <!-- User Menu -->
          <div class="relative">
            <button
              @click="toggleUserMenu"
              class="flex items-center space-x-3 p-1.5 rounded-lg hover:bg-gray-50 transition-colors duration-200"
            >
              <img
                class="w-8 h-8 rounded-full object-cover"
                :src="authStore.user?.avatar || '/api/placeholder/32/32'"
                :alt="authStore.user?.name"
              >
              <div class="hidden md:block text-left">
                <div class="text-sm font-medium text-gray-900">{{ authStore.user?.name }}</div>
                <div class="text-xs text-gray-500">{{ authStore.user?.role || 'Member' }}</div>
              </div>
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </button>

            <!-- User Dropdown -->
            <transition
              enter-active-class="transition duration-200 ease-out"
              enter-from-class="transform scale-95 opacity-0"
              enter-to-class="transform scale-100 opacity-100"
              leave-active-class="transition duration-150 ease-in"
              leave-from-class="transform scale-100 opacity-100"
              leave-to-class="transform scale-95 opacity-0"
            >
              <div
                v-if="showUserMenu"
                class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-1"
              >
                <div class="px-4 py-3 border-b border-gray-100">
                  <div class="text-sm font-medium text-gray-900">{{ authStore.user?.name }}</div>
                  <div class="text-sm text-gray-500">{{ authStore.user?.email }}</div>
                </div>
                
                <router-link
                  to="/profile"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150"
                  @click="showUserMenu = false"
                >
                  <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  Profile
                </router-link>
                
                <router-link
                  to="/settings"
                  class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150"
                  @click="showUserMenu = false"
                >
                  <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  Settings
                </router-link>
                
                <div class="border-t border-gray-100 my-1"></div>
                
                <button
                  @click="logout"
                  class="flex items-center w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-150"
                >
                  <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                  </svg>
                  Sign out
                </button>
              </div>
            </transition>
          </div>

          <!-- Mobile menu button -->
          <button
            @click="toggleMobileMenu"
            class="lg:hidden p-2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </button>
        </div>
      </div>

      <!-- Mobile Navigation Menu -->
      <transition
        enter-active-class="transition duration-300 ease-out"
        enter-from-class="transform -translate-y-2 opacity-0"
        enter-to-class="transform translate-y-0 opacity-100"
        leave-active-class="transition duration-200 ease-in"
        leave-from-class="transform translate-y-0 opacity-100"
        leave-to-class="transform -translate-y-2 opacity-0"
      >
        <div v-if="showMobileMenu" class="lg:hidden border-t border-gray-100 pt-4 pb-4 mt-4">
          <nav class="space-y-1">
            <router-link
              to="/dashboard"
              class="flex items-center space-x-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
              :class="$route.name === 'Dashboard' 
                ? 'bg-gray-50 text-gray-900' 
                : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'"
              @click="showMobileMenu = false"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
              </svg>
              <span>Dashboard</span>
            </router-link>

            <router-link
              to="/tasks"
              class="flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
              :class="$route.name === 'Tasks' 
                ? 'bg-gray-50 text-gray-900' 
                : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'"
              @click="showMobileMenu = false"
            >
              <div class="flex items-center space-x-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
                <span>Tasks</span>
              </div>
              <span v-if="tasksStore.tasksCount > 0" class="px-2 py-0.5 text-xs font-semibold text-gray-600 bg-gray-100 rounded-full">
                {{ tasksStore.tasksCount }}
              </span>
            </router-link>

            <router-link
              to="/notifications"
              class="flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200"
              :class="$route.name === 'Notifications' 
                ? 'bg-gray-50 text-gray-900' 
                : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50'"
              @click="showMobileMenu = false"
            >
              <div class="flex items-center space-x-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM5 12a7 7 0 1114 0v6l2 2H3l2-2v-6z"></path>
                </svg>
                <span>Notifications</span>
              </div>
              <span v-if="unreadCount > 0" class="px-2 py-0.5 text-xs font-semibold text-white bg-red-500 rounded-full">
                {{ unreadCount }}
              </span>
            </router-link>
          </nav>
        </div>
      </transition>
    </div>
  </nav>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useTasksStore } from '@/stores/tasks'
import { useNotificationsStore } from '@/stores/notifications'

const authStore = useAuthStore()
const tasksStore = useTasksStore()
const notificationsStore = useNotificationsStore()

const showUserMenu = ref(false)
const showNotifications = ref(false)  
const showMobileMenu = ref(false)

const unreadCount = computed(() => {
  return notificationsStore.notifications.filter(n => !n.read).length
})

const toggleUserMenu = () => {
  showUserMenu.value = !showUserMenu.value
  showNotifications.value = false
  showMobileMenu.value = false
}

const toggleNotifications = () => {
  showNotifications.value = !showNotifications.value
  showUserMenu.value = false
  showMobileMenu.value = false
}

const toggleMobileMenu = () => {
  showMobileMenu.value = !showMobileMenu.value
  showUserMenu.value = false
  showNotifications.value = false
}

const logout = () => {
  authStore.logout()
  showUserMenu.value = false
}

const handleClickOutside = (e) => {
  if (!e.target.closest('.relative')) {
    showUserMenu.value = false
    showNotifications.value = false
    showMobileMenu.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>