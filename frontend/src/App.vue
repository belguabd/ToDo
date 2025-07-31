<template>
  <div id="app" class="min-h-screen bg-gray-50">
    <Navbar v-if="authStore.isAuthenticated" />
    <main v-if="authStore.isAuthenticated" class="pt-20 px-6 pb-6">
      <div class="max-w-7xl mx-auto">
        <router-view />
      </div>
    </main>
    <main v-else class="min-h-screen flex items-center justify-center">
      <router-view />
    </main>
    <NotificationContainer />
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useTasksStore } from '@/stores/tasks'
import Navbar from '@/components/Navbar.vue'
import NotificationContainer from '@/components/NotificationContainer.vue'

const authStore = useAuthStore()
const tasksStore = useTasksStore()

onMounted(() => {
  // Initialize Echo for real-time updates
  if (authStore.isAuthenticated) {
    window.Echo.private(`App.Models.User.${authStore.user?.id}`)
      .listen('TaskCreated', (e) => {
        tasksStore.addTaskRealtime(e.task)
      })
      .listen('TaskUpdated', (e) => {
        tasksStore.updateTaskRealtime(e.task)
      })
      .listen('TaskDeleted', (e) => {
        tasksStore.deleteTaskRealtime(e.taskId)
      })
  }
})
</script>