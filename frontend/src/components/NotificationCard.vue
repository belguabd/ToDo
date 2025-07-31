<template>
  <div 
    :class="cn(
      'p-4 rounded-lg border-l-4 mb-4 shadow-sm bg-card min-w-[300px] max-w-[400px]',
      notificationStyles[notification.type]
    )"
  >
    <div class="flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <component :is="getIcon()" class="w-5 h-5" />
        <p class="font-medium text-card-foreground">{{ notification.message }}</p>
      </div>
      
      <Button
        variant="ghost"
        size="icon"
        @click="$emit('close')"
        class="h-6 w-6"
      >
        <X class="w-4 h-4" />
      </Button>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { CheckCircle, AlertCircle, Info, AlertTriangle, X } from 'lucide-vue-next'
import { cn } from '@/lib/utils'
import {Button} from '@/components/ui/button'

const props = defineProps({
  notification: {
    type: Object,
    required: true
  }
})

defineEmits(['close'])

const notificationStyles = {
  success: 'border-l-green-500 bg-green-50 dark:bg-green-950',
  error: 'border-l-red-500 bg-red-50 dark:bg-red-950',
  warning: 'border-l-yellow-500 bg-yellow-50 dark:bg-yellow-950',
  info: 'border-l-blue-500 bg-blue-50 dark:bg-blue-950'
}

const getIcon = () => {
  const icons = {
    success: CheckCircle,
    error: AlertCircle,
    warning: AlertTriangle,
    info: Info
  }
  return icons[props.notification.type] || Info
}
</script>