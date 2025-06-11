<template>
    <article class="main-panel">
        <div class="panel">
            <div class="panel-header">
                <p>{{ $breadcrumb }}</p>
            </div>
            <div>
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div
                        class="header-button-panels flex items-center justify-between mb-4"
                    >
                        <h2 class="text-lg font-semibold text-gray-800">
                            Services
                        </h2>
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
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th class="text-center">Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="service in services"
                                    :key="service.id"
                                >
                                    <td>{{ service.id }}</td>
                                    <td>{{ service.name }}</td>
                                    <td>{{ service.description }}</td>
                                    <td>
                                        <span
                                            v-if="service.image"
                                            class="inline-block max-w-[10ch] truncate"
                                            >{{ service.image }}</span
                                        >
                                        <span v-else class="text-gray-400"
                                            >No image</span
                                        >
                                    </td>
                                    <td>{{ service.price }}</td>
                                    <td class="text-center">
                                        <button
                                            @click="editService(service)"
                                            class="text-blue-500 hover:text-blue-700 mr-2"
                                            title="Edit"
                                        >
                                            <i
                                                class="fa-solid fa-pen-to-square"
                                            ></i>
                                        </button>
                                        <button
                                            @click="deleteService(service.id)"
                                            class="text-red-500 hover:text-red-700"
                                            title="Delete"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="services.length === 0">
                                    <td
                                        colspan="6"
                                        class="text-center text-gray-400"
                                    >
                                        No services found.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <baseModal
                v-model="showModal"
                title="Add / Edit Service"
                @cancel="cancelModal"
                @save="saveService"
            >
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Form Column -->
                    <div class="flex-1">
                        <form @submit.prevent="saveService" class="space-y-4">
                            <div>
                                <label class="block text-gray-700 mb-1"
                                    >Name</label
                                >
                                <input
                                    v-model="form.name"
                                    type="text"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Enter service name"
                                />
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1"
                                    >Description</label
                                >
                                <textarea
                                    v-model="form.description"
                                    required
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Enter description"
                                    rows="3"
                                ></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-1"
                                    >Price</label
                                >
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
                                <label class="block text-gray-700 mb-1"
                                    >Image URL</label
                                >
                                <input
                                    v-model="form.image"
                                    type="url"
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    placeholder="Enter image URL"
                                />
                            </div>
                        </form>
                    </div>
                    <!-- Image Preview Column -->
                    <div
                        class="flex-none w-full md:w-1/3 flex items-center justify-center"
                    >
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

const services = ref([
    {
        id: 1,
        name: 'Service A',
        description:
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, suscipit.',
        image: '',
        price: 100,
    },
    {
        id: 2,
        name: 'Service B',
        description:
            'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        image: '',
        price: 200,
    },
]);

const form = ref({
    id: null,
    name: '',
    description: '',
    image: '',
    price: null,
});

const resetForm = () => {
    form.value = {
        id: null,
        name: '',
        description: '',
        image: '',
        price: null,
    };
};

const cancelModal = () => {
    resetForm();
    showModal.value = false;
};

const saveService = () => {
    if (form.value.id) {
        const index = services.value.findIndex((s) => s.id === form.value.id);
        if (index !== -1) {
            services.value[index] = { ...form.value };
        }
    } else {
        const newId = services.value.length
            ? Math.max(...services.value.map((s) => s.id)) + 1
            : 1;
        services.value.push({
            id: newId,
            name: form.value.name,
            description: form.value.description,
            image: form.value.image,
            price: form.value.price,
        });
    }
    resetForm();
    showModal.value = false;
};

const editService = (service) => {
    form.value = { ...service };
    showModal.value = true;
};

const deleteService = (id) => {
    services.value = services.value.filter((s) => s.id !== id);
};
</script>
