import "./bootstrap";

const headerBtn = document.querySelector("[data-click='open-menu']");
const menuBtn = document.querySelector("[data-click='close-menu']");
const menu = document.querySelector("[data-target='mobile-menu']");

headerBtn.addEventListener("click", function (e) {
    menu.classList.remove("-translate-x-full");
    menu.classList.add("translate-x-0");
});

menuBtn.addEventListener("click", function (e) {
    menu.classList.add("-translate-x-full");
    menu.classList.remove("translate-x-0");
});
