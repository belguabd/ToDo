<template>
  <Card class="p-6">
    <form @submit.prevent="handleSubmit" class="space-y-4">
      <h2 class="text-2xl font-bold">
        {{ isEditing ? "Edit Task" : "Create New Task" }}
      </h2>

      <div class="space-y-2">
        <label class="text-sm font-medium">Title *</label>
        <Input v-model="form.title" placeholder="Enter task title" required />
      </div>

      <div class="space-y-2">
        <label class="text-sm font-medium">Description</label>
        <textarea
          v-model="form.description"
          class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
          placeholder="Enter task description"
        ></textarea>
      </div>

      <div class="space-y-2">
        <label class="text-sm font-medium">Due Date</label>
        <Input v-model="form.due_date" type="date" />
      </div>

      <div class="flex items-center space-x-2">
        <input
          v-model="form.completed"
          type="checkbox"
          class="w-4 h-4 text-primary bg-background border-border rounded focus:ring-primary focus:ring-2"
        />
        <label class="text-sm font-medium">Mark as completed</label>
      </div>

      <div class="flex space-x-2">
        <Button type="submit" :disabled="loading">
          {{
            loading ? "Saving..." : isEditing ? "Update Task" : "Create Task"
          }}
        </Button>

        <Button type="button" variant="outline" @click="$emit('cancel')">
          Cancel
        </Button>
      </div>
    </form>
  </Card>
</template>

<script setup>
import { ref, watch } from "vue";
import {Card} from "@/components/ui/card";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";

const props = defineProps({
  task: {
    type: Object,
    default: null,
  },
  loading: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["submit", "cancel"]);

const isEditing = ref(!!props.task);

const form = ref({
  title: "",
  description: "",
  due_date: "",
  completed: false,
});

watch(
  () => props.task,
  (newTask) => {
    if (newTask) {
      form.value = {
        title: newTask.title || "",
        description: newTask.description || "",
        due_date: newTask.due_date || "",
        completed: newTask.completed || false,
      };
      isEditing.value = true;
    } else {
      form.value = {
        title: "",
        description: "",
        due_date: "",
        completed: false,
      };
      isEditing.value = false;
    }
  },
  { immediate: true }
);

const handleSubmit = () => {
  emit("submit", { ...form.value });
};
</script>