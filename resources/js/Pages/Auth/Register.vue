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

      <!-- Divider -->
      <a-divider class="!text-gray-400">
        <span class="text-sm">Already have an account?</span>
      </a-divider>

      <!-- Login Link -->
      <Link href="/login">
        <a-button
          size="large"
          block
          class="!rounded-xl !h-12 !font-semibold !border-2 !border-gray-200 hover:!border-blue-300 !transition-all"
        >
          Sign In
        </a-button>
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