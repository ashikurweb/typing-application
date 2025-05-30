<template>
  <header class="shadow-md bg-white bg-gradient-to-br sticky top-0 z-50">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <!-- Logo Section -->
        <div class="flex items-center space-x-2">
          <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
          <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            TypeMaster
          </span>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center space-x-8">
          <Link 
            :href="route('home')" 
            class="text-blue-400 hover:text-blue-600 font-medium transition-colors duration-200 flex items-center space-x-1"
          >
            <HomeOutlined class="text-lg" />
            <span>Home</span>
          </Link>
          
          <Link 
            :href="route('blog.index')" 
            class="text-blue-400 hover:text-blue-600 font-medium transition-colors duration-200 flex items-center space-x-1"
          >
            <InfoCircleOutlined class="text-lg" />
            <span>Blog</span>
          </Link>
          
          <Link 
            href="#" 
            class="text-blue-400 hover:text-blue-600 font-medium transition-colors duration-200 flex items-center space-x-1"
          >
            <ContactsOutlined class="text-lg" />
            <span>Contact</span>
          </Link>

        </nav>

        <!-- User Section -->
        <div class="flex items-center space-x-4">
          <!-- Guest User (Login/Register) -->
          <div v-if="!isLoggedIn" class="hidden md:flex items-center space-x-3">
            <Link 
              :href="route('login')"
              class="text-blue-400 hover:text-blue-600 font-medium transition-colors duration-200"
            >
              Login
            </Link>
            <Link 
              :href="route('register')"
              class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-lg font-medium hover:from-blue-600 hover:to-purple-700 transition-all duration-200 shadow-md hover:shadow-lg"
            >
              Register
            </Link>
          </div>

          <!-- Logged In User -->
          <div v-else class="hidden md:block">
            <a-dropdown :trigger="['click']" placement="bottomRight">
              <div class="flex items-center space-x-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition-colors duration-200">
                <a-avatar :size="36" :src="user.avatar">
                  <template #icon><UserOutlined /></template>
                </a-avatar>
                <div class="flex flex-col">
                  <span class="text-sm font-medium text-gray-900">{{ user.name }}</span>
                  <span class="text-xs text-gray-500">{{ user.email }}</span>
                </div>
                <DownOutlined class="text-xs text-gray-400" />
              </div>
              <template #overlay>
                <a-menu class="min-w-56">
                  <a-menu-item key="profile">
                    <Link href="#" class="flex items-center space-x-3">
                      <UserOutlined class="text-lg" />
                      <span>Profile</span>
                    </Link>
                  </a-menu-item>
                  <a-menu-item key="dashboard">
                    <Link href="#" class="flex items-center space-x-3">
                      <DashboardOutlined class="text-lg" />
                      <span>Dashboard</span>
                    </Link>
                  </a-menu-item>
                  <a-menu-item key="settings">
                    <Link href="#" class="flex items-center space-x-3">
                      <SettingOutlined class="text-lg" />
                      <span>Settings</span>
                    </Link>
                  </a-menu-item>
                  <a-menu-divider />
                  <a-menu-item key="logout" @click="handleLogout">
                    <div class="flex items-center space-x-3 text-red-600">
                      <LogoutOutlined class="text-lg" />
                      <span>Logout</span>
                    </div>
                  </a-menu-item>
                </a-menu>
              </template>
            </a-dropdown>
          </div>

          <!-- Mobile Menu Button -->
          <button 
            @click="mobileMenuOpen = !mobileMenuOpen"
            class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200"
          >
            <MenuOutlined v-if="!mobileMenuOpen" class="text-xl" />
            <CloseOutlined v-else class="text-xl" />
          </button>
        </div>
      </div>

      <!-- Mobile Menu -->
      <div 
        v-show="mobileMenuOpen"
        class="md:hidden border-t border-gray-200 py-4 space-y-2"
      >
        <Link 
          :href="route('home')" 
          class="flex items-center space-x-3 px-4 py-3 text-blue-400 hover:bg-gray-50 rounded-lg transition-colors duration-200"
          @click="mobileMenuOpen = false"
        >
          <HomeOutlined />
          <span>Home</span>
        </Link>
        
        <Link 
          href="#" 
          class="flex items-center space-x-3 px-4 py-3 text-blue-400 hover:bg-gray-50 rounded-lg transition-colors duration-200"
          @click="mobileMenuOpen = false"
        >
          <InfoCircleOutlined />
          <span>Blog</span>
        </Link>
        
        <Link 
          href="#" 
          class="flex items-center space-x-3 px-4 py-3 text-blue-400 hover:bg-gray-50 rounded-lg transition-colors duration-200"
          @click="mobileMenuOpen = false"
        >
          <ContactsOutlined />
          <span>Contact</span>
        </Link>

        <!-- Mobile User Section -->
        <div v-if="!isLoggedIn" class="px-4 py-2 space-y-2">
          <div class="border-t border-gray-200 my-2"></div>
          <Link 
            :href="route('login')"
            class="block w-full text-center py-2 text-blue-400 hover:bg-gray-50 rounded-lg transition-colors duration-200"
            @click="mobileMenuOpen = false"
          >
            Login
          </Link>
          <Link 
            :href="route('register')"
            class="block w-full text-center py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg font-medium"
            @click="mobileMenuOpen = false"
          >
            Register
          </Link>
        </div>

        <div v-else class="px-4 py-2">
          <div class="border-t border-gray-200 my-2"></div>
          <div class="flex items-center space-x-3 mb-3">
            <a-avatar :size="32" :src="user.avatar">
              <template #icon><UserOutlined /></template>
            </a-avatar>
            <div>
              <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
              <div class="text-xs text-gray-500">{{ user.email }}</div>
            </div>
          </div>
          <div class="space-y-1">
            <Link 
              href="#" 
              class="flex items-center space-x-3 px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors duration-200"
              @click="mobileMenuOpen = false"
            >
              <UserOutlined />
              <span>Profile</span>
            </Link>
            <Link 
              href="#" 
              class="flex items-center space-x-3 px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors duration-200"
              @click="mobileMenuOpen = false"
            >
              <DashboardOutlined />
              <span>Dashboard</span>
            </Link>
            <Link 
              href="#" 
              class="flex items-center space-x-3 px-4 py-2 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors duration-200"
              @click="mobileMenuOpen = false"
            >
              <SettingOutlined />
              <span>Settings</span>
            </Link>
            <button 
              @click="handleLogout"
              class="flex items-center space-x-3 px-4 py-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200 w-full text-left"
            >
              <LogoutOutlined />
              <span>Logout</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </header>
</template>

<script setup>
import { ref, computed } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import {
  HomeOutlined,
  InfoCircleOutlined,
  ContactsOutlined,
  AppstoreOutlined,
  DownOutlined,
  StarOutlined,
  DollarOutlined,
  QuestionCircleOutlined,
  UserOutlined,
  DashboardOutlined,
  SettingOutlined,
  LogoutOutlined,
  MenuOutlined,
  CloseOutlined
} from '@ant-design/icons-vue'

// Mobile menu state
const mobileMenuOpen = ref(false)

// Get user data from Inertia props
const page = usePage()
const user = computed(() => page.props.auth?.user)
const isLoggedIn = computed(() => !!user.value)

// Handle logout
const handleLogout = () => {
  router.post('/logout')
  mobileMenuOpen.value = false
}

// Close mobile menu on route change
router.on('navigate', () => {
  mobileMenuOpen.value = false
})
</script>

