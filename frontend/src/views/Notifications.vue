<template>
  <div class="pt-4">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
      <div>
        <h1 class="text-3xl font-bold text-gray-900">Notifications</h1>
        <p class="text-gray-600 mt-2">Stay updated with your task activities</p>
      </div>
      <div class="flex items-center space-x-3">
        <button
          @click="markAllAsRead"
          class="px-4 py-2 text-blue-600 hover:text-blue-700 font-medium"
          :disabled="unreadCount === 0"
        >
          Mark all as read
        </button>
        <button
          @click="clearAll"
          class="px-4 py-2 text-red-600 hover:text-red-700 font-medium"
        >
          Clear all
        </button>
      </div>
    </div>

    <!-- Filter Tabs -->
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 mb-6">
      <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg w-fit">
        <button
          v-for="filter in filters"
          :key="filter.key"
          @click="activeFilter = filter.key"
          class="px-4 py-2 text-sm font-medium rounded-md transition-colors"
          :class="
            activeFilter === filter.key
              ? 'bg-white text-blue-600 shadow-sm'
              : 'text-gray-600 hover:text-gray-900'
          "
        >
          {{ filter.label }}
          <span class="ml-2 text-xs">{{ filter.count }}</span>
        </button>
      </div>
    </div>

    <!-- Notifications List -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
      <div v-if="filteredNotifications.length === 0" class="p-8 text-center">
        <svg
          class="w-12 h-12 text-gray-400 mx-auto mb-4"
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
        <p class="text-gray-500 mb-2">No notifications</p>
        <p class="text-sm text-gray-400">You're all caught up!</p>
      </div>

      <div v-else class="divide-y divide-gray-200">
        <div
          v-for="notification in filteredNotifications"
          :key="notification.id"
          class="p-6 hover:bg-gray-50 transition-colors"
          :class="{ 'bg-blue-50': !notification.read }"
        >
          <div class="flex items-start space-x-4">
            <!-- Icon -->
            <div class="flex-shrink-0">
              <div
                class="w-10 h-10 rounded-full flex items-center justify-center"
                :class="getNotificationIconClass(notification.type)"
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
                    :d="getNotificationIconPath(notification.type)"
                  ></path>
                </svg>
              </div>
            </div>

            <!-- Content -->
            <div class="flex-1 min-w-0">
              <div class="flex items-start justify-between">
                <div class="flex-1">
                  <p class="text-sm font-medium text-gray-900">
                    {{ notification.title }}
                  </p>
                  <p class="text-sm text-gray-600 mt-1">
                    {{ notification.message }}
                  </p>
                  <p class="text-xs text-gray-400 mt-2">
                    {{ formatNotificationDate(notification.created_at) }}
                  </p>
                </div>

                <div class="flex items-center space-x-2 ml-4">
                  <div
                    v-if="!notification.read"
                    class="w-2 h-2 bg-blue-500 rounded-full"
                  ></div>
                  <div class="flex items-center space-x-1">
                    <button
                      v-if="!notification.read"
                      @click="markAsRead(notification)"
                      class="p-1 text-gray-400 hover:text-blue-600 transition-colors"
                      title="Mark as read"
                    >
                      <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"
                        ></path>
                      </svg>
                    </button>
                    <button
                      @click="removeNotification(notification)"
                      class="p-1 text-gray-400 hover:text-red-600 transition-colors"
                      title="Remove notification"
                    >
                      <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"
                        ></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>

              <!-- Action buttons for specific notification types -->
              <div
                v-if="notification.actions && notification.actions.length"
                class="mt-3 flex items-center space-x-2"
              >
                <button
                  v-for="action in notification.actions"
                  :key="action.label"
                  @click="handleNotificationAction(notification, action)"
                  class="px-3 py-1 text-xs font-medium rounded-md transition-colors"
                  :class="
                    action.primary
                      ? 'bg-blue-600 text-white hover:bg-blue-700'
                      : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                  "
                >
                  {{ action.label }}
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script setup>
import { ref, computed, onMounted } from "vue";
import { useNotificationsStore } from "@/stores/notifications";
import { useTasksStore } from "@/stores/tasks";

const notificationsStore = useNotificationsStore();
const tasksStore = useTasksStore();

const activeFilter = ref("all");

// Mock notifications data - in real app this would come from the store
const mockNotifications = ref([
  {
    id: 1,
    type: "task_created",
    title: "New task created",
    message: 'You created a new task: "Complete project documentation"',
    read: false,
    created_at: new Date(Date.now() - 1000 * 60 * 30), // 30 minutes ago
    actions: [
      { label: "View Task", action: "view_task", taskId: 1, primary: true },
    ],
  },
  {
    id: 2,
    type: "task_completed",
    title: "Task completed",
    message: 'You completed the task: "Review code changes"',
    read: false,
    created_at: new Date(Date.now() - 1000 * 60 * 60 * 2), // 2 hours ago
  },
  {
    id: 3,
    type: "task_due",
    title: "Task due soon",
    message: 'The task "Prepare presentation" is due tomorrow',
    read: true,
    created_at: new Date(Date.now() - 1000 * 60 * 60 * 5), // 5 hours ago
    actions: [
      {
        label: "Mark Complete",
        action: "complete_task",
        taskId: 2,
        primary: true,
      },
      { label: "Extend Due Date", action: "extend_due_date", taskId: 2 },
    ],
  },
  {
    id: 4,
    type: "task_updated",
    title: "Task updated",
    message: 'You updated the priority of "Fix login bug" to High',
    read: true,
    created_at: new Date(Date.now() - 1000 * 60 * 60 * 24), // 1 day ago
  },
  {
    id: 5,
    type: "system",
    title: "Welcome to TaskFlow",
    message: "Get started by creating your first task!",
    read: true,
    created_at: new Date(Date.now() - 1000 * 60 * 60 * 24 * 2), // 2 days ago
  },
]);

const allNotifications = computed(() => mockNotifications.value);

const unreadCount = computed(() => {
  return allNotifications.value.filter((n) => !n.read).length;
});

const filters = computed(() => [
  { key: "all", label: "All", count: allNotifications.value.length },
  { key: "unread", label: "Unread", count: unreadCount.value },
  {
    key: "read",
    label: "Read",
    count: allNotifications.value.length - unreadCount.value,
  },
]);

const filteredNotifications = computed(() => {
  let notifications = allNotifications.value;

  if (activeFilter.value === "unread") {
    notifications = notifications.filter((n) => !n.read);
  } else if (activeFilter.value === "read") {
    notifications = notifications.filter((n) => n.read);
  }

  return notifications.sort(
    (a, b) => new Date(b.created_at) - new Date(a.created_at)
  );
});

const getNotificationIconClass = (type) => {
  switch (type) {
    case "task_created":
      return "bg-green-100 text-green-600";
    case "task_completed":
      return "bg-blue-100 text-blue-600";
    case "task_due":
      return "bg-yellow-100 text-yellow-600";
    case "task_updated":
      return "bg-purple-100 text-purple-600";
    case "system":
      return "bg-gray-100 text-gray-600";
    default:
      return "bg-gray-100 text-gray-600";
  }
};

const getNotificationIconPath = (type) => {
  switch (type) {
    case "task_created":
      return "M12 4v16m8-8H4";
    case "task_completed":
      return "M5 13l4 4L19 7";
    case "task_due":
      return "M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z";
    case "task_updated":
      return "M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z";
    case "system":
      return "M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z";
    default:
      return "M15 17h5l-5 5v-5zM12 18.5A2.5 2.5 0 1014.5 16H12v2.5z";
  }
};

const formatNotificationDate = (date) => {
  const now = new Date();
  const notificationDate = new Date(date);
  const diffInMinutes = Math.floor((now - notificationDate) / 1000 / 60);

  if (diffInMinutes < 1) {
    return "Just now";
  } else if (diffInMinutes < 60) {
    return `${diffInMinutes} minute${diffInMinutes > 1 ? "s" : ""} ago`;
  } else if (diffInMinutes < 60 * 24) {
    const hours = Math.floor(diffInMinutes / 60);
    return `${hours} hour${hours > 1 ? "s" : ""} ago`;
  } else if (diffInMinutes < 60 * 24 * 7) {
    const days = Math.floor(diffInMinutes / (60 * 24));
    return `${days} day${days > 1 ? "s" : ""} ago`;
  } else {
    return notificationDate.toLocaleDateString("en-US", {
      year: "numeric",
      month: "short",
      day: "numeric",
    });
  }
};

const markAsRead = (notification) => {
  notification.read = true;
  // In real app: notificationsStore.markAsRead(notification.id)
};

const markAllAsRead = () => {
  mockNotifications.value.forEach((n) => (n.read = true));
  // In real app: notificationsStore.markAllAsRead()
};

const removeNotification = (notification) => {
  const index = mockNotifications.value.findIndex(
    (n) => n.id === notification.id
  );
  if (index > -1) {
    mockNotifications.value.splice(index, 1);
  }
  // In real app: notificationsStore.removeNotification(notification.id)
};

const clearAll = () => {
  mockNotifications.value.splice(0);
  // In real app: notificationsStore.clearAll()
};

const handleNotificationAction = async (notification, action) => {
  switch (action.action) {
    case "view_task":
      // Navigate to task detail
      break;
    case "complete_task":
      try {
        await tasksStore.toggleTaskStatus(action.taskId);
        notificationsStore.success("Task marked as complete");
        markAsRead(notification);
      } catch (error) {
        notificationsStore.error("Failed to update task");
      }
      break;
    case "extend_due_date":
      // Handle extending due date
      break;
  }
};

onMounted(() => {
  // In real app, fetch notifications from API
});
</script>