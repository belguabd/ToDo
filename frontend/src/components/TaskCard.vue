<template>
  <Card class="p-4 hover:shadow-md transition-shadow">
    <div class="flex items-start justify-between">
      <div class="flex-1 space-y-2">
        <div class="flex items-center space-x-2">
          <input
            type="checkbox"
            :checked="task.completed"
            @change="toggleStatus"
            class="w-4 h-4 text-primary bg-background border-border rounded focus:ring-primary focus:ring-2"
          />
          <h3 
            :class="cn(
              'font-semibold text-lg',
              task.completed && 'line-through text-muted-foreground'
            )"
          >
            {{ task.title }}
          </h3>
        </div>
        
        <p 
          v-if="task.description" 
          :class="cn(
            'text-muted-foreground',
            task.completed && 'line-through'
          )"
        >
          {{ task.description }}
        </p>
        
        <div class="flex items-center space-x-2">
          <Badge :variant="task.completed ? 'secondary' : 'default'">
            {{ task.completed ? 'Completed' : 'Pending' }}
          </Badge>
          
          <span v-if="task.due_date" class="text-sm text-muted-foreground">
            Due: {{ formatDate(task.due_date) }}
          </span>
        </div>
      </div>
      
      <div class="flex items-center space-x-2 ml-4">
        <Button 
          variant="ghost" 
          size="icon"
          @click="$emit('edit', task)"
        >
          <Edit class="w-4 h-4" />
        </Button>
        
        <Button 
          variant="ghost" 
          size="icon"
          @click="$emit('delete', task)"
          class="text-destructive hover:text-destructive"
        >
          <Trash2 class="w-4 h-4" />
        </Button>
      </div>
    </div>
  </Card>
</template>

<script setup>
import { Edit, Trash2 } from 'lucide-vue-next'
import { cn } from '@/lib/utils'
// import Card from '@/components/ui/Card.vue'
import {Button} from '@/components/ui/button'
import {Badge} from '@/components/ui/badge'

const props = defineProps({
  task: {
    type: Object,
    required: true
  }
})

const emit = defineEmits(['toggle', 'edit', 'delete'])

const toggleStatus = () => {
  emit('toggle', props.task.id)
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString()
}
</script>