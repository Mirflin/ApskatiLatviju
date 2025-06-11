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
                            History
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table
                            class="custom-table"
                        >
                            <thead>
                                <tr>
                                    <th class="rounded-tl-xl">#</th>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th
                                        class="text-center"
                                    >
                                        Tools
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="item in history"
                                    :key="item.id"
                                    class="hover:bg-[#f5f6f8]"
                                >
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.user }}</td>
                                    <td>{{ item.action }}</td>
                                    <td>{{ item.date }}</td>
                                    <td>
                                        <span
                                            :class="statusClass(item.status)"
                                            >{{ item.status }}</span
                                        >
                                    </td>
                                    <td class="text-center">
                                        <button
                                            class="text-blue-500 hover:text-blue-700 mr-2"
                                            title="Edit"
                                        >
                                            <i
                                                class="fa-solid fa-pen-to-square"
                                            ></i>
                                        </button>
                                        <button
                                            class="text-red-500 hover:text-red-700"
                                            title="Delete"
                                        >
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="history.length === 0">
                                    <td
                                        colspan="6"
                                        class="text-center text-gray-400"
                                    >
                                        No data available
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </article>
</template>

<script setup>
import { ref } from 'vue';

const showModal = ref(false);

const form = ref({
    user: '',
    action: '',
    date: '',
});

const history = ref([
    {
        id: 1,
        user: 'TestN1 TestSurN1',
        action: 'Deleted item',
        date: '2025-01-01',
        status: 'Success',
    },
    {
        id: 2,
        user: 'TestN1 TestSurN2',
        action: 'Edited item',
        date: '2025-01-01',
        status: 'Pending',
    },
]);

const statusClass = (status) => {
    switch (status.toLowerCase()) {
        case 'success':
            return 'text-green-600 font-medium';
        case 'pending':
            return 'text-yellow-600 font-medium';
        case 'failed':
            return 'text-red-600 font-medium';
        default:
            return 'text-gray-600 font-medium';
    }
};

const submitForm = () => {
    history.value.push({
        id: history.value.length + 1,
        user: form.value.user,
        action: form.value.action,
        date: form.value.date,
        status: 'Pending',
    });

    form.value = {
        user: '',
        action: '',
        date: '',
    };
    showModal.value = false;
};
</script>

<script>
// import axios from 'axios';
// import { ref, onMounted } from 'vue';

// const history = ref([]);
// const loading = ref(false);

// const loadHistory = async () => {
//     loading.value = true;
//     try {
//         const response = await axios.get('/api/action-histories');
//         history.value = response.data.map((item) => ({
//             id: item.id,
//             user: item.user?.name ?? `ID: ${item.user_id}`,
//             action: item.action,
//             date: new Date(item.created_at).toLocaleDateString(),
//             status:
//                 item.status_id === 1
//                     ? 'Success'
//                     : item.status_id === 2
//                       ? 'Pending'
//                       : item.status_id === 3
//                         ? 'Failed'
//                         : 'Unknown',
//         }));
//     } catch (error) {
//         console.error('History loading failed:', error);
//     } finally {
//         loading.value = false;
//     }
// };

// onMounted(() => {
//     loadHistory();
// });

// const statusClass = (status) => {
//     switch (status.toLowerCase()) {
//         case 'success':
//             return 'text-green-600 font-medium';
//         case 'pending':
//             return 'text-yellow-600 font-medium';
//         case 'failed':
//             return 'text-red-600 font-medium';
//         default:
//             return 'text-gray-600 font-medium';
//     }
// };
</script>
