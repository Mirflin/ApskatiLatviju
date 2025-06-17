import './bootstrap';
import { createApp } from 'vue';
import adminPanel from './components/adminPanel.vue';
import dashboardStart from './components/dashboardStart.vue';

import './modal.js';
import './pagination.js';

const appElement = document.getElementById('app');
if (appElement) {
    const app = createApp();
    app.component('admin-panel', adminPanel);
    app.component('dashboard-start', dashboardStart);
    app.mount('#app');
}

// nav header, small width = burger nav
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
document.addEventListener('DOMContentLoaded', () => {
    const toggleBtn = document.getElementById('toggleAdvanced');
    const advancedFilter = document.getElementById('advancedFilter');
    const filterForm = document.querySelector('form[method="GET"]');

    if (!advancedFilter) return;

    const savedState = localStorage.getItem('advancedFiltersOpen');
    if (savedState === 'true') {
        advancedFilter.classList.remove('hidden');
    }

    toggleBtn?.addEventListener('click', () => {
        const isHidden = advancedFilter.classList.toggle('hidden');
        localStorage.setItem('advancedFiltersOpen', !isHidden);

        const toggleIcon = document.getElementById('toggleIcon');
        toggleIcon?.classList.toggle('rotate-180');
    });

    filterForm?.addEventListener('submit', () => {
        const advancedInputs = advancedFilter.querySelectorAll('input, select');
        const hasValues = Array.from(advancedInputs).some(
            (el) => el.value !== '' && el.name !== '_token',
        );

        localStorage.setItem('advancedFiltersOpen', hasValues);
    });

    const advancedInputs = advancedFilter.querySelectorAll('input, select');

    // Automatically open if there are filled fields in additional filters
    const hasAdvancedFilters = Array.from(advancedInputs).some(
        (el) => el.value !== '' && el.name !== '_token',
    );

    if (hasAdvancedFilters) {
        advancedFilter.classList.remove('hidden');
        localStorage.setItem('advancedFiltersOpen', 'true');

        const toggleIcon = document.getElementById('toggleIcon');
        toggleIcon?.classList.add('rotate-180');
    }
});

// Contacts (open and close contact info)
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.contacts-list .contact-item');

    items.forEach((item, index) => {
        const extraClass = `contact-extra-${index + 1}`;
        const extra = item.querySelector(`.${extraClass}`);

        const toggleContact = (e) => {
            e.stopPropagation();
            const isOpen =
                extra.style.maxHeight && extra.style.maxHeight !== '0px';

            items.forEach((otherItem, otherIndex) => {
                const otherExtraClass = `contact-extra-${otherIndex + 1}`;
                const otherExtra = otherItem.querySelector(
                    `.${otherExtraClass}`,
                );
                otherExtra.style.maxHeight = '0px';
            });

            extra.style.maxHeight = isOpen ? '0px' : `${extra.scrollHeight}px`;
        };

        item.addEventListener('click', toggleContact);

        item.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleContact(e);
            }
        });
    });
});