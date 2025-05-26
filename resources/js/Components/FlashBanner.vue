<template>
  <a-space direction="vertical" size="middle" class="w-full flex justify-center">
  </a-space>
</template>

<script lang="ts" setup>
import { onMounted } from 'vue'
import { message } from 'ant-design-vue'
import { usePage } from '@inertiajs/vue3'

// Destructure Inertia flash props
const { flash } = usePage().props;

/**
 * Unified helper to show success or error messages
 * @param type 'success' | 'error'
 */
const showMessage = (type: 'success' | 'error') => {
  const text = type === 'success'
    ? 'This is a success message. It will disappear in 10 seconds.'
    : 'This is an error message. It will disappear in 10 seconds.'
  message[type](text, 10)
}

// On component mount, fire any flash messages
onMounted(() => {
  if (flash.success) {
    message.success(flash.success as string, 5)
  }
  if (flash.error) {
    message.error(flash.error as string, 5)
  }
})
</script>

<style scoped>
.w-full {
  margin-top: 2rem;
}
</style>