<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { MailOutlined } from '@ant-design/icons-vue'
import FlashBanner from '@/Components/FlashBanner.vue'
import { ref } from 'vue'

defineProps({
  status: String,
  errors: Object,
})

const form = useForm({
  email: '',
})

const submit = () => {
  form.post(route('password.email'))
}
</script>

<template>
  <Head title="Forgot Password" />
  <FlashBanner />
  <GuestLayout title="Forgot Password">
    <div v-if="status" class="mb-4 text-green-600 font-medium text-sm">
      {{ status }}
    </div>

    <form @submit.prevent="submit" class="space-y-6 max-w-xl">
      <div>
        <a-input
          v-model:value="form.email"
          type="email"
          placeholder="Email address"
          size="large"
          :status="form.errors.email ? 'error' : ''"
          class="rounded-xl"
          autocomplete="username"
          autofocus
        >
          <template #prefix>
            <MailOutlined class="text-gray-400" />
          </template>
        </a-input>
        <div v-if="form.errors.email" class="mt-1 text-sm text-red-500">
          {{ form.errors.email }}
        </div>
      </div>

      <a-button
        type="primary"
        html-type="submit"
        size="large"
        :loading="form.processing"
        block
        class="!bg-gradient-to-r !from-blue-500 !to-purple-600 !border-none !rounded-xl !h-12 !text-white !font-semibold !shadow-lg hover:!shadow-xl !transition-all"
      >
        Send Password Reset Link
      </a-button>

      <a-divider class="!text-gray-400">
            <span class="text-sm">Or continue with</span>
      </a-divider>
      <!-- Login Link -->
      <Link href="/login" class="mt-4 block text-center text-sm text-gray-600">
        Back to login? 
        <span class="font-semibold hover:text-blue-600 transition-colors hover:underline">Sign In</span>
      </Link>
    </form>
  </GuestLayout>
</template>
