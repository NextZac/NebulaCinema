<template>
    <AdminLayout>
        <div class="form-container">
            <h2>Edit Post</h2>
            <form @submit.prevent="updatePost">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input
                        type="text"
                        v-model="form.title"
                        class="form-control"
                        id="title"
                        required
                    />
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref } from "vue";
import { usePage, Inertia } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

const { props } = usePage();
const form = ref({
    title: props.post.title,
});

const updatePost = () => {
    Inertia.put(`/admin/posts/${props.post.id}`, form.value);
};
</script>

<style>
.form-container {
    max-width: 600px;
    margin: 0 auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-container h2 {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
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
</style>
