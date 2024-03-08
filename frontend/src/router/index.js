import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AddBook from '@/components/AddBook.vue'
import EditBook from '@/components/EditBook.vue'
import ViewBook from '@/components/ViewBook.vue'


const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/add',
    name: 'addBook',
    component: AddBook
  },
  {
    path: '/edit/:id',
    name: 'editBook',
    component: EditBook
  },
  {
    path: '/view/:id',
    name: 'viewBook',
    component: ViewBook
  }

]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
