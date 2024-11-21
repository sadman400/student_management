import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import StudentView from '@/views/Students/StudentView.vue'
import CreateView from '@/views/Students/CreateView.vue'
import EditView from '@/views/Students/EditView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/students',
      name: 'students',
      component: StudentView,
    },
    {
      path: '/students/create',
      name: 'students-create',
      component: CreateView,
    },
    {
      path: '/students/:id/edit',
      name: 'students-edit',
      component: EditView,
    }
   
  ],
})

export default router
