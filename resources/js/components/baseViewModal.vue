<template>
    <transition name="fade">
        <div
            v-if="modelValue"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
            @click="$emit('update:modelValue', false)"
        >
            <div
                class="model-content bg-white text-black rounded-2xl p-8 w-full shadow-xl relative animate-fade-in-up m-5 overflow-y-auto"
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
    max-height: calc(95vh - 1.5rem);
    width: 40rem;
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
