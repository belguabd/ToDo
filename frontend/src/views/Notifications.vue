<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 pt-20">
    <div class="max-w-7xl mx-auto px-8 py-8">
      <!-- Enhanced Header -->
      <div class="sticky top-16 z-10 backdrop-blur-xl bg-white/80 dark:bg-slate-900/80 border-b border-slate-200/50 dark:border-slate-700/50 mb-8 rounded-3xl">
        <div class="p-8">
          <div class="relative">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/5 to-purple-500/10 dark:from-blue-400/10 dark:to-purple-500/20 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-br from-green-500/5 to-teal-500/10 dark:from-green-400/10 dark:to-teal-500/20 rounded-full translate-y-12 -translate-x-12"></div>
            <div class="relative">
              <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 dark:from-white dark:to-slate-300 bg-clip-text text-transparent mb-3">
                Notifications
              </h1>
              <p class="text-slate-500 dark:text-slate-400 text-lg">Stay updated with your latest activities</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Enhanced Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <!-- Total Notifications Card -->
        <div class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-200/50 dark:border-slate-700/50">
          <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-600/10 dark:from-blue-400/10 dark:to-blue-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <BellIcon class="w-6 h-6 text-blue-600 dark:text-blue-400" />
              </div>
              <div class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full font-medium">
                Total
              </div>
            </div>
            <div class="space-y-1">
              <p class="text-3xl font-bold text-slate-800 dark:text-white">
                {{ notifications.length }}
              </p>
              <p class="text-sm text-slate-500 dark:text-slate-400">All Notifications</p>
            </div>
          </div>
        </div>

        <!-- Unread Notifications Card -->
        <div class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-200/50 dark:border-slate-700/50">
          <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-amber-600/10 dark:from-amber-400/10 dark:to-amber-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <EyeSlashIcon class="w-6 h-6 text-amber-600 dark:text-amber-400" />
              </div>
              <div class="text-xs px-2 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-full font-medium">
                Unread
              </div>
            </div>
            <div class="space-y-1">
              <p class="text-3xl font-bold text-slate-800 dark:text-white">
                {{ unreadCount }}
              </p>
              <p class="text-sm text-slate-500 dark:text-slate-400">Need Attention</p>
            </div>
          </div>
        </div>

        <!-- Success Notifications Card -->
        <div class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-200/50 dark:border-slate-700/50">
          <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-green-600/10 dark:from-green-400/10 dark:to-green-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <CheckCircleIcon class="w-6 h-6 text-green-600 dark:text-green-400" />
              </div>
              <div class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full font-medium">
                Success
              </div>
            </div>
            <div class="space-y-1">
              <p class="text-3xl font-bold text-slate-800 dark:text-white">
                {{ getTypeCount('success') }}
              </p>
              <p class="text-sm text-slate-500 dark:text-slate-400">Successful Actions</p>
            </div>
          </div>
        </div>

        <!-- Task Notifications Card -->
        <div class="group relative overflow-hidden bg-gradient-to-br from-purple-500 to-purple-600 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-500 text-white">
          <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
          <div class="relative">
            <div class="flex items-center justify-between mb-4">
              <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <ClipboardDocumentListIcon class="w-6 h-6 text-white" />
              </div>
            </div>
            <div class="space-y-1">
              <p class="text-3xl font-bold">{{ getTaskCount() }}</p>
              <p class="text-sm text-purple-100">Task Related</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Enhanced Filters and Actions -->
      <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-8 mb-8 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-50/50 to-blue-50/30 dark:from-slate-800/50 dark:to-blue-900/10 opacity-50"></div>
        <div class="relative">
          <!-- Top Row: Filters and Actions -->
          <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-6">
            <!-- Enhanced Filter Buttons -->
            <div class="flex flex-wrap gap-3">
              <button
                @click="activeFilter = 'all'"
                :class="[
                  'relative px-6 py-3 rounded-2xl text-sm font-medium transition-all duration-300 group',
                  activeFilter === 'all' 
                    ? 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-lg ring-1 ring-indigo-600/20' 
                    : 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600'
                ]"
              >
                All ({{ notifications.length }})
                <div
                  v-if="activeFilter === 'all'"
                  class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-indigo-400 to-indigo-600 rounded-full"
                ></div>
              </button>
              <button
                @click="activeFilter = 'success'"
                :class="[
                  'relative px-6 py-3 rounded-2xl text-sm font-medium transition-all duration-300 flex items-center space-x-2 group',
                  activeFilter === 'success' 
                    ? 'bg-gradient-to-r from-green-600 to-green-700 text-white shadow-lg ring-1 ring-green-600/20' 
                    : 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600'
                ]"
              >
                <CheckCircleIcon class="w-4 h-4" />
                <span>Success ({{ getTypeCount('success') }})</span>
                <div
                  v-if="activeFilter === 'success'"
                  class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-green-400 to-green-600 rounded-full"
                ></div>
              </button>
              <button
                @click="activeFilter = 'error'"
                :class="[
                  'relative px-6 py-3 rounded-2xl text-sm font-medium transition-all duration-300 flex items-center space-x-2 group',
                  activeFilter === 'error' 
                    ? 'bg-gradient-to-r from-red-600 to-red-700 text-white shadow-lg ring-1 ring-red-600/20' 
                    : 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600'
                ]"
              >
                <XCircleIcon class="w-4 h-4" />
                <span>Errors ({{ getTypeCount('error') }})</span>
                <div
                  v-if="activeFilter === 'error'"
                  class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-red-400 to-red-600 rounded-full"
                ></div>
              </button>
              <button
                @click="activeFilter = 'info'"
                :class="[
                  'relative px-6 py-3 rounded-2xl text-sm font-medium transition-all duration-300 flex items-center space-x-2 group',
                  activeFilter === 'info' 
                    ? 'bg-gradient-to-r from-blue-600 to-blue-700 text-white shadow-lg ring-1 ring-blue-600/20' 
                    : 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600'
                ]"
              >
                <InformationCircleIcon class="w-4 h-4" />
                <span>Info ({{ getTypeCount('info') }})</span>
                <div
                  v-if="activeFilter === 'info'"
                  class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full"
                ></div>
              </button>
              <button
                @click="activeFilter = 'warning'"
                :class="[
                  'relative px-6 py-3 rounded-2xl text-sm font-medium transition-all duration-300 flex items-center space-x-2 group',
                  activeFilter === 'warning' 
                    ? 'bg-gradient-to-r from-yellow-600 to-yellow-700 text-white shadow-lg ring-1 ring-yellow-600/20' 
                    : 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600'
                ]"
              >
                <ExclamationTriangleIcon class="w-4 h-4" />
                <span>Warnings ({{ getTypeCount('warning') }})</span>
                <div
                  v-if="activeFilter === 'warning'"
                  class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full"
                ></div>
              </button>
            </div>

            <!-- Enhanced Actions -->
            <div class="flex items-center gap-3">
              <button
                @click="markAllAsRead"
                v-if="unreadCount > 0"
                class="group inline-flex items-center px-6 py-3 text-sm font-medium text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 border border-blue-200 dark:border-blue-700 rounded-2xl transition-all duration-200 hover:scale-105"
              >
                <EyeIcon class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" />
                Mark All Read
              </button>
              <button
                @click="clearAll"
                v-if="filteredNotifications.length > 0"
                class="group inline-flex items-center px-6 py-3 text-sm font-medium text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 border border-red-200 dark:border-red-700 rounded-2xl transition-all duration-200 hover:scale-105"
              >
                <TrashIcon class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" />
                Clear All
              </button>
            </div>
          </div>

          <!-- Enhanced Search and Sort -->
          <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative group">
              <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 to-purple-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
              <MagnifyingGlassIcon class="absolute left-4 top-1/2 transform -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-200 z-10" />
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Search notifications..."
                class="relative z-10 w-full pl-12 pr-4 py-3 border border-slate-300 dark:border-slate-600 rounded-2xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 bg-white dark:bg-slate-700 text-slate-900 dark:text-white hover:border-slate-400 dark:hover:border-slate-500"
              />
            </div>
            <div class="md:w-48 relative group">
              <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 to-teal-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
              <select
                v-model="sortBy"
                class="relative z-10 w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-2xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 dark:focus:border-emerald-400 transition-all duration-200 bg-white dark:bg-slate-700 text-slate-900 dark:text-white hover:border-slate-400 dark:hover:border-slate-500 appearance-none"
              >
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="unread">Unread First</option>
              </select>
              <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none z-10">
                <svg class="w-5 h-5 text-slate-400 group-focus-within:text-emerald-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Enhanced Notifications List -->
      <div class="space-y-6">
        <!-- Enhanced Empty State -->
        <div v-if="filteredNotifications.length === 0" class="text-center py-16 bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
          <div class="relative mb-8">
            <div class="w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-600 rounded-3xl flex items-center justify-center mx-auto shadow-inner">
              <BellSlashIcon class="w-12 h-12 text-slate-400 dark:text-slate-500" />
            </div>
            <div class="absolute -top-2 -right-2 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center animate-bounce">
              <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
              </svg>
            </div>
          </div>
          <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">
            {{ searchQuery ? 'No matching notifications' : 'No notifications yet' }}
          </h3>
          <p class="text-slate-500 dark:text-slate-400 max-w-md mx-auto leading-relaxed">
            {{ searchQuery ? 'Try adjusting your search or filters to find what you\'re looking for.' : 'When you receive notifications, they\'ll appear here. Stay tuned for updates!' }}
          </p>
        </div>

        <!-- Enhanced Notification Cards -->
        <TransitionGroup name="notification-list" tag="div" class="space-y-4">
          <div
            v-for="(notification, index) in filteredNotifications"
            :key="notification.id"
            :class="[
              'group relative overflow-hidden bg-white dark:bg-slate-800 rounded-3xl shadow-sm hover:shadow-xl border transition-all duration-300 cursor-pointer',
              !notification.read ? 'border-l-4 shadow-lg' : 'border-slate-200/50 dark:border-slate-700/50',
              getCardBorderColor(notification.type),
              !notification.read ? 'bg-gradient-to-r from-blue-50/30 to-white dark:from-blue-900/10 dark:to-slate-800' : ''
            ]"
            :style="{ animationDelay: `${index * 50}ms` }"
            @click="handleNotificationClick(notification)"
          >
            <!-- Gradient Background on Hover -->
            <div class="absolute inset-0 bg-gradient-to-r opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              :class="getHoverGradient(notification.type)"
            ></div>

            <div class="relative p-8">
              <div class="flex items-start justify-between">
                <!-- Main Content -->
                <div class="flex items-start space-x-6 flex-1">
                  <!-- Enhanced Icon -->
                  <div :class="[
                    'flex-shrink-0 w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300',
                    getIconBackground(notification.type)
                  ]">
                    <CheckCircleIcon v-if="notification.type === 'success'" class="h-7 w-7 text-white" />
                    <XCircleIcon v-if="notification.type === 'error'" class="h-7 w-7 text-white" />
                    <InformationCircleIcon v-if="notification.type === 'info'" class="h-7 w-7 text-white" />
                    <ExclamationTriangleIcon v-if="notification.type === 'warning'" class="h-7 w-7 text-white" />
                  </div>

                  <!-- Content -->
                  <div class="flex-1 min-w-0">
                    <!-- Header -->
                    <div class="flex items-center gap-3 mb-3">
                      <h3 v-if="notification.title" class="text-xl font-semibold text-slate-900 dark:text-white">
                        {{ notification.title }}
                      </h3>
                      <span :class="[
                        'inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold ring-1',
                        getStatusBadgeColor(notification.type)
                      ]">
                        {{ notification.type.charAt(0).toUpperCase() + notification.type.slice(1) }}
                      </span>
                      <span v-if="!notification.read" class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 animate-pulse ring-1 ring-blue-200 dark:ring-blue-700">
                        New
                      </span>
                    </div>

                    <!-- Message -->
                    <p class="text-slate-700 dark:text-slate-300 mb-6 leading-relaxed text-base">{{ notification.message }}</p>

                    <!-- Metadata -->
                    <div class="flex items-center gap-6 text-sm text-slate-500 dark:text-slate-400">
                      <span class="flex items-center gap-2 px-2 py-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors duration-200">
                        <ClockIcon class="h-4 w-4" />
                        {{ formatTime(notification.createdAt || notification.id) }}
                      </span>
                      <span v-if="notification.category" class="flex items-center gap-2 px-2 py-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors duration-200">
                        <TagIcon class="h-4 w-4" />
                        {{ notification.category }}
                      </span>
                      <span v-if="notification.taskId" class="flex items-center gap-2 px-2 py-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors duration-200">
                        <ClipboardDocumentListIcon class="h-4 w-4" />
                        Task #{{ notification.taskId }}
                      </span>
                    </div>

                    <!-- Action Button -->
                    <div v-if="notification.action" class="mt-6">
                      <button
                        @click.stop="handleAction(notification)"
                        :class="[
                          'group/btn inline-flex items-center px-6 py-3 text-sm font-medium rounded-2xl focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-200 hover:shadow-lg hover:scale-105',
                          getActionButtonColor(notification.type)
                        ]"
                      >
                        {{ notification.action.text }}
                        <ArrowRightIcon class="ml-2 h-4 w-4 group-hover/btn:translate-x-1 transition-transform duration-200" />
                      </button>
                    </div>
                  </div>
                </div>

                <!-- Enhanced Action Buttons -->
                <div class="flex items-center gap-2 ml-6 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-4 group-hover:translate-x-0">
                  <button
                    v-if="!notification.read"
                    @click.stop="markAsRead(notification.id)"
                    class="p-3 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-xl transition-all duration-200 hover:scale-110"
                    title="Mark as read"
                  >
                    <EyeIcon class="h-5 w-5" />
                  </button>
                  <button
                    @click.stop="removeNotification(notification.id)"
                    class="p-3 text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-all duration-200 hover:scale-110"
                    title="Remove notification"
                  >
                    <XMarkIcon class="h-5 w-5" />
                  </button>
                </div>
              </div>
            </div>
          </div>
        </TransitionGroup>
      </div>

      <!-- Enhanced Load More Button -->
      <div v-if="filteredNotifications.length >= 20" class="text-center mt-8">
        <button class="group inline-flex items-center px-8 py-4 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-2xl hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 hover:scale-105 shadow-sm hover:shadow-md">
          Load More Notifications
          <ArrowDownIcon class="ml-2 h-4 w-4 group-hover:translate-y-1 transition-transform duration-200" />
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useNotificationsStore } from '@/stores/notifications'
import {
  CheckCircleIcon,
  XCircleIcon,
  InformationCircleIcon,
  ExclamationTriangleIcon,
  XMarkIcon,
  BellSlashIcon,
  BellIcon,
  MagnifyingGlassIcon,
  ClockIcon,
  TagIcon,
  EyeIcon,
  EyeSlashIcon,
  ArrowRightIcon,
  TrashIcon,
  ClipboardDocumentListIcon,
  ArrowDownIcon
} from '@heroicons/vue/24/outline'

const notificationsStore = useNotificationsStore()

// Local state
const activeFilter = ref('all')
const searchQuery = ref('')
const sortBy = ref('newest')

// Computed properties
const notifications = computed(() => notificationsStore.notifications)

const unreadCount = computed(() => 
  notifications.value.filter(n => !n.read).length
)

const filteredNotifications = computed(() => {
  let filtered = notifications.value

  // Filter by type
  if (activeFilter.value !== 'all') {
    filtered = filtered.filter(n => n.type === activeFilter.value)
  }

  // Filter by search query
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(n => 
      n.title?.toLowerCase().includes(query) ||
      n.message.toLowerCase().includes(query) ||
      n.category?.toLowerCase().includes(query)
    )
  }

  // Sort notifications
  return filtered.sort((a, b) => {
    if (sortBy.value === 'newest') {
      return (b.createdAt || b.id) - (a.createdAt || a.id)
    } else if (sortBy.value === 'oldest') {
      return (a.createdAt || a.id) - (b.createdAt || b.id)
    } else if (sortBy.value === 'unread') {
      if (a.read === b.read) {
        return (b.createdAt || b.id) - (a.createdAt || a.id)
      }
      return a.read ? 1 : -1
    }
  })
})

// Methods
const getTypeCount = (type) => {
  return notifications.value.filter(n => n.type === type).length
}

const getTaskCount = () => {
  return notifications.value.filter(n => n.category === 'Tasks').length
}

const getCardBorderColor = (type) => {
  const colors = {
    success: 'border-l-green-500',
    error: 'border-l-red-500',
    info: 'border-l-blue-500',
    warning: 'border-l-yellow-500'
  }
  return colors[type] || colors.info
}

const getHoverGradient = (type) => {
  const gradients = {
    success: 'from-green-50/30 to-emerald-50/30 dark:from-green-900/5 dark:to-emerald-900/5',
    error: 'from-red-50/30 to-red-50/30 dark:from-red-900/5 dark:to-red-900/5',
    info: 'from-blue-50/30 to-indigo-50/30 dark:from-blue-900/5 dark:to-indigo-900/5',
    warning: 'from-yellow-50/30 to-amber-50/30 dark:from-yellow-900/5 dark:to-amber-900/5'
  }
  return gradients[type] || gradients.info
}

const getIconBackground = (type) => {
  const colors = {
    success: 'bg-gradient-to-br from-green-500 to-emerald-600',
    error: 'bg-gradient-to-br from-red-500 to-red-600',
    info: 'bg-gradient-to-br from-blue-500 to-indigo-600',
    warning: 'bg-gradient-to-br from-yellow-500 to-amber-600'
  }
  return colors[type] || colors.info
}

const getStatusBadgeColor = (type) => {
  const colors = {
    success: 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300 ring-green-200 dark:ring-green-800',
    error: 'bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 ring-red-200 dark:ring-red-800',
    info: 'bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 ring-blue-200 dark:ring-blue-800',
    warning: 'bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 ring-yellow-200 dark:ring-yellow-800'
  }
  return colors[type] || colors.info
}

const getActionButtonColor = (type) => {
  const colors = {
    success: 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300 hover:bg-green-100 dark:hover:bg-green-900/30 focus:ring-green-500',
    error: 'bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-100 dark:hover:bg-red-900/30 focus:ring-red-500',
    info: 'bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-blue-900/30 focus:ring-blue-500',
    warning: 'bg-yellow-50 dark:bg-yellow-900/20 text-yellow-700 dark:text-yellow-300 hover:bg-yellow-100 dark:hover:bg-yellow-900/30 focus:ring-yellow-500'
  }
  return colors[type] || colors.info
}

const formatTime = (timestamp) => {
  const now = Date.now()
  const diff = now - timestamp
  
  if (diff < 1000 * 60) return 'Just now'
  if (diff < 1000 * 60 * 60) return `${Math.floor(diff / (1000 * 60))} minutes ago`
  if (diff < 1000 * 60 * 60 * 24) return `${Math.floor(diff / (1000 * 60 * 60))} hours ago`
  if (diff < 1000 * 60 * 60 * 24 * 7) return `${Math.floor(diff / (1000 * 60 * 60 * 24))} days ago`
  
  return new Date(timestamp).toLocaleDateString()
}

const removeNotification = (id) => {
  notificationsStore.removeNotification(id)
}

const markAsRead = (id) => {
  notificationsStore.markAsRead(id)
}

const markAllAsRead = () => {
  notificationsStore.markAllAsRead()
}

const clearAll = () => {
  notificationsStore.clearAll()
}

const handleAction = (notification) => {
  if (notification.action && notification.action.handler) {
    notification.action.handler()
    // Mark as read after action
    markAsRead(notification.id)
  }
}

const handleNotificationClick = (notification) => {
  if (!notification.read) {
    markAsRead(notification.id)
  }
}
</script>

<style scoped>
.notification-list-enter-active,
.notification-list-leave-active {
  transition: all 0.4s ease;
}

.notification-list-enter-from {
  opacity: 0;
  transform: translateY(-20px) scale(0.95);
}

.notification-list-leave-to {
  opacity: 0;
  transform: translateX(100%) scale(0.95);
}

.notification-list-move {
  transition: transform 0.4s ease;
}
</style>