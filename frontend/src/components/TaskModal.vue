<template>
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
      <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-lg bg-white">
        <div class="mt-3">
          <!-- Header -->
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">
              {{ isEditing ? 'Edit Task' : 'Create New Task' }}
            </h3>
            <button
              @click="$emit('close')"
              class="text-gray-400 hover:text-gray-600 transition-colors"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
  
          <!-- Form -->
          <form @submit.prevent="handleSubmit" class="space-y-4">
            <!-- Title -->
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                Title *
              </label>
              <input
                id="title"
                v-model="form.title"
                type="text"
                required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter task title..."
              >
            </div>
  
            <!-- Description -->
            <div>
              <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                Description
              </label>
              <textarea
                id="description"
                v-model="form.description"
                rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Enter task description..."
              ></textarea>
            </div>
  
            <!-- Priority -->
            <div>
              <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">
                Priority
              </label>
              <select
                id="priority"
                v-model="form.priority"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
              </select>
            </div>
  
            <!-- Due Date -->
            <div>
              <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">
                Due Date
              </label>
              <input
                id="due_date"
                v-model="form.due_date"
                type="date"
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
              >
            </div>
  
            <!-- Tags -->
            <div>
              <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">
                Tags
              </label>
              <div class="flex flex-wrap gap-2 mb-2">
                <span
                  v-for="tag in form.tags"
                  :key="tag"
                  class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"
                >
                  {{ tag }}
                  <button
                    type="button"
                    @click="removeTag(tag)"
                    class="ml-1 text-blue-600 hover:text-blue-800"
                  >
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                  </button>
                </span>
              </div>
              <div class="flex space-x-2">
                <input
                  v-model="newTag"
                  type="text"
                  placeholder="Add a tag..."
                  class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                  @keydown.enter.prevent="addTag"
                >
                <button
                  type="button"
                  @click="addTag"
                  class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors"
                >
                  Add
                </button>
              </div>
            </div>
  
            <!-- Status (only when editing) -->
            <div v-if="isEditing">
              <label class="flex items-center space-x-2">
                <input
                  v-model="form.completed"
                  type="checkbox"
                  class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                >
                <span class="text-sm font-medium text-gray-700">Mark as completed</span>
              </label>
            </div>
  
            <!-- Buttons -->
            <div class="flex items-center justify-end space-x-3 pt-4">
              <button
                type="button"
                @click="$emit('close')"
                class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors"
              >
                Cancel
              </button>
              <button
                type="submit"
                :disabled="!form.title.trim()"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed text-white rounded-lg transition-colors"
              >
                {{ isEditing ? 'Update Task' : 'Create Task' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, reactive, watch } from 'vue'
  
  const props = defineProps({
    task: {
      type: Object,
      default: null
    },
    isEditing: {
      type: Boolean,
      default: false
    }
  })
  
  const emit = defineEmits(['close', 'save'])
  
  const newTag = ref('')
  
  const form = reactive({
    title: '',
    description: '',
    priority: 'medium',
    due_date: '',
    tags: [],
    completed: false
  })
  
  // Watch for task prop changes to populate form
  watch(() => props.task, (newTask) => {
    if (newTask && props.isEditing) {
      Object.assign(form, {
        title: newTask.title || '',
        description: newTask.description || '',
        priority: newTask.priority || 'medium',
        due_date: newTask.due_date ? new Date(newTask.due_date).toISOString().split('T')[0] : '',
        tags: [...(newTask.tags || [])],
        completed: newTask.completed || false
      })
    } else {
      // Reset form for new task
      Object.assign(form, {
        title: '',
        description: '',
        priority: 'medium',
        due_date: '',
        tags: [],
        completed: false
      })
    }
  }, { immediate: true })
  
  const addTag = () => {
    const tag = newTag.value.trim()
    if (tag && !form.tags.includes(tag)) {
      form.tags.push(tag)
      newTag.value = ''
    }
  }
  
  const removeTag = (tagToRemove) => {
    form.tags = form.tags.filter(tag => tag !== tagToRemove)
  }
  
  const handleSubmit = () => {
    const taskData = {
      title: form.title.trim(),
      description: form.description.trim(),
      priority: form.priority,
      due_date: form.due_date || null,
      tags: form.tags,
      completed: form.completed
    }
  
    emit('save', taskData)
  }
  </script>