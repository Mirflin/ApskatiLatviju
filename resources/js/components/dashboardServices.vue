<template>
    <article class="main-panel">
        <div class="panel">
            <div class="panel-header">
                <p>/ services</p>
            </div>
            <div class="p-6 bg-[#f7f8fa]">
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="header-button-panels">
                        <h2 class="text-lg font-semibold mb-4 text-gray-800">
                            Services
                        </h2>
                        <button>Create new</button>
                    </div>

                    <universalTable
                        :data="news"
                        :columns="columns"
                        :perPage="10"
                        :searchableFields="['name', 'description','price']"
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
import universalTable from './universalTable.vue'

const news = [
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
]

function handleEdit(row) {
  alert(`Edit ${row}`)
}

function handleDelete(row) {
  alert(`Delete ${row}`)
}

</script>
