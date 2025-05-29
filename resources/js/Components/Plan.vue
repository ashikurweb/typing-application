<template>
  <div :class="[
    'min-h-screen transition-all duration-700 relative overflow-hidden py-20',
    isDark ? 'bg-gray-900' : 'bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50'
  ]">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
      <div 
        v-for="(particle, index) in backgroundParticles" 
        :key="index"
        :class="[
          'absolute rounded-full opacity-10 animate-float',
          particle.size,
          particle.color
        ]"
        :style="{ 
          animationDelay: `${particle.delay}s`,
          left: particle.left,
          top: particle.top,
          animationDuration: `${particle.duration}s`
        }"
      />
    </div>

    <div class="container mx-auto px-6 relative z-10">
      <!-- Header Section -->
      <div class="text-center mb-16">
        <div class="inline-flex items-center justify-center p-3 bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl shadow-lg mb-6">
          <CrownIcon class="w-8 h-8 text-white" />
        </div>

        <h2 :class="[
          'text-5xl md:text-6xl font-bold mb-6',
          isDark ? 'text-white' : 'text-gray-800'
        ]">
          Choose Your
          <span class="bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent ml-4">
            Plan
          </span>
        </h2>

        <p :class="[
          'text-xl md:text-2xl max-w-3xl mx-auto leading-relaxed mb-8',
          isDark ? 'text-gray-300' : 'text-gray-600'
        ]">
          Unlock your typing potential with our flexible pricing plans designed for every skill level
        </p>

        <!-- Billing Toggle -->
        <div class="flex items-center justify-center gap-4 mb-12">
          <span :class="[
            'text-lg font-medium transition-colors duration-300',
            !isYearly ? (isDark ? 'text-white' : 'text-gray-800') : (isDark ? 'text-gray-400' : 'text-gray-500')
          ]">
            Monthly
          </span>
          
          <a-switch 
            v-model:checked="isYearly"
            size="large"
            :class="[
              'relative transition-all duration-300 transform hover:scale-110',
              isYearly ? 'shadow-lg shadow-purple-500/30' : ''
            ]"
          >
            <template #checkedChildren>
              <CalendarIcon class="w-4 h-4" />
            </template>
            <template #unCheckedChildren>
              <ClockIcon class="w-4 h-4" />
            </template>
          </a-switch>
          
          <span :class="[
            'text-lg font-medium transition-colors duration-300',
            isYearly ? (isDark ? 'text-white' : 'text-gray-800') : (isDark ? 'text-gray-400' : 'text-gray-500')
          ]">
            Yearly
          </span>
          
          <a-tag 
            v-show="isYearly" 
            color="success"
            class="ml-2 animate-pulse font-semibold"
          >
            Save 20%
          </a-tag>
        </div>
      </div>

      <!-- Pricing Cards -->
      <a-row :gutter="[32, 32]" justify="center" class="max-w-7xl mx-auto">
        <a-col 
          v-for="(plan, index) in pricingPlans" 
          :key="plan.id"
          :xs="24" 
          :md="8"
          :class="[
            'transform transition-all duration-700',
            visibleCards.includes(index) ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'
          ]"
          :style="{ transitionDelay: `${index * 200}ms` }"
        >
          <a-card
            :class="[
              'group relative backdrop-blur-sm border-2 transition-all duration-500 cursor-pointer h-full',
              'hover:scale-105 hover:-translate-y-4 shadow-xl hover:shadow-2xl',
              plan.popular 
                ? 'border-purple-500 bg-gradient-to-br from-purple-500/10 to-pink-500/10 transform scale-105' 
                : isDark 
                  ? 'bg-gray-800/50 border-gray-700 hover:bg-gray-800/70 hover:border-purple-500/50' 
                  : 'bg-white/80 border-gray-200 hover:bg-white/95 hover:border-purple-500/50',
              {
                'ring-4 ring-purple-500/20': hoveredPlan === plan.id,
                'animate-pulse-border': plan.popular
              }
            ]"
            :body-style="{ 
              padding: plan.popular ? '40px 32px' : '32px', 
              height: '100%', 
              display: 'flex', 
              flexDirection: 'column',
              position: 'relative'
            }"
            @mouseenter="hoveredPlan = plan.id"
            @mouseleave="hoveredPlan = null"
          >
            <!-- Popular Badge -->
            <div 
              v-if="plan.popular"
              class="absolute -top-4 left-1/2 transform -translate-x-1/2 z-10"
            >
              <a-tag 
                color="purple"
                class="px-6 py-2 rounded-full font-bold text-sm shadow-lg animate-bounce-slow"
              >
                <template #icon>
                  <StarIcon class="w-4 h-4" />
                </template>
                Most Popular
              </a-tag>
            </div>

            <!-- Gradient Border Effect -->
            <div 
              v-if="plan.popular || hoveredPlan === plan.id"
              :class="[
                'absolute inset-0 rounded-lg opacity-20 transition-opacity duration-500',
                plan.gradient
              ]" 
            />
            
            <!-- Plan Header -->
            <div class="relative z-10 text-center mb-8">
              <div :class="[
                'inline-flex items-center justify-center w-16 h-16 rounded-2xl mb-4 shadow-lg transition-all duration-500 group-hover:scale-110',
                plan.iconBg
              ]">
                <component :is="plan.icon" class="w-8 h-8 text-white" />
              </div>

              <h3 :class="[
                'text-2xl font-bold mb-2',
                isDark ? 'text-white' : 'text-gray-800'
              ]">
                {{ plan.name }}
              </h3>
              
              <p :class="[
                'text-sm',
                isDark ? 'text-gray-300' : 'text-gray-600'
              ]">
                {{ plan.description }}
              </p>
            </div>

            <!-- Pricing -->
            <div class="relative z-10 text-center mb-8">
              <div class="flex items-baseline justify-center mb-2">
                <span :class="[
                  'text-5xl font-bold',
                  plan.popular ? 'text-purple-600' : isDark ? 'text-white' : 'text-gray-800'
                ]">
                  ${{ isYearly ? plan.yearlyPrice : plan.monthlyPrice }}
                </span>
                <span :class="[
                  'text-lg ml-2',
                  isDark ? 'text-gray-400' : 'text-gray-500'
                ]">
                  /{{ isYearly ? 'year' : 'month' }}
                </span>
              </div>
              
              <div 
                v-if="isYearly && plan.yearlySavings"
                class="text-green-500 font-semibold text-sm animate-pulse"
              >
                Save ${{ plan.yearlySavings }} annually
              </div>
            </div>

            <!-- Features -->
            <div class="relative z-10 flex-1 mb-8">
              <ul class="space-y-4">
                <li 
                  v-for="(feature, fIndex) in plan.features" 
                  :key="`${plan.id}-feature-${fIndex}`"
                  class="flex items-start gap-3 group/feature"
                >
                  <div :class="[
                    'flex-shrink-0 w-5 h-5 rounded-full flex items-center justify-center mt-0.5 transition-all duration-300 group-hover/feature:scale-110',
                    feature.included 
                      ? 'bg-green-500 text-white' 
                      : 'bg-gray-300 text-gray-500'
                  ]">
                    <CheckIcon v-if="feature.included" class="w-3 h-3" />
                    <XIcon v-else class="w-3 h-3" />
                  </div>
                  <span :class="[
                    'text-sm leading-relaxed transition-colors duration-300',
                    feature.included 
                      ? isDark ? 'text-gray-200' : 'text-gray-700'
                      : isDark ? 'text-gray-500' : 'text-gray-400',
                    { 'line-through': !feature.included }
                  ]">
                    {{ feature.text }}
                  </span>
                </li>
              </ul>
            </div>

            <!-- CTA Button -->
            <div class="relative z-10">
              <a-button 
                :type="plan.popular ? 'primary' : 'default'"
                block
                size="large"
                :class="[
                  'h-12 font-semibold text-base rounded-xl transition-all duration-300 transform hover:scale-105',
                  plan.popular 
                    ? 'bg-gradient-to-r from-purple-600 to-pink-600 border-0 shadow-lg hover:shadow-xl' 
                    : isDark 
                      ? 'bg-gray-700 border-gray-600 text-white hover:bg-gray-600 hover:border-purple-500' 
                      : 'border-gray-300 hover:border-purple-500 hover:text-purple-600'
                ]"
                @click="selectPlan(plan)"
              >
                <template #icon>
                  <RocketIcon class="w-5 h-5" />
                </template>
                {{ plan.ctaText }}
              </a-button>

              <!-- Money Back Guarantee -->
              <div 
                v-if="plan.id !== 'basic'"
                class="text-center mt-3"
              >
                <a-typography-text 
                  type="secondary" 
                  class="text-xs flex items-center justify-center gap-1"
                >
                  <ShieldCheckIcon class="w-3 h-3" />
                  30-day money-back guarantee
                </a-typography-text>
              </div>
            </div>

            <!-- Hover Glow Effect -->
            <div 
              v-show="hoveredPlan === plan.id"
              :class="[
                'absolute inset-0 rounded-lg opacity-30 blur-xl transition-opacity duration-500',
                plan.gradient
              ]"
            />
          </a-card>
        </a-col>
      </a-row>

      <!-- Bottom Section -->
      <div class="text-center mt-16">
        <!-- FAQ Link -->
        <a-button 
          type="link" 
          size="large"
          :class="isDark ? 'text-gray-300 hover:text-white' : 'text-gray-600 hover:text-gray-800'"
        >
          <template #icon>
            <HelpCircleIcon class="w-5 h-5" />
          </template>
          Have questions? Check our FAQ
        </a-button>

        <!-- Trust Badges -->
        <div class="flex items-center justify-center gap-8 mt-8 opacity-60">
          <div class="flex items-center gap-2">
            <LockIcon class="w-5 h-5" />
            <span class="text-sm font-medium">Secure Payment</span>
          </div>
          <div class="flex items-center gap-2">
            <RefreshCwIcon class="w-5 h-5" />
            <span class="text-sm font-medium">Cancel Anytime</span>
          </div>
          <div class="flex items-center gap-2">
            <HeartIcon class="w-5 h-5" />
            <span class="text-sm font-medium">Loved by 25K+ Users</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Background Gradient Orbs -->
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse-slow" />
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse-slow" style="animation-delay: 2s" />
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-5 animate-pulse-slow" style="animation-delay: 4s" />
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, computed } from 'vue'
import { 
  Card as ACard,
  Button as AButton,
  Row as ARow,
  Col as ACol,
  Switch as ASwitch,
  Tag as ATag,
  Typography as ATypography
} from 'ant-design-vue'

// Icons
import {
  Crown as CrownIcon,
  Calendar as CalendarIcon,
  Clock as ClockIcon,
  Star as StarIcon,
  Zap as ZapIcon,
  Shield as ShieldIcon,
  Rocket as RocketIcon,
  Check as CheckIcon,
  X as XIcon,
  ShieldCheck as ShieldCheckIcon,
  HelpCircle as HelpCircleIcon,
  Lock as LockIcon,
  RefreshCw as RefreshCwIcon,
  Heart as HeartIcon
} from 'lucide-vue-next'

// Reactive data
const isDark = ref(false)
const isYearly = ref(false)
const hoveredPlan = ref(null)
const visibleCards = ref([])
const backgroundParticles = reactive([])

// Pricing plans data
const pricingPlans = reactive([
  {
    id: 'basic',
    name: 'Basic',
    description: 'Perfect for beginners',
    icon: ZapIcon,
    iconBg: 'bg-gradient-to-r from-green-500 to-emerald-600',
    gradient: 'bg-gradient-to-r from-green-500/20 to-emerald-500/20',
    monthlyPrice: 0,
    yearlyPrice: 0,
    yearlySavings: null,
    popular: false,
    ctaText: 'Start Free',
    features: [
      { text: 'Basic typing tests', included: true },
      { text: 'Speed tracking (WPM)', included: true },
      { text: '5 practice sessions/day', included: true },
      { text: 'Basic progress tracking', included: true },
      { text: 'Limited lessons', included: true },
      { text: 'Advanced analytics', included: false },
      { text: 'Custom keyboard layouts', included: false },
      { text: 'Typing games', included: false },
      { text: 'Priority support', included: false }
    ]
  },
  {
    id: 'pro',
    name: 'Pro',
    description: 'Most popular choice',
    icon: ShieldIcon,
    iconBg: 'bg-gradient-to-r from-purple-500 to-pink-600',
    gradient: 'bg-gradient-to-r from-purple-500/20 to-pink-500/20',
    monthlyPrice: 9.99,
    yearlyPrice: 95.90,
    yearlySavings: 24.00,
    popular: true,
    ctaText: 'Start Pro Trial',
    features: [
      { text: 'Everything in Basic', included: true },
      { text: 'Unlimited practice sessions', included: true },
      { text: 'Advanced analytics dashboard', included: true },
      { text: 'All typing games & challenges', included: true },
      { text: 'Custom keyboard layouts', included: true },
      { text: 'Progress export (PDF/Excel)', included: true },
      { text: 'Dark/Light theme', included: true },
      { text: 'Email support', included: true },
      { text: 'Priority support', included: false }
    ]
  },
  {
    id: 'advance',
    name: 'Advanced',
    description: 'For typing professionals',
    icon: CrownIcon,
    iconBg: 'bg-gradient-to-r from-orange-500 to-red-600',
    gradient: 'bg-gradient-to-r from-orange-500/20 to-red-500/20',
    monthlyPrice: 19.99,
    yearlyPrice: 191.90,
    yearlySavings: 48.00,
    popular: false,
    ctaText: 'Go Advanced',
    features: [
      { text: 'Everything in Pro', included: true },
      { text: 'AI-powered recommendations', included: true },
      { text: 'Custom training programs', included: true },
      { text: 'Team collaboration tools', included: true },
      { text: 'API access for integrations', included: true },
      { text: 'White-label customization', included: true },
      { text: 'Priority support (24/7)', included: true },
      { text: 'Personal typing coach', included: true },
      { text: 'Advanced reporting', included: true }
    ]
  }
])

// Methods
const selectPlan = (plan) => {
  console.log('Selected plan:', plan.name, isYearly.value ? 'yearly' : 'monthly')
  // Here you would integrate with your payment system
}

const generateBackgroundParticles = () => {
  const colors = ['bg-purple-400', 'bg-pink-400', 'bg-indigo-400', 'bg-blue-400', 'bg-cyan-400']
  const sizes = ['w-1 h-1', 'w-2 h-2', 'w-3 h-3', 'w-4 h-4']
  
  for (let i = 0; i < 20; i++) {
    backgroundParticles.push({
      delay: Math.random() * 10,
      duration: 8 + Math.random() * 4,
      size: sizes[Math.floor(Math.random() * sizes.length)],
      color: colors[Math.floor(Math.random() * colors.length)],
      left: `${Math.random() * 100}%`,
      top: `${Math.random() * 100}%`
    })
  }
}

// Lifecycle
onMounted(() => {
  generateBackgroundParticles()
  
  // Animate cards on mount
  setTimeout(() => {
    visibleCards.value = [0, 1, 2]
  }, 300)

  // Check for dark mode preference
  if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    isDark.value = true
  }
})
</script>

<style scoped>
/* Custom animations */
@keyframes float {
  0%, 100% { transform: translateY(0px) rotate(0deg); }
  50% { transform: translateY(-30px) rotate(180deg); }
}

@keyframes pulse-slow {
  0%, 100% { opacity: 0.1; }
  50% { opacity: 0.2; }
}

@keyframes bounce-slow {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

@keyframes pulse-border {
  0%, 100% { box-shadow: 0 0 0 0 rgba(139, 92, 246, 0.4); }
  50% { box-shadow: 0 0 0 10px rgba(139, 92, 246, 0); }
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

.animate-pulse-slow {
  animation: pulse-slow 4s ease-in-out infinite;
}

.animate-bounce-slow {
  animation: bounce-slow 2s ease-in-out infinite;
}

.animate-pulse-border {
  animation: pulse-border 2s ease-in-out infinite;
}

/* Tailwind 4 compatible utilities */
.bg-gradient-to-br {
  background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
}

.bg-gradient-to-r {
  background-image: linear-gradient(to right, var(--tw-gradient-stops));
}

.backdrop-blur-sm {
  backdrop-filter: blur(4px);
}

.mix-blend-multiply {
  mix-blend-mode: multiply;
}

.bg-clip-text {
  background-clip: text;
  -webkit-background-clip: text;
}

.text-transparent {
  color: transparent;
}

/* Custom hover effects */
.group:hover .group-hover\:scale-110 {
  transform: scale(1.1);
}

.group/feature:hover .group-hover/feature\:scale-110 {
  transform: scale(1.1);
}
</style>