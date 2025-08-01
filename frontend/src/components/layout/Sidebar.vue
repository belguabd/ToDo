<template>
  <aside
    class="fixed left-0 top-16 h-screen w-64 bg-white border-r border-gray-200 z-40"
  >
    <div class="p-6">
      <nav class="space-y-2">
        <!-- Dashboard -->
        <router-link
          to="/dashboard"
          class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors"
          :class="
            $route.name === 'Dashboard'
              ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600'
              : 'text-gray-700 hover:bg-gray-50'
          "
        >
          <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"
            ></path>
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"
            ></path>
          </svg>
          <span class="font-medium">Dashboard</span>
        </router-link>

        <!-- Tasks -->
        <router-link
          to="/tasks"
          class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors"
          :class="
            $route.name === 'Tasks'
              ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600'
              : 'text-gray-700 hover:bg-gray-50'
          "
        >
          <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"
            ></path>
          </svg>
          <span class="font-medium">Tasks</span>
          <span
            class="ml-auto bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded-full"
          >
            {{ tasksStore.tasksCount }}
          </span>
        </router-link>

        <!-- Notifications -->
        <router-link
          to="/notifications"
          class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors"
          :class="
            $route.name === 'Notifications'
              ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600'
              : 'text-gray-700 hover:bg-gray-50'
          "
        >
          <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M15 17h5l-5 5v-5zM12 18.5A2.5 2.5 0 1014.5 16H12v2.5z"
            ></path>
          </svg>
          <span class="font-medium">Notifications</span>
          <span
            v-if="unreadCount > 0"
            class="ml-auto bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full"
          >
            {{ unreadCount }}
          </span>
        </router-link>
      </nav>

      <!-- Task Categories -->
      <div class="mt-8">
        <h3
          class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wide"
        >
          Categories
        </h3>
        <nav class="mt-4 space-y-1">
          <button
            @click="filterTasks('all')"
            class="w-full flex items-center space-x-3 px-4 py-2 text-left rounded-lg transition-colors"
            :class="
              activeFilter === 'all'
                ? 'bg-blue-50 text-blue-600'
                : 'text-gray-600 hover:bg-gray-50'
            "
          >
            <div class="w-2 h-2 rounded-full bg-gray-400"></div>
            <span>All Tasks</span>
            <span class="ml-auto text-xs">{{ tasksStore.tasksCount }}</span>
          </button>

          <button
            @click="filterTasks('pending')"
            class="w-full flex items-center space-x-3 px-4 py-2 text-left rounded-lg transition-colors"
            :class="
              activeFilter === 'pending'
                ? 'bg-blue-50 text-blue-600'
                : 'text-gray-600 hover:bg-gray-50'
            "
          >
            <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
            <span>Pending</span>
            <span class="ml-auto text-xs">{{
              tasksStore.pendingTasks.length
            }}</span>
          </button>

          <button
            @click="filterTasks('completed')"
            class="w-full flex items-center space-x-3 px-4 py-2 text-left rounded-lg transition-colors"
            :class="
              activeFilter === 'completed'
                ? 'bg-blue-50 text-blue-600'
                : 'text-gray-600 hover:bg-gray-50'
            "
          >
            <div class="w-2 h-2 rounded-full bg-green-400"></div>
            <span>Completed</span>
            <span class="ml-auto text-xs">{{
              tasksStore.completedTasks.length
            }}</span>
          </button>
        </nav>
      </div>

      <!-- Create Task Button -->
      <div class="mt-8">
        <button
          @click="$emit('create-task')"
          class="w-full flex items-center justify-center space-x-2 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors font-medium"
        >
          <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 4v16m8-8H4"
            ></path>
          </svg>
          <span>New Task</span>
        </button>
      </div>
    </div>
  </aside>
</template>
  
  <script setup>
import { ref, computed } from "vue";
import { useTasksStore } from "@/stores/tasks";
import { useNotificationsStore } from "@/stores/notifications";

const tasksStore = useTasksStore();
const notificationsStore = useNotificationsStore();

const activeFilter = ref("all");

const unreadCount = computed(() => {
  return notificationsStore.notifications.filter((n) => !n.read).length;
});

const filterTasks = (filter) => {
  activeFilter.value = filter;
  // Emit event to parent component to handle filtering
};

defineEmits(["create-task"]);
</script>