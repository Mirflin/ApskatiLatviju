<template>
    <article class="main-panel">
        <div class="panel" v-if="loaded">
            <div class="panel-header">
                <p>{{ "/ moderators" }}</p>
            </div>

            <div>
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div
                        class="header-button-panels flex items-center justify-between mb-4"
                    >
                        <h2 class="text-lg font-semibold text-gray-800">
                            Lietotāji
                        </h2>
                        <button
                            @click="showModal = true"
                            v-if="isAdmin"
                            class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600"
                        >
                            Jauns lietotājs
                        </button>
                    </div>
                    <universalTable
                        :data="data"
                        :columns="columns"
                        :perPage="10"
                        :searchableFields="['name', 'email', 'permission','status','created_at']"
                        @edit="editNews"
                        @delete="handleDelete"
                        @restore="handleRestore"
                    >
                        <template #tool="{ row }" v-if="isAdmin">
                            <button @click="editNews(row)">
                                <i class="fa-solid fa-pen-to-square fa-lg"></i>
                            </button>
                            <button v-if="user.id != row.id && row.status == 'Active'" @click="handleDelete(row)">
                                <i class="fa-solid fa-trash fa-lg"></i>
                            </button>
                            <button v-if="user.id != row.id && row.status == 'Suspended'" @click="handleRestore(row)">
                                <i class="fa-solid fa-window-restore fa-lg"></i>
                            </button>
                        </template>
                    </universalTable>
                </div>
            </div>
            <baseModal
                v-model="showModal"
                title="Jauns / Mainit Lietotāju"
                v-if="isAdmin"
                @cancel="cancelModal"
                @save="saveUser"
            >
                <form @submit.prevent="saveUser" class="space-y-4">
                    <div>
                        <label class="block text-gray-700 mb-1">Lietotājs</label>
                        <input
                            v-model="form.name"
                            type="text"
                            required
                            class="w-full border border-gray-300 rounded px-3 py-2"
                            placeholder="Ievadi lietotājvardu"
                        />
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-1">E-pasts</label>
                        <input
                            v-model="form.email"
                            type="email"
                            required
                            class="w-full border border-gray-300 rounded px-3 py-2"
                            placeholder="Ievadi e-pastu"
                        />
                    </div>

                    <div>
                        <label v-if="isAdmin" class="block text-gray-700 mb-1"
                            >Atļaujas</label
                        >
                        <select
                            v-model="form.permission"
                            v-if="isAdmin"
                            class="w-full border border-gray-300 rounded px-3 py-2"
                            required
                        >
                            <option value="" disabled>Izvele atļaujas</option>
                            <option value="2">Moderators</option>
                            <option value="1">Administrators</option>
                        </select>
                    </div>
                </form>
            </baseModal>
            <baseModal
                title="Parols"
                v-model="showPasswordModal"
            >
                <h1>Jauno lietotāju parols: </h1>
                <p>{{ newPassword }}</p>
            </baseModal>
        </div>
    </article>
</template>

<script setup>
import universalTable from './universalTable.vue';
import baseModal from './baseModal.vue';
import axios from 'axios';
import { ref, onMounted } from 'vue';

const showModal = ref(false);
const showPasswordModal = ref(false);


const data = ref([]);
const loaded = ref(false);
const user = ref();
const isAdmin = ref(false);
const newPassword = ref();

async function fetchdata(){
    try{
        const response = await axios.get('/api/user-list');
        data.value = response.data;
        data.value.forEach(element => {
            element.created_at = (new Date(element.created_at)).toLocaleString();
        });
        user.value = (await axios.get('/api/get-current-user')).data;
        if(user.value.permision_group == 1){
            isAdmin.value = true
        }
    } catch(error){
        console.log(error)
    } finally {
        loaded.value = true;
    }
}

onMounted( async () => {
    fetchdata()
});


const form = ref({
    name: '',
    email: '',
    permission: '',
});

const resetForm = () => {
    form.value = { name: '', email: '', permission: ''};
};

const cancelModal = () => {
    resetForm();
    showModal.value = false;
};

const saveUser = async () => {
    if(form.value.name && form.value.email && form.value.permission){
        let newData = {
            name: form.value.name,
            email: form.value.email,
            permision_group: parseInt(form.value.permission),
        };

        let response = await axios.post('/api/create-new-user', newData);
        showModal.value = false;
        let message = response.data.message;
        if(message != 'redacted'){
            newPassword.value = response.data.message;
            showPasswordModal.value = true;
        }
        resetForm();
        showModal.value = false;
        fetchdata()
    }
};

const columns = [
    { label: 'Id', key: 'id' },
    { label: 'Vārds', key: 'name' },
    { label: 'E-pasts', key: 'email' },
    { label: 'Atļaujas', key: 'permission' },
    { label: 'Status', key: 'status' },
    { label: 'Uztaisīts', key: 'created_at' },
];

const editNews = (newsItem) => {
    form.value = { ...newsItem };
    showModal.value = true;
};

async function handleDelete(item) {
    await axios.post('/api/delete-user', {id: item.id});
    cancelModal();
    fetchdata();
}
async function handleRestore(item){
    await axios.post('/api/restore-user', {id: item.id});
    cancelModal();
    fetchdata();
}
</script>
