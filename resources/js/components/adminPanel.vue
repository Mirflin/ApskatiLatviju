<template>
  <div>
    <section id="main">
      <aside class="dashboard-aside">
        <div class="options">

          <button @click="setActive('start')" :class="{ active: active === 'start' }" class="parrent-label">
            <div>
              <img class="parrent-image" />
              <p class="function-p">Dashboard</p>
            </div>
          </button>

          <div class="parrent-option">
            <div class="parrent-label">
              <div>
                <img class="parrent-image" />
                <p class="function-p">Graphs</p>
              </div>
              <div>
                <i class="fa-solid fa-circle-plus" style="color: #74C0FC;"></i>
                <i class="fa-solid fa-chevron-up"></i>
                <i class="fa-solid fa-chevron-down"></i>
              </div>
            </div>
            <div class="child-option">
              <button @click="setActive('travelT')" :class="{ active: active === 'travelT' }" class="child">
                <img class="child-option-image" />
                <div class="child-option-text">
                  <p>Travel trends</p>
                </div>
              </button>
              <button @click="setActive('serviceT')" :class="{ active: active === 'serviceT' }" class="child">
                <img class="child-option-image" />
                <div class="child-option-text">
                  <p>Services trends</p>
                </div>
              </button>
            </div>
          </div>

          <button @click="setActive('news')" :class="{ active: active === 'news' }" class="parrent-label">
            <div>
              <i class="fa-solid fa-newspaper fa-2xl"></i>
              <p class="function-p">News</p>
            </div>
          </button>

          <button @click="setActive('travels')" :class="{ active: active === 'travels' }" class="parrent-label">
            <div>
              <img class="parrent-image" />
              <p class="function-p">Travels</p>
            </div>
          </button>

          <button @click="setActive('services')" :class="{ active: active === 'services' }" class="parrent-label">
            <div>
              <img class="parrent-image" />
              <p class="function-p">Services</p>
            </div>
          </button>

          <button @click="setActive('history')" :class="{ active: active === 'history' }" class="parrent-label">
            <div>
              <img class="parrent-image" />
              <p class="function-p">Actions history</p>
            </div>
          </button>

          <button @click="setActive('moderators')" :class="{ active: active === 'moderators' }" class="parrent-label">
            <div>
              <img class="parrent-image" />
              <p class="function-p">Moderators</p>
            </div>
          </button>
        </div>

        <div class="aside-footer">
          <div class="theme-changer">
            <div class="white">
              <img />
              <p></p>
            </div>
            <div class="black">
              <img />
              <p></p>
            </div>
          </div>
        </div>
      </aside>

      <component :is="currentComponent" :breadcrumb="breadcrumb" />
    </section>
  </div>
</template>

<script setup>
import { ref, watch, onMounted, computed, defineAsyncComponent } from 'vue';

const active = ref('start');
const breadcrumb = computed(() => `/dashboard/${active.value}`);

const componentsMap = {
  start: defineAsyncComponent(() => import('@/components/dashboardStart.vue')),
  history: defineAsyncComponent(() => import('@/components/dashboardHistory.vue')),
  news: defineAsyncComponent(() => import('@/components/dashboardNews.vue')),
  travels: defineAsyncComponent(() => import('@/components/dashboardTravels.vue')),
  services: defineAsyncComponent(() => import('@/components/dashboardServices.vue')),
  moderators: defineAsyncComponent(() => import('@/components/dashboardModerators.vue')),
  travelT: defineAsyncComponent(() => import('@/components/dashboardTravelTrend.vue')),
  serviceT: defineAsyncComponent(() => import('@/components/dashboardServiceTrend.vue')),
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
</script>

<style scoped>
.active {
  background-color: #229cff;
}
</style>
