<template>
    <div
      class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 dark:from-slate-900 dark:via-blue-950/20 dark:to-slate-900 pt-8"
    >
      <div class="max-w-3xl mx-auto px-6">
        <!-- Enhanced Header with Blue Theme -->
        <div
          class="relative overflow-hidden bg-gradient-to-r from-slate-50 via-white to-slate-50 dark:from-slate-800 dark:via-slate-700 dark:to-slate-800 rounded-3xl p-8 shadow-lg border-b border-slate-200/50 dark:border-slate-700/50 mb-8 backdrop-blur-sm"
        >
          <!-- Animated background elements -->
          <div
            class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-blue-600/15 to-indigo-600/10 rounded-full -translate-y-24 translate-x-24 animate-pulse"
          ></div>
          <div
            class="absolute bottom-0 left-0 w-36 h-36 bg-gradient-to-br from-blue-500/10 to-cyan-500/10 rounded-full translate-y-18 -translate-x-18"
          ></div>
          <div
            class="absolute top-1/2 left-1/2 w-20 h-20 bg-blue-600/5 rounded-full -translate-x-1/2 -translate-y-1/2"
          ></div>
  
          <div class="relative flex items-center justify-between">
            <div>
              <h1
                class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 bg-clip-text text-transparent mb-3"
              >
                Create New Task
              </h1>
              <p class="text-slate-600 dark:text-slate-400 text-lg">
                Transform your ideas into actionable tasks
              </p>
            </div>
            <router-link
              to="/tasks"
              class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-slate-100 to-slate-50 dark:from-slate-700 dark:to-slate-600 text-slate-700 dark:text-slate-200 rounded-2xl hover:from-blue-50 hover:to-indigo-50 dark:hover:from-slate-600 dark:hover:to-slate-500 transition-all duration-300 hover:scale-105 font-medium shadow-sm hover:shadow-md border border-slate-200/50 dark:border-slate-600/50"
            >
              <ChevronLeft
                class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-200"
              />
              Back to Tasks
            </router-link>
          </div>
        </div>
  
        <!-- Enhanced Create Task Form -->
        <div
          class="bg-gradient-to-r from-slate-50 via-white to-slate-50 dark:from-slate-800 dark:via-slate-700 dark:to-slate-800 rounded-3xl shadow-xl border-b border-slate-200/50 dark:border-slate-700/50 overflow-hidden backdrop-blur-sm"
        >
          <form @submit.prevent="handleSubmit" class="p-10 space-y-10">
            <!-- Task Title with Enhanced Styling -->
            <div class="space-y-4">
              <Label
                for="title"
                class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
              >
                <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                Task Title
                <span class="text-red-500 ml-1">*</span>
              </Label>
              <div class="relative group">
                <div
                  class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-indigo-600/10 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"
                ></div>
                <FileText
                  class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors duration-200 z-10"
                />
                <Input
                  id="title"
                  v-model="form.title"
                  type="text"
                  required
                  placeholder="What needs to be accomplished?"
                  class="relative z-10 pl-12 pr-12 h-14 text-lg bg-slate-50/50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-600 rounded-2xl focus:border-blue-600 focus:ring-blue-600/20 focus:ring-4 transition-all duration-200"
                  :class="{
                    'border-red-500 focus:border-red-500 focus:ring-red-500/20':
                      errors.title,
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
                class="text-sm text-red-600 dark:text-red-400 flex items-center"
              >
                <AlertCircle class="w-4 h-4 mr-1" />
                {{ errors.title }}
              </p>
            </div>
  
            <!-- Task Description with Enhanced Styling -->
            <div class="space-y-4">
              <Label
                for="description"
                class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
              >
                <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                Description
              </Label>
              <div class="relative group">
                <div
                  class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-indigo-600/10 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"
                ></div>
                <Mic
                  class="absolute top-5 left-4 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors duration-200 z-10"
                />
                <Textarea
                  id="description"
                  v-model="form.description"
                  rows="5"
                  placeholder="Add more details about your task... (optional)"
                  class="relative z-10 pl-12 pr-4 py-4 text-base bg-slate-50/50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-600 rounded-2xl focus:border-blue-600 focus:ring-blue-600/20 focus:ring-4 transition-all duration-200 resize-none"
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
                  <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                  Status
                </Label>
                <div class="relative group">
                  <div
                    class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-indigo-600/10 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"
                  ></div>
                  <ListChecks
                    class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors duration-200 z-10"
                  />
                  <select
                    id="status"
                    v-model="form.status"
                    class="relative z-10 pl-12 pr-4 h-14 text-base bg-slate-50/50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-600 rounded-2xl focus:border-blue-600 focus:ring-blue-600/20 focus:ring-4 transition-all duration-200 w-full appearance-none"
                  >
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                  </select>
                </div>
              </div>
              <div class="space-y-4">
                <Label
                  for="priority"
                  class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
                >
                  <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                  Priority
                </Label>
                <div class="relative group">
                  <div
                    class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-indigo-600/10 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"
                  ></div>
                  <Flag
                    class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors duration-200 z-10"
                  />
                  <select
                    id="priority"
                    v-model="form.priority"
                    class="relative z-10 pl-12 pr-4 h-14 text-base bg-slate-50/50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-600 rounded-2xl focus:border-blue-600 focus:ring-blue-600/20 focus:ring-4 transition-all duration-200 w-full appearance-none"
                  >
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                  </select>
                </div>
              </div>
            </div>
  
            <!-- Due Date with Enhanced Styling -->
            <div class="space-y-4">
              <Label
                for="due_date"
                class="block text-base font-semibold text-slate-700 dark:text-slate-200 flex items-center"
              >
                <div class="w-2 h-2 bg-blue-600 rounded-full mr-3"></div>
                Due Date
                <span class="text-xs font-normal text-slate-500 ml-2"
                  >(optional)</span
                >
              </Label>
              <div class="relative group">
                <div
                  class="absolute inset-0 bg-gradient-to-r from-blue-600/10 to-indigo-600/10 rounded-2xl opacity-0 group-focus-within:opacity-100 transition-opacity duration-300"
                ></div>
                <Calendar
                  class="absolute left-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors duration-200 z-10"
                />
                <Input
                  id="due_date"
                  v-model="form.due_date"
                  type="date"
                  class="relative z-10 pl-12 pr-4 h-14 text-base bg-slate-50/50 dark:bg-slate-900/50 border-slate-200 dark:border-slate-600 rounded-2xl focus:border-blue-600 focus:ring-blue-600/20 focus:ring-4 transition-all duration-200"
                />
              </div>
            </div>
  
            <!-- Action Buttons with Enhanced Styling -->
            <div class="flex items-center justify-between pt-8">
              <Button
                as-child
                variant="outline"
                size="lg"
                class="group h-12 px-6 rounded-2xl border-slate-300 hover:border-blue-300 hover:bg-blue-50 dark:hover:bg-blue-950/30 transition-all duration-200"
              >
                <router-link to="/tasks" class="flex items-center">
                  <ChevronLeft
                    class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-200"
                  />
                  Cancel
                </router-link>
              </Button>
  
              <div class="flex items-center space-x-4">
                <Button
                  type="button"
                  @click="saveDraft"
                  variant="outline"
                  size="lg"
                  class="h-12 px-6 rounded-2xl border-blue-200 hover:border-blue-300 hover:bg-blue-50 dark:hover:bg-blue-950/30 text-blue-700 dark:text-blue-300 transition-all duration-200 group"
                >
                  <Save
                    class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-200"
                  />
                  Save Draft
                </Button>
  
                <Button
                  type="submit"
                  :disabled="!form.title || isSubmitting"
                  size="lg"
                  class="h-12 px-8 rounded-2xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 disabled:from-slate-300 disabled:to-slate-300 shadow-lg hover:shadow-xl disabled:shadow-none transition-all duration-300 group"
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
        <div
          class="mt-8 bg-gradient-to-r from-slate-50 via-white to-slate-50 dark:from-slate-800 dark:via-slate-700 dark:to-slate-800 rounded-3xl p-8 border-b border-slate-200/50 dark:border-slate-700/50 shadow-lg backdrop-blur-sm"
        >
          <div class="flex items-start space-x-5">
            <div class="flex-shrink-0">
              <div
                class="w-12 h-12 bg-gradient-to-br from-blue-100 to-indigo-100 dark:from-blue-900/50 dark:to-indigo-900/50 rounded-2xl flex items-center justify-center shadow-sm"
              >
                <Lightbulb class="w-6 h-6 text-blue-600 dark:text-blue-400" />
              </div>
            </div>
            <div class="flex-1">
              <h3
                class="text-lg font-semibold text-blue-900 dark:text-blue-100 mb-3 flex items-center"
              >
                Pro Tips for Better Task Management
              </h3>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-start space-x-3">
                  <div
                    class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"
                  ></div>
                  <p class="text-blue-700 dark:text-blue-300">
                    Use clear, actionable titles that start with verbs
                  </p>
                </div>
                <div class="flex items-start space-x-3">
                  <div
                    class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"
                  ></div>
                  <p class="text-blue-700 dark:text-blue-300">
                    Set realistic deadlines to maintain momentum
                  </p>
                </div>
                <div class="flex items-start space-x-3">
                  <div
                    class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"
                  ></div>
                  <p class="text-blue-700 dark:text-blue-300">
                    Break complex tasks into smaller subtasks
                  </p>
                </div>
                <div class="flex items-start space-x-3">
                  <div
                    class="w-2 h-2 bg-blue-600 rounded-full mt-2 flex-shrink-0"
                  ></div>
                  <p class="text-blue-700 dark:text-blue-300">
                    Use the description for important context
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Floating Success Indicator -->
        <div
          class="fixed bottom-8 right-8 opacity-0 transition-opacity duration-300"
          id="success-indicator"
        >
          <div class="bg-blue-600 text-white px-6 py-3 rounded-2xl shadow-lg">
            <div class="flex items-center space-x-2">
              <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
              <span class="font-medium">Task created successfully!</span>
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
  
      await tasksStore.createTask(taskData);
  
      // Show success indicator
      const indicator = document.getElementById("success-indicator");
      if (indicator) {
        indicator.style.opacity = "1";
        setTimeout(() => {
          indicator.style.opacity = "0";
        }, 3000);
      }
  
      notificationsStore.success("Task created successfully!");
  
      // Clear form and draft
      clearDraft();
      Object.assign(form, {
        title: "",
        description: "",
        status: "pending",
        priority: "medium",
        due_date: "",
      });
  
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