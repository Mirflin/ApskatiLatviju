<template>
    <div class="table-wrapper">
        <input
            type="text"
            v-model="searchQuery"
            placeholder="Meklēt..."
            class="search-bar"
        />

        <div class="table-container">
            <table class="custom-table w-full text-left">
                <thead>
                    <tr>
                        <th v-for="col in columns" :key="col.key">
                            {{ col.label }}
                        </th>
                        <th v-if="$slots.tool" class="text-center">Instrumenti</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in paginatedData" :key="item.id">
                        <td
                            v-for="col in columns"
                            :key="col.key"
                            class="max-w-xs truncate"
                            :title="item[col.key]"
                        >
                            {{
                                typeof item[col.key] === 'string'
                                    ? item[col.key].length <= 20
                                        ? item[col.key]
                                        : item[col.key].substring(0, 20) + '...'
                                    : item[col.key]
                            }}
                        </td>
                        <td v-if="$slots.tool" class="text-center">
                            <slot name="tool" :row="item" :onEdit="emitEdit" :onDelete="emitDelete" :onRestore="emitRestore" />
                        </td>
                        <!--
                        <td class="text-center">
                            <button @click="$emit('view', item)"><i class="fa-solid fa-eye"></i></button>
                            <button @click="$emit('edit', item)"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button @click="$emit('delete', item.id)"><i class="fa-solid fa-trash"></i></button>
                        </td>
                        -->
                    </tr>
                    <tr v-if="paginatedData.length === 0">
                        <td
                            :colspan="columns.length + ($slots.tool ? 1 : 0)"
                            class="text-center text-gray-400 py-6"
                        >
                            Nav atrasti dati
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <button @click="prevPage" :disabled="page === 1">Atpakaļ</button>
            <span>Lappa {{ page }} of {{ totalPages }}</span>
            <button @click="nextPage" :disabled="page === totalPages">
                Talāk
            </button>
        </div>
    </div>
</template>
<script setup>
import { ref, computed, watch } from 'vue';

const props = defineProps({
    data: Array,
    columns: Array,
    perPage: {
        type: Number,
        default: 5,
    },
    alphabetField: {
        type: String,
        default: 'name',
    },
    searchableFields: {
        type: Array,
        default: () => ['name'],
    },
});

const emit = defineEmits(['edit', 'delete','view', 'restore']);

const page = ref(1);
const searchQuery = ref('');

const filteredData = computed(() => {
    let result = props.data;

    if (searchQuery.value) {
        const query = searchQuery.value.toLowerCase();
        result = result.filter((item) =>
            props.searchableFields.some((field) =>
                String(item[field] || '')
                    .toLowerCase()
                    .includes(query),
            ),
        );
    }
    return result;
});

const totalPages = computed(() =>
    Math.max(1, Math.ceil(filteredData.value.length / props.perPage)),
);

const paginatedData = computed(() => {
    const start = (page.value - 1) * props.perPage;
    return filteredData.value.slice(start, start + props.perPage);
});

function prevPage() {
    if (page.value > 1) page.value--;
}

function nextPage() {
    if (page.value < totalPages.value) page.value++;
}

function emitEdit(item) {
    emit('edit', item);
}

function emitDelete(item) {
    emit('delete', item);
}
function emitRestore(item){
    emit('restore', item)
}

watch(
    () => props.data,
    () => {
        page.value = 1;
    },
);
</script>

<style scoped>
.table-container{
    background-color: var(--bg-aside);
    color: #fff;
}
.text-center button{
    margin-right: 0.5rem;
}

</style>
<!-- <style scoped>
.table-wrapper {
  padding: 1rem;
  font-family: sans-serif;
}

.alphabet-filter {
  display: flex;
  flex-wrap: wrap;
  gap: 0.25rem;
  margin-bottom: 1rem;
}

.alphabet-filter button {
  padding: 0.25rem 0.5rem;
  border: 1px solid #ccc;
  background: #eee;
  cursor: pointer;
  border-radius: 0.25rem;
  font-size: 0.875rem;
}

.alphabet-filter button.active {
  background: #007bff;
  color: white;
  border-color: #007bff;
}

.table-container {
  height: 28.35rem;
  overflow-y: auto;
  margin-bottom: 1rem;
  border: 1px solid #ccc;
}

table {
  width: 100%;
  border-collapse: collapse;
  min-width: 31.25rem;
}

th,
td {
  padding: 0.5rem;
  border: 1px solid #ccc;
  text-align: left;
}

th {
  background-color: #f5f5f5;
}

</style> -->
