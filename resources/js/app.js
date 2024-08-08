import "./bootstrap";

const menuBtn = document.querySelector("[data-event='toggle-menu']");
const menu = document.querySelector("[data-target='mobile-menu']");

menuBtn.addEventListener("click", function (e) {
    menu.classList.toggle("translate-x-full");
    menu.classList.toggle("translate-x-0");
});
