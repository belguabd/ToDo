import { defineStore } from 'pinia'
import api from '@/lib/api'

export const useTasksStore = defineStore('tasks', {
  state: () => ({
    tasks: [],
    loading: false,
    error: null,
  }),

  getters: {
    completedTasks: (state) => state.tasks.filter(task => task.completed),
    pendingTasks: (state) => state.tasks.filter(task => !task.completed),
    tasksCount: (state) => state.tasks.length,
  },

  actions: {
    async fetchTasks() {
      try {
        this.loading = true
        this.error = null
        
        const response = await api.get('/tasks')
        this.tasks = response.data.data || response.data
        
        return this.tasks
      } catch (error) {
        this.error = error.response?.data?.message || 'Failed to fetch tasks'
        throw error
      } finally {
        this.loading = false
      }
    },

    async getTask(id) {
      try {
        const response = await api.get(`/tasks/${id}`)
        return response.data.data || response.data
      } catch (error) {
        this.error = error.response?.data?.message || 'Failed to fetch task'
        throw error
      }
    },

    async createTask(taskData) {
      try {
        this.loading = true
        this.error = null
        
        const response = await api.post('/tasks', taskData)
        const newTask = response.data.data || response.data
        
        this.tasks.unshift(newTask)
        
        return newTask
      } catch (error) {
        this.error = error.response?.data?.message || 'Failed to create task'
        throw error
      } finally {
        this.loading = false
      }
    },

    async updateTask(id, taskData) {
      try {
        this.loading = true
        this.error = null
        
        const response = await api.put(`/tasks/${id}`, taskData)
        const updatedTask = response.data.data || response.data
        
        const index = this.tasks.findIndex(task => task.id === id)
        if (index !== -1) {
          this.tasks[index] = updatedTask
        }
        
        return updatedTask
      } catch (error) {
        this.error = error.response?.data?.message || 'Failed to update task'
        throw error
      } finally {
        this.loading = false
      }
    },

    async deleteTask(id) {
      try {
        this.loading = true
        this.error = null
        
        await api.delete(`/tasks/${id}`)
        
        this.tasks = this.tasks.filter(task => task.id !== id)
        
        return true
      } catch (error) {
        this.error = error.response?.data?.message || 'Failed to delete task'
        throw error
      } finally {
        this.loading = false
      }
    },

    async toggleTaskStatus(id) {
      const task = this.tasks.find(t => t.id === id)
      if (task) {
        return await this.updateTask(id, {
          ...task,
          completed: !task.completed
        })
      }
    },

    // Real-time updates
    addTaskRealtime(task) {
      this.tasks.unshift(task)
    },

    updateTaskRealtime(updatedTask) {
      const index = this.tasks.findIndex(task => task.id === updatedTask.id)
      if (index !== -1) {
        this.tasks[index] = updatedTask
      }
    },

    deleteTaskRealtime(taskId) {
      this.tasks = this.tasks.filter(task => task.id !== taskId)
    },
  },
})
