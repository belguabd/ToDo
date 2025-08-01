import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const routes = [
  {
    path: '/',
    redirect: '/dashboard'
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('@/views/Login.vue'),
    meta: { guest: true }
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('@/views/Register.vue'),
    meta: { guest: true }
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: () => import('@/views/Dashboard.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/tasks',
    name: 'Tasks',
    component: () => import('@/views/Tasks.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/tasks/create',
    name: 'TasksCreate',
    component: () => import('@/views/CreateTask.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/tasks/:id/edit',
    name: 'TaskEdit',
    component: () => import('@/views/EditTask.vue'),
    meta: { requiresAuth: true },
    props: true
  },
  {
    path: '/tasks/:id',
    name: 'TaskDetail',
    component: () => import('@/views/TaskDetail.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/notifications',
    name: 'Notifications',
    component: () => import('@/views/Notifications.vue'),
    meta: { requiresAuth: true }
  },

  //   {
  //     path: '/profile',
  //     name: 'Profile',
  //     component: () => import('@/views/Profile.vue'),
  //     meta: { requiresAuth: true }
  //   },
  //   {
  //     path: '/settings',
  //     name: 'Settings',
  //     component: () => import('@/views/Settings.vue'),
  //     meta: { requiresAuth: true }
  //   }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach(async (to, from, next) => {
  const authStore = useAuthStore()


  if (to.meta.requiresAuth && !authStore.isAuthenticated) {
    next({
      name: 'Login',
      query: { redirect: to.fullPath }
    })
  } else if (to.meta.guest && authStore.isAuthenticated) {
    next({ name: 'Dashboard' })
  } else {
    next()
  }
})

export default router