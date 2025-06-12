<template>
    <article class="main-panel">
        <div class="panel">
            <div class="panel-header">
                <p>/ service-request</p>
            </div>
            <div>
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="header-button-panels flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Pakalpojumu pieteikumi</h2>
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
                            <button @click="$emit('edit', row)"><i class="fa-solid fa-pen-to-square fa-xl"></i></button>
                            <button @click="$emit('delete', row)"><i class="fa-solid fa-trash fa-xl"></i></button>
                        </template>
                    </universalTable>
                </div>
            </div>
        </div>
    </article>
</template>

<script setup>
import { ref } from 'vue';
import universalTable from './universalTable.vue'

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
  { label: 'Name', key: 'name' },
  { label: 'Description', key: 'description' },
  { label: 'Price', key: 'price' },
  { label: 'Client name', key: 'client_name' },
  { label: 'Client email', key: 'client_email' },
  { label: 'Code', key: 'code' },
  { label: 'Created at', key: 'created_at' },
]

function handleEdit(row) {
  alert(`Edit ${row}`)
}

function handleDelete(row) {
  alert(`Delete ${row}`)
}

</script>
