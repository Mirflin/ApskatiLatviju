<template>
    <article class="main-panel">
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
                        :data="travels2"
                        :columns="columns"
                        :perPage="10"
                        :searchableFields="['name', 'city','spot_count','group','seazon','price','time_term']"
                        @edit="handleEdit"
                        @delete="handleDelete"
                    >
                        <template #tool="{ row }">
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
import { ref } from 'vue';
import universalTable from './universalTable.vue'
import baseViewModal from './baseViewModal.vue';

const travels2 = [
  { id: 1, header: 'Alice', content: 'alice@example.com', created_at: "2025" },
  { id: 2, header: 'Bob', content: 'bob@example.com' , created_at: "2025"},
  { id: 3, header: 'Charlie', content: 'charlie@example.com' , created_at: "2024"},
  { id: 4, header: 'David', content: 'david@example.com' , created_at: "2025"},
  { id: 5, header: 'Fve', content: 'eve@example.com' , created_at: "2025"},
  { id: 6, header: 'Frank', content: 'frank@example.com' , created_at: "2025"},
  { id: 7, header: 'Charlie', content: 'charlie@example.com' , created_at: "2024"},
  { id: 8, header: 'David', content: 'david@example.com' , created_at: "2025"},
  { id: 9, header: 'Fve', content: 'eve@example.com' , created_at: "2025"},
  { id: 10, header: 'Frank', content: 'frank@example.com' , created_at: "2025"},

]

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

function handleEdit(row) {
  alert(`Edit ${row}`)
}

function handleDelete(row) {
  alert(`Delete ${row}`)
}

</script>
