import Swiper from "swiper";

document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper(".profile-swiper", {
        slidesPerView: 2,
        spaceBetween: 30,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
    console.log(swiper);
});
