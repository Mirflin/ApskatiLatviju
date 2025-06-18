<template>
    <article class="main-panel" v-if="loaded">
        <div class="panel">
            <div class="panel-header">
                <p>/ travel</p>
            </div>
            <div>
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="header-button-panels flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Ceļojumi</h2>
                        <button
                            @click="showModal = true"
                            class="px-4 py-2 bg-orange-500 text-white hover:bg-orange-600 rounded"
                        >
                            Jauns ceļojums
                        </button>
                    </div>
                    <universalTable
                        :data="data"
                        :columns="columns"
                        :perPage="10"
                        :searchableFields="['name', 'city','spot_count','group','seazon','price','time_term']"
                        @edit="editTravel"
                        @delete="deleteTravel"
                        @restore="handleRestore"
                    >
                        <template #tool="{ row }">
                            <button @click="editTravel(row)">
                                <i class="fa-solid fa-pen-to-square fa-lg"></i>
                            </button>
                            <button v-if="row.status == 'Active'" @click="deleteTravel(row)">
                                <i class="fa-solid fa-trash fa-lg"></i>
                            </button>
                            <button v-if="row.status == 'Suspended'" @click="handleRestore(row)">
                                <i class="fa-solid fa-window-restore fa-lg"></i>
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
                title="Jauns / Mainit Ceļojumu"
                @cancel="cancelModal"
                @save="saveTravel"
            >
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <form @submit.prevent="saveTravel" class="space-y-4">
                            <div>
                                <label class="block text-gray-700 mb-1">Nosaukums</label>
                                <input
                                    v-model="form.name"
                                    type="text"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Ievadi ceļojuma nosaukums"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Pilsēta</label>
                                <input
                                    v-model="form.city"
                                    type="text"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Ievadi ceļojuma pilsētu"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Apraksts</label>
                                <textarea
                                    v-model="form.description"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Ievadi ceļojuma aprakstu"
                                    rows="3"
                                ></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Cēna</label>
                                <input
                                    v-model.number="form.price"
                                    type="number"
                                    min="0"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Ievadi ceļojuma cēnu"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Laika termiņš</label>
                                <input
                                    v-model="form.timeTerm"
                                    type="date"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Ievadi ceļojuma laika termiņu"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1"
                                    >Sezons</label
                                >
                                <select
                                    v-model="form.seazon"
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    required
                                >
                                    <option disabled>Izvele sezonu</option>
                                    <option v-for="seazon in seazons" :key="seazon.id" :value="seazon.id">
                                        {{ seazon.name }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1"
                                    >Grupa</label
                                >
                                <select
                                    v-model="form.group"
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    required
                                >
                                    <option disabled>Izvele grupu</option>
                                    <option v-for="group in travel_groups" :key="group.id" :value="group.id">
                                        {{ group.name }}
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Ceļa punkti</label>
                                <input
                                    v-model="form.road_marks"
                                    type="string"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Ievad ceļa punktus (Liepāja-Riga)"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Vietu skaits</label>
                                <input
                                    v-model="form.spot_count"
                                    type="number"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Ievad vietu skaits"
                                />
                            </div>
                        </form>
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
  { label: 'Pilsēta', key: 'city' },
  { label: 'Vietas', key: 'spot_count' },
  { label: 'Grupa', key: 'group' },
  { label: 'Sezons', key: 'seazon' },
  { label: 'Cēna', key: 'price' },
  { label: 'Laika termiņš', key: 'time_term' },
  { label: 'Status', key: 'status' },
  { label: 'Uztaisīts', key: 'created_at' },
]

const data = ref([]);
const travel_groups = ref([]);
const seazons = ref([]);
const loaded = ref(false);
const imageBase64 = ref();
const fileSelected = ref(false);
const previewUrl = ref(null);

const showModal = ref(false);

async function fetchdata(){
    try{
        let response = await axios.get('/api/get-travels');
        data.value = response.data;
        data.value.forEach(element => {
            element.created_at = (new Date(element.created_at)).toLocaleString();
        });

        response = await axios.get('/api/get-travel-groups');
        travel_groups.value = response.data;

        response = await axios.get('/api/get-seazons');
        seazons.value = response.data;

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
    city: '',
    description: '',
    seazon_id: null,
    group_id: null,
    road_marks: '',
    image: '',
    price: null,
    spot_count: 0,
    time_term: '',
});

const resetForm = () => {
    form.value = {
        id: null,
        name: '',
        city: '',
        description: '',
        seazon_id: null,
        group_id: null,
        road_marks: '',
        image: '',
        spot_count: 0,
        price: null,
        time_term: '',
    };
    fileSelected.value = false;
    previewUrl.value = null;
};

const cancelModal = () => {
    resetForm();
    showModal.value = false;
    fileSelected.value = false;
    previewUrl.value = null;
};

const saveTravel = async() => {
    try {
        let travels = {
            name: form.value.name,
            city: form.value.city,
            description: form.value.description,
            image: imageBase64.value || null,
            seazon_id: parseInt(form.value.seazon),
            group_id: parseInt(form.value.group),
            road_marks: form.value.road_marks,
            price: form.value.price,
            spot_count: form.value.spot_count,
            time_term: form.value.timeTerm,
        };

        if (form.value.id) {
            travels.id = form.value.id;
            await axios.post('/api/edit-travel', travels);
        } else {
            await axios.post('/api/create-new-travel', travels);
        }

        resetForm();
        fetchdata();
        fileSelected.value = false;
        previewUrl.value = null;
        showModal.value = false;
    } catch (error) {
        console.log(error);
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

const editTravel = (travel) => {
    form.value = { ...travel };
    showModal.value = true;
};

const deleteTravel = async(item) => {
    await axios.post('/api/delete-travel', {id: item.id});
    fetchdata();
    showModal.value = false;
};

const handleRestore = async(item) => {
    await axios.post('/api/restore-travel', {id: item.id});
    fetchdata();
    showModal.value = false;
}

</script>
