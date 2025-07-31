<template>
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
          <!-- Icon -->
          <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.732 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
          </div>
  
          <!-- Content -->
          <div class="text-center">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Delete Task</h3>
            <p class="text-gray-600 mb-6">
              Are you sure you want to delete "{{ task?.title }}"? This action cannot be undone.
            </p>
  
            <!-- Buttons -->
            <div class="flex items-center justify-center space-x-3">
              <button
                @click="$emit('close')"
                class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors"
              >
                Cancel
              </button>
              <button
                @click="$emit('confirm')"
                class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
              >
                Delete Task
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    task: {
      type: Object,
      required: true
    }
  })
  
  defineEmits(['close', 'confirm'])
  </script>