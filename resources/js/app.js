import './bootstrap';
import { createApp } from 'vue';
import adminPanel from './components/adminPanel.vue';
import dashboardStart from './components/dashboardStart.vue';

import './modal.js';

const app = createApp();
app.component('admin-panel', adminPanel);
app.component('dashboard-start', dashboardStart);
app.mount('#app');

window.addEventListener('DOMContentLoaded', () => {
    const burger = document.querySelector('.burger');
    const btnList = document.querySelector('.btn-list');

    if (!burger || !btnList) {
        console.warn('burger or btnList not found');
        return;
    }

    burger.addEventListener('click', () => {
        if (btnList.classList.contains('visible')) {
            burger.style.color = '';
            btnList.classList.remove('visible');
            btnList.classList.add('hiding');
            setTimeout(() => {
                btnList.classList.remove('hiding');
            }, 300);
        } else {
            burger.style.color = 'var(--main-orange)';
            btnList.classList.add('visible');
        }
    });

    window.addEventListener('scroll', () => {
        burger.style.color = '';
        btnList.classList.remove('visible');
    });
});

// Open advanced filters
document.getElementById('toggleAdvanced')?.addEventListener('click', () => {
    const advanced = document.getElementById('advancedFilter');
    if (advanced.classList.contains('hidden')) {
        advanced.classList.remove('hidden');
    } else {
        advanced.classList.add('hidden');
    }
});

// Footer content (open and close detailed info)
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.contacts-list .contact-item');

    items.forEach((item) => {
        item.addEventListener('click', () => {
            const extra = item.querySelector('.contact-extra');

            if (extra.style.maxHeight && extra.style.maxHeight !== '0px') {
                extra.style.maxHeight = '0';
            } else {
                items.forEach((otherItem) => {
                    if (otherItem !== item) {
                        const otherExtra =
                            otherItem.querySelector('.contact-extra');
                        otherExtra.style.maxHeight = '0';
                    }
                });
                extra.style.maxHeight = extra.scrollHeight + 'px';
            }
        });
    });
});
