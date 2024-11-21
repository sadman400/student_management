<script setup>
import { RouterLink, RouterView } from 'vue-router';
import { ref } from 'vue';

const isMenuOpen = ref(false);

function toggleMenu() {
  isMenuOpen.value = !isMenuOpen.value;
}
</script>

<template>
  <header class="bg-slate-950 shadow sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <RouterLink to="/" class="text-2xl font-bold text-yellow-300 hover:text-yellow-400">
        Logo
      </RouterLink>

      <nav class="hidden md:flex space-x-6">
        <RouterLink
          to="/"
          class="text-lg text-white hover:text-yellow-300 transition-colors duration-300"
        >
          Home
        </RouterLink>
        <RouterLink
          to="/students"
          class="text-lg text-white hover:text-yellow-300 transition-colors duration-300"
        >
          Students
        </RouterLink>
      </nav>

      <button
        @click="toggleMenu"
        class="md:hidden text-yellow-300 focus:outline-none"
        aria-label="Toggle Menu"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="2"
          stroke="currentColor"
          class="w-6 h-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3 5h18M3 12h18m-9 7h9"
          />
        </svg>
      </button>
    </div>

    <div
      v-if="isMenuOpen"
      class="bg-slate-900 md:hidden py-4 space-y-2 text-center border-t border-gray-700"
    >
      <RouterLink
        to="/"
        @click="toggleMenu"
        class="block text-lg text-white hover:text-yellow-300 transition-colors duration-300"
      >
        Home
      </RouterLink>
      <RouterLink
        to="/students"
        @click="toggleMenu"
        class="block text-lg text-white hover:text-yellow-300 transition-colors duration-300"
      >
        Students
      </RouterLink>
    </div>
  </header>

  <main class="container mx-auto px-6 py-6 min-h-screen">
    <RouterView />
  </main>

  <footer class="bg-slate-950 py-6 text-center text-white text-sm">
    <p>&copy; 2024. All rights reserved by Sadman</p>
  </footer>
</template>

<style scoped>
header {
  background: linear-gradient(to right, #1e293b, #0f172a);
}

button:hover {
  transform: scale(1.1);
  transition: transform 0.2s ease-in-out;
}
</style>
