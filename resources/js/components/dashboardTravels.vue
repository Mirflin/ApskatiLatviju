<template>
    <article class="main-panel">
        <div class="panel">
            <div class="panel-header">
                <p>{{ $breadcrumb }}</p>
            </div>
            <div>
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="header-button-panels flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Travel</h2>
                        <button
                            @click="showModal = true"
                            class="px-4 py-2 bg-orange-500 text-white hover:bg-orange-600 rounded"
                        >
                            Create new
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>City</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Time term</th>
                                    <th class="text-center">Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="travel in travels" :key="travel.id">
                                    <td>{{ travel.id }}</td>
                                    <td>{{ travel.name }}</td>
                                    <td>{{ travel.city }}</td>
                                    <td>{{ travel.description }}</td>
                                    <td>
                                        <span
                                            v-if="travel.image"
                                            class="inline-block max-w-[10ch] truncate"
                                            >{{ travel.image }}</span
                                        >
                                        <span v-else class="text-gray-400"
                                            >No image</span
                                        >
                                    </td>
                                    <td>{{ travel.price }}</td>
                                    <td class="font-medium">{{ travel.timeTerm }}</td>
                                    <td class="text-center">
                                        <button
                                            @click="editTravel(travel)"
                                            class="text-blue-500 hover:text-blue-700 mr-2"
                                            title="Edit"
                                        >
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button
                                            @click="deleteTravel(travel.id)"
                                            class="text-red-500 hover:text-red-700"
                                            title="Delete"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="travels.length === 0">
                                    <td colspan="8" class="text-center text-gray-400 py-6">
                                        No travels found.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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
</script>