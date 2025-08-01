import { defineStore } from 'pinia'

export const useNotificationsStore = defineStore('notifications', {
  state: () => ({
    notifications: [],
  }),

  getters: {
    unreadCount: (state) => state.notifications.filter(n => !n.read).length,
  },

  actions: {
    addNotification(notification) {
      const id = Date.now()
      const newNotification = {
        id,
        type: 'success',
        read: false,
        createdAt: Date.now(),
        ...notification,
      }

      // Add to beginning (newest first)
      this.notifications.unshift(newNotification)
      return id
    },

    removeNotification(id) {
      this.notifications = this.notifications.filter(n => n.id !== id)
    },

    markAsRead(id) {
      const notification = this.notifications.find(n => n.id === id)
      if (notification) {
        notification.read = true
      }
    },

    success(message, options = {}) {
      return this.addNotification({
        type: 'success',
        message,
        ...options,
      })
    },

    error(message, options = {}) {
      return this.addNotification({
        type: 'error',
        message,
        ...options,
      })
    },

    info(message, options = {}) {
      return this.addNotification({
        type: 'info',
        message,
        ...options,
      })
    },

    warning(message, options = {}) {
      return this.addNotification({
        type: 'warning',
        message,
        ...options,
      })
    },
  },
})