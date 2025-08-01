<template>
  <div class="min-h-screen bg-gray-50 pt-20">
    <div class="max-w-4xl mx-auto px-8">
      <!-- Header -->
      <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
          <button
            @click="goBack"
            class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors duration-200"
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
                d="M15 19l-7-7 7-7"
              ></path>
            </svg>
          </button>
          <div>
            <h1 class="text-3xl font-bold text-gray-900">Edit Task</h1>
            <p class="text-gray-600">Update your task details</p>
          </div>
        </div>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="flex items-center justify-center py-16">
        <div
          class="inline-flex items-center justify-center w-12 h-12 border-4 border-gray-200 border-t-gray-900 rounded-full animate-spin"
        ></div>
      </div>

      <!-- Error State -->
      <div
        v-else-if="error"
        class="bg-red-50 border border-red-200 rounded-lg p-6 mb-8"
      >
        <div class="flex items-center">
          <svg
            class="w-5 h-5 text-red-600 mr-3"
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
          <p class="text-red-800">{{ error }}</p>
        </div>
      </div>

      <!-- Edit Form -->
      <div
        v-else-if="task"
        class="bg-white rounded-lg border border-gray-200 p-8"
      >
        <form @submit.prevent="updateTask" class="space-y-6">
          <!-- Title -->
          <div>
            <label
              for="title"
              class="block text-sm font-semibold text-gray-900 mb-2"
            >
              Task Title *
            </label>
            <input
              id="title"
              v-model="form.title"
              type="text"
              required
              placeholder="Enter task title..."
              class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors"
            />
          </div>

          <!-- Description -->
          <div>
            <label
              for="description"
              class="block text-sm font-semibold text-gray-900 mb-2"
            >
              Description
            </label>
            <textarea
              id="description"
              v-model="form.description"
              rows="4"
              placeholder="Enter task description..."
              class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors resize-vertical"
            ></textarea>
          </div>

          <!-- Priority and Due Date Row -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Priority -->
            <div>
              <label
                for="priority"
                class="block text-sm font-semibold text-gray-900 mb-2"
              >
                Priority
              </label>
              <select
                id="priority"
                v-model="form.priority"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors"
              >
                <option value="">Select priority</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
              </select>
            </div>

            <!-- Due Date -->
            <div>
              <label
                for="due_date"
                class="block text-sm font-semibold text-gray-900 mb-2"
              >
                Due Date
              </label>
              <input
                id="due_date"
                v-model="form.due_date"
                type="date"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors"
              />
            </div>
          </div>

          <!-- Status -->
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-3">
              Status
            </label>
            <div class="flex items-center space-x-6">
              <label class="flex items-center">
                <input
                  v-model="form.completed"
                  :value="false"
                  type="radio"
                  class="w-4 h-4 text-gray-600 focus:ring-gray-500 border-gray-300"
                />
                <span class="ml-2 text-gray-700">Pending</span>
              </label>
              <label class="flex items-center">
                <input
                  v-model="form.completed"
                  :value="true"
                  type="radio"
                  class="w-4 h-4 text-gray-600 focus:ring-gray-500 border-gray-300"
                />
                <span class="ml-2 text-gray-700">Completed</span>
              </label>
            </div>
          </div>

          <!-- Tags -->
          <div>
            <label
              for="tags"
              class="block text-sm font-semibold text-gray-900 mb-2"
            >
              Tags
            </label>
            <div class="space-y-3">
              <input
                v-model="newTag"
                @keyup.enter="addTag"
                type="text"
                placeholder="Add a tag and press Enter..."
                class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-gray-500 transition-colors"
              />
              <div
                v-if="form.tags && form.tags.length"
                class="flex flex-wrap gap-2"
              >
                <span
                  v-for="(tag, index) in form.tags"
                  :key="index"
                  class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-700"
                >
                  {{ tag }}
                  <button
                    @click="removeTag(index)"
                    type="button"
                    class="ml-2 w-4 h-4 text-gray-500 hover:text-gray-700"
                  >
                    <svg fill="currentColor" viewBox="0 0 20 20">
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

          <!-- Action Buttons -->
          <div
            class="flex items-center justify-between pt-6 border-t border-gray-200"
          >
            <button
              @click="goBack"
              type="button"
              class="px-6 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium transition-colors duration-200"
            >
              Cancel
            </button>

            <div class="flex items-center space-x-3">
              <button
                @click="deleteTask"
                type="button"
                class="px-6 py-3 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg font-medium transition-colors duration-200"
              >
                Delete Task
              </button>
              <button
                type="submit"
                :disabled="submitting || !form.title.trim()"
                class="px-8 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors duration-200 font-medium disabled:opacity-50 disabled:cursor-not-allowed"
              >
                {{ submitting ? "Updating..." : "Update Task" }}
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