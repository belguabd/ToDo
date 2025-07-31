<template>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
      <!-- Header -->
      <div class="sticky top-0 z-10 backdrop-blur-xl bg-white/80 dark:bg-slate-900/80 border-b border-slate-200/50 dark:border-slate-700/50">
        <div class="max-w-7xl mx-auto px-6 py-4">
          <div class="flex items-center justify-between">
            <div>
              <h1 class="text-2xl font-bold bg-gradient-to-r from-slate-800 to-slate-600 dark:from-white dark:to-slate-300 bg-clip-text text-transparent">
                Dashboard
              </h1>
              <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Welcome back! Here's what's happening today.</p>
            </div>
            <div class="flex items-center space-x-3">
              <div class="relative">
                <div class="w-2 h-2 bg-green-500 rounded-full absolute -top-1 -right-1 animate-pulse"></div>
                <div class="w-8 h-8 bg-slate-200 dark:bg-slate-700 rounded-full flex items-center justify-center">
                  <svg class="w-4 h-4 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7H4l5-5v5z"></path>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
          <!-- Main Content -->
          <div class="lg:col-span-3 space-y-8">
            <!-- Enhanced Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
              <!-- Total Tasks Card -->
              <div class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-200/50 dark:border-slate-700/50">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-blue-600/10 dark:from-blue-400/10 dark:to-blue-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative">
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                      <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                      </svg>
                    </div>
                    <div class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full font-medium">
                      Total
                    </div>
                  </div>
                  <div class="space-y-1">
                    <p class="text-3xl font-bold text-slate-800 dark:text-white">
                      {{ tasksStore.tasksCount }}
                    </p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">All Tasks</p>
                  </div>
                  <div class="mt-4 flex items-center text-xs text-slate-400 dark:text-slate-500">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    Total managed tasks
                  </div>
                </div>
              </div>
  
              <!-- Pending Tasks Card -->
              <div class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-200/50 dark:border-slate-700/50">
                <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-amber-600/10 dark:from-amber-400/10 dark:to-amber-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative">
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                      <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    </div>
                    <div class="text-xs px-2 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-full font-medium">
                      Active
                    </div>
                  </div>
                  <div class="space-y-1">
                    <p class="text-3xl font-bold text-slate-800 dark:text-white">
                      {{ tasksStore.pendingTasks.length }}
                    </p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Pending Tasks</p>
                  </div>
                  <div class="mt-4 flex items-center text-xs text-slate-400 dark:text-slate-500">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    Need attention
                  </div>
                </div>
              </div>
  
              <!-- Completed Tasks Card -->
              <div class="group relative overflow-hidden bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-200/50 dark:border-slate-700/50">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-green-600/10 dark:from-green-400/10 dark:to-green-500/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative">
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                      <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    </div>
                    <div class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-full font-medium">
                      Done
                    </div>
                  </div>
                  <div class="space-y-1">
                    <p class="text-3xl font-bold text-slate-800 dark:text-white">
                      {{ tasksStore.completedTasks.length }}
                    </p>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Completed</p>
                  </div>
                  <div class="mt-4 flex items-center text-xs text-slate-400 dark:text-slate-500">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    Great progress!
                  </div>
                </div>
              </div>
  
              <!-- Today's Focus Card -->
              <div class="group relative overflow-hidden bg-gradient-to-br from-orange-500 to-orange-600 rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all duration-500 text-white">
                <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative">
                  <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                      <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                      </svg>
                    </div>
                  </div>
                  <div class="space-y-1">
                    <p class="text-3xl font-bold">{{ getCurrentDate() }}</p>
                    <p class="text-sm text-orange-100">{{ getCurrentDay() }}</p>
                  </div>
                  <div class="mt-4 flex items-center text-xs text-orange-100">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                    {{ completionRate }}% completion rate
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Enhanced Progress Analytics -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
              <div class="relative bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 p-8 border-b border-slate-200/50 dark:border-slate-700/50">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-purple-500/10 rounded-full -translate-y-16 translate-x-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-br from-green-500/10 to-blue-500/10 rounded-full translate-y-12 -translate-x-12"></div>
                <div class="relative">
                  <div class="flex items-center justify-between mb-2">
                    <div>
                      <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Progress Analytics</h2>
                      <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Track your productivity and task completion</p>
                    </div>
                    <div class="flex items-center space-x-1 bg-white dark:bg-slate-800 rounded-xl p-2 shadow-sm">
                      <div class="flex items-center space-x-2 px-3 py-1 rounded-lg">
                        <div class="w-3 h-3 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full shadow-sm"></div>
                        <span class="text-xs font-medium text-slate-600 dark:text-slate-300">Completed</span>
                      </div>
                      <div class="flex items-center space-x-2 px-3 py-1 rounded-lg">
                        <div class="w-3 h-3 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full shadow-sm"></div>
                        <span class="text-xs font-medium text-slate-600 dark:text-slate-300">Pending</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="p-8">
                <div class="grid md:grid-cols-2 gap-8">
                  <!-- Enhanced Completed Progress -->
                  <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-emerald-500/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 hover:border-green-200 dark:hover:border-green-800 transition-colors duration-300">
                      <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                          <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                          </div>
                          <div>
                            <h3 class="text-lg font-semibold text-slate-700 dark:text-slate-200">Completed Tasks</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Successfully finished</p>
                          </div>
                        </div>
                        <div class="text-right">
                          <span class="text-2xl font-bold text-slate-900 dark:text-white">{{ tasksStore.completedTasks.length }}</span>
                          <p class="text-sm text-slate-500 dark:text-slate-400">of {{ tasksStore.tasksCount }}</p>
                        </div>
                      </div>
                      
                      <!-- Enhanced Progress Bar -->
                      <div class="relative mb-4">
                        <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-4 shadow-inner overflow-hidden">
                          <div 
                            class="relative h-4 rounded-full transition-all duration-1000 ease-out overflow-hidden"
                            :style="{ width: `${completionRate}%` }"
                          >
                            <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-500"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-white/30 to-transparent"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent animate-pulse"></div>
                          </div>
                        </div>
                        <div class="absolute -top-8 right-0 px-2 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-xs font-medium rounded-md">
                          {{ completionRate }}%
                        </div>
                      </div>
                      
                      <!-- Stats Row -->
                      <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center text-green-600 dark:text-green-400">
                          <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                          </svg>
                          <span class="font-medium">{{ completionRate }}% Success</span>
                        </div>
                        <span class="text-slate-500 dark:text-slate-400">{{ tasksStore.completedTasks.length }} tasks done</span>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Enhanced Pending Progress -->
                  <div class="relative group">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 to-orange-500/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative p-6 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 hover:border-amber-200 dark:hover:border-amber-800 transition-colors duration-300">
                      <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center space-x-3">
                          <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                          </div>
                          <div>
                            <h3 class="text-lg font-semibold text-slate-700 dark:text-slate-200">Pending Tasks</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Awaiting completion</p>
                          </div>
                        </div>
                        <div class="text-right">
                          <span class="text-2xl font-bold text-slate-900 dark:text-white">{{ tasksStore.pendingTasks.length }}</span>
                          <p class="text-sm text-slate-500 dark:text-slate-400">remaining</p>
                        </div>
                      </div>
                      
                      <!-- Enhanced Progress Bar -->
                      <div class="relative mb-4">
                        <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-4 shadow-inner overflow-hidden">
                          <div 
                            class="relative h-4 rounded-full transition-all duration-1000 ease-out overflow-hidden"
                            :style="{ width: `${pendingRate}%` }"
                          >
                            <div class="absolute inset-0 bg-gradient-to-r from-amber-500 to-orange-500"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-white/30 to-transparent"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent animate-pulse"></div>
                          </div>
                        </div>
                        <div class="absolute -top-8 right-0 px-2 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 text-xs font-medium rounded-md">
                          {{ pendingRate }}%
                        </div>
                      </div>
                      
                      <!-- Stats Row -->
                      <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center text-amber-600 dark:text-amber-400">
                          <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                          </svg>
                          <span class="font-medium">{{ pendingRate }}% Pending</span>
                        </div>
                        <span class="text-slate-500 dark:text-slate-400">{{ tasksStore.pendingTasks.length }} tasks left</span>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Overall Progress Summary -->
                <div class="mt-8 p-6 bg-gradient-to-r from-slate-50 to-blue-50 dark:from-slate-800 dark:to-blue-900/20 rounded-2xl border border-slate-200/50 dark:border-slate-700/50">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                      <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                      </div>
                      <div>
                        <h4 class="text-lg font-semibold text-slate-800 dark:text-white">Overall Progress</h4>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Your productivity summary</p>
                      </div>
                    </div>
                    <div class="text-right">
                      <div class="text-3xl font-bold text-slate-900 dark:text-white">{{ completionRate }}%</div>
                      <div class="text-sm text-slate-500 dark:text-slate-400">completion rate</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  
            <!-- Enhanced Recent Activity Section -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
              <!-- Enhanced Header -->
              <div class="relative bg-gradient-to-r from-slate-50 via-white to-slate-50 dark:from-slate-800 dark:via-slate-700 dark:to-slate-800 p-6 border-b border-slate-200/50 dark:border-slate-700/50">
                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-purple-500/5 to-blue-500/10 rounded-full -translate-y-20 translate-x-20"></div>
                <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-br from-emerald-500/5 to-teal-500/10 rounded-full translate-y-16 -translate-x-16"></div>
                <div class="relative flex items-center justify-between">
                  <div>
                    <h2 class="text-xl font-bold text-slate-800 dark:text-white">Recent Activity</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Your latest tasks and updates</p>
                  </div>
                                    <router-link to="/tasks" 
                    class="group inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-slate-900 to-slate-800 dark:from-white dark:to-slate-100 text-white dark:text-slate-900 rounded-xl text-sm font-medium hover:from-slate-800 hover:to-slate-700 dark:hover:from-slate-100 dark:hover:to-slate-200 transition-all duration-200 hover:scale-105 hover:shadow-lg">
                    <svg class="w-4 h-4 mr-2 group-hover:rotate-12 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    View All Tasks
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </router-link>
                </div>
              </div>
  
              <div class="p-6">
                <!-- Enhanced Empty State -->
                <div v-if="recentTasks.length === 0" class="text-center py-16">
                  <div class="relative mb-8">
                    <div class="w-24 h-24 bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-600 rounded-3xl flex items-center justify-center mx-auto shadow-inner">
                      <svg class="w-12 h-12 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                      </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center animate-bounce">
                      <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                      </svg>
                    </div>
                  </div>
                  <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">No tasks yet</h3>
                  <p class="text-slate-500 dark:text-slate-400 mb-8 max-w-md mx-auto">Create your first task to get started with productivity tracking and see your progress here.</p>
                  <button
                    @click="$router.push('/tasks')"
                    class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-2xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 hover:scale-105 hover:shadow-xl"
                  >
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create First Task
                    <div class="ml-2 w-6 h-6 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors duration-200">
                      <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                      </svg>
                    </div>
                  </button>
                </div>
  
                <!-- Enhanced Tasks List -->
                <div v-else class="space-y-2">
                  <div v-for="(task, index) in recentTasks" :key="task.id" 
                    class="group relative overflow-hidden rounded-2xl border border-slate-200/50 dark:border-slate-700/50 hover:border-slate-300 dark:hover:border-slate-600 transition-all duration-300"
                    :style="{ animationDelay: `${index * 100}ms` }"
                  >
                    <!-- Gradient Background -->
                    <div class="absolute inset-0 bg-gradient-to-r opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                      :class="task.completed 
                        ? 'from-green-50/50 to-emerald-50/50 dark:from-green-900/10 dark:to-emerald-900/10' 
                        : 'from-blue-50/50 to-indigo-50/50 dark:from-blue-900/10 dark:to-indigo-900/10'"
                    ></div>
                    
                    <!-- Content -->
                    <div class="relative flex items-center justify-between p-5 hover:bg-slate-50/50 dark:hover:bg-slate-700/20 transition-colors duration-200">
                      <div class="flex items-center space-x-4 flex-1 min-w-0">
                        <!-- Enhanced Checkbox -->
                        <button
                          @click="toggleTask(task)"
                          class="flex-shrink-0 group/checkbox"
                        >
                          <div class="relative">
                            <div
                              class="w-7 h-7 border-2 rounded-xl flex items-center justify-center transition-all duration-300 shadow-sm"
                              :class="task.completed 
                                ? 'bg-gradient-to-br from-green-500 to-emerald-600 border-green-500 shadow-green-200 dark:shadow-green-900/30 scale-105' 
                                : 'border-slate-300 hover:border-blue-400 hover:bg-blue-50 dark:border-slate-600 dark:hover:border-blue-400 dark:hover:bg-blue-900/20 group-hover/checkbox:scale-110'"
                            >
                              <svg v-if="task.completed" class="w-5 h-5 text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                              </svg>
                            </div>
                            <!-- Ripple Effect -->
                            <div v-if="!task.completed" class="absolute inset-0 border-2 border-blue-400 rounded-xl opacity-0 group-hover/checkbox:opacity-30 group-hover/checkbox:scale-125 transition-all duration-300"></div>
                          </div>
                        </button>
                        
                        <!-- Task Content -->
                        <div class="flex-1 min-w-0">
                          <h4 
                            class="text-lg font-semibold transition-all duration-300"
                            :class="task.completed 
                              ? 'text-slate-400 dark:text-slate-500 line-through' 
                              : 'text-slate-800 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400'"
                          >
                            {{ task.title }}
                          </h4>
                          <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm leading-relaxed" :class="task.completed ? 'line-through' : ''">
                            {{ task.description }}
                          </p>
                          
                          <!-- Task Metadata -->
                          <div class="flex items-center space-x-3 mt-3">
                            <span
                              class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium border transition-colors duration-200"
                              :class="getPriorityClass(task.priority)"
                            >
                              <div class="w-1.5 h-1.5 rounded-full mr-1.5" 
                                :class="getPriorityDotClass(task.priority)"></div>
                              {{ task.priority || 'Normal' }}
                            </span>
                            <span class="text-xs text-slate-400 dark:text-slate-500 font-medium flex items-center">
                              <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                              </svg>
                              {{ formatDate(task.created_at) }}
                            </span>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Action Button -->
                      <div class="flex items-center space-x-3 flex-shrink-0 ml-4">
                        <!-- Progress Indicator -->
                        <div class="relative w-12 h-12 flex items-center justify-center">
                          <svg class="w-12 h-12 transform -rotate-90" viewBox="0 0 36 36">
                            <path
                              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-dasharray="100, 100"
                              class="text-slate-200 dark:text-slate-700"
                            />
                            <path
                              d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              :stroke-dasharray="task.completed ? '100, 100' : '0, 100'"
                              :class="task.completed ? 'text-green-500' : 'text-blue-500'"
                              class="transition-all duration-1000 ease-out"
                            />
                          </svg>
                          <div class="absolute inset-0 flex items-center justify-center">
                            <svg v-if="task.completed" class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <svg v-else class="w-4 h-4 text-slate-400 group-hover:text-blue-500 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                          </div>
                        </div>
                        
                        <!-- Hover Arrow -->
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                          <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-300 group-hover:translate-x-1 transition-all duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                          </svg>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- View More Button -->
                  <div v-if="tasksStore.tasks.length > 5" class="mt-6 text-center">
                    <router-link to="/tasks" 
                      class="group inline-flex items-center px-6 py-3 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 transition-all duration-200 hover:scale-105">
                      <span class="text-sm font-medium mr-2">View {{ tasksStore.tasks.length - 5 }} more tasks</span>
                      <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                      </svg>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Enhanced Right Sidebar -->
          <div class="lg:col-span-1 space-y-8">
            <!-- Quick Actions -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl p-6 shadow-sm border border-slate-200/50 dark:border-slate-700/50">
              <h3 class="text-lg font-bold text-slate-800 dark:text-white mb-4">Quick Actions</h3>
              <div class="space-y-3">
                <router-link to="/tasks" 
                  class="flex items-center justify-between p-3 rounded-xl bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors group">
                  <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                      <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                      </svg>
                    </div>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-200">All Tasks</span>
                  </div>
                  <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 dark:group-hover:text-slate-200 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                </router-link>
              </div>
            </div>
  
            <!-- Task Summary -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
              <div class="p-6 border-b border-slate-200/50 dark:border-slate-700/50">
                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Task Summary</h3>
              </div>
  
              <div class="p-6">
                <div class="space-y-4">
                  <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600 dark:text-slate-300">Total Tasks</span>
                    <span class="font-semibold text-slate-900 dark:text-white">{{ tasksStore.tasksCount }}</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600 dark:text-slate-300">Completed</span>
                    <span class="font-semibold text-green-600 dark:text-green-400">{{ tasksStore.completedTasks.length }}</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600 dark:text-slate-300">Pending</span>
                    <span class="font-semibold text-amber-600 dark:text-amber-400">{{ tasksStore.pendingTasks.length }}</span>
                  </div>
                  <div class="pt-2 border-t border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                      <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Success Rate</span>
                      <span class="font-bold text-slate-900 dark:text-white">{{ completionRate }}%</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { computed, onMounted } from 'vue'
  import { useTasksStore } from '@/stores/tasks'
  
  const tasksStore = useTasksStore()
  
  const recentTasks = computed(() => {
    return tasksStore.tasks.slice(0, 5)
  })
  
  const completionRate = computed(() => {
    if (tasksStore.tasksCount === 0) return 0
    return Math.round((tasksStore.completedTasks.length / tasksStore.tasksCount) * 100)
  })
  
  const pendingRate = computed(() => {
    if (tasksStore.tasksCount === 0) return 0
    return Math.round((tasksStore.pendingTasks.length / tasksStore.tasksCount) * 100)
  })
  
  const toggleTask = async (task) => {
    try {
      await tasksStore.toggleTaskStatus(task.id)
    } catch (error) {
      console.error('Failed to toggle task:', error)
    }
  }
  
  const getPriorityClass = (priority) => {
    switch (priority?.toLowerCase()) {
      case 'high':
        return 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/20 dark:text-red-300 dark:border-red-800'
      case 'medium':
        return 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-900/20 dark:text-amber-300 dark:border-amber-800'
      case 'low':
        return 'bg-green-50 text-green-700 border-green-200 dark:bg-green-900/20 dark:text-green-300 dark:border-green-800'
      default:
        return 'bg-slate-50 text-slate-700 border-slate-200 dark:bg-slate-700/30 dark:text-slate-300 dark:border-slate-600'
    }
  }
  
  const getPriorityDotClass = (priority) => {
    switch (priority?.toLowerCase()) {
      case 'high':
        return 'bg-red-500'
      case 'medium':
        return 'bg-amber-500'
      case 'low':
        return 'bg-green-500'
      default:
        return 'bg-slate-400'
    }
  }
  
  const formatDate = (date) => {
    if (!date) return ''
    return new Date(date).toLocaleDateString('en-US', {
      month: 'short',
      day: 'numeric'
    })
  }
  
  const getCurrentDate = () => {
    return new Date().toLocaleDateString('en-US', {
      day: 'numeric'
    })
  }
  
  const getCurrentDay = () => {
    return new Date().toLocaleDateString('en-US', {
      weekday: 'long'
    })
  }
  
  onMounted(() => {
    tasksStore.fetchTasks()
  })
  </script>