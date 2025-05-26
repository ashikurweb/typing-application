<template>
  <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl w-full space-y-8">
      <!-- Auth Card -->
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-200/50 p-8">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900">{{ title }}</h1>
        </div>
        <slot />
      </div>

    </div>
  </div>
</template>

<script setup>
defineProps({
  title: {
    type: String,
    default: 'Welcome'
  }
})
</script>