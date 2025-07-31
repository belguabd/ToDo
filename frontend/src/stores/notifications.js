import { defineStore } from 'pinia'

export const useNotificationsStore = defineStore('notifications', {
  state: () => ({
    notifications: [],
  }),

  actions: {
    addNotification(notification) {
      const id = Date.now()
      this.notifications.push({
        id,
        type: 'success',
        duration: 5000,
        ...notification,
      })

      // Auto remove after duration
      setTimeout(() => {
        this.removeNotification(id)
      }, notification.duration || 5000)

      return id
    },

    removeNotification(id) {
      this.notifications = this.notifications.filter(n => n.id !== id)
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