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

    <!-- Social Login -->
    <div class="mt-6 text-center">
        <a-divider class="!text-gray-400">
            <span class="text-sm">Or continue with</span>
        </a-divider>
        <div class="flex justify-center space-x-6 mt-4">
            <Link
              @click="socialLogin('google')"
              class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-full bg-white shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105"
            >
              <img src="/assets/image/auth/google.png" alt="Google" class="h-6 w-6" />
            </Link>

            <Link
              @click="socialLogin('facebook')"
              class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-full bg-white shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105"
            >
              <img src="/assets/image/auth/facebook.png" alt="Facebook" class="h-6 w-6" />
            </Link>

            <Link
              @click="socialLogin('github')"
              class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-full bg-white shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105"
            >
              <img src="/assets/image/auth/github.png" alt="GitHub" class="h-6 w-6" />
          </Link>

            <Link
              @click="socialLogin('linkedin')"
              class="w-12 h-12 flex items-center justify-center border border-gray-300 rounded-full bg-white shadow-sm hover:shadow-md transition-all duration-300 hover:scale-105"
            >
              <img src="/assets/image/auth/linkedin.png" alt="Linkedin" class="h-6 w-6" />
          </Link>
        </div>
    </div>
      <!-- Register Link -->
      <Link href="/register" class="mt-4 block text-center text-sm text-gray-600">
        Don't have an account? 
        <span class="font-semibold hover:text-blue-600 transition-colors hover:underline">Sign In</span>
      </Link>
    </form>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import { MailOutlined, LockOutlined } from '@ant-design/icons-vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

const loading = ref( false );

function socialLogin(provider) {
  loading.value = true
  window.location.href = route('social.login', provider)
}

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