<template>
    <article class="main-panel">
        <div class="panel">
            <div class="panel-header">
                <p>/ news</p>
            </div>
            <div class="p-6 bg-[#f7f8fa]">
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="header-button-panels">
                        <h2 class="text-lg font-semibold mb-4 text-gray-800">
                            News
                        </h2>
                        <button
                            id="openModal"
                        >
                            Create new
                        </button>
                    </div>
                    <universalTable
                        :data="news"
                        :columns="columns"
                        :perPage="10"
                        :searchableFields="['header', 'content','created_at']"
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
    <div
        id="infoModal"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex justify-center items-center z-50 opacity-0 pointer-events-none transition-opacity duration-300"
    >
        <div
            class="modal-window bg-[var(--main-white)] text-[var(--main-black)] rounded-2xl p-8 max-w-md w-full shadow-xl relative animate-fade-in-up m-5"
        >
            <button
                id="closeModal"
                class="absolute top-4 right-4 text-[var(--main-black)] hover:text-[var(--orange-red)] text-xl"
            >
                &times;
            </button>
            <h2 class="text-2xl font-bold mb-4 font-oswald">
                Title
            </h2>

            <div
                class="modal-window-text space-y-4 text-gray-800 text-lg leading-relaxed"
            >
                content text
            </div>
        </div>
    </div>
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
  { label: 'Header', key: 'header' },
  { label: 'Content', key: 'content' },
  { label: 'Created at', key: 'created_at' },
]

function handleEdit(row) {
  alert(`Edit ${row}`)
}

function handleDelete(row) {
  alert(`Delete ${row}`)
}

</script>
