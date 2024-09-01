import {DEFAULT_URL} from "./constants"

const menuBtn = document.querySelector("[data-event='toggle-menu']");
const menu = document.querySelector("[data-target='mobile-menu']");
// Profile menu
const profileBtn = document.querySelector("[data-event='toggle-profile-menu']");
const profileMenu = document.querySelector("[data-target='profile-menu']");
// Notifications
const notificationsBtn = document.querySelector("[data-event='toggle-notifications']");
const notifications = document.querySelector("div.notifications");

document.addEventListener("click", function (e) {
    if (!menu.contains(e.target) && !menuBtn.contains(e.target)) {
        menu.classList.add("translate-x-full");
    }
    if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
        profileMenu.classList.add("hidden");
        profileMenu.classList.add("opacity-0");
    }

    if (!notifications.contains(e.target) && !notificationsBtn.contains(e.target)) {
        notifications.classList.remove("grid");
        notifications.classList.add("hidden");
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

notificationsBtn.addEventListener("click", function (e) {
    notifications.classList.toggle("hidden");
});

// Mark notification as read
notifications.addEventListener("click", function (e) {
    if (e.target.nodeName !== "BUTTON") return;
    const url = `${DEFAULT_URL}/notifications/mark-as-read`;
    const notification = e.target.closest("div.notification");

    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({id: notification.dataset.id}),
    }).then(() => {
        notification.remove();
        if(notifications.children.length === 0) {
            const title = document.createElement("h3");
            title.classList.add("text-gray-400")
            title.innerHTML = "No new notifications";
            notifications.appendChild(title);
        }
    });
});
