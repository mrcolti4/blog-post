const modalBtn = document.querySelector("button.open-modal");
const modal = document.querySelector(".delete-post-modal");
const modalOverlay = modal.querySelector('.modal-overlay');


modalBtn.addEventListener("click", function (e) {
    modal.classList.toggle("hidden");
});
