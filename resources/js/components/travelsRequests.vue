<template>
    <article class="main-panel" v-if="loaded">
        <div class="panel">
            <div class="panel-header">
                <p>/ travel-request</p>
            </div>
            <div>
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="header-button-panels flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Ceļojumu pieteikumi</h2>
                    </div>
                    <universalTable
                        :data="data"
                        :columns="columns"
                        :perPage="10"
                        :searchableFields="['name', 'city','price','client_name','client_email','code','time_term']"
                        @delete="handleDelete"
                    >
                        <template #tool="{ row }">
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
        </div>
    </article>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import universalTable from './universalTable.vue'
import baseViewModal from './baseViewModal.vue';
import axios from 'axios';

const data = ref([]);
const loaded = ref(false);

const columns = [
  { label: 'Id', key: 'id' },
  { label: 'Nosaukums', key: 'name' },
  { label: 'Pilsēta', key: 'city' },
  { label: 'Cēna', key: 'price' },
  { label: 'Klienta vards', key: 'client_name' },
  { label: 'Klienta ē-pasts', key: 'client_email' },
  { label: 'Kods', key: 'code' },
  { label: 'Laika termiņš', key: 'time_term' },
  { label: 'Uztaisīts', key: 'created_at' },
]

async function fetchdata(){
    try{
        const response = await axios.get('/api/get-travel-requests');
        data.value = response.data;
    } catch(error){
        console.log(error)
    } finally {
        loaded.value = true;
    }
}

onMounted( async () => {
    fetchdata();
});

function handleEdit(row) {
  alert(`Edit ${row}`)
}

async function handleDelete(row) {
  await axios.post('/api/delete-travel-request', {id: row.id});
  fetchdata();
}

</script>
