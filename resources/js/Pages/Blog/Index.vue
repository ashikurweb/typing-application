<template>
  <AppLayout />
  <div class="min-h-screen bg-white">
    <!-- Breadcrumb Section -->
    <div class="container mx-auto px-4 pt-6">
      <a-breadcrumb>
        <a-breadcrumb-item>
          <a href="#">Home</a>
        </a-breadcrumb-item>
        <a-breadcrumb-item>Blogs</a-breadcrumb-item>
      </a-breadcrumb>
    </div>

    <div class="container mx-auto px-4 mt-8">
      <!-- Header Section -->
      <div class="flex justify-between flex-wrap mb-6">
        <h4 class="text-2xl font-semibold text-gray-900">
          Blogs
        </h4>
        <div class="flex items-center gap-2">
          <div class="flex gap-3">
            <a-input
              placeholder="Search"
              class="px-4 py-2.5 w-[293px] h-10"
              v-model:value="searchQuery"
            >
              <template #prefix>
                <SearchOutlined />
              </template>
              <template #suffix>
                <CloseCircleOutlined
                  v-if="searchQuery"
                  class="text-red-500 cursor-pointer"
                  @click="clearFilters"
                />
              </template>
            </a-input>
          </div>
        </div>
      </div>

      <!-- Category Filter Section -->
      <div class="mb-8">
        <div class="flex flex-wrap gap-3 items-center">
          <span class="text-base font-medium text-gray-700 mr-2">Categories:</span>
          <a-tag
            :color="selectedCategory === '' ? 'blue' : 'default'"
            class="cursor-pointer px-3 py-1 text-sm"
            @click="selectedCategory = ''"
          >
            All
          </a-tag>
          <a-tag
            v-for="category in categories"
            :key="category.value"
            :color="selectedCategory === category.value ? 'blue' : 'default'"
            class="cursor-pointer px-3 py-1 text-sm capitalize"
            @click="selectedCategory = category.value"
          >
            {{ category.label }}
          </a-tag>
        </div>
        
        <!-- Results Count -->
        <div class="mt-4 text-sm text-gray-600">
          Showing {{ filteredBlogs.length }} of {{ blogs.length }} articles
          <span v-if="selectedCategory || searchQuery" class="ml-2">
            <a-button type="text" size="small" @click="clearAllFilters" class="text-red-500">
              Clear All Filters
            </a-button>
          </span>
        </div>
      </div>

      <!-- Blog Cards Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <div
          class="relative mb-20"
          v-for="(blog, index) in filteredBlogs"
          :key="index"
        >
          <div class="w-[calc(100%-24px)] h-[401px]">
            <img
              class="w-full h-full object-cover rounded-md"
              :src="blog.image_url"
              :alt="blog.title"
            />
          </div>
          <div
            class="p-5 bottom-[-50px] w-[calc(100%-24px)] block-shadow bg-white ml-6 rounded-md -mt-[130px] relative z-[1]"
          >
            <div
              class="bg-indigo-600 absolute right-12 -top-10 h-[72px] w-[72px] flex-col rounded-sm text-white text-xl inline-flex items-center justify-center"
            >
              <span class="text-sm">{{ blog.dayNumber }}-{{ blog.shortMonthName }}</span>
              <span>{{ blog.year }}</span>
            </div>
            <!-- end date badge -->
            <div
              class="border-0 border-b border-solid border-gray-200 pb-4"
            >
              <a-tag
                class="text-base text-indigo-500 capitalize mb-2 inline-block"
                :color="getCategoryColor(blog.category)"
              >
                {{ blog.category }}
              </a-tag>
              <a
                href="#"
                class="no-underline hover:text-indigo-600 mb-3 text-2xl text-gray-900 font-medium block cursor-pointer"
                @click="openBlog(blog)"
              >
                {{ blog.title }}
              </a>
            </div>

            <div class="flex pt-5 justify-between items-center">
              <a
                href="#"
                class="no-underline text-base text-gray-700 font-normal cursor-pointer"
                @click="openBlog(blog)"
              >
                Read More
              </a>
              <a href="#" @click="openBlog(blog)">
                <a-button
                  class="h-8 w-8 bg-indigo-200 text-indigo-600 rounded-[2px] hover:bg-indigo-600 hover:text-white cursor-pointer m-0 border-none flex justify-center items-center p-0"
                >
                  <RightOutlined class="h-4 w-4" />
                </a-button>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-if="filteredBlogs.length === 0" class="text-center py-16">
        <div class="text-gray-400 mb-4">
          <SearchOutlined style="font-size: 64px;" />
        </div>
        <h3 class="text-xl font-medium text-gray-900 mb-2">No blogs found</h3>
        <p class="text-gray-500 mb-4">Try adjusting your search or filter criteria</p>
        <a-button type="primary" @click="clearAllFilters">Clear All Filters</a-button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import {
  SearchOutlined,
  CloseCircleOutlined,
  RightOutlined
} from '@ant-design/icons-vue'
import AppLayout from '@/Layouts/AppLayout.vue'

// Reactive data
const searchQuery = ref('')
const selectedCategory = ref('')
const currentPage = ref(1)
const pageSize = ref(9)

// Categories
const categories = ref([
  { value: 'technology', label: 'Technology' },
  { value: 'development', label: 'Development' },
  { value: 'design', label: 'Design' },
  { value: 'business', label: 'Business' },
  { value: 'lifestyle', label: 'Lifestyle' },
  { value: 'travel', label: 'Travel' }
])

// Sample blog data (same structure as your original)
const blogs = ref([
  {
    id: 1,
    title: 'Building Modern Vue 3 Applications with Composition API',
    category: 'technology',
    image_url: 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=500&h=401&fit=crop',
    dayNumber: '15',
    shortMonthName: 'Mar',
    year: '2024',
    slug: 'building-modern-vue-3-applications'
  },
  {
    id: 2,
    title: 'Advanced CSS Grid Techniques for Modern Web Design',
    category: 'design',
    image_url: 'https://images.unsplash.com/photo-1586717791821-3f44a563fa4c?w=500&h=401&fit=crop',
    dayNumber: '12',
    shortMonthName: 'Mar',
    year: '2024',
    slug: 'advanced-css-grid-techniques'
  },
  {
    id: 3,
    title: 'Microservices Architecture with Node.js and Docker',
    category: 'development',
    image_url: 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=500&h=401&fit=crop',
    dayNumber: '10',
    shortMonthName: 'Mar',
    year: '2024',
    slug: 'microservices-architecture-nodejs-docker'
  },
])

// Computed properties
const filteredBlogs = computed(() => {
  let filtered = blogs.value

  // Filter by category
  if (selectedCategory.value) {
    filtered = filtered.filter(blog => blog.category === selectedCategory.value)
  }

  // Filter by search query
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(blog =>
      blog.title.toLowerCase().includes(query) ||
      blog.category.toLowerCase().includes(query)
    )
  }

  return filtered
})

const currentPageStart = computed(() => {
  return (currentPage.value - 1) * pageSize.value + 1
})

const currentPageEnd = computed(() => {
  const end = currentPage.value * pageSize.value
  return end > filteredBlogs.value.length ? filteredBlogs.value.length : end
})

// Methods
const clearFilters = () => {
  searchQuery.value = ''
}

const clearAllFilters = () => {
  searchQuery.value = ''
  selectedCategory.value = ''
  currentPage.value = 1
}

const getCategoryColor = (category) => {
  const colors = {
    technology: 'blue',
    development: 'green',
    design: 'purple',
    business: 'orange',
    lifestyle: 'pink',
    travel: 'cyan'
  }
  return colors[category] || 'blue'
}

</script>

<style scoped>
.block-shadow {
  box-shadow: 0px 8px 30px 0px rgba(15, 23, 42, 0.12);
}

.container {
  max-width: 1200px;
}

/* Custom styling for Ant Design components */
:deep(.ant-input) {
  border-radius: 6px;
}

:deep(.ant-tag) {
  border-radius: 4px;
  transition: all 0.2s ease;
}

:deep(.ant-tag):hover {
  transform: translateY(-1px);
}

:deep(.ant-pagination) {
  margin: 0;
}

:deep(.ant-breadcrumb) {
  font-size: 14px;
}
</style>