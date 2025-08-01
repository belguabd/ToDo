<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 pt-20">
    <div class="max-w-4xl mx-auto px-8 py-8">
      <!-- Enhanced Header -->
      <div class="relative overflow-hidden bg-white dark:bg-slate-800 rounded-3xl p-8 shadow-sm border border-slate-200/50 dark:border-slate-700/50 mb-8">
        <!-- Animated background elements -->
        <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-500/5 to-purple-500/10 dark:from-blue-400/10 dark:to-purple-500/20 rounded-full -translate-y-20 translate-x-20"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-emerald-500/5 to-teal-500/10 dark:from-emerald-400/10 dark:to-teal-500/20 rounded-full translate-y-16 -translate-x-16"></div>
        <div class="absolute top-1/2 left-1/2 w-24 h-24 bg-gradient-to-br from-slate-500/5 to-slate-600/10 dark:from-slate-400/10 dark:to-slate-500/20 rounded-full -translate-x-1/2 -translate-y-1/2"></div>

        <div class="relative flex items-center justify-between">
          <div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 dark:from-white dark:to-slate-300 bg-clip-text text-transparent mb-3">
              Create New Task
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-lg">
              Transform your ideas into actionable tasks
            </p>
          </div>
          <router-link
            to="/tasks"
            class="group inline-flex items-center px-6 py-3 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-2xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-all duration-300 hover:scale-105 font-medium shadow-sm hover:shadow-md ring-1 ring-slate-200/50 dark:ring-slate-600/50"
          >
            <ChevronLeft class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-200" />
            Back to Tasks
          </router-link>
        </div>
      </div>

      <!-- Enhanced Create Task Form -->
      <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <form @submit.prevent="handleSubmit" class="p-10 space-y-10">
          <!-- Task Title with Enhanced Styling -->
          <div class="space-y-4">
            <Label
              for="title"
              class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
            >
              <div class="w-2 h-2 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full mr-3"></div>
              Task Title
              <span class="text-red-500 ml-1">*</span>
            </Label>
            <div class="relative group">
              <div class="absolute inset-0 bg-gradient-to-r from-blue-500/5 to-purple-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
              <FileText class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-200 z-10" />
              <Input
                id="title"
                v-model="form.title"
                type="text"
                required
                placeholder="What needs to be accomplished?"
                class="relative z-10 pl-12 pr-12 h-14 text-lg bg-slate-50/50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-600 rounded-2xl focus:border-blue-500 focus:ring-blue-500/20 focus:ring-4 transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-500"
                :class="{
                  'border-red-500 focus:border-red-500 focus:ring-red-500/20': errors.title,
                }"
              />
              <div
                v-if="errors.title"
                class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none z-10"
              >
                <AlertCircle class="w-5 h-5 text-red-500" />
              </div>
            </div>
            <p
              v-if="errors.title"
              class="text-sm text-red-600 dark:text-red-400 flex items-center bg-red-50 dark:bg-red-900/20 px-3 py-2 rounded-lg"
            >
              <AlertCircle class="w-4 h-4 mr-2" />
              {{ errors.title }}
            </p>
          </div>

          <!-- Task Description with Enhanced Styling -->
          <div class="space-y-4">
            <Label
              for="description"
              class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
            >
              <div class="w-2 h-2 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full mr-3"></div>
              Description
            </Label>
            <div class="relative group">
              <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/5 to-teal-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
              <Mic class="absolute top-5 left-4 h-5 w-5 text-slate-400 group-focus-within:text-emerald-500 transition-colors duration-200 z-10" />
              <Textarea
                id="description"
                v-model="form.description"
                rows="5"
                placeholder="Add more details about your task... (optional)"
                class="relative z-10 pl-12 pr-4 py-4 text-base bg-slate-50/50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-600 rounded-2xl focus:border-emerald-500 focus:ring-emerald-500/20 focus:ring-4 transition-all duration-200 resize-none hover:border-slate-300 dark:hover:border-slate-500"
              />
            </div>
          </div>

          <!-- Status and Priority with Enhanced Styling -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
              <Label
                for="status"
                class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
              >
                <div class="w-2 h-2 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full mr-3"></div>
                Status
              </Label>
              <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-amber-500/5 to-orange-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
                <ListChecks class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-amber-500 transition-colors duration-200 z-10" />
                <select
                  id="status"
                  v-model="form.status"
                  class="relative z-10 pl-12 pr-4 h-14 text-base bg-slate-50/50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-600 rounded-2xl focus:border-amber-500 focus:ring-amber-500/20 focus:ring-4 transition-all duration-200 w-full appearance-none hover:border-slate-300 dark:hover:border-slate-500"
                >
                  <option value="pending">Pending</option>
                  <option value="completed">Completed</option>
                </select>
                <!-- Custom dropdown arrow -->
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none z-10">
                  <svg class="w-5 h-5 text-slate-400 group-focus-within:text-amber-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </div>
              </div>
            </div>
            <div class="space-y-4">
              <Label
                for="priority"
                class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
              >
                <div class="w-2 h-2 bg-gradient-to-r from-red-500 to-pink-500 rounded-full mr-3"></div>
                Priority
              </Label>
              <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-r from-red-500/5 to-pink-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
                <Flag class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-red-500 transition-colors duration-200 z-10" />
                <select
                  id="priority"
                  v-model="form.priority"
                  class="relative z-10 pl-12 pr-4 h-14 text-base bg-slate-50/50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-600 rounded-2xl focus:border-red-500 focus:ring-red-500/20 focus:ring-4 transition-all duration-200 w-full appearance-none hover:border-slate-300 dark:hover:border-slate-500"
                >
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
          </div>

          <!-- Due Date with Enhanced Styling -->
          <div class="space-y-4">
            <Label
              for="due_date"
              class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
            >
              <div class="w-2 h-2 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mr-3"></div>
              Due Date
              <span class="text-xs font-normal text-slate-500 dark:text-slate-400 ml-2 px-2 py-1 bg-slate-100 dark:bg-slate-700 rounded-full">(optional)</span>
            </Label>
            <div class="relative group">
              <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/5 to-purple-500/5 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"></div>
              <Calendar class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-200 z-10" />
              <Input
                id="due_date"
                v-model="form.due_date"
                type="date"
                class="relative z-10 pl-12 pr-4 h-14 text-base bg-slate-50/50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-600 rounded-2xl focus:border-indigo-500 focus:ring-indigo-500/20 focus:ring-4 transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-500"
              />
            </div>
          </div>

          <!-- Action Buttons with Enhanced Styling -->
          <div class="flex items-center justify-between pt-8 border-t border-slate-200/50 dark:border-slate-700/50">
            <Button
              as-child
              variant="outline"
              size="lg"
              class="group h-12 px-6 rounded-2xl border-slate-300 dark:border-slate-600 hover:border-slate-400 dark:hover:border-slate-500 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-all duration-200"
            >
              <router-link to="/tasks" class="flex items-center">
                <ChevronLeft class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-200" />
                Cancel
              </router-link>
            </Button>

            <div class="flex items-center space-x-4">
              <Button
                type="button"
                @click="saveDraft"
                variant="outline"
                size="lg"
                class="group h-12 px-6 rounded-2xl border-blue-200 dark:border-blue-700 hover:border-blue-300 dark:hover:border-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 text-blue-700 dark:text-blue-300 transition-all duration-200"
              >
                <Save class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200" />
                Save Draft
              </Button>

              <Button
                type="submit"
                :disabled="!form.title || isSubmitting"
                size="lg"
                class="group h-12 px-8 rounded-2xl bg-gradient-to-r from-slate-900 to-slate-800 dark:from-white dark:to-slate-100 text-white dark:text-slate-900 hover:from-slate-800 hover:to-slate-700 dark:hover:from-slate-100 dark:hover:to-slate-200 disabled:from-slate-300 disabled:to-slate-300 dark:disabled:from-slate-600 dark:disabled:to-slate-600 shadow-lg hover:shadow-xl disabled:shadow-none transition-all duration-300 hover:scale-105 disabled:hover:scale-100"
              >
                <LoaderCircle
                  v-if="isSubmitting"
                  class="w-5 h-5 mr-2 animate-spin"
                />
                <Plus
                  v-else
                  class="w-5 h-5 mr-2 group-hover:scale-110 group-hover:rotate-90 transition-all duration-200"
                />
                {{ isSubmitting ? "Creating Task..." : "Create Task" }}
              </Button>
            </div>
          </div>
        </form>
      </div>

      <!-- Enhanced Quick Tips -->
      <div class="mt-8 bg-white dark:bg-slate-800 rounded-3xl p-8 border border-slate-200/50 dark:border-slate-700/50 shadow-sm">
        <div class="flex items-start space-x-6">
          <div class="flex-shrink-0">
            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
              <Lightbulb class="w-7 h-7 text-white" />
            </div>
          </div>
          <div class="flex-1">
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-4 flex items-center">
              Pro Tips for Better Task Management
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="group flex items-start space-x-3 p-4 rounded-2xl hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors duration-200">
                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0 group-hover:scale-125 transition-transform duration-200"></div>
                <p class="text-slate-700 dark:text-slate-300 leading-relaxed">
                  Use clear, actionable titles that start with verbs
                </p>
              </div>
              <div class="group flex items-start space-x-3 p-4 rounded-2xl hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors duration-200">
                <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2 flex-shrink-0 group-hover:scale-125 transition-transform duration-200"></div>
                <p class="text-slate-700 dark:text-slate-300 leading-relaxed">
                  Set realistic deadlines to maintain momentum
                </p>
              </div>
              <div class="group flex items-start space-x-3 p-4 rounded-2xl hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors duration-200">
                <div class="w-2 h-2 bg-amber-500 rounded-full mt-2 flex-shrink-0 group-hover:scale-125 transition-transform duration-200"></div>
                <p class="text-slate-700 dark:text-slate-300 leading-relaxed">
                  Break complex tasks into smaller subtasks
                </p>
              </div>
              <div class="group flex items-start space-x-3 p-4 rounded-2xl hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors duration-200">
                <div class="w-2 h-2 bg-purple-500 rounded-full mt-2 flex-shrink-0 group-hover:scale-125 transition-transform duration-200"></div>
                <p class="text-slate-700 dark:text-slate-300 leading-relaxed">
                  Use the description for important context
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Floating Success Indicator -->
      <div
        class="fixed bottom-8 right-8 opacity-0 transition-all duration-300 transform translate-y-4"
        id="success-indicator"
      >
        <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-4 rounded-2xl shadow-xl ring-1 ring-white/20">
          <div class="flex items-center space-x-3">
            <div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>
            <span class="font-semibold">Task created successfully!</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
<script setup>
import { ref, reactive, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useTasksStore } from "@/stores/tasks";
import { useNotificationsStore } from "@/stores/notifications";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";
import { Button } from "@/components/ui/button";
import {
  AlertCircle,
  Calendar,
  ChevronLeft,
  Lightbulb,
  LoaderCircle,
  Mic,
  Plus,
  Save,
  FileText,
  Flag,
  ListChecks,
} from "lucide-vue-next";

const router = useRouter();
const tasksStore = useTasksStore();
const notificationsStore = useNotificationsStore();

const isSubmitting = ref(false);

const form = reactive({
  title: "",
  description: "",
  status: "pending",
  priority: "medium",
  due_date: "",
});

const errors = reactive({
  title: "",
});

const validateForm = () => {
  errors.title = "";

  if (!form.title.trim()) {
    errors.title = "Task title is required";
    return false;
  }

  if (form.title.length > 255) {
    errors.title = "Task title must be less than 255 characters";
    return false;
  }

  return true;
};

const handleSubmit = async () => {
  if (!validateForm()) return;

  isSubmitting.value = true;

  try {
    const taskData = {
      title: form.title.trim(),
      description: form.description.trim(),
      status: form.status,
      priority: form.priority,
      due_date: form.due_date || null,
      completed: form.status === "completed",
    };

    console.log("Creating task with data:", taskData);
    await tasksStore.createTask(taskData);

    // Show success indicator
    // const indicator = document.getElementById("success-indicator");
    // if (indicator) {
    //   indicator.style.opacity = "1";
    //   setTimeout(() => {
    //     indicator.style.opacity = "0";
    //   }, 3000);
    // }

    // notificationsStore.success("Task created successfully!");

    // Clear form and draft
    // clearDraft();
    // Object.assign(form, {
    //   title: "",
    //   description: "",
    //   status: "pending",
    //   priority: "medium",
    //   due_date: "",
    // });

    // Navigate after a brief delay to show success
    setTimeout(() => {
      router.push("/tasks");
    }, 1500);
  } catch (error) {
    notificationsStore.error("Failed to create task. Please try again.");
    console.error("Error creating task:", error);
  } finally {
    isSubmitting.value = false;
  }
};

const saveDraft = () => {
  if (!form.title.trim()) {
    notificationsStore.error("Please add a task title before saving draft");
    return;
  }

  // Save to localStorage
  localStorage.setItem("taskDraft", JSON.stringify(form));
  notificationsStore.success("Draft saved successfully!");
};

const loadDraft = () => {
  const draft = localStorage.getItem("taskDraft");
  if (draft) {
    try {
      const draftData = JSON.parse(draft);
      Object.assign(form, draftData);
    } catch (error) {
      console.error("Error loading draft:", error);
    }
  }
};

const clearDraft = () => {
  localStorage.removeItem("taskDraft");
};

onMounted(() => {
  loadDraft();
});
</script>