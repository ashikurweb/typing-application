<template>
  <section class="relative min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
      <!-- Floating Particles -->
      <div 
        v-for="(particle, index) in particles" 
        :key="index"
        class="absolute w-2 h-2 bg-white/20 rounded-full animate-pulse"
        :style="{
          left: particle.x + '%',
          top: particle.y + '%',
          animationDelay: particle.delay + 's',
          animationDuration: particle.duration + 's'
        }"
      ></div>
      
      <!-- Gradient Orbs -->
      <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-500/30 rounded-full blur-3xl animate-pulse"></div>
      <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
      <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-indigo-500/20 rounded-full blur-2xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16">
      <div class="text-center">
        <!-- Main Heading with Typing Animation -->
        <div class="mb-8">
          <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white mb-4">
            <span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
              Master Your
            </span>
            <br />
            <span class="relative">
              <span class="bg-gradient-to-r from-yellow-400 to-orange-400 bg-clip-text text-transparent">
                {{ currentWord }}
              </span>
              <span 
                class="inline-block w-1 h-16 bg-gradient-to-b from-yellow-400 to-orange-400 ml-2 animate-pulse"
                :class="{ 'opacity-100': showCursor, 'opacity-0': !showCursor }"
              ></span>
            </span>
          </h1>
        </div>

        <!-- Subtitle -->
        <p class="text-xl sm:text-2xl text-gray-300 mb-12 max-w-4xl mx-auto leading-relaxed">
          Transform your typing skills with our advanced practice platform. 
          <span class="text-purple-400 font-semibold">Real-time feedback</span>, 
          <span class="text-blue-400 font-semibold">adaptive lessons</span>, and 
          <span class="text-pink-400 font-semibold">gamified learning</span> 
          await you.
        </p>

        <!-- Interactive Demo Typing Box -->
        <div class="mb-12 max-w-4xl mx-auto">
          <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 border border-white/20 shadow-2xl">
            <div class="text-left">
              <div class="text-gray-400 text-sm mb-2 flex items-center justify-between">
                <span>Try typing this sample text:</span>
                <div class="flex items-center space-x-4">
                  <span class="text-green-400">WPM: {{ wpm }}</span>
                  <span class="text-blue-400">Accuracy: {{ accuracy }}%</span>
                </div>
              </div>
              <div class="text-lg text-gray-300 mb-4 leading-relaxed" ref="textToType">
                <span 
                  v-for="(char, index) in sampleText" 
                  :key="index"
                  :class="{
                    'bg-green-500/30 text-green-300': index < typedText.length && typedText[index] === char,
                    'bg-red-500/30 text-red-300': index < typedText.length && typedText[index] !== char,
                    'bg-blue-500/30': index === typedText.length
                  }"
                >{{ char }}</span>
              </div>
              <input
                v-model="typedText"
                @input="handleTyping"
                class="w-full bg-transparent border-2 border-white/30 rounded-lg px-4 py-3 text-white placeholder-gray-400 focus:border-purple-400 focus:outline-none transition-all duration-300"
                placeholder="Start typing here..."
                :maxlength="sampleText.length"
              />
            </div>
          </div>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
          <Link 
            :href="route('register')"
            class="group relative px-8 py-4 bg-gradient-to-r from-purple-600 to-blue-600 rounded-full text-white font-semibold text-lg shadow-2xl hover:shadow-purple-500/25 transition-all duration-300 transform hover:scale-105"
          >
            <span class="relative z-10">Start Your Journey</span>
            <div class="absolute inset-0 bg-gradient-to-r from-purple-700 to-blue-700 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          </Link>
          
          <button 
            @click="playDemo"
            class="group flex items-center space-x-3 px-8 py-4 border-2 border-white/30 rounded-full text-white font-semibold text-lg hover:bg-white/10 transition-all duration-300 transform hover:scale-105"
          >
            <svg class="w-6 h-6 group-hover:animate-pulse" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
            </svg>
            <span>Watch Demo</span>
          </button>
        </div>

        <!-- Stats Section -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 max-w-4xl mx-auto">
          <div 
            v-for="(stat, index) in stats" 
            :key="index"
            class="text-center p-6 bg-white/5 backdrop-blur-sm rounded-xl border border-white/10 hover:bg-white/10 transition-all duration-300 transform hover:scale-105"
          >
            <div class="text-3xl font-bold text-white mb-2">
              <span 
                class="bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent"
                :data-target="stat.value"
              >
                {{ animatedStats[index] }}{{ stat.suffix }}
              </span>
            </div>
            <div class="text-gray-400 text-sm">{{ stat.label }}</div>
          </div>
        </div>
      </div>

      <!-- Floating Elements -->
      <div class="absolute top-20 left-10 hidden lg:block">
        <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg rotate-12 animate-bounce" style="animation-delay: 0.5s;"></div>
      </div>
      <div class="absolute top-32 right-10 hidden lg:block">
        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full animate-bounce" style="animation-delay: 1s;"></div>
      </div>
      <div class="absolute bottom-20 left-20 hidden lg:block">
        <div class="w-8 h-8 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-lg rotate-45 animate-pulse"></div>
      </div>
      <div class="absolute bottom-32 right-20 hidden lg:block">
        <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-teal-500 rounded-full animate-pulse" style="animation-delay: 1.5s;"></div>
      </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
      <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center">
        <div class="w-1 h-3 bg-white rounded-full mt-2 animate-pulse"></div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

// Typing animation words
const words = ['Typing Speed', 'Accuracy', 'Productivity', 'Efficiency', 'Skills']
const currentWord = ref('')
const wordIndex = ref(0)
const charIndex = ref(0)
const isDeleting = ref(false)
const showCursor = ref(true)

// Sample text for demo
const sampleText = ref('The quick brown fox jumps over the lazy dog. This pangram contains every letter of the alphabet.')
const typedText = ref('')
const wpm = ref(0)
const accuracy = ref(100)
const startTime = ref(null)

// Stats
const stats = [
  { value: 10000, suffix: '+', label: 'Active Users' },
  { value: 95, suffix: '%', label: 'Accuracy Rate' },
  { value: 120, suffix: '', label: 'Avg WPM' },
  { value: 50, suffix: '+', label: 'Languages' }
]
const animatedStats = ref([0, 0, 0, 0])

// Particles
const particles = ref([])

// Generate random particles
const generateParticles = () => {
  particles.value = Array.from({ length: 50 }, (_, i) => ({
    x: Math.random() * 100,
    y: Math.random() * 100,
    delay: Math.random() * 3,
    duration: 2 + Math.random() * 3
  }))
}

// Typing animation
const typeText = () => {
  const current = words[wordIndex.value]
  
  if (isDeleting.value) {
    currentWord.value = current.substring(0, charIndex.value - 1)
    charIndex.value--
    
    if (charIndex.value === 0) {
      isDeleting.value = false
      wordIndex.value = (wordIndex.value + 1) % words.length
    }
  } else {
    currentWord.value = current.substring(0, charIndex.value + 1)
    charIndex.value++
    
    if (charIndex.value === current.length) {
      setTimeout(() => {
        isDeleting.value = true
      }, 2000)
    }
  }
}

// Cursor blinking
const blinkCursor = () => {
  showCursor.value = !showCursor.value
}

// Handle typing demo
const handleTyping = () => {
  if (!startTime.value) {
    startTime.value = Date.now()
  }
  
  // Calculate WPM
  const timeElapsed = (Date.now() - startTime.value) / 1000 / 60 // minutes
  const wordsTyped = typedText.value.length / 5 // average word length
  wpm.value = Math.round(wordsTyped / timeElapsed) || 0
  
  // Calculate accuracy
  let correct = 0
  for (let i = 0; i < typedText.value.length; i++) {
    if (typedText.value[i] === sampleText.value[i]) {
      correct++
    }
  }
  accuracy.value = typedText.value.length > 0 ? Math.round((correct / typedText.value.length) * 100) : 100
}

// Animate stats
const animateStats = () => {
  stats.forEach((stat, index) => {
    let current = 0
    const increment = stat.value / 50
    const timer = setInterval(() => {
      current += increment
      if (current >= stat.value) {
        animatedStats.value[index] = stat.value
        clearInterval(timer)
      } else {
        animatedStats.value[index] = Math.round(current)
      }
    }, 50)
  })
}

// Play demo
const playDemo = () => {
  // Reset demo
  typedText.value = ''
  startTime.value = null
  wpm.value = 0
  accuracy.value = 100
  
  // Auto-type demo text
  let i = 0
  const demoText = 'Welcome to TypeMaster!'
  const autoType = setInterval(() => {
    if (i < demoText.length) {
      typedText.value += demoText[i]
      handleTyping()
      i++
    } else {
      clearInterval(autoType)
      setTimeout(() => {
        typedText.value = ''
        startTime.value = null
      }, 2000)
    }
  }, 100)
}

let typeInterval, cursorInterval

onMounted(() => {
  generateParticles()
  
  // Start typing animation
  typeInterval = setInterval(typeText, 150)
  cursorInterval = setInterval(blinkCursor, 530)
  
  // Animate stats after a delay
  setTimeout(animateStats, 1000)
})

onUnmounted(() => {
  if (typeInterval) clearInterval(typeInterval)
  if (cursorInterval) clearInterval(cursorInterval)
})
</script>

<style scoped>
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

/* Custom scrollbar for typing area */
input::-webkit-scrollbar {
  display: none;
}

input {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>