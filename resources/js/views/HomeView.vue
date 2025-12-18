<template>
  <v-container class="py-12">
    <v-row>
      <!-- Hero with Typing Animation -->
      <v-col cols="12">
        <v-sheet class="pa-12 text-center hero-gradient glass" elevation="6" rounded>
          <h1 class="text-h2 font-weight-black mb-4 text-white hero-title">
            Bring Your Ideas to Life
          </h1>
          <p class="text-h5 mb-8 text-white hero-subtitle">
            <span ref="typed"></span>
          </p>
          <v-btn color="white" class="ma-2 hero-btn" to="/signup" large>
            <span class="gradient-text">Get Started</span>
          </v-btn>
          <v-btn color="secondary" class="ma-2 hero-btn" to="/projects" large>
            View Projects
          </v-btn>
        </v-sheet>
      </v-col>
    </v-row>

    <!-- Features -->
    <v-container class="mt-12">
      <v-row>
        <v-col cols="12" md="4" v-for="feature in features" :key="feature.title">
          <v-hover v-slot="{ isHovering, props }">
            <v-card v-bind="props" class="feature-card pa-6 text-center glass" :elevation="isHovering ? 12 : 6"
              :style="{ transform: isHovering ? 'translateY(-6px) scale(1.02)' : '' }">
              <div class="feature-icon mb-3">
                <v-icon size="48" color="white">{{ feature.icon }}</v-icon>
              </div>
              <h2 class="text-h5 font-weight-bold mt-2 mb-2 gradient-text">
                {{ feature.title }}
              </h2>
              <p class="text-body-2 mb-4">{{ feature.desc }}</p>
              <v-btn text color="primary" class="mt-2" :to="feature.link">
                {{ feature.btn }}
              </v-btn>
            </v-card>
          </v-hover>
        </v-col>
      </v-row>
    </v-container>

    <!-- CTA -->
    <v-container class="text-center my-12">
      <h2 class="text-h4 font-weight-bold mb-2">Ready to bring your idea to life?</h2>
      <p class="text-body-1 mb-4">Start your journey today with Hobby Devs</p>
      <v-btn color="primary" large to="/signup">Get Started</v-btn>
    </v-container>

    <!-- Floating Action Button -->
    <v-btn fab icon color="primary" class="fab-cta" to="/projects">
      <v-icon>mdi-rocket-launch</v-icon>
    </v-btn>
  </v-container>
</template>


<script setup>
import { onMounted, ref } from 'vue'
import Typed from 'typed.js'

const typed = ref(null)

const features = [
  {
    title: 'Explore Projects',
    desc: 'Browse innovative ideas and apply based on your skills and availability.',
    icon: 'mdi-lightbulb-on-outline',
    btn: 'View Projects',
    link: '/projects',
  },
  {
    title: 'Sign Up',
    desc: 'Create your profile and showcase your skills or post your project idea.',
    icon: 'mdi-account-plus-outline',
    btn: 'Get Started',
    link: '/signup',
  },
  {
    title: 'About Us',
    desc: 'Learn how Hobby Devs bridges the gap between visionaries and developers.',
    icon: 'mdi-information-outline',
    btn: 'Read More',
    link: '/about',
  },
]

onMounted(() => {
  new Typed(typed.value, {
    strings: [
      'Connect with hobby developers.',
      'Turn your vision into reality.',
      'Build together. Grow together.',
    ],
    typeSpeed: 50,
    backSpeed: 30,
    loop: true,
    smartBackspace: true,
  })
})
</script>