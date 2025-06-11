<template>
    <transition name="fade">
        <div
            v-if="modelValue"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
            @click="$emit('update:modelValue', false)"
        >
            <div
                class="model-content bg-white text-black rounded-2xl p-8 max-w-md w-full shadow-xl relative animate-fade-in-up m-5 overflow-y-auto"
                @click.stop
            >
                <button
                    @click="$emit('update:modelValue', false)"
                    class="absolute top-4 right-4 text-black hover:text-orange-600 text-xl"
                    aria-label="Close modal"
                >
                    ×
                </button>

                <h2 class="text-2xl font-bold mb-4 font-oswald">{{ title }}</h2>

                <slot />

                <div class="mt-6 flex justify-end space-x-2">
                    <button
                        @click="$emit('cancel')"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded"
                    >
                        Cancel
                    </button>
                    <button
                        @click="$emit('save')"
                        class="px-4 py-2 bg-orange-500 text-white hover:bg-orange-600 rounded"
                    >
                        Save
                    </button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script setup>
defineProps({
    title: { type: String, default: 'Modal title' },
    modelValue: { type: Boolean, required: true },
});
defineEmits(['update:modelValue', 'cancel', 'save']);
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.25s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
.custom-modal {
    max-height: 80%;
}
.model-content {
    max-height: calc(95vh - 2.5rem);
    overflow-y: auto;
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.3s ease forwards;
}
</style>
