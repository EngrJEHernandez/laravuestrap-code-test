<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Users POST
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100">

                        <!-- Search Bar -->
                        <div class="mb-4">
                            <input
                                type="text"
                                v-model="searchTerm"
                                placeholder="Search by title..."
                                class="form-control"
                            />
                        </div>

                        <!-- Dynamic Table -->
                        <table class="table table-striped table-hover">
                            <thead class="table-dark dark:bg-gray-700 text-dark dark:text-white">
                                <tr>
                                    <th v-for="column in columns" :key="column">{{ column }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 text-dark dark:text-white">
                                <tr v-for="post in props.posts.data" :key="post.id">
                                    <td v-for="column in columns" :key="column">{{ post[column] }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <!-- Pagination Controls -->
                        <nav aria-label="Page navigation" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item" :class="{ disabled: props.posts.current_page === 1 }">
                                    <a class="page-link" @click.prevent="getPosts(props.posts.current_page - 1)" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li v-for="page in props.posts.last_page" :key="page" class="page-item" :class="{ active: page === props.posts.current_page }">
                                    <a class="page-link" @click.prevent="getPosts(page)" href="#">{{ page }}</a>
                                </li>
                                <li class="page-item" :class="{ disabled: props.posts.current_page === props.posts.last_page }">
                                    <a class="page-link" @click.prevent="getPosts(props.posts.current_page + 1)" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref, watch } from 'vue';
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    posts: Object, // Accept posts as a prop
    search: String, // Accept the search term as a prop
});

// Setup state
const searchTerm = ref(props.search || ''); // Initialize search term
const columns = ['id', 'title', 'body', 'user_id']; // Define table columns
const currentPage = ref(props.posts.current_page); // Initialize current page from props

// Function to fetch posts based on the search term and page
function getPosts(page) {
    Inertia.get(`/dashboard`, { 
        page: page, 
        search: searchTerm.value, 
        preserveState: true // Preserves the current state of the page
    });
    currentPage.value = page; // Update current page
}

// Watch for changes in the search term
watch(searchTerm, (newValue) => {
    getPosts(1); // Fetch posts whenever the search term changes, resetting to page 1
});
</script>

<style scoped>
/* Custom Pagination Styles */

/* Active page styles */
.pagination .page-item.active .page-link {
    background-color: #6c757d; /* Grey background for active page */
    color: #fff; /* White text for active page */
}

/* Default page link styles */
.pagination .page-link {
    color: #6c757d; /* Grey text for pagination links */
    border-color: #6c757d; /* Grey border for pagination links */
}

/* Hover styles for page links */
.pagination .page-link:hover {
    background-color: #5a6268; /* Darker grey on hover */
    color: #fff; /* White text on hover */
}

/* Disabled page link styles */
.pagination .page-item.disabled .page-link {
    color: #6c757d; /* Grey color for disabled links */
    background-color: transparent; /* No background for disabled links */
    border-color: #6c757d; /* Grey border for disabled links */
}
</style>
