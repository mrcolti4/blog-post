import "./bootstrap";

// import Swiper from "swiper/bundle";
import "swiper/css";
import Swiper from "swiper";
import { Autoplay, Pagination, Navigation } from "swiper/modules";

const menuBtn = document.querySelector("[data-event='toggle-menu']");
const menu = document.querySelector("[data-target='mobile-menu']");

menuBtn.addEventListener("click", function (e) {
    menu.classList.toggle("translate-x-full");
    menu.classList.toggle("translate-x-0");
});

const homeSlider = new Swiper(".swiper", {
    modules: [Navigation, Pagination, Autoplay],
    spaceBetween: 40,
    slidesPerView: 1,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    speed: 1000,
    // autoplay: {
    //     delay: 2500,
    //     disableOnInteraction: false,
    // },
    breakpoints: {
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
    },
});
