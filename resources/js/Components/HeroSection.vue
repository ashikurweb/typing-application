<template>
  <section class="relative min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 overflow-hidden">
    <!-- Enhanced Animated Background Elements -->
    <AppLayout />
    
    <!-- Dynamic Background Particles -->
    <div class="absolute inset-0 pointer-events-none">
      <!-- Floating Particles with Enhanced Animation -->
      <div 
        v-for="(particle, index) in particles" 
        :key="index"
        class="absolute rounded-full animate-pulse transition-all duration-1000"
        :class="[
          particle.size,
          particle.color,
          particle.blur
        ]"
        :style="{
          left: particle.x + '%',
          top: particle.y + '%',
          animationDelay: particle.delay + 's',
          animationDuration: particle.duration + 's',
          transform: `rotate(${particle.rotation}deg) scale(${particle.scale})`
        }"
      ></div>
      
      <!-- Enhanced Gradient Orbs with Movement -->
      <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gradient-to-r from-purple-500/30 to-pink-500/30 rounded-full blur-3xl animate-pulse transform hover:scale-110 transition-transform duration-[3000ms]"></div>
      <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-gradient-to-r from-blue-500/30 to-cyan-500/30 rounded-full blur-3xl animate-pulse transform hover:scale-110 transition-transform duration-[4000ms]" style="animation-delay: 2s;"></div>
      <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-gradient-to-r from-indigo-500/20 to-purple-500/20 rounded-full blur-2xl animate-pulse hover:scale-125 transition-transform duration-[5000ms]" style="animation-delay: 1s;"></div>
      
      <!-- Floating Geometric Shapes -->
      <div class="absolute top-20 left-20 w-8 h-8 bg-gradient-to-r from-yellow-400 to-orange-400 rotate-45 animate-spin-slow opacity-70"></div>
      <div class="absolute top-40 right-32 w-6 h-6 bg-gradient-to-r from-green-400 to-emerald-400 rounded-full animate-bounce opacity-60" style="animation-delay: 0.5s;"></div>
      <div class="absolute bottom-32 left-16 w-10 h-10 bg-gradient-to-r from-pink-400 to-rose-400 rotate-12 animate-pulse opacity-80"></div>
      <div class="absolute bottom-20 right-20 w-12 h-12 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-lg animate-bounce opacity-70" style="animation-delay: 1s;"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16">
      <div class="text-center">
        <!-- Enhanced Main Heading with Advanced Typing Animation -->
        <div class="mb-8 transform hover:scale-105 transition-transform duration-500">
          <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white mb-4 drop-shadow-2xl">
            <span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-gradient-x">
              Master Your
            </span>
            <br />
            <span class="relative inline-block">
              <span class="bg-gradient-to-r from-yellow-400 via-orange-400 to-red-400 bg-clip-text text-transparent animate-gradient-x">
                {{ currentWord }}
              </span>
              <span 
                class="inline-block w-1 h-16 bg-gradient-to-b from-yellow-400 to-orange-400 ml-2 animate-pulse transform origin-bottom"
                :class="{ 
                  'opacity-100 animate-pulse': showCursor, 
                  'opacity-0': !showCursor,
                  'animate-bounce': isTyping
                }"
              ></span>
            </span>
          </h1>
        </div>

        <!-- Enhanced Subtitle with Staggered Animation -->
        <div class="mb-12 transform translate-y-4 animate-fade-in-up" style="animation-delay: 0.5s;">
          <p class="text-xl sm:text-2xl text-gray-300 mb-8 max-w-4xl mx-auto leading-relaxed">
            Transform your typing skills with our advanced practice platform. 
            <span class="text-purple-400 font-semibold hover:text-purple-300 transition-colors cursor-pointer animate-pulse">Real-time feedback</span>, 
            <span class="text-blue-400 font-semibold hover:text-blue-300 transition-colors cursor-pointer animate-pulse" style="animation-delay: 0.5s;">adaptive lessons</span>, and 
            <span class="text-pink-400 font-semibold hover:text-pink-300 transition-colors cursor-pointer animate-pulse" style="animation-delay: 1s;">gamified learning</span> 
            await you.
          </p>
        </div>

        <!-- Enhanced Interactive Demo Typing Box -->
        <div class="mb-12 max-w-4xl mx-auto transition-all duration-500">
          <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 shadow-2xl hover:shadow-purple-500/25 transition-shadow duration-500 relative overflow-hidden group">
            <!-- Animated Border Effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/20 via-blue-500/20 to-pink-500/20 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 animate-pulse"></div>
            
            <div class="text-left relative z-10">
              <!-- Enhanced Header with Live Stats -->
              <div class="text-gray-400 text-sm mb-4 flex items-center justify-between flex-wrap gap-4">
                <span class="flex items-center space-x-2">
                  <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                  <span>Try typing this sample text:</span>
                </span>
                <div class="flex items-center space-x-6">
                  <div class="flex items-center space-x-2 bg-green-500/20 px-3 py-1 rounded-full border border-green-500/30">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-green-400 font-semibold">WPM: {{ wpm }}</span>
                  </div>
                  <div class="flex items-center space-x-2 bg-blue-500/20 px-3 py-1 rounded-full border border-blue-500/30">
                    <div class="w-2 h-2 bg-blue-400 rounded-full animate-pulse"></div>
                    <span class="text-blue-400 font-semibold">Accuracy: {{ accuracy }}%</span>
                  </div>
                  <div class="flex items-center space-x-2 bg-purple-500/20 px-3 py-1 rounded-full border border-purple-500/30">
                    <div class="w-2 h-2 bg-purple-400 rounded-full animate-pulse"></div>
                    <span class="text-purple-400 font-semibold">Time: {{ formatTime(timeElapsed) }}</span>
                  </div>
                </div>
              </div>

              <!-- Progress Bar -->
              <div class="w-full h-2 bg-white/10 rounded-full mb-6 overflow-hidden">
                <div 
                  class="h-full bg-gradient-to-r from-green-400 via-blue-400 to-purple-400 rounded-full transition-all duration-300 relative"
                  :style="{ width: progressPercent + '%' }"
                >
                  <div class="absolute inset-0 bg-white/30 animate-pulse"></div>
                </div>
              </div>
              
              <!-- Enhanced Text Display with Character Animation -->
              <div class="text-lg text-gray-300 mb-6 leading-relaxed font-mono bg-black/20 p-4 rounded-xl border border-white/10" ref="textToType">
                <span 
                  v-for="(char, index) in sampleText" 
                  :key="index"
                  class="relative inline-block transition-all duration-200 transform"
                  :class="{
                    'bg-green-500/40 text-green-300 scale-105 shadow-lg shadow-green-500/25 rounded-sm': index < typedText.length && typedText[index] === char,
                    'bg-red-500/40 text-red-300 scale-105 shadow-lg shadow-red-500/25 rounded-sm animate-shake': index < typedText.length && typedText[index] !== char,
                    'bg-blue-500/40 text-white scale-110 shadow-lg shadow-blue-500/50 rounded-sm animate-pulse': index === typedText.length && !isCompleted,
                    'hover:scale-105': index >= typedText.length
                  }"
                >{{ char === ' ' ? '·' : char }}</span>
              </div>

              <!-- Enhanced Input Field -->
              <div class="relative">
                <input
                  v-model="typedText"
                  @input="handleTyping"
                  @focus="inputFocused = true"
                  @blur="inputFocused = false"
                  class="w-full bg-transparent border-2 border-white/30 rounded-xl px-6 py-4 text-white placeholder-gray-400 focus:border-purple-400 focus:outline-none transition-all duration-300 font-mono text-lg backdrop-blur-sm"
                  :class="{
                    'border-purple-400 shadow-lg shadow-purple-500/25 scale-[1.02]': inputFocused,
                    'border-green-400 shadow-lg shadow-green-500/25': isCompleted
                  }"
                  placeholder="Start typing here to begin your journey..."
                  :maxlength="sampleText.length"
                  :disabled="isCompleted"
                />
                <div 
                  v-if="inputFocused" 
                  class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-blue-500/10 rounded-xl pointer-events-none animate-pulse"
                ></div>
              </div>

              <!-- Auto-Type Demo Button -->
              <div class="mt-6 flex justify-center">
                <button
                  @click="startAutoDemo"
                  :disabled="isAutoTyping"
                  class="px-6 py-3 bg-gradient-to-r from-purple-500 to-blue-500 text-white rounded-xl font-semibold transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-purple-500/25 disabled:opacity-50 disabled:cursor-not-allowed flex items-center space-x-2"
                >
                  <svg v-if="!isAutoTyping" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                  </svg>
                  <div v-else class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                  <span>{{ isAutoTyping ? 'Auto Typing...' : '🤖 Watch Auto Demo' }}</span>
                </button>
              </div>
            </div>

            <!-- Completion Animation -->
            <div 
              v-if="isCompleted"
              class="absolute inset-0 bg-gradient-to-r from-green-500/90 to-blue-500/90 backdrop-blur-xl rounded-3xl flex items-center justify-center animate-fade-in"
            >
            <div>
                <!-- Trigger Button -->
                <button 
                  @click="openModal"
                  class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl hover:from-blue-600 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                  <span class="flex items-center gap-2">
                    <SmileOutlined />
                    Open Notification Modal
                  </span>
                </button>

                <!-- Modern Modal Overlay -->
                <Teleport to="body">
                  <Transition
                    enter-active-class="transition-all duration-300 ease-out"
                    enter-from-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="transition-all duration-300 ease-in"
                    leave-from-class="opacity-100"
                    leave-to-class="opacity-0"
                  >
                    <div 
                      v-if="isModalOpen"
                      class="fixed inset-0 z-50 flex items-center justify-center p-4"
                      @click="closeModal"
                    >
                      <!-- Backdrop with blur effect -->
                      <div class="absolute inset-0 bg-black/50 backdrop-blur-md"></div>
                      
                      <!-- Modal Container -->
                      <Transition
                        enter-active-class="transition-all duration-500 ease-out"
                        enter-from-class="opacity-0 scale-75 translate-y-8"
                        enter-to-class="opacity-100 scale-100 translate-y-0"
                        leave-active-class="transition-all duration-300 ease-in"
                        leave-from-class="opacity-100 scale-100 translate-y-0"
                        leave-to-class="opacity-0 scale-75 translate-y-8"
                      >
                        <div 
                          v-if="isModalOpen"
                          class="relative bg-white dark:bg-gray-800 rounded-3xl shadow-2xl max-w-md w-full mx-4 overflow-hidden"
                          @click.stop
                        >
                          <!-- Gradient Border Effect -->
                          <div class="absolute inset-0 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 rounded-3xl p-[2px]">
                            <div class="bg-white dark:bg-gray-800 rounded-3xl h-full w-full"></div>
                          </div>
                          
                          <!-- Modal Content -->
                          <div class="relative z-10 p-8">
                            <!-- Header with Icon -->
                            <div class="flex items-center gap-4 mb-6">
                              <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <SmileOutlined class="text-white text-xl animate-bounce" />
                              </div>
                              <h3 class="text-2xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 dark:from-white dark:to-gray-300 bg-clip-text text-transparent">
                                Success Notification
                              </h3>
                            </div>

                            <!-- Description -->
                            <div class="mb-8">
                              <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed">
                                This is your modern notification modal with beautiful animations and glassmorphism effects. The content flows naturally with smooth transitions.
                              </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3 justify-end">
                              <button
                                @click="closeModal"
                                class="px-6 py-3 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all duration-200"
                              >
                                Dismiss
                              </button>
                              <button
                                @click="handleAction"
                                class="px-6 py-3 bg-gradient-to-r from-green-500 to-blue-500 text-white rounded-xl hover:from-green-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
                              >
                                Take Action
                              </button>
                            </div>
                          </div>

                          <!-- Completion Animation Overlay -->
                          <Transition
                            enter-active-class="transition-all duration-500 ease-out"
                            enter-from-class="opacity-0 scale-95"
                            enter-to-class="opacity-100 scale-100"
                            leave-active-class="transition-all duration-300 ease-in"
                            leave-from-class="opacity-100 scale-100"
                            leave-to-class="opacity-0 scale-95"
                          >
                            <div 
                              v-if="isCompleted"
                              class="absolute inset-0 bg-gradient-to-r from-green-500/95 to-blue-500/95 backdrop-blur-xl rounded-3xl flex items-center justify-center z-20"
                            >
                              <div class="text-center text-white">
                                <div class="w-16 h-16 mx-auto mb-4 bg-white/20 rounded-full flex items-center justify-center animate-pulse">
                                  <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                  </svg>
                                </div>
                                <h4 class="text-xl font-semibold mb-2">Action Completed!</h4>
                                <p class="text-white/80">Processing your request...</p>
                              </div>
                            </div>
                          </Transition>
                        </div>
                      </Transition>
                    </div>
                  </Transition>
                </Teleport>
              </div>
            </div>
          </div>
        </div>

        <!-- Enhanced CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16 transform animate-fade-in-up" style="animation-delay: 1s;">
          <Link 
            :href="route('register')"
            class="group relative px-8 py-4 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full text-white font-semibold text-lg shadow-2xl hover:shadow-purple-500/50 transition-all duration-500 transform hover:scale-110 hover:-translate-y-2 overflow-hidden"
          >
            <span class="relative z-10 flex items-center space-x-2">
              <span>Start Your Journey</span>
              <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
              </svg>
            </span>
            <div class="absolute inset-0 bg-gradient-to-r from-purple-700 to-blue-700 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 animate-pulse"></div>
            <div class="absolute inset-0 bg-white/20 rounded-full transform scale-0 group-hover:scale-100 transition-transform duration-500"></div>
          </Link>
          
          <button 
            @click="playDemo"
            class="group flex items-center space-x-3 px-8 py-4 border-2 border-white/30 rounded-full text-white font-semibold text-lg hover:bg-white/10 hover:border-white/50 transition-all duration-500 transform hover:scale-110 hover:-translate-y-2 backdrop-blur-sm"
          >
            <svg class="w-6 h-6 group-hover:animate-spin transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
            </svg>
            <span>Watch Demo</span>
          </button>
        </div>

        <!-- Enhanced Stats Section -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 max-w-4xl mx-auto">
          <div 
            v-for="(stat, index) in stats" 
            :key="index"
            class="text-center p-6 bg-white/5 backdrop-blur-sm rounded-2xl border border-white/10 hover:bg-white/10 hover:border-white/20 transition-all duration-500 transform hover:scale-110 hover:-translate-y-2 group cursor-pointer"
            :style="{ animationDelay: (index * 0.2) + 's' }"
          >
            <div class="text-4xl font-bold text-white mb-3 transform group-hover:scale-110 transition-transform duration-300">
              <span 
                class="bg-gradient-to-r from-purple-400 via-blue-400 to-pink-400 bg-clip-text text-transparent animate-gradient-x"
                :data-target="stat.value"
              >
                {{ animatedStats[index] }}{{ stat.suffix }}
              </span>
            </div>
            <div class="text-gray-400 text-sm group-hover:text-gray-300 transition-colors duration-300">{{ stat.label }}</div>
            <div class="w-full h-1 bg-white/10 rounded-full mt-3 overflow-hidden">
              <div class="h-full bg-gradient-to-r from-purple-400 to-blue-400 rounded-full transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Enhanced Floating Elements -->
      <div class="absolute top-20 left-10 hidden lg:block animate-float">
        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg rotate-12 animate-bounce hover:rotate-45 transition-transform duration-500" style="animation-delay: 0.5s;"></div>
      </div>
      <div class="absolute top-32 right-10 hidden lg:block animate-float">
        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full animate-bounce hover:scale-125 transition-transform duration-500" style="animation-delay: 1s;"></div>
      </div>
      <div class="absolute bottom-20 left-20 hidden lg:block animate-float">
        <div class="w-8 h-8 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-lg rotate-45 animate-pulse hover:rotate-90 transition-transform duration-500"></div>
      </div>
      <div class="absolute bottom-32 right-20 hidden lg:block animate-float">
        <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-teal-500 rounded-full animate-pulse hover:scale-125 transition-transform duration-500" style="animation-delay: 1.5s;"></div>
      </div>
    </div>

    <!-- Enhanced Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce hover:scale-125 transition-transform duration-300 cursor-pointer group">
      <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center group-hover:border-white/60 transition-colors duration-300">
        <div class="w-1 h-3 bg-gradient-to-b from-white to-transparent rounded-full mt-2 animate-pulse group-hover:h-4 transition-all duration-300"></div>
      </div>
    </div>
  </section>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref, onMounted, onUnmounted, computed , nextTick} from 'vue'
import { SmileOutlined } from '@ant-design/icons-vue';

const isModalOpen = ref(false);
const isCompleted = ref(false);

const openModal = () => {
  isModalOpen.value = true;
};

const closeModal = () => {
  if (isCompleted.value) {
    isCompleted.value = false;
    // Small delay to let completion animation fade out
    setTimeout(() => {
      isModalOpen.value = false;
    }, 300);
  } else {
    isModalOpen.value = false;
  }
};

const handleAction = async () => {
  isCompleted.value = true;
  
  // Auto close after showing completion
  setTimeout(() => {
    closeModal();
  }, 2500);
};
// Enhanced typing animation words
const words = ['Typing Speed', 'Accuracy', 'Productivity', 'Efficiency', 'Skills', 'Performance', 'Mastery']
const currentWord = ref('')
const wordIndex = ref(0)
const charIndex = ref(0)
const isDeleting = ref(false)
const showCursor = ref(true)
const isTyping = ref(false)

// Enhanced sample texts
const sampleTexts = [
  'The quick brown fox jumps over the lazy dog. This pangram contains every letter of the alphabet and is perfect for typing practice.',
  'Technology is advancing rapidly, and those who adapt quickly will thrive in the digital age.',
  'Success is not final, failure is not fatal: it is the courage to continue that counts.',
  'In the midst of difficulty lies opportunity. Every challenge is a chance to grow stronger.',
  'The only way to do great work is to love what you do and pursue excellence in everything.'
]

const currentTextIndex = ref(0)
const sampleText = computed(() => sampleTexts[currentTextIndex.value])

// Enhanced typing test state
const typedText = ref('')
const wpm = ref(0)
const accuracy = ref(100)
const startTime = ref(null)
const timeElapsed = ref(0)
// const isCompleted = ref(false)
const inputFocused = ref(false)
const isAutoTyping = ref(false)

// Progress calculation
const progressPercent = computed(() => {
  return Math.min((typedText.value.length / sampleText.value.length) * 100, 100)
})

// Enhanced stats with more metrics
const stats = [
  { value: 25000, suffix: '+', label: 'Active Users' },
  { value: 98, suffix: '%', label: 'Accuracy Rate' },
  { value: 150, suffix: '', label: 'Avg WPM' },
  { value: 75, suffix: '+', label: 'Languages' }
]
const animatedStats = ref([0, 0, 0, 0])

// Enhanced particles with more variety
const particles = ref([])

// Timer for elapsed time
let timeInterval = null

// Generate enhanced particles
const generateParticles = () => {
  const colors = [
    'bg-purple-400/30',
    'bg-blue-400/30', 
    'bg-pink-400/30',
    'bg-green-400/30',
    'bg-yellow-400/30',
    'bg-indigo-400/30'
  ]
  
  const sizes = ['w-1 h-1', 'w-2 h-2', 'w-3 h-3', 'w-4 h-4']
  const blurs = ['blur-none', 'blur-sm', 'blur-md']
  
  particles.value = Array.from({ length: 80 }, (_, i) => ({
    x: Math.random() * 100,
    y: Math.random() * 100,
    delay: Math.random() * 5,
    duration: 3 + Math.random() * 6,
    color: colors[Math.floor(Math.random() * colors.length)],
    size: sizes[Math.floor(Math.random() * sizes.length)],
    blur: blurs[Math.floor(Math.random() * blurs.length)],
    rotation: Math.random() * 360,
    scale: 0.5 + Math.random() * 1
  }))
}

// Enhanced typing animation
const typeText = () => {
  const current = words[wordIndex.value]
  isTyping.value = true
  
  if (isDeleting.value) {
    currentWord.value = current.substring(0, charIndex.value - 1)
    charIndex.value--
    
    if (charIndex.value === 0) {
      isDeleting.value = false
      wordIndex.value = (wordIndex.value + 1) % words.length
      isTyping.value = false
    }
  } else {
    currentWord.value = current.substring(0, charIndex.value + 1)
    charIndex.value++
    
    if (charIndex.value === current.length) {
      isTyping.value = false
      setTimeout(() => {
        isDeleting.value = true
      }, 2500)
    }
  }
}

// Enhanced cursor blinking
const blinkCursor = () => {
  showCursor.value = !showCursor.value
}

// Format time helper
const formatTime = (seconds) => {
  const mins = Math.floor(seconds / 60)
  const secs = seconds % 60
  return `${mins}:${secs.toString().padStart(2, '0')}`
}

// Enhanced typing handler
const handleTyping = () => {
  if (!startTime.value && typedText.value.length > 0) {
    startTime.value = Date.now()
    startTimer()
  }
  
  calculateStats()
  
  if (typedText.value.length === sampleText.value.length) {
    completeTest()
  }
}

// Start timer
const startTimer = () => {
  timeInterval = setInterval(() => {
    if (startTime.value) {
      timeElapsed.value = Math.floor((Date.now() - startTime.value) / 1000)
    }
  }, 1000)
}

// Enhanced stats calculation
const calculateStats = () => {
  if (!startTime.value) return
  
  // Calculate WPM (Words Per Minute)
  const timeInMinutes = timeElapsed.value / 60
  const wordsTyped = typedText.value.length / 5 // Standard: 5 characters = 1 word
  wpm.value = timeInMinutes > 0 ? Math.round(wordsTyped / timeInMinutes) : 0
  
  // Calculate Accuracy
  let correctChars = 0
  for (let i = 0; i < typedText.value.length; i++) {
    if (typedText.value[i] === sampleText.value[i]) {
      correctChars++
    }
  }
  accuracy.value = typedText.value.length > 0 ? Math.round((correctChars / typedText.value.length) * 100) : 100
}

// Complete test
const completeTest = () => {
  isCompleted.value = true
  if (timeInterval) {
    clearInterval(timeInterval)
  }
  
  // Create celebration effect
  setTimeout(() => {
    for (let i = 0; i < 20; i++) {
      createCelebrationParticle()
    }
  }, 500)
}

// Create celebration particles
const createCelebrationParticle = () => {
  // This would create floating celebration elements
  // Implementation depends on your specific animation needs
}

// Reset typing test
const resetTypingTest = () => {
  typedText.value = ''
  startTime.value = null
  timeElapsed.value = 0
  wpm.value = 0
  accuracy.value = 100
  isCompleted.value = false
  
  if (timeInterval) {
    clearInterval(timeInterval)
  }
  
  // Change to next text
  currentTextIndex.value = (currentTextIndex.value + 1) % sampleTexts.length
}

// Auto typing demo
const startAutoDemo = async () => {
  if (isAutoTyping.value) return
  
  resetTypingTest()
  isAutoTyping.value = true
  
  const demoText = sampleText.value
  let charIndex = 0
  
  const typeChar = () => {
    if (charIndex < demoText.length && isAutoTyping.value) {
      // Simulate natural typing with occasional mistakes
      if (Math.random() < 0.95) { // 95% accuracy
        typedText.value += demoText[charIndex]
        charIndex++
      } else {
        // Add wrong character, then correct it
        const wrongChar = String.fromCharCode(97 + Math.floor(Math.random() * 26))
        typedText.value += wrongChar
        
        setTimeout(() => {
          typedText.value = typedText.value.slice(0, -1)
          setTimeout(() => {
            if (isAutoTyping.value) {
              typedText.value += demoText[charIndex]
              charIndex++
            }
          }, 100)
        }, 300)
      }
      
      handleTyping()
      
      if (charIndex < demoText.length) {
        setTimeout(typeChar, 80 + Math.random() * 120) // Variable speed
      } else {
        isAutoTyping.value = false
      }
    }
  }
  
  setTimeout(typeChar, 500)
}

// Enhanced stats animation
const animateStats = () => {
  stats.forEach((stat, index) => {
    let current = 0
    const increment = stat.value / 60
    const timer = setInterval(() => {
      current += increment
      if (current >= stat.value) {
        animatedStats.value[index] = stat.value
        clearInterval(timer)
      } else {
        animatedStats.value[index] = Math.round(current)
      }
    }, 30)
  })
}

// Play demo
const playDemo = () => {
  // Implement demo functionality
  startAutoDemo()
}

let typeInterval, cursorInterval

onMounted(() => {
  generateParticles()
  
  // Start animations
  typeInterval = setInterval(typeText, 120)
  cursorInterval = setInterval(blinkCursor, 500)
  
  // Animate stats after delay
  setTimeout(animateStats, 1500)
  
  // Regenerate particles periodically
  setInterval(generateParticles, 15000)
})

onUnmounted(() => {
  if (typeInterval) clearInterval(typeInterval)
  if (cursorInterval) clearInterval(cursorInterval)
  if (timeInterval) clearInterval(timeInterval)
});
</script>

<style scoped>
 @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(168, 85, 247, 0.4); }
            50% { box-shadow: 0 0 40px rgba(168, 85, 247, 0.8); }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-2px); }
            75% { transform: translateX(2px); }
        }
        
        @keyframes bounce-in {
            0% { transform: scale(0) rotate(0deg); opacity: 0; }
            50% { transform: scale(1.2) rotate(180deg); opacity: 0.8; }
            100% { transform: scale(1) rotate(360deg); opacity: 1; }
        }
        
        @keyframes fade-in {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes particle-float {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) scale(1); opacity: 0; }
        }
        
        .float { animation: float 6s ease-in-out infinite; }
        .pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
        .shake { animation: shake 0.5s ease-in-out; }
        .bounce-in { animation: bounce-in 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55); }
        .fade-in { animation: fade-in 0.6s ease-out; }
        .particle { animation: particle-float linear infinite; }
        
        .gradient-text {
            background: linear-gradient(45deg, #a855f7, #3b82f6, #ec4899);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient-shift 3s ease infinite;
        }
        
        @keyframes gradient-shift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .typing-cursor {
            animation: blink 1s infinite;
        }
        
        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }
        /* Custom animations */
@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in {
  animation: fade-in 0.5s ease-out;
}

/* Glassmorphism effect enhancement */
.backdrop-blur-md {
  backdrop-filter: blur(12px);
}

.backdrop-blur-xl {
  backdrop-filter: blur(24px);
}
</style>