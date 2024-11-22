<template>
    <AdminLayout>
        <div class="posts">
            <h2>Movies</h2>
            <inertia-link href="/admin/movies/create" class="btn btn-primary"
                >Create Movie</inertia-link
            >
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="post in posts" :key="post.id">
                        <td>{{ post.id }}</td>
                        <td>{{ post.title }}</td>
                        <td>
                            <inertia-link
                                :href="`/admin/movies/${post.id}/edit`"
                                class="btn btn-warning mx-4"
                                >Edit</inertia-link
                            >
                            <button
                                @click="deletePost(post.id)"
                                class="btn btn-danger mx-4"
                            >
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { usePage, router } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const { props } = usePage();
const posts = ref(props.movies);

const deletePost = (id) => {
    if (confirm("Are you sure you want to delete this post?")) {
        router.delete(`/admin/posts/${id}`);
    }
};
</script>

<style>
.posts {
    text-align: center;
}

.posts h2 {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    transition: background 0.3s;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.btn-warning {
    background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
}

.btn-danger {
    background: linear-gradient(135deg, #ff758c 0%, #ff7eb3 100%);
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th,
.table td {
    padding: 10px;
    border: 1px solid #ddd;
}

.table th {
    background: #f5f7fa;
}

.table tbody tr:nth-child(odd) {
    background: #f9f9f9;
}
</style>
