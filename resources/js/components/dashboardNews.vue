<template>
    <article class="main-panel" v-if="loaded">
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
                            :data="data"
                            :columns="columns"
                            :perPage="10"
                            :searchableFields="[
                                'header',
                                'content',
                                'created_at',
                            ]"
                            @edit="editNews"
                            @delete="deleteNews"
                            @view="viewNews"
                        >
                            <template #tool="{ row }">
                                <button @click="editNews(row)">
                                    <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                </button>
                                <button @click="deleteNews(row)">
                                    <i class="fa-solid fa-trash fa-lg"></i>
                                </button>
                                <button @click="viewNews(row)">
                                    <i class="fa-solid fa-eye fa-lg"></i>
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
                    <form @submit.prevent="saveNews" enctype="multipart/form-data" class="space-y-4">
                        <div>
                            <label class="block text-gray-700 mb-1"
                                >Apgalvojums</label
                            >
                            <input
                                v-model="form.header"
                                type="text"
                                maxlength="60"
                                required
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                placeholder="Ievadi jaunumu apgalvojumu"
                            />
                        </div>
                        <div>
                            <label class="block text-gray-700 mb-1"
                                >Teksts</label
                            >
                            <textarea
                                v-model="form.paragraph"
                                required
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                placeholder="Ievadi jaunumu tekstu"
                                rows="4"
                            ></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Attēls</label>
                                <input
                                    @change="onImageImport"
                                    type="file"
                                    id="file-upload"
                                    name="image"
                                    class="sr-only"
                                    placeholder="Enter image URL"
                                />
                                <label :class="{ 'highlight': fileSelected }" for="file-upload" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 cursor-pointer"
                                    >Attels</label
                                >
                        </div>
                        <div class="flex-none w-full md:w-1/3 flex items-center justify-center">
                            <img
                                v-if="previewUrl"
                                :src="previewUrl"
                                alt="Attels"
                                class="max-w-full max-h-40 object-contain rounded"
                            />
                            <span v-else class="text-gray-500">Nav attels</span>
                        </div>
                    </form>
                </baseModal>
                <baseViewModal
                    v-model="showViewModal"
                    title="Apskatit attelu"
                >
                    <div class="flex-none w-full md:w-1/3 flex items-center justify-center">
                        <img
                            v-if="view_item"
                            :src="view_item"
                            alt="Attels"
                            class="max-w-full max-h-40 object-contain rounded"
                        />
                        <span v-else class="text-gray-500">Nav attels</span>
                    </div>
                </baseViewModal>
            </div>
        </div>
    </article>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import baseModal from './baseModal.vue';
import axios from 'axios';
import baseViewModal from './baseViewModal.vue';
import universalTable from './universalTable.vue';

const data = ref([]);
const loaded = ref(false);
const imageBase64 = ref();
const fileSelected = ref(false);
const previewUrl = ref(null);

const columns = [
    { label: 'Id', key: 'id' },
    { label: 'Apgalvojums', key: 'header' },
    { label: 'Teksts', key: 'paragraph' },
    { label: 'Attēls', key: 'image' },
    { label: 'Uztaisīts', key: 'created_at' },
];

const showModal = ref(false);
const showViewModal = ref(false);

async function fetchdata(){
    try{
        const response = await axios.get('/api/get-news');
        data.value = response.data;
        data.value.forEach(element => {
            element.created_at = (new Date(element.created_at)).toLocaleString();
        });
    } catch(error){
        console.log(error)
    } finally {
        loaded.value = true;
    }
}

onMounted( async () => {
    fetchdata();
});

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
    fileSelected.value = false;
    previewUrl.value = null;
};

const cancelModal = () => {
    resetForm();
    showModal.value = false;
    showViewModal.value = false;
};

const saveNews = async () => {
    try {
        const news = {
            header: form.value.header,
            paragraph: form.value.paragraph,
            image: imageBase64.value || null,
        };

        if (form.value.id) {
            news.id = form.value.id;
            await axios.post('/api/edit-news', news);
        } else {
            await axios.post('/api/create-new-news', news);
        }

        resetForm();
        fetchdata();
        showModal.value = false;
        fileSelected.value = false;
    } catch (error) {
    }
};

function onImageImport(e){
    const file = e.target.files[0];
    if (file && ["image/png", "image/jpeg", "image/gif", "image/svg+xml"].includes(file.type)) {
        const reader = new FileReader();
        reader.onload = (event) => {
            imageBase64.value = event.target.result;
            previewUrl.value = URL.createObjectURL(file);
        };
        fileSelected.value = true;
        reader.readAsDataURL(file);
    }else{
        previewUrl.value = null;
        fileSelected.value = false;
    }
}

const editNews = (newsItem) => {
    form.value = { ...newsItem };
    showModal.value = true;
};

const deleteNews = async (item) => {
    await axios.post('/api/delete-news', {id: item.id});
    fetchdata();
    showModal.value = false;
};

const view_item = ref();

function viewNews(item){
    showViewModal.value = true
    view_item.value = item.image;
}

</script>
<style scoped>
.highlight{
  border-color: #2eff5f;
  background-color: #2eff5f;
  color: #ffffff;
}
</style>
