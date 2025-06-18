<template>
    <article class="main-panel" v-if="loaded">
        <div class="panel">
            <div class="panel-header">
                <p>/ services</p>
            </div>
            <div>
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div
                        class="header-button-panels flex items-center justify-between mb-4"
                    >
                        <h2 class="text-lg font-semibold text-gray-800">
                            Pakalpojumi
                        </h2>
                        <button
                            @click="showModal = true"
                            class="px-4 py-2 bg-orange-500 text-white hover:bg-orange-600 rounded"
                        >
                            Jauns pakalpojums
                        </button>
                    </div>

                    <universalTable
                        :data="data"
                        :columns="columns"
                        :perPage="10"
                        :searchableFields="['name', 'description','price']"
                        @edit="handleEdit"
                        @delete="handleDelete"
                    >
                        <template #tool="{ row }">
                            <button @click="editNews(row)">
                                <i class="fa-solid fa-pen-to-square fa-lg"></i>
                            </button>
                            <button @click="handleDelete(row)">
                                <i class="fa-solid fa-trash fa-lg"></i>
                            </button>
                        </template>
                    </universalTable>

                </div>
            </div>

            <baseViewModal
                v-model="showViewModal"
                title="Show news"
                @cancel="cancelModal"
            >
                <div class="view-modal">
                    <div class="">
                        <div>
                            <h3>Header: </h3>
                            <p>{{view_item.header}}</p>
                        </div>
                        <div>
                            <h3>Paragraph: </h3>
                            <textarea disabled style="resize: none;" class="w-full border border-gray-300 rounded px-3 py-2">{{ view_item.paragraph }}</textarea>
                        </div>
                    </div>
                    <img class="modal-image" :src="view_item.image">
                </div>
            </baseViewModal>

            <baseModal
                v-model="showModal"
                title="Jauns / Mainit Pakalpojumu"
                @cancel="cancelModal"
                @save="saveService"
            >
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Form Column -->
                    <div class="flex-1">
                        <form @submit.prevent="saveService" class="space-y-4">
                            <div>
                                <label class="block text-gray-700 mb-1"
                                    >Nosaukums</label
                                >
                                <input
                                    v-model="form.name"
                                    type="text"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Ievad pakalpojuma nosaukumu"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1"
                                    >Apraksts</label
                                >
                                <textarea
                                    v-model="form.description"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Ievad aprakstu"
                                    rows="3"
                                ></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1"
                                    >Cēna</label
                                >
                                <input
                                    v-model.number="form.price"
                                    type="number"
                                    min="0"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Ievad cēnu"
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </baseModal>
        </div>
    </article>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import baseModal from './baseModal.vue';
import baseViewModal from './baseViewModal.vue';
import universalTable from './universalTable.vue'
import axios from 'axios';

const columns = [
  { label: 'Id', key: 'id' },
  { label: 'Nosaukums', key: 'name' },
  { label: 'Apraksts', key: 'description' },
  { label: 'Cēna', key: 'price' },
]

const data = ref([]);
const loaded = ref(false);
const showModal = ref(false);
const isAdmin = ref(false);
const user = ref();

async function fetchdata(){
    try{
        const response = await axios.get('/api/get-services');
        data.value = response.data;
        user.value = (await axios.get('/api/get-current-user')).data;
        if(user.value.permision_group == 1){
            isAdmin.value = true
        }
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
    name: '',
    description: '',
    price: null,
});

const resetForm = () => {
    form.value = {
        id: null,
        name: '',
        description: '',
        price: null,
    };
};

const cancelModal = () => {
    resetForm();
    showModal.value = false;
};

async function saveService() {
    if(form.value.name, form.value.description, form.value.price){
        let newService = {
            id: form.value.id,
            name: form.value.name,
            description: form.value.description,
            price: form.value.price
        }

        await axios.post('/api/create-new-service', newService);

        resetForm();
        fetchdata();
        showModal.value = false;
    }
};

const editService = (service) => {
    form.value = { ...service };
    form.value.id = service.id;
    showModal.value = true;
};

const deleteService = (id) => {
    services.value = services.value.filter((s) => s.id !== id);
};

const editNews = (newsItem) => {
    form.value = { ...newsItem };
    showModal.value = true;
};

async function handleDelete(row) {
    await axios.post('/api/delete-service', {id: row.id});
    fetchdata();
}

</script>
