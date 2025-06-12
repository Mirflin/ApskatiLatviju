<template>
    <article class="main-panel">
        <div class="panel">
            <div class="panel-header">
                <p>/ news</p>
            </div>
            <div>
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="header-button-panels mb-4">
                        <div class="header-button-panels flex row justify-between header-align mb-4">
                            <h2
                                class="text-lg font-semibold text-gray-800"
                            >
                                Aktualitātes
                            </h2>
                            <button
                                @click="showModal = true"
                                class="px-4 py-2 bg-orange-500 text-white hover:bg-orange-600 rounded flex"
                            >
                                Jauna aktualitāte
                            </button>
                        </div>
                        <universalTable
                            :data="news2"
                            :columns="columns"
                            :perPage="10"
                            :searchableFields="[
                                'header',
                                'content',
                                'created_at',
                            ]"
                            @edit="handleEdit"
                            @delete="handleDelete"
                        >
                            <template #tool="{ row }">
                                <button @click="$emit('edit', row)">
                                    <i
                                        class="fa-solid fa-pen-to-square fa-xl"
                                    ></i>
                                </button>
                                <button @click="$emit('delete', row)">
                                    <i class="fa-solid fa-trash fa-xl"></i>
                                </button>
                            </template>
                        </universalTable>
                    </div>
                </div>

                <baseModal
                    v-model="showModal"
                    title="Add / Edit News"
                    @cancel="cancelModal"
                    @save="saveNews"
                >
                    <form @submit.prevent="saveNews" class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-1"
                                >Header</label
                            >
                            <input
                                v-model="form.header"
                                type="text"
                                maxlength="60"
                                required
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                placeholder="Enter news header"
                            />
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1"
                                >Content</label
                            >
                            <textarea
                                v-model="form.paragraph"
                                required
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                placeholder="Enter news paragraph"
                                rows="4"
                            ></textarea>
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1"
                                >Image URL</label
                            >
                            <input
                                v-model="form.image"
                                type="url"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                placeholder="Enter image URL"
                            />
                        </div>
                    </form>
                </baseModal>
            </div>
        </div>
    </article>
</template>

<script setup>
import { ref } from 'vue';
import baseModal from './baseModal.vue';

const showModal = ref(false);

const news = ref([
    {
        id: 1,
        header: 'Breaking News',
        paragraph: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
        image: 'https://via.placeholder.com/150x90',
    },
    {
        id: 2,
        header: 'Update on Event',
        paragraph:
            'Praesent commodo cursus magna, vel scelerisque nisl consectetur...',
        image: '',
    },
]);

const form = ref({
    id: null,
    header: '',
    paragraph: '',
    image: '',
});

const resetForm = () => {
    form.value = {
        id: null,
        header: '',
        paragraph: '',
        image: '',
    };
};

const cancelModal = () => {
    resetForm();
    showModal.value = false;
};

const saveNews = () => {
    if (form.value.id) {
        const index = news.value.findIndex((n) => n.id === form.value.id);
        if (index !== -1) {
            news.value[index] = { ...form.value };
        }
    } else {
        const newId = news.value.length
            ? Math.max(...news.value.map((n) => n.id)) + 1
            : 1;
        news.value.push({
            id: newId,
            header: form.value.header,
            paragraph: form.value.paragraph,
            image: form.value.image,
        });
    }
    resetForm();
    showModal.value = false;
};

const editNews = (newsItem) => {
    form.value = { ...newsItem };
    showModal.value = true;
};

const deleteNews = (id) => {
    news.value = news.value.filter((n) => n.id !== id);
};

import universalTable from './universalTable.vue';

const news2 = [
    {
        id: 1,
        header: 'Alice',
        content: 'alice@example.com',
        created_at: '2025',
    },
    { id: 2, header: 'Bob', content: 'bob@example.com', created_at: '2025' },
    {
        id: 3,
        header: 'Charlie',
        content: 'charlie@example.com',
        created_at: '2024',
    },
    {
        id: 4,
        header: 'David',
        content: 'david@example.com',
        created_at: '2025',
    },
    { id: 5, header: 'Fve', content: 'eve@example.com', created_at: '2025' },
    {
        id: 6,
        header: 'Frank',
        content: 'frank@example.com',
        created_at: '2025',
    },
    {
        id: 7,
        header: 'Charlie',
        content: 'charlie@example.com',
        created_at: '2024',
    },
    {
        id: 8,
        header: 'David',
        content: 'david@example.com',
        created_at: '2025',
    },
    { id: 9, header: 'Fve', content: 'eve@example.com', created_at: '2025' },
    {
        id: 10,
        header: 'Frank',
        content: 'frank@example.com',
        created_at: '2025',
    },
];

const columns = [
    { label: 'Id', key: 'id' },
    { label: 'Header', key: 'header' },
    { label: 'Content', key: 'content' },
    { label: 'Created at', key: 'created_at' },
];

function handleEdit(row) {
    alert(`Edit ${row}`);
}

function handleDelete(row) {
    alert(`Delete ${row}`);
}
</script>

<style>
.header-align{
    height: 100%;
    align-items: center;
}
</style>