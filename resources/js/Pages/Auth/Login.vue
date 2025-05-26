<template>
  <AuthenticatedLayout title="Sign In" subtitle="Welcome back! Please sign in to your account">
    <form @submit.prevent="submit" class="space-y-6">
      <!-- Email Field -->
      <div>
        <a-input
          v-model:value="form.email"
          type="email"
          placeholder="Email address"
          size="large"
          :status="errors.email ? 'error' : ''"
          class="rounded-xl"
        >
          <template #prefix>
            <MailOutlined class="text-gray-400" />
          </template>
        </a-input>
        <div v-if="errors.email" class="mt-1 text-sm text-red-500">
          {{ errors.email }}
        </div>
      </div>

      <!-- Password Field -->
      <div>
        <a-input-password
          v-model:value="form.password"
          placeholder="Password"
          size="large"
          :status="errors.password ? 'error' : ''"
          class="rounded-xl"
        >
          <template #prefix>
            <LockOutlined class="text-gray-400" />
          </template>
        </a-input-password>
        <div v-if="errors.password" class="mt-1 text-sm text-red-500">
          {{ errors.password }}
        </div>
      </div>

      <!-- Remember Me & Forgot Password -->
      <div class="flex items-center justify-between">
        <a-checkbox v-model:checked="form.remember">
          <span class="text-sm text-gray-600">Remember me</span>
        </a-checkbox>
        <Link href="/forgot-password" class="text-sm text-blue-600 hover:text-blue-500 transition-colors">
          Forgot password?
        </Link>
      </div>

      <!-- Submit Button -->
      <a-button
        type="primary"
        html-type="submit"
        size="large"
        :loading="form.processing"
        block
        class="!bg-gradient-to-r !from-blue-500 !to-purple-600 !border-none !rounded-xl !h-12 !text-white !font-semibold !shadow-lg hover:!shadow-xl !transition-all"
      >
        Sign In
      </a-button>

      <!-- Divider -->
      <a-divider class="!text-gray-400">
        <span class="text-sm">New to Typing App?</span>
      </a-divider>

      <!-- Register Link -->
      <Link href="/register">
        <a-button
          size="large"
          block
          class="!rounded-xl !h-12 !font-semibold !border-2 !border-gray-200 hover:!border-blue-300 !transition-all"
        >
          Create Account
        </a-button>
      </Link>
    </form>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import { MailOutlined, LockOutlined } from '@ant-design/icons-vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
  errors: Object,
  status: String,
})

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post('/login', {
    onFinish: () => form.reset('password'),
  })
}
</script>