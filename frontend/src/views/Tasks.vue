<template>
  <div class="min-h-screen bg-gray-50 pt-20">
    <!-- Clean Header -->
    <div class="max-w-6xl mx-auto px-8 mb-12">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-3xl font-bold text-gray-900 mb-2">Tasks</h1>
          <p class="text-gray-600">Manage your tasks and stay organized</p>
        </div>
        <router-link
          to="/tasks/create"
          class="inline-flex items-center px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors duration-200 font-medium"
        >
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          New Task
        </router-link>
      </div>
    </div>

    <div class="max-w-6xl mx-auto px-8">
      <!-- Clean Filters and Controls -->
      <div class="bg-white rounded-lg border border-gray-200 p-6 mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
          <!-- Filter Tabs -->
          <div class="flex items-center space-x-1 bg-gray-100 p-1 rounded-lg">
            <button
              v-for="filter in filters"
              :key="filter.key"
              @click="activeFilter = filter.key"
              class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-200 flex items-center space-x-2"
              :class="
                activeFilter === filter.key
                  ? 'bg-white text-gray-900 shadow-sm'
                  : 'text-gray-600 hover:text-gray-900'
              "
            >
              <span>{{ filter.label }}</span>
              <span
                v-if="filter.count > 0"
                class="px-2 py-0.5 text-xs rounded-full"
                :class="
                  activeFilter === filter.key
                    ? 'bg-gray-100 text-gray-700'
                    : 'bg-gray-200 text-gray-600'
                "
              >
                {{ filter.count }}
              </span>
            </button>
          </div>

          <!-- Controls -->
          <div class="flex flex-col sm:flex-row sm:items-center space-y-3 sm:space-y-0 sm:space-x-4">
            <!-- Search -->
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </div>
              <input
                v-model="searchQuery"
                type="text"
                placeholder="Search tasks..."
                class="block w-full sm:w-80 pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors"
              />
            </div>

            <!-- Sort -->
            <div class="relative">
              <select
                v-model="sortBy"
                class="appearance-none px-4 py-2.5 pr-10 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 bg-white transition-colors cursor-pointer"
              >
                <option value="created_at">Date Created</option>
                <option value="due_date">Due Date</option>
                <option value="priority">Priority</option>
                <option value="title">Title</option>
              </select>
              <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tasks List -->
      <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <!-- Loading State -->
        <div v-if="tasksStore.loading" class="p-16 text-center">
          <div class="inline-flex items-center justify-center w-12 h-12 border-4 border-gray-200 border-t-gray-900 rounded-full animate-spin mb-4"></div>
          <p class="text-gray-600 font-medium">Loading tasks...</p>
        </div>

        <!-- Empty State -->
        <div v-else-if="filteredTasks.length === 0" class="p-16 text-center">
          <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
          </div>
          <h3 class="text-xl font-semibold text-gray-900 mb-2">
            {{ searchQuery ? "No tasks found" : "No tasks yet" }}
          </h3>
          <p class="text-gray-600 mb-8 max-w-md mx-auto">
            {{
              searchQuery
                ? "Try adjusting your search terms or filters"
                : "Create your first task to get started with organizing your work"
            }}
          </p>
          <router-link
            to="/tasks/create"
            class="inline-flex items-center px-6 py-3 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 transition-colors duration-200"
          >
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create First Task
          </router-link>
        </div>

        <!-- Tasks List -->
        <div v-else class="divide-y divide-gray-200">
          <div
            v-for="task in filteredTasks"
            :key="task.id"
            class="group p-6 hover:bg-gray-50 transition-colors duration-200 cursor-pointer"
            @click="selectTask(task)"
          >
            <div class="flex items-start space-x-4">
              <!-- Checkbox -->
              <button
                @click.stop="toggleTask(task)"
                class="flex-shrink-0 mt-1"
              >
                <div
                  class="w-5 h-5 border-2 rounded flex items-center justify-center transition-all duration-200"
                  :class="
                    task.completed
                      ? 'bg-gray-900 border-gray-900'
                      : 'border-gray-300 hover:border-gray-400'
                  "
                >
                  <svg
                    v-if="task.completed"
                    class="w-3 h-3 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="3"
                      d="M5 13l4 4L19 7"
                    ></path>
                  </svg>
                </div>
              </button>

              <!-- Task Content -->
              <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between">
                  <div class="flex-1">
                    <h3
                      class="text-lg font-medium mb-1 transition-colors duration-200"
                      :class="
                        task.completed
                          ? 'text-gray-500 line-through'
                          : 'text-gray-900 group-hover:text-gray-700'
                      "
                    >
                      {{ task.title }}
                    </h3>
                    <p
                      v-if="task.description"
                      class="text-gray-600 text-sm mb-3"
                      :class="task.completed ? 'line-through' : ''"
                    >
                      {{ task.description }}
                    </p>
                  </div>

                  <!-- Action Buttons -->
                  <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 ml-4">
                    <button
                      @click.stop="editTask(task)"
                      class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200"
                    >
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                      </svg>
                    </button>
                    <button
                      @click.stop="deleteTask(task)"
                      class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200"
                    >
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Task Metadata -->
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-4">
                    <!-- Priority Badge -->
                    <span
                      v-if="task.priority"
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                      :class="getPriorityClass(task.priority)"
                    >
                      <div
                        class="w-1.5 h-1.5 rounded-full mr-1.5"
                        :class="getPriorityDotClass(task.priority)"
                      ></div>
                      {{ task.priority }}
                    </span>

                    <!-- Dates -->
                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                      <span
                        v-if="task.due_date"
                        class="flex items-center space-x-1"
                        :class="{
                          'text-red-600': isOverdue(task.due_date),
                        }"
                      >
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Due {{ formatDate(task.due_date) }}</span>
                      </span>
                      <span class="flex items-center space-x-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Created {{ formatDate(task.created_at) }}</span>
                      </span>
                    </div>
                  </div>

                  <!-- Tags -->
                  <div v-if="task.tags && task.tags.length" class="flex items-center space-x-1">
                    <span
                      v-for="tag in task.tags.slice(0, 3)"
                      :key="tag"
                      class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-700"
                    >
                      {{ tag }}
                    </span>
                    <span
                      v-if="task.tags.length > 3"
                      class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-gray-100 text-gray-600"
                    >
                      +{{ task.tags.length - 3 }}
                    </span>
                  </div>
                </div>
              </div>

              <!-- Arrow -->
              <div class="flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div
      v-if="showDeleteModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
      @click="showDeleteModal = false"
    >
      <div
        class="bg-white rounded-lg p-6 max-w-md w-full"
        @click.stop
      >
        <div class="flex items-center mb-4">
          <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-4">
            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-900">Delete Task</h3>
            <p class="text-gray-600 text-sm">This action cannot be undone.</p>
          </div>
        </div>
        
        <p class="text-gray-700 mb-6">
          Are you sure you want to delete "<strong>{{ taskToDelete?.title }}</strong>"?
        </p>
        
        <div class="flex justify-end space-x-3">
          <button
            @click="showDeleteModal = false"
            class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200"
          >
            Cancel
          </button>
          <button
            @click="confirmDelete"
            class="px-4 py-2 bg-red-600 text-white hover:bg-red-700 rounded-lg transition-colors duration-200"
          >
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { useTasksStore } from "@/stores/tasks";
import { useNotificationsStore } from "@/stores/notifications";

const tasksStore = useTasksStore();
const notificationsStore = useNotificationsStore();

const activeFilter = ref("all");
const searchQuery = ref("");
const sortBy = ref("created_at");
const showDeleteModal = ref(false);
const taskToDelete = ref(null);

const filters = computed(() => [
  { key: "all", label: "All", count: tasksStore.tasksCount },
  { key: "pending", label: "Pending", count: tasksStore.pendingTasks.length },
  { key: "completed", label: "Completed", count: tasksStore.completedTasks.length },
]);

const filteredTasks = computed(() => {
  let tasks = tasksStore.tasks;

  // Filter by status
  if (activeFilter.value === "pending") {
    tasks = tasks.filter((task) => !task.completed);
  } else if (activeFilter.value === "completed") {
    tasks = tasks.filter((task) => task.completed);
  }

  // Filter by search query
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase();
    tasks = tasks.filter(
      (task) =>
        task.title.toLowerCase().includes(query) ||
        task.description?.toLowerCase().includes(query)
    );
  }

  // Sort tasks
  tasks.sort((a, b) => {
    switch (sortBy.value) {
      case "title":
        return a.title.localeCompare(b.title);
      case "priority":
        const priorityOrder = { high: 3, medium: 2, low: 1 };
        return (priorityOrder[b.priority] || 0) - (priorityOrder[a.priority] || 0);
      case "due_date":
        if (!a.due_date && !b.due_date) return 0;
        if (!a.due_date) return 1;
        if (!b.due_date) return -1;
        return new Date(a.due_date) - new Date(b.due_date);
      default:
        return new Date(b.created_at) - new Date(a.created_at);
    }
  });

  return tasks;
});

const toggleTask = async (task) => {
  try {
    await tasksStore.toggleTaskStatus(task.id);
    notificationsStore.success(
      `Task ${task.completed ? "uncompleted" : "completed"}`
    );
  } catch (error) {
    notificationsStore.error("Failed to update task");
  }
};

const selectTask = (task) => {
  console.log("Selected task:", task);
  // Navigate to task detail page
};

const editTask = (task) => {
  console.log("Edit task:", task);
  // Navigate to edit task page
};

const deleteTask = (task) => {
  taskToDelete.value = task;
  showDeleteModal.value = true;
};

const confirmDelete = async () => {
  try {
    await tasksStore.deleteTask(taskToDelete.value.id);
    notificationsStore.success("Task deleted successfully");
    showDeleteModal.value = false;
    taskToDelete.value = null;
  } catch (error) {
    notificationsStore.error("Failed to delete task");
  }
};

const getPriorityClass = (priority) => {
  switch (priority?.toLowerCase()) {
    case "high":
      return "bg-red-50 text-red-700 border border-red-200";
    case "medium":
      return "bg-yellow-50 text-yellow-700 border border-yellow-200";
    case "low":
      return "bg-green-50 text-green-700 border border-green-200";
    default:
      return "bg-gray-50 text-gray-700 border border-gray-200";
  }
};

const getPriorityDotClass = (priority) => {
  switch (priority?.toLowerCase()) {
    case "high":
      return "bg-red-500";
    case "medium":
      return "bg-yellow-500";
    case "low":
      return "bg-green-500";
    default:
      return "bg-gray-400";
  }
};

const isOverdue = (dueDate) => {
  if (!dueDate) return false;
  return new Date(dueDate) < new Date();
};

const formatDate = (date) => {
  if (!date) return "";
  return new Date(date).toLocaleDateString("en-US", {
    month: "short",
    day: "numeric",
    year: "numeric",
  });
};

onMounted(() => {
  tasksStore.fetchTasks();
});
</script>