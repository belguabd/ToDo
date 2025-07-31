<template>
  <div class="max-w-2xl mx-auto space-y-6">
    <div v-if="loading" class="text-center py-8">
      <p class="text-muted-foreground">Loading task details...</p>
    </div>

    <div v-else-if="task">
      <div class="flex items-center justify-between mb-6">
        <Button variant="ghost" @click="$router.go(-1)">
          <ArrowLeft class="w-4 h-4 mr-2" />
          Back
        </Button>

        <div class="flex space-x-2">
          <Button variant="outline" @click="editMode = !editMode">
            <Edit class="w-4 h-4 mr-2" />
            {{ editMode ? "Cancel" : "Edit" }}
          </Button>

          <Button variant="destructive" @click="handleDelete">
            <Trash2 class="w-4 h-4 mr-2" />
            Delete
          </Button>
        </div>
      </div>

      <TaskForm
        v-if="editMode"
        :task="task"
        :loading="tasksStore.loading"
        @submit="handleUpdate"
        @cancel="editMode = false"
      />

      <Card v-else class="p-6">
        <div class="space-y-4">
          <div class="flex items-center space-x-3">
            <input
              type="checkbox"
              :checked="task.completed"
              @change="handleToggle"
              class="w-5 h-5 text-primary bg-background border-border rounded focus:ring-primary focus:ring-2"
            />
            <h1
              class="text-3xl font-bold"
              :class="{ 'line-through text-muted-foreground': task.completed }"
            >
              {{ task.title }}
            </h1>
          </div>

          <Badge
            :variant="task.completed ? 'secondary' : 'default'"
            class="w-fit"
          >
            {{ task.completed ? "Completed" : "Pending" }}
          </Badge>

          <div v-if="task.description" class="prose dark:prose-invert">
            <h3>Description</h3>
            <p>{{ task.description }}</p>
          </div>

          <div
            v-if="task.due_date"
            class="flex items-center space-x-2 text-muted-foreground"
          >
            <Calendar class="w-4 h-4" />
            <span>Due: {{ formatDate(task.due_date) }}</span>
          </div>

          <div
            class="flex items-center space-x-4 text-sm text-muted-foreground pt-4 border-t"
          >
            <span>Created: {{ formatDate(task.created_at) }}</span>
            <span v-if="task.updated_at !== task.created_at">
              Updated: {{ formatDate(task.updated_at) }}
            </span>
          </div>
        </div>
      </Card>
    </div>

    <div v-else class="text-center py-8">
      <p class="text-muted-foreground">Task not found</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { ArrowLeft, Edit, Trash2, Calendar } from "lucide-vue-next";
import { useTasksStore } from "@/stores/tasks";
import { useNotificationsStore } from "@/stores/notifications";
import TaskForm from "@/components/TaskForm.vue";
import { Card } from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";

const route = useRoute();
const router = useRouter();
const tasksStore = useTasksStore();
const notificationsStore = useNotificationsStore();

const task = ref(null);
const loading = ref(true);
const editMode = ref(false);

const fetchTask = async () => {
  try {
    loading.value = true;
    task.value = await tasksStore.getTask(route.params.id);
  } catch (error) {
    notificationsStore.error("Failed to load task");
    router.push("/tasks");
  } finally {
    loading.value = false;
  }
};

const handleUpdate = async (taskData) => {
  try {
    const updatedTask = await tasksStore.updateTask(task.value.id, taskData);
    task.value = updatedTask;
    editMode.value = false;
    notificationsStore.success("Task updated successfully!");
  } catch (error) {
    notificationsStore.error("Failed to update task");
  }
};

const handleToggle = async () => {
  try {
    const updatedTask = await tasksStore.toggleTaskStatus(task.value.id);
    task.value = updatedTask;
    notificationsStore.success("Task status updated!");
  } catch (error) {
    notificationsStore.error("Failed to update task status");
  }
};

const handleDelete = async () => {
  if (confirm("Are you sure you want to delete this task?")) {
    try {
      await tasksStore.deleteTask(task.value.id);
      notificationsStore.success("Task deleted successfully!");
      router.push("/tasks");
    } catch (error) {
      notificationsStore.error("Failed to delete task");
    }
  }
};

const formatDate = (date) => {
  return new Date(date).toLocaleDateString("en-US", {
    year: "numeric",
    month: "long",
    day: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  });
};

onMounted(() => {
  fetchTask();
});
</script>