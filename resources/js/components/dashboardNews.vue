<template>
    <article class="main-panel">
        <div class="panel">
            <div class="panel-header">
                <p>{{ breadcrumb }}</p>
            </div>
            <div>
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div
                        class="header-button-panels flex items-center justify-between mb-4"
                    >
                        <h2 class="text-lg font-semibold text-gray-800">
                            News
                        </h2>
                        <button
                            @click="showModal = true"
                            class="px-4 py-2 bg-orange-500 text-white hover:bg-orange-600 rounded"
                        >
                            Create new
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="custom-table w-full text-left">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Header</th>
                                    <th>Paragraph</th>
                                    <th>Image</th>
                                    <th class="text-center">Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="newsItem in news" :key="newsItem.id">
                                    <td>{{ newsItem.id }}</td>
                                    <td>{{ newsItem.header }}</td>
                                    <td
                                        class="max-w-xs truncate"
                                        :title="newsItem.paragraph"
                                    >
                                        {{ newsItem.paragraph }}
                                    </td>
                                    <td>
                                        <span
                                            v-if="newsItem.image"
                                            class="inline-block max-w-[10ch] truncate"
                                            >{{ newsItem.image }}</span
                                        >
                                        <span v-else class="text-gray-400"
                                            >No image</span
                                        >
                                    </td>
                                    <td class="text-center">
                                        <button
                                            @click="editNews(newsItem)"
                                            class="text-blue-500 hover:text-blue-700 mr-2"
                                            title="Edit"
                                        >
                                            <i
                                                class="fa-solid fa-pen-to-square"
                                            ></i>
                                        </button>
                                        <button
                                            @click="deleteNews(newsItem.id)"
                                            class="text-red-500 hover:text-red-700"
                                            title="Delete"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="news.length === 0">
                                    <td
                                        colspan="7"
                                        class="text-center text-gray-400 py-6"
                                    >
                                        No news found.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                        <label class="block text-gray-700 mb-1">Header</label>
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
                            >Paragraph</label
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
</script>
