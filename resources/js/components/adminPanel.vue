<template>
    <div>
        <section id="main" class="d-flex">
            <aside class="dashboard-aside">
                <div class="options">
                    <button
                        @click="setActive('start')"
                        :class="{ active: active === 'start' }"
                        class="aside-option"
                    >
                        <div>
                            <i class="fa-solid fa-gauge-high fa-xl"></i>
                            <span>Admin panelis</span>
                        </div>
                    </button>

                    <!--
                    <div class="aside-group">
                        <div class="aside-option" @click="toggleGraphsOptions">
                            <div class="flex gap-2">
                                <i class="fa-solid fa-chart-simple fa-xl"></i>
                                <span>Grafiki</span>
                            </div>
                            <div>
                                <i
                                    v-if="showGraphsOptions"
                                    class="fa-solid fa-chevron-up"
                                ></i>
                                <i v-else class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>
                        <div v-if="showGraphsOptions" class="child-options">
                            <button
                                @click="setActive('travelT')"
                                :class="{ active: active === 'travelT' }"
                                class="child-option"
                            >
                                <i class="fa-solid fa-location-dot fa-xl"></i>
                                <span>Ceļojumi</span>
                            </button>
                            <button
                                @click="setActive('serviceT')"
                                :class="{ active: active === 'serviceT' }"
                                class="child-option"
                            >
                                <i class="fa-solid fa-bell-concierge fa-xl"></i>
                                <span>Pakalpojumi</span>
                            </button>
                        </div>
                    </div>
                    -->

                    <div class="aside-group">
                        <div class="aside-option" @click="toggleRequestsOptions">
                            <div class="flex gap-2">
                                <i class="fa-solid fa-list fa-xl"></i>
                                <span>Pieteikumi</span>
                            </div>
                            <div>
                                <i
                                    v-if="showRequestsOptions"
                                    class="fa-solid fa-chevron-up"
                                ></i>
                                <i v-else class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>

                        <div v-if="showRequestsOptions" class="child-options">
                            <button
                                @click="setActive('travelRequest')"
                                :class="{ active: active === 'travelRequest' }"
                                class="child-option"
                            >
                                <i class="fa-solid fa-location-dot fa-xl"></i>
                                <span>Ceļojumi</span>
                            </button>
                            <button
                                @click="setActive('serviceRequest')"
                                :class="{ active: active === 'serviceRequest' }"
                                class="child-option"
                            >
                                <i class="fa-solid fa-bell-concierge fa-xl"></i>
                                <span>Pakalpojumi</span>
                            </button>
                        </div>
                    </div>

                    

                    <button
                        @click="setActive('news')"
                        :class="{ active: active === 'news' }"
                        class="aside-option"
                    >
                        <div>
                            <i class="fa-solid fa-fire fa-xl"></i>
                            <span>Aktualitātes</span>
                        </div>
                    </button>

                    <button
                        @click="setActive('travels')"
                        :class="{ active: active === 'travels' }"
                        class="aside-option"
                    >
                        <div>
                            <i class="fa-solid fa-car fa-xl"></i>
                            <span>Ceļojumi</span>
                        </div>
                    </button>

                    <button
                        @click="setActive('services')"
                        :class="{ active: active === 'services' }"
                        class="aside-option"
                    >
                        <div>
                            <i class="fa-solid fa-bell-concierge fa-xl"></i>
                            <span>Pakalpojumi</span>
                        </div>
                    </button>

                    <button
                        @click="setActive('history')"
                        :class="{ active: active === 'history' }"
                        class="aside-option"
                    >
                        <div>
                            <i class="fa-solid fa-clock-rotate-left fa-xl"></i>
                            <span>Vēsture</span>
                        </div>
                    </button>

                    <button
                        @click="setActive('moderators')"
                        :class="{ active: active === 'moderators' }"
                        class="aside-option"
                    >
                        <div>
                            <i class="fa-solid fa-user-doctor fa-xl"></i>
                            <span>Lietotāji</span>
                        </div>
                    </button>

                    <button
                        @click="setActive('citi')"
                        :class="{ active: active === 'citi' }"
                        class="aside-option"
                    >
                        <div>
                            <i class="fa-solid fa-gears fa-xl"></i>
                            <span>Citi</span>
                        </div>
                    </button>

                </div>

                <div class="aside-footer">
                    <button @click="toggleTheme" class="theme-toggle">
                        <i class="fa-solid fa-moon me-1" v-if="!isDark"></i>
                        <i class="fa-solid fa-sun me-1" v-else></i>
                        {{ isDark ? 'Dark' : 'Light' }} Mode
                    </button>
                </div>
            </aside>

            <component
                :is="currentComponent"
                :breadcrumb="breadcrumb"
                class="flex-grow-1 p-4"
            />
        </section>
    </div>
</template>

<script setup>
import { ref, watch, onMounted, computed, defineAsyncComponent } from 'vue';

const active = ref('start');
const breadcrumb = computed(() => `/dashboard/${active.value}`);

const componentsMap = {
    start: defineAsyncComponent(
        () => import('@/components/dashboardStart.vue'),
    ),
    history: defineAsyncComponent(
        () => import('@/components/dashboardHistory.vue'),
    ),
    news: defineAsyncComponent(() => import('@/components/dashboardNews.vue')),
    travels: defineAsyncComponent(
        () => import('@/components/dashboardTravels.vue'),
    ),
    services: defineAsyncComponent(
        () => import('@/components/dashboardServices.vue'),
    ),
    moderators: defineAsyncComponent(
        () => import('@/components/dashboardModerators.vue'),
    ),
    travelT: defineAsyncComponent(
        () => import('@/components/dashboardTravelTrend.vue'),
    ),
    serviceT: defineAsyncComponent(
        () => import('@/components/dashboardServiceTrend.vue'),
    ),
    travelRequest: defineAsyncComponent(
        () => import('@/components/travelsRequests.vue'),
    ),
    serviceRequest: defineAsyncComponent(
        () => import('@/components/servicesRequests.vue'),
    ),
    helpRequest: defineAsyncComponent(
        () => import('@/components/helpRequests.vue'),
    ),
    citi: defineAsyncComponent(
        () => import('@/components/dashboardCiti.vue')
    )
};

const currentComponent = computed(() => componentsMap[active.value] || null);

onMounted(() => {
    const hash = window.location.hash.replace('#', '');
    if (Object.keys(componentsMap).includes(hash)) {
        active.value = hash;
    }
    window.addEventListener('hashchange', () => {
        const newHash = window.location.hash.replace('#', '');
        if (Object.keys(componentsMap).includes(newHash)) {
            active.value = newHash;
        }
    });
});

watch(active, (newVal) => {
    history.pushState(null, '', `#${newVal}`);
});

function setActive(name) {
    active.value = name;
}

const showGraphsOptions = ref(false);
const showRequestsOptions = ref(false);

function toggleGraphsOptions() {
    showGraphsOptions.value = !showGraphsOptions.value;
}

function toggleRequestsOptions(){
    showRequestsOptions.value = !showRequestsOptions.value;
}

// dark/light theme switcher
const isDark = ref(false);

function toggleTheme() {
    isDark.value = !isDark.value;
    document.body.classList.toggle('dark-theme', isDark.value);
}
</script>

<style scoped>
.main-section {
    display: flex;
    flex-direction: row;
    min-height: 100vh;
    width: 100%;
}

.main-content {
    flex-grow: 1;
    width: 100%;
    background-color: var(--bg-main);
    overflow-y: auto;
}

@media (max-width: 768px) {
    .main-section {
        flex-direction: column;
    }

    .dashboard-aside {
        width: 100%;
        border-right: none;
        border-bottom: 1px solid var(--bg-aside);
    }

    .main-content {
        width: 100%;
    }
}
</style>