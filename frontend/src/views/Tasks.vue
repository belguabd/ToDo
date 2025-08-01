<template>
  <div
    class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 pt-20"
  >
    <!-- Enhanced Header -->
    <div
      class="sticky top-16 z-10 backdrop-blur-xl bg-white/80 dark:bg-slate-900/80 border-b border-slate-200/50 dark:border-slate-700/50"
    >
      <div class="max-w-7xl mx-auto px-8 py-6">
        <div class="flex items-center justify-between">
          <div>
            <h1
              class="text-3xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 dark:from-white dark:to-slate-300 bg-clip-text text-transparent"
            >
              Tasks
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
              Manage your tasks and stay organized
            </p>
          </div>
          <router-link
            to="/tasks/create"
            class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-slate-900 to-slate-800 dark:from-white dark:to-slate-100 text-white dark:text-slate-900 rounded-xl font-medium hover:from-slate-800 hover:to-slate-700 dark:hover:from-slate-100 dark:hover:to-slate-200 transition-all duration-200 hover:scale-105 hover:shadow-lg"
          >
            <svg
              class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300"
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
            New Task
            <div
              class="ml-2 w-6 h-6 bg-white/20 dark:bg-slate-900/20 rounded-full flex items-center justify-center group-hover:bg-white/30 dark:group-hover:bg-slate-900/30 transition-colors duration-200"
            >
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path
                  fill-rule="evenodd"
                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </div>
          </router-link>
        </div>
      </div>
    </div>

    <div class="max-w-7xl mx-auto px-8 py-8">
      <!-- Enhanced Filters and Controls -->
      <div
        class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-8 mb-8 overflow-hidden"
      >
        <div
          class="absolute inset-0 bg-gradient-to-r from-slate-50/50 to-blue-50/30 dark:from-slate-800/50 dark:to-blue-900/10 opacity-50"
        ></div>
        <div class="relative">
          <div
            class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-6 lg:space-y-0"
          >
            <!-- Enhanced Filter Tabs -->
            <div
              class="flex items-center space-x-2 bg-slate-100 dark:bg-slate-700/50 p-2 rounded-2xl"
            >
              <button
                v-for="filter in filters"
                :key="filter.key"
                @click="activeFilter = filter.key"
                class="relative px-6 py-3 text-sm font-medium rounded-xl transition-all duration-300 flex items-center space-x-3 group"
                :class="
                  activeFilter === filter.key
                    ? 'bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-lg ring-1 ring-slate-900/10 dark:ring-white/10'
                    : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-white/60 dark:hover:bg-slate-600/30'
                "
              >
                <span>{{ filter.label }}</span>
                <span
                  v-if="filter.count > 0"
                  class="px-2.5 py-1 text-xs rounded-full font-semibold transition-colors duration-200"
                  :class="
                    activeFilter === filter.key
                      ? 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300'
                      : 'bg-slate-200/60 dark:bg-slate-600/60 text-slate-600 dark:text-slate-400 group-hover:bg-slate-200 dark:group-hover:bg-slate-600'
                  "
                >
                  {{ filter.count }}
                </span>
                <div
                  v-if="activeFilter === filter.key"
                  class="absolute bottom-0 left-0 right-0 h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full"
                ></div>
              </button>
            </div>

            <!-- Enhanced Controls -->
            <div
              class="flex flex-col sm:flex-row sm:items-center space-y-4 sm:space-y-0 sm:space-x-4"
            >
              <!-- Enhanced Search -->
              <div class="relative group">
                <div
                  class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none"
                >
                  <svg
                    class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-200"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                    ></path>
                  </svg>
                </div>
                <input
                  v-model="searchQuery"
                  type="text"
                  placeholder="Search tasks..."
                  class="block w-full sm:w-80 pl-12 pr-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl text-sm placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 bg-white dark:bg-slate-700 text-slate-900 dark:text-white hover:border-slate-400 dark:hover:border-slate-500"
                />
                <div
                  class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-500/5 to-purple-500/5 opacity-0 group-focus-within:opacity-100 transition-opacity duration-200 pointer-events-none"
                ></div>
              </div>

              <!-- Enhanced Sort -->
              <div class="relative group">
                <select
                  v-model="sortBy"
                  class="appearance-none px-4 py-3 pr-12 border border-slate-300 dark:border-slate-600 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 dark:focus:border-blue-400 bg-white dark:bg-slate-700 text-slate-900 dark:text-white transition-all duration-200 cursor-pointer hover:border-slate-400 dark:hover:border-slate-500 min-w-[180px]"
                >
                  <option value="created_at">Date Created</option>
                  <option value="due_date">Due Date</option>
                  <option value="priority">Priority</option>
                  <option value="title">Title</option>
                </select>
                <div
                  class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none"
                >
                  <svg
                    class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-200"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M8 9l4-4 4 4m0 6l-4 4-4-4"
                    ></path>
                  </svg>
                </div>
                <div
                  class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-500/5 to-purple-500/5 opacity-0 group-focus-within:opacity-100 transition-opacity duration-200 pointer-events-none"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Enhanced Tasks List Container -->
      <div
        class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden"
      >
        <!-- Loading State -->
        <div v-if="tasksStore.loading" class="p-16 text-center">
          <div class="relative mb-6">
            <div
              class="w-16 h-16 border-4 border-slate-200 dark:border-slate-700 border-t-blue-500 rounded-full animate-spin mx-auto"
            ></div>
            <div
              class="absolute inset-0 w-16 h-16 border-4 border-transparent border-t-purple-500 rounded-full animate-spin mx-auto"
              style="animation-delay: 0.15s; animation-duration: 1.5s"
            ></div>
          </div>
          <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">
            Loading tasks...
          </h3>
          <p class="text-slate-500 dark:text-slate-400">
            Please wait while we fetch your tasks
          </p>
        </div>

        <!-- Enhanced Empty State -->
        <div v-else-if="filteredTasks.length === 0" class="p-16 text-center">
          <div class="relative mb-8">
            <div
              class="w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-600 rounded-3xl flex items-center justify-center mx-auto shadow-inner"
            >
              <svg
                class="w-12 h-12 text-slate-400 dark:text-slate-500"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"
                ></path>
              </svg>
            </div>
            <div
              class="absolute -top-2 -right-2 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center animate-bounce"
            >
              <svg
                class="w-4 h-4 text-white"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                ></path>
              </svg>
            </div>
          </div>
          <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">
            {{ searchQuery ? "No tasks found" : "No tasks yet" }}
          </h3>
          <p
            class="text-slate-500 dark:text-slate-400 mb-8 max-w-md mx-auto leading-relaxed"
          >
            {{
              searchQuery
                ? "Try adjusting your search terms or filters to find what you're looking for"
                : "Create your first task to get started with organizing your work and boost your productivity"
            }}
          </p>
          <router-link
            to="/tasks/create"
            class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-2xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 hover:scale-105 hover:shadow-xl"
          >
            <svg
              class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300"
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
            {{ searchQuery ? "Create New Task" : "Create First Task" }}
            <div
              class="ml-2 w-6 h-6 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors duration-200"
            >
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path
                  fill-rule="evenodd"
                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </div>
          </router-link>
        </div>

        <!-- Enhanced Tasks List -->
        <div
          v-else
          class="divide-y divide-slate-200/50 dark:divide-slate-700/50"
        >
          <div
            v-for="(task, index) in filteredTasks"
            :key="task.id"
            class="group relative overflow-hidden transition-all duration-300 hover:bg-slate-50/50 dark:hover:bg-slate-700/20 cursor-pointer"
            :style="{ animationDelay: `${index * 50}ms` }"
            @click="selectTask(task)"
          >
            <!-- Gradient Background on Hover -->
            <div
              class="absolute inset-0 bg-gradient-to-r opacity-0 group-hover:opacity-100 transition-opacity duration-300"
              :class="
                task.completed
                  ? 'from-green-50/30 to-emerald-50/30 dark:from-green-900/5 dark:to-emerald-900/5'
                  : 'from-blue-50/30 to-indigo-50/30 dark:from-blue-900/5 dark:to-indigo-900/5'
              "
            ></div>

            <!-- Content -->
            <div class="relative flex items-start space-x-6 p-8">
              <!-- Enhanced Checkbox -->
              <button
                @click.stop="toggleTask(task)"
                class="flex-shrink-0 mt-1 group/checkbox"
              >
                <div class="relative">
                  <div
                    class="w-6 h-6 border-2 rounded-xl flex items-center justify-center transition-all duration-300 shadow-sm"
                    :class="
                      task.completed
                        ? 'bg-gradient-to-br from-green-500 to-emerald-600 border-green-500 shadow-green-200 dark:shadow-green-900/30 scale-110'
                        : 'border-slate-300 dark:border-slate-600 hover:border-blue-400 dark:hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 group-hover/checkbox:scale-110'
                    "
                  >
                    <svg
                      v-if="task.completed"
                      class="w-4 h-4 text-white animate-bounce"
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
                  <!-- Ripple Effect -->
                  <div
                    v-if="!task.completed"
                    class="absolute inset-0 border-2 border-blue-400 rounded-xl opacity-0 group-hover/checkbox:opacity-30 group-hover/checkbox:scale-125 transition-all duration-300"
                  ></div>
                </div>
              </button>

              <!-- Enhanced Task Content -->
              <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between">
                  <div class="flex-1 min-w-0">
                    <h3
                      class="text-xl font-semibold mb-2 transition-all duration-300 leading-tight"
                      :class="
                        task.completed
                          ? 'text-slate-400 dark:text-slate-500 line-through'
                          : 'text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400'
                      "
                    >
                      {{ task.title }}
                    </h3>
                    <p
                      v-if="task.description"
                      class="text-slate-600 dark:text-slate-400 text-sm mb-4 leading-relaxed"
                      :class="task.completed ? 'line-through' : ''"
                    >
                      {{ task.description }}
                    </p>
                  </div>

                  <!-- Enhanced Action Buttons -->
                  <div
                    class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-all duration-300 ml-6 transform translate-x-4 group-hover:translate-x-0"
                  >
                    <router-link
                      :to="{ name: 'TaskEdit', params: { id: task.id } }"
                      class="p-3 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-xl transition-all duration-200 hover:scale-110"
                      @click.stop
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
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                        />
                      </svg>
                    </router-link>
                    <button
                      @click.stop="deleteTask(task)"
                      class="p-3 text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-all duration-200 hover:scale-110"
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
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                        ></path>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Enhanced Task Metadata -->
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-4">
                    <!-- Enhanced Priority Badge -->
                    <span
                      v-if="task.priority"
                      class="inline-flex items-center px-3 py-1.5 rounded-xl text-xs font-semibold ring-1 transition-all duration-200"
                      :class="getPriorityClass(task.priority)"
                    >
                      <div
                        class="w-2 h-2 rounded-full mr-2 shadow-sm"
                        :class="getPriorityDotClass(task.priority)"
                      ></div>
                      {{ task.priority }}
                    </span>

                    <!-- Enhanced Dates -->
                    <div
                      class="flex items-center space-x-4 text-xs text-slate-500 dark:text-slate-400"
                    >
                      <span
                        v-if="task.due_date"
                        class="flex items-center space-x-1.5 px-2 py-1 rounded-lg transition-colors duration-200"
                        :class="{
                          'text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20':
                            isOverdue(task.due_date),
                          'hover:bg-slate-100 dark:hover:bg-slate-700/50':
                            !isOverdue(task.due_date),
                        }"
                      >
                        <svg
                          class="w-3.5 h-3.5"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                          ></path>
                        </svg>
                        <span class="font-medium"
                          >Due {{ formatDate(task.due_date) }}</span
                        >
                      </span>
                      <span
                        class="flex items-center space-x-1.5 px-2 py-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700/50 transition-colors duration-200"
                      >
                        <svg
                          class="w-3.5 h-3.5"
                          fill="none"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                          ></path>
                        </svg>
                        <span>Created {{ formatDate(task.created_at) }}</span>
                      </span>
                    </div>
                  </div>

                  <!-- Enhanced Tags -->
                  <div
                    v-if="task.tags && task.tags.length"
                    class="flex items-center space-x-2"
                  >
                    <span
                      v-for="tag in task.tags.slice(0, 3)"
                      :key="tag"
                      class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors duration-200"
                    >
                      {{ tag }}
                    </span>
                    <span
                      v-if="task.tags.length > 3"
                      class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors duration-200"
                    >
                      +{{ task.tags.length - 3 }}
                    </span>
                  </div>
                </div>
              </div>

              <!-- Enhanced Arrow -->
              <div
                class="flex-shrink-0 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0"
              >
                <svg
                  class="w-6 h-6 text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-300"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                  ></path>
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Enhanced Delete Confirmation Modal -->
    <div
      v-if="showDeleteModal"
      class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 z-50"
      @click="showDeleteModal = false"
    >
      <div
        class="bg-white dark:bg-slate-800 rounded-3xl p-8 max-w-md w-full shadow-2xl ring-1 ring-slate-900/10 dark:ring-white/10 transform transition-all duration-300"
        @click.stop
      >
        <div class="flex items-center mb-6">
          <div
            class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg"
          >
            <svg
              class="w-7 h-7 text-white"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"
              ></path>
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white">
              Delete Task
            </h3>
            <p class="text-slate-600 dark:text-slate-400 text-sm mt-1">
              This action cannot be undone.
            </p>
          </div>
        </div>

        <div class="bg-slate-50 dark:bg-slate-700/50 rounded-2xl p-4 mb-6">
          <p class="text-slate-700 dark:text-slate-300">
            Are you sure you want to delete "<strong
              class="text-slate-900 dark:text-white"
              >{{ taskToDelete?.title }}</strong
            >"?
          </p>
        </div>

        <div class="flex justify-end space-x-3">
          <button
            @click="showDeleteModal = false"
            class="px-6 py-3 text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 rounded-xl transition-all duration-200 font-medium"
          >
            Cancel
          </button>
          <button
            @click="confirmDelete"
            class="px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white hover:from-red-700 hover:to-red-800 rounded-xl transition-all duration-200 font-medium hover:scale-105 hover:shadow-lg"
          >
            Delete Task
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
  {
    key: "completed",
    label: "Completed",
    count: tasksStore.completedTasks.length,
  },
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
        return (
          (priorityOrder[b.priority] || 0) - (priorityOrder[a.priority] || 0)
        );
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
      return "bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 ring-red-200 dark:ring-red-800/50";
    case "medium":
      return "bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300 ring-amber-200 dark:ring-amber-800/50";
    case "low":
      return "bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300 ring-green-200 dark:ring-green-800/50";
    default:
      return "bg-slate-50 dark:bg-slate-700/30 text-slate-700 dark:text-slate-300 ring-slate-200 dark:ring-slate-600/50";
  }
};

const getPriorityDotClass = (priority) => {
  switch (priority?.toLowerCase()) {
    case "high":
      return "bg-red-500";
    case "medium":
      return "bg-amber-500";
    case "low":
      return "bg-green-500";
    default:
      return "bg-slate-400";
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