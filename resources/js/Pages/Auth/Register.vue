<template>
  <AuthenticatedLayout title="Create an Account">
    <form @submit.prevent="submit" class="space-y-6">
      <!-- Name Field -->
      <div>
        <a-input
          v-model:value="form.name"
          placeholder="Full name"
          size="large"
          :status="errors.name ? 'error' : ''"
          class="rounded-xl"
        >
          <template #prefix>
            <UserOutlined class="text-gray-400" />
          </template>
        </a-input>
        <div v-if="errors.name" class="mt-1 text-sm text-red-500">
          {{ errors.name }}
        </div>
      </div>

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

      <!-- Confirm Password Field -->
      <div>
        <a-input-password
          v-model:value="form.password_confirmation"
          placeholder="Confirm password"
          size="large"
          :status="errors.password_confirmation ? 'error' : ''"
          class="rounded-xl"
        >
          <template #prefix>
            <LockOutlined class="text-gray-400" />
          </template>
        </a-input-password>
        <div v-if="errors.password_confirmation" class="mt-1 text-sm text-red-500">
          {{ errors.password_confirmation }}
        </div>
      </div>

      <!-- Terms & Conditions -->
      <div>
        <a-checkbox v-model:checked="form.terms" :class="{ 'text-red-500': errors.terms }">
          <span class="text-sm text-gray-600">
            I agree to the 
            <a href="#" class="text-blue-600 hover:text-blue-500">Terms of Service</a>
            and 
            <a href="#" class="text-blue-600 hover:text-blue-500">Privacy Policy</a>
          </span>
        </a-checkbox>
        <div v-if="errors.terms" class="mt-1 text-sm text-red-500">
          {{ errors.terms }}
        </div>
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
        Create Account
      </a-button>

      <!-- Login Link -->
      <Link href="/login" class="mt-4 block text-center text-sm text-gray-600">
        Already have an account? 
        <span class="font-semibold hover:text-blue-600 transition-colors hover:underline">Sign In</span>
      </Link>
    </form>
  </AuthenticatedLayout>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import { UserOutlined, MailOutlined, LockOutlined } from '@ant-design/icons-vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
  errors: Object,
})

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
})

const submit = () => {
  form.post('/register', {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>