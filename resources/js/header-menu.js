const menuBtn = document.querySelector("[data-event='toggle-menu']");
const menu = document.querySelector("[data-target='mobile-menu']");
const profileBtn = document.querySelector("[data-event='toggle-profile-menu']");
const profileMenu = document.querySelector("[data-target='profile-menu']");

document.addEventListener("click", function (e) {
    if (!menu.contains(e.target) && !menuBtn.contains(e.target)) {
        menu.classList.add("translate-x-full");
    }
    if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
        profileMenu.classList.add("hidden");
        profileMenu.classList.add("opacity-0");
    }
});

menuBtn.addEventListener("click", function (e) {
    menu.classList.toggle("translate-x-full");
    menu.classList.toggle("translate-x-0");
});

profileBtn.addEventListener("click", function (e) {
    profileMenu.classList.toggle("hidden");
    setTimeout(function () {
        profileMenu.classList.toggle("opacity-0");
    }, 20);
});
