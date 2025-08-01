<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 pt-20">
    <div class="max-w-4xl mx-auto px-8 py-8">
      <!-- Enhanced Header -->
      <div class="mb-8">
        <div class="flex items-center space-x-6 mb-6">
          <button
            @click="goBack"
            class="group p-3 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-2xl transition-all duration-200 hover:scale-110"
          >
            <svg
              class="w-6 h-6 group-hover:-translate-x-1 transition-transform duration-200"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M15 19l-7-7 7-7"
              ></path>
            </svg>
          </button>
          <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 dark:from-white dark:to-slate-300 bg-clip-text text-transparent mb-2">
              Edit Task
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-lg">Update your task details</p>
          </div>
        </div>
      </div>

      <!-- Enhanced Loading State -->
      <div v-if="loading" class="flex items-center justify-center py-20 bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
        <div class="text-center">
          <div class="relative mb-6">
            <div class="w-16 h-16 border-4 border-slate-200 dark:border-slate-700 border-t-blue-500 rounded-full animate-spin mx-auto"></div>
            <div class="absolute inset-0 w-16 h-16 border-4 border-transparent border-t-purple-500 rounded-full animate-spin mx-auto" style="animation-delay: 0.15s; animation-duration: 1.5s;"></div>
          </div>
          <h3 class="text-lg font-semibold text-slate-800 dark:text-white mb-2">Loading task...</h3>
          <p class="text-slate-500 dark:text-slate-400">Please wait while we fetch your task details</p>
        </div>
      </div>

      <!-- Enhanced Error State -->
      <div
        v-else-if="error"
        class="bg-gradient-to-r from-red-50 to-red-50/50 dark:from-red-900/20 dark:to-red-900/10 border border-red-200 dark:border-red-800/50 rounded-3xl p-8 mb-8 shadow-sm"
      >
        <div class="flex items-center">
          <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
            <svg
              class="w-6 h-6 text-white"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
              ></path>
            </svg>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-red-800 dark:text-red-300 mb-1">Error Loading Task</h3>
            <p class="text-red-700 dark:text-red-400">{{ error }}</p>
          </div>
        </div>
      </div>

      <!-- Enhanced Edit Form -->
      <div
        v-else-if="task"
        class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden"
      >
        <form @submit.prevent="updateTask" class="p-10 space-y-10">
          <!-- Enhanced Title -->
          <div class="space-y-4">
            <label
              for="title"
              class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
            >
              <div class="w-2 h-2 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mr-3"></div>
              Task Title
              <span class="text-red-500 ml-1">*</span>
            </label>
            <div class="relative group">
              <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 to-purple-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
              <input
                id="title"
                v-model="form.title"
                type="text"
                required
                placeholder="Enter task title..."
                class="relative z-10 w-full px-4 py-4 text-lg border border-slate-300 dark:border-slate-600 rounded-2xl text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 bg-slate-50/50 dark:bg-slate-900/50 hover:border-slate-400 dark:hover:border-slate-500"
              />
            </div>
          </div>

          <!-- Enhanced Description -->
          <div class="space-y-4">
            <label
              for="description"
              class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
            >
              <div class="w-2 h-2 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full mr-3"></div>
              Description
            </label>
            <div class="relative group">
              <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 to-teal-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
              <textarea
                id="description"
                v-model="form.description"
                rows="5"
                placeholder="Enter task description..."
                class="relative z-10 w-full px-4 py-4 text-base border border-slate-300 dark:border-slate-600 rounded-2xl text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 dark:focus:border-emerald-400 transition-all duration-200 bg-slate-50/50 dark:bg-slate-900/50 hover:border-slate-400 dark:hover:border-slate-500 resize-vertical"
              ></textarea>
            </div>
          </div>

          <!-- Enhanced Priority and Due Date Row -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Enhanced Priority -->
            <div class="space-y-4">
              <label
                for="priority"
                class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
              >
                <div class="w-2 h-2 bg-gradient-to-r from-red-500 to-pink-500 rounded-full mr-3"></div>
                Priority
              </label>
              <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-red-500/5 to-pink-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
                <select
                  id="priority"
                  v-model="form.priority"
                  class="relative z-10 w-full px-4 py-4 text-base border border-slate-300 dark:border-slate-600 rounded-2xl text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 dark:focus:border-red-400 transition-all duration-200 bg-slate-50/50 dark:bg-slate-900/50 hover:border-slate-400 dark:hover:border-slate-500 appearance-none"
                >
                  <option value="">Select priority</option>
                  <option value="low">Low</option>
                  <option value="medium">Medium</option>
                  <option value="high">High</option>
                </select>
                <!-- Custom dropdown arrow -->
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none z-10">
                  <svg class="w-5 h-5 text-slate-400 group-focus-within:text-red-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </div>
              </div>
            </div>

            <!-- Enhanced Due Date -->
            <div class="space-y-4">
              <label
                for="due_date"
                class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
              >
                <div class="w-2 h-2 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mr-3"></div>
                Due Date
              </label>
              <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 to-purple-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
                <input
                  id="due_date"
                  v-model="form.due_date"
                  type="date"
                  class="relative z-10 w-full px-4 py-4 text-base border border-slate-300 dark:border-slate-600 rounded-2xl text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all duration-200 bg-slate-50/50 dark:bg-slate-900/50 hover:border-slate-400 dark:hover:border-slate-500"
                />
              </div>
            </div>
          </div>

          <!-- Enhanced Status -->
          <div class="space-y-4">
            <label class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center">
              <div class="w-2 h-2 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full mr-3"></div>
              Status
            </label>
            <div class="flex items-center space-x-8">
              <label class="group flex items-center cursor-pointer">
                <div class="relative">
                  <input
                    v-model="form.completed"
                    :value="false"
                    type="radio"
                    class="sr-only"
                  />
                  <div class="w-5 h-5 border-2 border-slate-300 dark:border-slate-600 rounded-full group-hover:border-amber-400 transition-colors duration-200"
                    :class="!form.completed ? 'bg-gradient-to-r from-amber-500 to-orange-500 border-amber-500' : ''"
                  >
                    <div v-if="!form.completed" class="w-2 h-2 bg-white rounded-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
                  </div>
                </div>
                <span class="ml-3 text-slate-700 dark:text-slate-300 font-medium">Pending</span>
              </label>
              <label class="group flex items-center cursor-pointer">
                <div class="relative">
                  <input
                    v-model="form.completed"
                    :value="true"
                    type="radio"
                    class="sr-only"
                  />
                  <div class="w-5 h-5 border-2 border-slate-300 dark:border-slate-600 rounded-full group-hover:border-green-400 transition-colors duration-200"
                    :class="form.completed ? 'bg-gradient-to-r from-green-500 to-emerald-500 border-green-500' : ''"
                  >
                    <div v-if="form.completed" class="w-2 h-2 bg-white rounded-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
                  </div>
                </div>
                <span class="ml-3 text-slate-700 dark:text-slate-300 font-medium">Completed</span>
              </label>
            </div>
          </div>

          <!-- Enhanced Tags -->
          <div class="space-y-4">
            <label
              for="tags"
              class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
            >
              <div class="w-2 h-2 bg-gradient-to-r from-violet-500 to-purple-500 rounded-full mr-3"></div>
              Tags
            </label>
            <div class="space-y-4">
              <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-violet-500/5 to-purple-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
                <input
                  v-model="newTag"
                  @keyup.enter="addTag"
                  type="text"
                  placeholder="Add a tag and press Enter..."
                  class="relative z-10 w-full px-4 py-4 text-base border border-slate-300 dark:border-slate-600 rounded-2xl text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-violet-500/20 focus:border-violet-500 dark:focus:border-violet-400 transition-all duration-200 bg-slate-50/50 dark:bg-slate-900/50 hover:border-slate-400 dark:hover:border-slate-500"
                />
              </div>
              <div
                v-if="form.tags && form.tags.length"
                class="flex flex-wrap gap-3"
              >
                <span
                  v-for="(tag, index) in form.tags"
                  :key="index"
                  class="group inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors duration-200"
                >
                  {{ tag }}
                  <button
                    @click="removeTag(index)"
                    type="button"
                    class="ml-2 w-5 h-5 text-slate-500 hover:text-red-600 dark:hover:text-red-400 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-200 hover:scale-110"
                  >
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-3 h-3">
                      <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </button>
                </span>
              </div>
            </div>
          </div>

          <!-- Enhanced Action Buttons -->
          <div class="flex items-center justify-between pt-8 border-t border-slate-200/50 dark:border-slate-700/50">
            <button
              @click="goBack"
              type="button"
              class="group px-6 py-3 text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-2xl font-medium transition-all duration-200 hover:scale-105"
            >
              <span class="group-hover:-translate-x-1 transition-transform duration-200 inline-block">Cancel</span>
            </button>

            <div class="flex items-center space-x-4">
              <button
                @click="deleteTask"
                type="button"
                class="group px-6 py-3 text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-2xl font-medium transition-all duration-200 hover:scale-105 border border-red-200 dark:border-red-800"
              >
                <span class="flex items-center">
                  <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                  </svg>
                  Delete Task
                </span>
              </button>
              <button
                type="submit"
                :disabled="submitting || !form.title.trim()"
                class="group px-8 py-3 bg-gradient-to-r from-slate-900 to-slate-800 dark:from-white dark:to-slate-100 text-white dark:text-slate-900 rounded-2xl hover:from-slate-800 hover:to-slate-700 dark:hover:from-slate-100 dark:hover:to-slate-200 transition-all duration-200 font-medium disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:shadow-xl disabled:shadow-none hover:scale-105 disabled:hover:scale-100"
              >
                <span class="flex items-center">
                  <svg v-if="submitting" class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                  </svg>
                  <svg v-else class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                  </svg>
                  {{ submitting ? "Updating..." : "Update Task" }}
                </span>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
  
<script setup>
import { ref, reactive, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useTasksStore } from "@/stores/tasks";
import { useNotificationsStore } from "@/stores/notifications";

const route = useRoute();
const router = useRouter();
const tasksStore = useTasksStore();
const notificationsStore = useNotificationsStore();

const task = ref(null);
const loading = ref(true);
const error = ref(null);
const submitting = ref(false);
const newTag = ref("");

const form = reactive({
  title: "",
  description: "",
  priority: "",
  due_date: "",
  completed: false,
  tags: [],
});

const loadTask = async () => {
  try {
    loading.value = true;
    error.value = null;

    const taskData = await tasksStore.getTask(route.params.id);
    task.value = taskData;

    // Populate form with task data
    form.title = taskData.title || "";
    form.description = taskData.description || "";
    form.priority = taskData.priority || "";
    form.due_date = taskData.due_date || "";
    form.completed = taskData.completed || false;
    form.tags = taskData.tags ? [...taskData.tags] : [];
  } catch (err) {
    error.value = "Failed to load task";
    console.error("Error loading task:", err);
  } finally {
    loading.value = false;
  }
};

const updateTask = async () => {
  if (!form.title.trim()) return;

  try {
    submitting.value = true;

    await tasksStore.updateTask(route.params.id, {
      title: form.title.trim(),
      description: form.description?.trim() || null,
      priority: form.priority || null,
      due_date: form.due_date || null,
      completed: form.completed,
      tags: form.tags,
    });

    notificationsStore.success("Task updated successfully");
    router.push({ name: "Tasks" });
  } catch (err) {
    notificationsStore.error("Failed to update task");
    console.error("Error updating task:", err);
  } finally {
    submitting.value = false;
  }
};

const deleteTask = async () => {
  if (!confirm("Are you sure you want to delete this task?")) return;

  try {
    await tasksStore.deleteTask(route.params.id);
    notificationsStore.success("Task deleted successfully");
    router.push({ name: "Tasks" });
  } catch (err) {
    notificationsStore.error("Failed to delete task");
    console.error("Error deleting task:", err);
  }
};

const addTag = () => {
  const tag = newTag.value.trim();
  if (tag && !form.tags.includes(tag)) {
    form.tags.push(tag);
    newTag.value = "";
  }
};

const removeTag = (index) => {
  form.tags.splice(index, 1);
};

const goBack = () => {
  router.back();
};

onMounted(() => {
  loadTask();
});
</script>