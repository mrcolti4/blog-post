import Swiper from "swiper";
import { Autoplay, Pagination, Navigation } from "swiper/modules";
import "swiper/css";

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
