<template>

    <h1 class="text-3xl font-bold mx-auto text-center pt-5">Edit students</h1>

    <div class="max-w-md mx-auto mt-10">
        <form action="" method="post" @submit.prevent="updateStudent"  class="bg-white p-8 rounded-lg shadow-lg">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" v-model="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p v-if="errors.name" class="text-red-500 text-sm">{{ errors.name[0] }}</p>
            </div>
            <div class="mb-4">
                <label for="course" class="block text-gray-700 text-sm font-bold mb-2">Course</label>
                <input type="text" name="course" id="course" v-model="course" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p v-if="errors.course" class="text-red-500 text-sm">{{ errors.course[0] }}</p>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="text" name="email" id="email" v-model="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p v-if="errors.email" class="text-red-500 text-sm">{{ errors.email[0] }}</p>
            </div>
            <div class="mb-6">
                <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                <input type="text" name="phone" id="phone" v-model="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p v-if="errors.phone" class="text-red-500 text-sm">{{ errors.phone[0] }}</p>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
        </form>
    </div>

</template>

<script setup>

import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute, useRouter } from "vue-router";

const name = ref('');
const course = ref('');
const email = ref('');
const phone = ref('');
const errors = ref({});

const $route = useRoute();
const $router = useRouter();

onMounted(() => {
    axios
    .get(`https://backend.test/api/students/${$route.params.id}/edit`)
    .then((res) => {
        const { name: studentName, course: studentCourse, email: studentEmail, phone: studentPhone } = res.data.student;
        name.value = studentName;
        course.value = studentCourse;
        email.value = studentEmail;
        phone.value = studentPhone;
    })
})

function updateStudent() {
    errors.value = {};
    axios
    .put(`https://backend.test/api/students/${$route.params.id}`, {
        name: name.value,
        course: course.value,
        email: email.value,
        phone: phone.value
    })
    .then((res) => {
        alert(res.data.message);
        $router.push({ name: 'students' });
    }).catch((error) => {
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors;
        } else {
            alert("An error occurred, please try again.");
        }
    })
}

</script>

