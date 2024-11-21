<template>
    <div class="py-8">
      <div class="flex justify-between items-center py-4">
        <h1 class="text-4xl font-extrabold text-gray-800">Students</h1>
        <RouterLink
          to="/students/create"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow"
        >
          + Add Student
        </RouterLink>
      </div>
  
      <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="table-auto w-full border-collapse bg-white">
          <thead class="bg-gray-200 border border-gray-300">
            <tr>
              <th class="px-6 py-3 text-left font-medium text-gray-600">ID</th>
              <th class="px-6 py-3 text-left font-medium text-gray-600">Name</th>
              <th class="px-6 py-3 text-left font-medium text-gray-600">Course</th>
              <th class="px-6 py-3 text-left font-medium text-gray-600">Email</th>
              <th class="px-6 py-3 text-left font-medium text-gray-600">Phone</th>
              <th class="px-6 py-3 text-left font-medium text-gray-600">Created At</th>
              <th class="px-6 py-3 text-right font-medium text-gray-600">Actions</th>
            </tr>
          </thead>
          <tbody v-if="students.length">
            <tr
              v-for="student in students"
              :key="student.id"
              class="hover:bg-gray-100 border-t"
            >
              <td class="px-6 py-3">{{ student.id }}</td>
              <td class="px-6 py-3">{{ student.name }}</td>
              <td class="px-6 py-3">{{ student.course }}</td>
              <td class="px-6 py-3">{{ student.email }}</td>
              <td class="px-6 py-3">{{ student.phone }}</td>
              <td class="px-6 py-3">
                {{ new Date(student.created_at).toLocaleDateString() }}
              </td>
              <td class="px-6 py-3 flex justify-end gap-3">
                <RouterLink
                  :to="`/students/${student.id}/edit`"
                  class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded shadow"
                >
                  Edit
                </RouterLink>
                <button
                  @click="openConfirmationModal(student.id)"
                  class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded shadow"
                >
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                Loading students...
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  
      <div
        v-if="isModalOpen"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center"
      >
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm">
          <h3 class="text-lg font-bold text-gray-800 mb-4">
            Confirm Deletion
          </h3>
          <p class="text-gray-600">
            Are you sure you want to delete this student? This action cannot be
            undone.
          </p>
          <div class="mt-6 flex justify-end gap-3">
            <button
              @click="closeModal"
              class="py-2 px-4 bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold rounded"
            >
              Cancel
            </button>
            <button
              @click="deleteStudent(modalStudentId)"
              class="py-2 px-4 bg-red-500 hover:bg-red-600 text-white font-semibold rounded"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import axios from "axios";
  import { onMounted, ref } from "vue";
  
  const students = ref([]);
  const isModalOpen = ref(false);
  const modalStudentId = ref(null);
  
  onMounted(() => {
    getStudents();
  });
  
  function getStudents() {
    axios.get("https://backend.test/api/students").then((res) => {
      students.value = res.data.students;
    });
  }
  
  function openConfirmationModal(id) {
    modalStudentId.value = id;
    isModalOpen.value = true;
  }
  
  function closeModal() {
    isModalOpen.value = false;
    modalStudentId.value = null;
  }
  
  function deleteStudent(id) {
    axios
      .delete(`https://backend.test/api/students/${id}/delete`)
      .then(() => {
        students.value = students.value.filter((student) => student.id !== id);
        alert("Student successfully deleted!");
        closeModal();
      })
      .catch(() => {
        alert("An error occurred while trying to delete the student.");
      });
  }
  </script>
  
  <style scoped>
  tr:hover {
    transition: background-color 0.2s;
  }
  </style>
  