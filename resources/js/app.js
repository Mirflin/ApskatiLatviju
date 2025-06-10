import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';

const app = createApp()
app.component('example-component', ExampleComponent)
app.mount('#app');

// --------------------
// welcome.blade.php

// scrolling by section
window.addEventListener("DOMContentLoaded", () => {
    document.querySelector(".btn-list").classList.remove("hidden-on-load");

    document.querySelectorAll('.btn-list a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetID = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetID);
            if (!targetElement) return;

            const headerOffset = 100;
            const elementPosition = targetElement.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth"
            });

            // hide burger when go to the section
            if (btnList.classList.contains("visible")) {
                btnList.classList.remove("visible");
                btnList.classList.add("hiding");

                setTimeout(() => {
                    btnList.classList.remove("hiding");
                }, 300);
            }
        });
    });
});

/*
document.querySelectorAll(".options .parrent-option").forEach((option) => {
    option.addEventListener("click", function(e){
        option.querySelector(".child-option").classList.toggle('hidden-elem')
    })
})

/*
console.log(document.querySelectorAll(".options a").closest("parrent-label"))
(document.querySelectorAll(".options a").closest(".parrent-label")).forEach((label) => {
    console.log(label)
    label.addEventListener("click", function (e) {
        label.classList.toggle('active')
        console.log("click")
    })
})
    */



// burger -> hide/show
const burger = document.querySelector(".burger");
const btnList = document.querySelector(".btn-list");

burger.addEventListener("click", () => {
    if (btnList.classList.contains("visible")) {
        burger.style.color = "";
        btnList.classList.remove("visible");
        btnList.classList.add("hiding");
        setTimeout(() => {
            btnList.classList.remove("hiding");
        }, 300);
    } else {
        burger.style.color = "var(--main-orange)";
        btnList.classList.add("visible");
    }
});

window.addEventListener('scroll', () => {
    burger.style.color = "";
    btnList.classList.remove("visible");
});

// slideshow
// const slides = document.querySelectorAll(".slide");
// const nextBtn = document.querySelector(".slider-btn.next");
// const prevBtn = document.querySelector(".slider-btn.prev");
// let currentSlide = 0;
// let slideInterval = setInterval(nextSlide, 5000);

// function showSlide(index) {
//     slides.forEach((slide, i) => {
//         slide.classList.toggle("active", i === index);
//     });
// }

// function nextSlide() {
//     currentSlide = (currentSlide + 1) % slides.length;
//     showSlide(currentSlide);
// }

// function prevSlide() {
//     currentSlide = (currentSlide - 1 + slides.length) % slides.length;
//     showSlide(currentSlide);
// }

// nextBtn.addEventListener("click", () => {
//     nextSlide();
//     resetInterval();
// });

// prevBtn.addEventListener("click", () => {
//     prevSlide();
//     resetInterval();
// });

// function resetInterval() {
//     clearInterval(slideInterval);
//     slideInterval = setInterval(nextSlide, 5000);
// }

// blink animation
document.querySelectorAll(".btn-list a").forEach((link) => {
    link.addEventListener("click", function (e) {
        const href = this.getAttribute("href");
        if (href && href.startsWith("#")) {
            e.preventDefault();

            const target = document.querySelector(href);
            if (target) {
                target.classList.add("blink-animation");

                target.scrollIntoView({ behavior: "smooth" });

                setTimeout(() => {
                    target.classList.remove("blink-animation");
                }, 600);
            }
        }
    });
});

// --------------------

