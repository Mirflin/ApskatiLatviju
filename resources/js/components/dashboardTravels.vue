<template>
    <article class="main-panel">
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
                        :data="travels2"
                        :columns="columns"
                        :perPage="10"
                        :searchableFields="['name', 'city','spot_count','group','seazon','price','time_term']"
                        @edit="handleEdit"
                        @delete="handleDelete"
                    >
                        <template #tool="{ row }">
                            <button class="tools" @click="$emit('edit', row)"><i class="fa-solid fa-pen-to-square fa-xl"></i></button>
                            <button class="tools" @click="$emit('delete', row)"><i class="fa-solid fa-trash fa-xl"></i></button>
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
                title="Add / Edit Travel"
                @cancel="cancelModal"
                @save="saveTravel"
            >
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <form @submit.prevent="saveTravel" class="space-y-4">
                            <div>
                                <label class="block text-gray-700 mb-1">Name</label>
                                <input
                                    v-model="form.name"
                                    type="text"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Enter travel name"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">City</label>
                                <input
                                    v-model="form.city"
                                    type="text"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Enter city"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Description</label>
                                <textarea
                                    v-model="form.description"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Enter description"
                                    rows="3"
                                ></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Price</label>
                                <input
                                    v-model.number="form.price"
                                    type="number"
                                    min="0"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Enter price"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Time term</label>
                                <input
                                    v-model="form.timeTerm"
                                    type="date"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1">Image URL</label>
                                <input
                                    v-model="form.image"
                                    type="url"
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Enter image URL"
                                />
                            </div>
                        </form>
                    </div>
                    <div class="flex-none w-full md:w-1/3 flex items-center justify-center">
                        <img
                            v-if="form.image"
                            :src="form.image"
                            alt="Preview image"
                            class="max-w-full max-h-40 object-contain rounded"
                        />
                        <span v-else class="text-gray-500">No image</span>
                    </div>
                </div>
            </baseModal>
        </div>
    </article>
</template>

<script setup>
import { ref } from 'vue';
import baseModal from './baseModal.vue';
import baseViewModal from './baseViewModal.vue';

const showModal = ref(false);

const travels = ref([
    {
        id: 1,
        name: 'No Kuldiga',
        city: 'Liepaja',
        description:
            'Lorem ipsum doloidem aut cumque dolores. Facererat quisquam dolorum commodi voluptate eveniet reiciendis magnam?',
        image: '',
        price: 20,
        timeTerm: '2025-06-30',
    },
    {
        id: 2,
        name: 'No Kuldigai',
        city: 'Riga',
        description:
            'Lorem ipsum ddem aut cumque dolores. Facere earum id maiolorum commodi voluptate eveniet reiciendis magnam?',
        image: '',
        price: 40,
        timeTerm: '2025-07-30',
    },
]);

const form = ref({
    id: null,
    name: '',
    city: '',
    description: '',
    image: '',
    price: null,
    timeTerm: '',
});

const resetForm = () => {
    form.value = {
        id: null,
        name: '',
        city: '',
        description: '',
        image: '',
        price: null,
        timeTerm: '',
    };
};

const cancelModal = () => {
    resetForm();
    showModal.value = false;
};

const saveTravel = () => {
    if (form.value.id) {
        const index = travels.value.findIndex((t) => t.id === form.value.id);
        if (index !== -1) {
            travels.value[index] = { ...form.value };
        }
    } else {
        const newId = travels.value.length
            ? Math.max(...travels.value.map((t) => t.id)) + 1
            : 1;
        travels.value.push({
            id: newId,
            name: form.value.name,
            city: form.value.city,
            description: form.value.description,
            image: form.value.image,
            price: form.value.price,
            timeTerm: form.value.timeTerm,
        });
    }
    resetForm();
    showModal.value = false;
};

const editTravel = (travel) => {
    form.value = { ...travel };
    showModal.value = true;
};

const deleteTravel = (id) => {
    travels.value = travels.value.filter((t) => t.id !== id);
};
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
  { label: 'City', key: 'city' },
  { label: 'Spots', key: 'spot_count' },
  { label: 'Group', key: 'group' },
  { label: 'Seazon', key: 'seazon' },
  { label: 'Price', key: 'price' },
  { label: 'Time', key: 'time_term' },
  { label: 'Created at', key: 'created_at' },
]

function handleEdit(row) {
  alert(`Edit ${row}`)
}

function handleDelete(row) {
  alert(`Delete ${row}`)
}

</script>
