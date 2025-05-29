<template>
  <div class="leaderboard-section min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 py-20 px-4">
    <div class="max-w-7xl mx-auto">
      
      <!-- Hero Section -->
      <div class="text-center mb-16 relative">
        <div class="absolute inset-0 flex items-center justify-center">
          <div class="w-96 h-96 bg-gradient-to-r from-purple-600/20 to-pink-600/20 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10">
          <h1 class="text-6xl md:text-7xl font-extrabold mb-6">
            <span class="bg-gradient-to-r from-white via-purple-200 to-pink-200 bg-clip-text text-transparent">
              Champions
            </span>
          </h1>
          <p class="text-xl text-slate-400 font-light max-w-2xl mx-auto leading-relaxed">
            Where legends are born and typing mastery is celebrated
          </p>
        </div>
      </div>

      <!-- Live Stats Bar -->
      <div class="mb-16">
        <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-8">
          <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div 
              v-for="(stat, index) in liveStats" 
              :key="stat.label"
              class="text-center group cursor-pointer"
              @mouseenter="animateStat(index)"
            >
              <div class="relative mb-4">
                <div class="text-4xl font-black text-white transition-all duration-500 group-hover:scale-110" 
                     :class="stat.color">
                  {{ stat.animated }}{{ stat.suffix }}
                </div>
                <div class="absolute -inset-2 bg-gradient-to-r opacity-0 group-hover:opacity-20 transition-opacity duration-300 rounded-lg blur"
                     :class="stat.gradient"></div>
              </div>
              <div class="text-slate-400 font-medium tracking-wide">{{ stat.label }}</div>
            </div>
          </div>
        </div>
      </div>

      <div class="grid lg:grid-cols-12 gap-8">
        
        <!-- Main Leaderboard -->
        <div class="lg:col-span-8">
          <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl overflow-hidden">
            
            <!-- Header -->
            <div class="p-8 border-b border-white/10">
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                  <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center">
                    <span class="text-white text-xl">👑</span>
                  </div>
                  <div>
                    <h2 class="text-2xl font-bold text-white">Global Elite</h2>
                    <p class="text-slate-400">Top performers worldwide</p>
                  </div>
                </div>
                
                <div class="flex space-x-2">
                  <button 
                    v-for="period in periods" 
                    :key="period.value"
                    @click="selectedPeriod = period.value"
                    class="px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300"
                    :class="selectedPeriod === period.value 
                      ? 'bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-lg' 
                      : 'text-slate-400 hover:text-white hover:bg-white/10'"
                  >
                    {{ period.label }}
                  </button>
                </div>
              </div>
            </div>

            <!-- Podium Top 3 -->
            <div class="p-8 bg-gradient-to-b from-white/5 to-transparent">
              <div class="flex items-end justify-center space-x-8 mb-8">
                
                <!-- 2nd Place -->
                <div class="text-center transform hover:scale-105 transition-all duration-300">
                  <div class="relative mb-4">
                    <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-slate-400 mx-auto">
                      <img :src="champions[1].avatar" :alt="champions[1].name" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-slate-400 rounded-full flex items-center justify-center text-white font-bold text-sm">
                      2
                    </div>
                  </div>
                  <h3 class="font-bold text-white text-lg mb-1">{{ champions[1].name }}</h3>
                  <div class="text-slate-400 text-sm mb-2">{{ champions[1].country }}</div>
                  <div class="bg-slate-400/20 rounded-lg p-3">
                    <div class="text-2xl font-bold text-slate-300">{{ champions[1].wpm }}</div>
                    <div class="text-xs text-slate-400">WPM</div>
                  </div>
                </div>

                <!-- 1st Place -->
                <div class="text-center transform hover:scale-105 transition-all duration-300 -mt-4">
                  <div class="relative mb-4">
                    <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-yellow-400 mx-auto shadow-xl">
                      <img :src="champions[0].avatar" :alt="champions[0].name" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                      <div class="text-3xl animate-bounce">👑</div>
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full flex items-center justify-center text-white font-bold">
                      1
                    </div>
                  </div>
                  <h3 class="font-bold text-white text-xl mb-1">{{ champions[0].name }}</h3>
                  <div class="text-slate-400 text-sm mb-2">{{ champions[0].country }}</div>
                  <div class="bg-gradient-to-r from-yellow-400/20 to-orange-400/20 rounded-lg p-4 border border-yellow-400/30">
                    <div class="text-3xl font-bold text-yellow-400">{{ champions[0].wpm }}</div>
                    <div class="text-xs text-yellow-400/70">WPM</div>
                  </div>
                </div>

                <!-- 3rd Place -->
                <div class="text-center transform hover:scale-105 transition-all duration-300">
                  <div class="relative mb-4">
                    <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-orange-400 mx-auto">
                      <img :src="champions[2].avatar" :alt="champions[2].name" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center text-white font-bold text-sm">
                      3
                    </div>
                  </div>
                  <h3 class="font-bold text-white text-lg mb-1">{{ champions[2].name }}</h3>
                  <div class="text-slate-400 text-sm mb-2">{{ champions[2].country }}</div>
                  <div class="bg-orange-400/20 rounded-lg p-3">
                    <div class="text-2xl font-bold text-orange-300">{{ champions[2].wpm }}</div>
                    <div class="text-xs text-orange-400/70">WPM</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Rest of Leaderboard -->
            <div class="p-8">
              <div class="space-y-3">
                <div 
                  v-for="(player, index) in restOfPlayers" 
                  :key="player.id"
                  class="flex items-center p-4 rounded-2xl bg-white/5 hover:bg-white/10 transition-all duration-300 group cursor-pointer border border-transparent hover:border-white/20"
                >
                  <!-- Rank -->
                  <div class="w-12 h-12 rounded-xl bg-slate-700 flex items-center justify-center mr-4 group-hover:bg-slate-600 transition-colors">
                    <span class="text-slate-300 font-bold">#{{ index + 4 }}</span>
                  </div>

                  <!-- Avatar & Info -->
                  <div class="flex items-center flex-grow">
                    <div class="w-12 h-12 rounded-xl overflow-hidden mr-4">
                      <img :src="player.avatar" :alt="player.name" class="w-full h-full object-cover">
                    </div>
                    <div>
                      <div class="flex items-center space-x-2">
                        <h4 class="font-semibold text-white">{{ player.name }}</h4>
                        <span v-if="player.isPro" class="px-2 py-1 bg-gradient-to-r from-purple-500 to-pink-500 text-xs rounded-full text-white font-bold">
                          PRO
                        </span>
                      </div>
                      <div class="text-slate-400 text-sm">{{ player.country }} • Level {{ player.level }}</div>
                    </div>
                  </div>

                  <!-- Stats -->
                  <div class="text-right">
                    <div class="text-xl font-bold text-white">{{ player.wpm }} <span class="text-sm text-slate-400">WPM</span></div>
                    <div class="text-sm text-green-400">{{ player.accuracy }}% accuracy</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-4 space-y-8">
          
          <!-- Your Rank -->
          <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8">
            <div class="text-center">
              <div class="w-20 h-20 rounded-full overflow-hidden border-4 border-purple-400 mx-auto mb-4">
                <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150" alt="You" class="w-full h-full object-cover">
              </div>
              <h3 class="text-xl font-bold text-white mb-2">Your Rank</h3>
              <div class="text-5xl font-black text-purple-400 mb-2">#{{ userStats.rank }}</div>
              <div class="text-slate-400 mb-6">of {{ userStats.total.toLocaleString() }} players</div>
              
              <div class="grid grid-cols-2 gap-4">
                <div class="bg-white/5 rounded-xl p-4">
                  <div class="text-2xl font-bold text-white">{{ userStats.wpm }}</div>
                  <div class="text-xs text-slate-400">WPM</div>
                </div>
                <div class="bg-white/5 rounded-xl p-4">
                  <div class="text-2xl font-bold text-green-400">{{ userStats.accuracy }}%</div>
                  <div class="text-xs text-slate-400">Accuracy</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Achievements -->
          <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center">
              <span class="mr-3">🏆</span>
              Achievements
            </h3>
            <div class="grid grid-cols-3 gap-4">
              <div 
                v-for="achievement in achievements" 
                :key="achievement.id"
                class="text-center p-4 rounded-xl bg-white/5 hover:bg-white/10 transition-all cursor-pointer group"
                @click="showAchievement(achievement)"
              >
                <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">{{ achievement.icon }}</div>
                <div class="text-xs text-slate-400">{{ achievement.name }}</div>
              </div>
            </div>
          </div>

          <!-- Live Challenges -->
          <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-8">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center">
              <span class="mr-3">⚡</span>
              Live Challenges
            </h3>
            <div class="space-y-4">
              <div 
                v-for="challenge in challenges" 
                :key="challenge.id"
                class="p-4 rounded-xl bg-gradient-to-r from-purple-500/10 to-pink-500/10 border border-purple-500/20 hover:border-purple-400/40 transition-all cursor-pointer group"
              >
                <div class="flex items-start justify-between mb-3">
                  <div>
                    <h4 class="font-semibold text-white text-sm">{{ challenge.title }}</h4>
                    <p class="text-xs text-slate-400">{{ challenge.participants }} joined</p>
                  </div>
                  <div class="text-xl">{{ challenge.icon }}</div>
                </div>
                <div class="flex justify-between items-center text-xs">
                  <span class="text-purple-400">{{ challenge.timeLeft }}</span>
                  <span class="text-green-400">+{{ challenge.reward }} XP</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'

const selectedPeriod = ref('weekly')

const periods = [
  { value: 'daily', label: 'Daily' },
  { value: 'weekly', label: 'Weekly' },
  { value: 'monthly', label: 'Monthly' },
  { value: 'allTime', label: 'All Time' }
]

const liveStats = reactive([
  { 
    label: 'Online Now', 
    value: 2847, 
    animated: 0, 
    suffix: '', 
    color: 'text-green-400',
    gradient: 'from-green-400 to-emerald-400'
  },
  { 
    label: 'Tests Today', 
    value: 15420, 
    animated: 0, 
    suffix: '', 
    color: 'text-blue-400',
    gradient: 'from-blue-400 to-cyan-400'
  },
  { 
    label: 'Avg Speed', 
    value: 72, 
    animated: 0, 
    suffix: ' WPM', 
    color: 'text-purple-400',
    gradient: 'from-purple-400 to-pink-400'
  },
  { 
    label: 'Accuracy', 
    value: 94, 
    animated: 0, 
    suffix: '%', 
    color: 'text-yellow-400',
    gradient: 'from-yellow-400 to-orange-400'
  }
])

const champions = [
  {
    name: 'Sarah Kim',
    avatar: 'https://images.unsplash.com/photo-1494790108755-2616b332e234?w=150',
    country: '🇰🇷 South Korea',
    wpm: 156,
    accuracy: 99.2
  },
  {
    name: 'Alex Chen',
    avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150',
    country: '🇨🇦 Canada',
    wpm: 143,
    accuracy: 97.8
  },
  {
    name: 'Maria Silva',
    avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150',
    country: '🇧🇷 Brazil',
    wpm: 138,
    accuracy: 96.5
  }
]

const restOfPlayers = [
  {
    id: 4,
    name: 'James Wilson',
    avatar: 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150',
    country: '🇺🇸 United States',
    wpm: 135,
    accuracy: 95.8,
    level: 67,
    isPro: true
  },
  {
    id: 5,
    name: 'Yuki Tanaka',
    avatar: 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150',
    country: '🇯🇵 Japan',
    wpm: 132,
    accuracy: 98.1,
    level: 59,
    isPro: false
  },
  {
    id: 6,
    name: 'Emma Johnson',
    avatar: 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150',
    country: '🇬🇧 United Kingdom',
    wpm: 128,
    accuracy: 94.7,
    level: 52,
    isPro: true
  }
]

const userStats = {
  rank: 1247,
  total: 25847,
  wpm: 85,
  accuracy: 94.2
}

const achievements = [
  { id: 1, name: 'Speed King', icon: '👑' },
  { id: 2, name: 'Perfect', icon: '💎' },
  { id: 3, name: 'Streak', icon: '🔥' },
  { id: 4, name: 'Marathon', icon: '🏃' },
  { id: 5, name: 'Night Owl', icon: '🦉' },
  { id: 6, name: 'Elite', icon: '⭐' }
]

const challenges = [
  {
    id: 1,
    title: 'Speed Demon Challenge',
    participants: 1247,
    timeLeft: '2h 15m',
    reward: 500,
    icon: '🚀'
  },
  {
    id: 2,
    title: 'Accuracy Master',
    participants: 892,
    timeLeft: '5h 42m',
    reward: 300,
    icon: '🎯'
  },
  {
    id: 3,
    title: 'Weekend Warrior',
    participants: 2156,
    timeLeft: '1d 8h',
    reward: 750,
    icon: '⚔️'
  }
]

const animateStat = (index) => {
  // Animate individual stat on hover
}

const showAchievement = (achievement) => {
  console.log('Show achievement:', achievement)
}

onMounted(() => {
  // Animate stats on load
  liveStats.forEach((stat, index) => {
    let current = 0
    const increment = stat.value / 50
    const timer = setInterval(() => {
      current += increment
      if (current >= stat.value) {
        current = stat.value
        clearInterval(timer)
      }
      stat.animated = Math.floor(current)
    }, 30)
  })
})
</script>

<style scoped>
.leaderboard-section {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 4px;
}

::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);
}

::-webkit-scrollbar-thumb {
  background: rgba(139, 92, 246, 0.5);
  border-radius: 2px;
}

/* Smooth transitions */
* {
  transition-property: all;
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
</style>