<template>
  <div class="fixed top-4 right-4 z-50 space-y-4">
    <transition-group name="notification" tag="div">
      <div
        v-for="notification in notificationsStore.notifications"
        :key="notification.id"
        class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
      >
        <div class="p-4">
          <div class="flex items-start">
            <!-- Icon -->
            <div class="flex-shrink-0">
              <div
                class="w-8 h-8 rounded-full flex items-center justify-center"
                :class="getIconClass(notification.type)"
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
                    :d="getIconPath(notification.type)"
                  ></path>
                </svg>
              </div>
            </div>

            <!-- Content -->
            <div class="ml-3 w-0 flex-1">
              <p
                class="text-sm font-medium"
                :class="getTextClass(notification.type)"
              >
                {{ notification.title || getDefaultTitle(notification.type) }}
              </p>
              <p class="mt-1 text-sm text-gray-500">
                {{ notification.message }}
              </p>
            </div>

            <!-- Close button -->
            <div class="ml-4 flex-shrink-0 flex">
              <button
                @click="notificationsStore.removeNotification(notification.id)"
                class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
              >
                <span class="sr-only">Close</span>
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
            </div>
          </div>

          <!-- Progress bar -->
          <div
            class="mt-3 bg-gray-200 rounded-full h-1"
            v-if="notification.duration"
          >
            <div
              class="h-1 rounded-full transition-all duration-100 ease-linear"
              :class="getProgressClass(notification.type)"
              :style="{ width: getProgressWidth(notification) + '%' }"
            ></div>
          </div>
        </div>
      </div>
    </transition-group>
  </div>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from "vue";
import { useNotificationsStore } from "@/stores/notifications";

const notificationsStore = useNotificationsStore();
const intervals = ref(new Map());

const getIconClass = (type) => {
  switch (type) {
    case "success":
      return "bg-green-100 text-green-600";
    case "error":
      return "bg-red-100 text-red-600";
    case "warning":
      return "bg-yellow-100 text-yellow-600";
    case "info":
      return "bg-blue-100 text-blue-600";
    default:
      return "bg-gray-100 text-gray-600";
  }
};

const getTextClass = (type) => {
  switch (type) {
    case "success":
      return "text-green-900";
    case "error":
      return "text-red-900";
    case "warning":
      return "text-yellow-900";
    case "info":
      return "text-blue-900";
    default:
      return "text-gray-900";
  }
};

const getProgressClass = (type) => {
  switch (type) {
    case "success":
      return "bg-green-500";
    case "error":
      return "bg-red-500";
    case "warning":
      return "bg-yellow-500";
    case "info":
      return "bg-blue-500";
    default:
      return "bg-gray-500";
  }
};

const getIconPath = (type) => {
  switch (type) {
    case "success":
      return "M5 13l4 4L19 7";
    case "error":
      return "M6 18L18 6M6 6l12 12";
    case "warning":
      return "M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.732 15.5c-.77.833.192 2.5 1.732 2.5z";
    case "info":
      return "M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z";
    default:
      return "M15 17h5l-5 5v-5zM12 18.5A2.5 2.5 0 1014.5 16H12v2.5z";
  }
};

const getDefaultTitle = (type) => {
  switch (type) {
    case "success":
      return "Success";
    case "error":
      return "Error";
    case "warning":
      return "Warning";
    case "info":
      return "Info";
    default:
      return "Notification";
  }
};

const getProgressWidth = (notification) => {
  if (!notification.duration || !notification.startTime) return 0;

  const elapsed = Date.now() - notification.startTime;
  const progress = Math.max(0, 100 - (elapsed / notification.duration) * 100);
  return progress;
};

// Track notification progress
const trackProgress = (notification) => {
  if (!notification.duration) return;

  notification.startTime = Date.now();

  const interval = setInterval(() => {
    const elapsed = Date.now() - notification.startTime;
    if (elapsed >= notification.duration) {
      clearInterval(interval);
      intervals.value.delete(notification.id);
    }
  }, 100);

  intervals.value.set(notification.id, interval);
};

// Watch for new notifications
onMounted(() => {
  // notificationsStore.$subscribe((mutation, state) => {
  //   if (mutation.type === 'direct' && mutation.events) {
  //     mutation.events.forEach(event => {
  //       if (event.type === 'add') {
  //         const notification = state.notifications.find(n => n.id === event.newValue.id)
  //         if (notification) {
  //           trackProgress(notification)
  //         }
  //       }
  //     })
  //   }
  // })
});

onUnmounted(() => {
  // Clear all intervals
  intervals.value.forEach((interval) => clearInterval(interval));
  intervals.value.clear();
});
</script>

<style scoped>
.notification-enter-active,
.notification-leave-active {
  transition: all 0.3s ease;
}

.notification-enter-from {
  opacity: 0;
  transform: translateX(100%);
}

.notification-leave-to {
  opacity: 0;
  transform: translateX(100%);
}

.notification-move {
  transition: transform 0.3s ease;
}
</style>