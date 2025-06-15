<template>
    <div class="table-wrapper">
        <input
            type="text"
            v-model="searchQuery"
            placeholder="Search..."
            class="search-bar"
        />

        <div class="table-container">
            <table class="custom-table w-full text-left">
                <thead>
                    <tr>
                        <th v-for="col in columns" :key="col.key">
                            {{ col.label }}
                        </th>
                        <th v-if="$slots.tool" class="text-center">Tools</th>
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
                            <slot
                                name="tool"
                                :row="item"
                                @edit="emitEdit(item)"
                                @delete="emitDelete(item)"
                            />
                        </td>
                    </tr>
                    <tr v-if="paginatedData.length === 0">
                        <td
                            :colspan="columns.length + ($slots.tool ? 1 : 0)"
                            class="text-center text-gray-400 py-6"
                        >
                            No data found
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <button @click="prevPage" :disabled="page === 1">Prev</button>
            <span>Page {{ page }} of {{ totalPages }}</span>
            <button @click="nextPage" :disabled="page === totalPages">
                Next
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

const emit = defineEmits(['edit', 'delete']);

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
    console.log('edit');
    emit('delete', item);
}

watch(
    () => props.data,
    () => {
        page.value = 1;
    },
);
</script>
