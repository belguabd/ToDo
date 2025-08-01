<template>
  <div id="app" class="min-h-screen bg-gray-50">
    <!-- Always show NavBar -->
    <NavBar />

    <!-- Always show content -->
    <main class="pt-20 px-6 pb-6">
      <div class="max-w-7xl mx-auto">
        <RouterView />
      </div>
    </main>

    <!-- Loading Overlay -->
    <div
      v-if="authStore.loading"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
    >
      <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-indigo-600"></div>
        <span class="text-gray-700">Loading...</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import NavBar from '@/components/Navbar.vue'
import echo from '@/lib/echo'

const authStore = useAuthStore()

onMounted(async () => {
  await authStore.initAuth()

  const userId = authStore.user?.id
  if (!userId) return

  echo.private(`user.${userId}`).listen('.task.created', (e) => {
    console.log('✅ New task created:', e.task)
  })
})
</script>
