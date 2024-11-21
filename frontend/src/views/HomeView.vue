<script setup>
</script>

<template>
  <main class="min-h-screen flex flex-col items-center justify-center">
    <section class="text-center">
      <h1 class="text-5xl font-bold text-blue-600 mb-6">Welcome to the Student Management System</h1>
      <p class="text-gray-700 text-lg max-w-2xl mx-auto">
        Manage your student data efficiently with our system. Track courses, emails, phone numbers, and much more—all in one place!
      </p>
    </section>

    <section class="mt-10">
      <h2 class="text-2xl text-center font-semibold text-gray-800 mb-4">Get Started</h2>
      <div class="flex justify-center gap-6">
        <RouterLink 
          to="/students" 
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded shadow-md transition duration-300"
        >
          View Students
        </RouterLink>
        <RouterLink 
          to="/students/create" 
          class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-6 rounded shadow-md transition duration-300"
        >
          Add New Student
        </RouterLink>
      </div>
    </section>

    <footer class="mt-20 text-center text-sm text-gray-500">
      &copy; 2024 Student Management System. All rights reserved.
    </footer>
  </main>
</template>
