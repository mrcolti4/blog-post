const modalBtn = document.querySelector("button.open-modal");
const modalOverlay = document.querySelector(".delete-post-modal");
const modal = modalOverlay.querySelector(".delete-modal");
const closeBtns = modal.querySelectorAll("button.close-modal");

function toggleModal(){
    modalOverlay.classList.toggle("hidden");
}

modalBtn.addEventListener("click",  toggleModal);

modalOverlay.addEventListener("click", function(e) {
    if(e.target === modalOverlay) {
        toggleModal()
    }
})

closeBtns.forEach(btn => {
    btn.addEventListener("click", toggleModal);
});

document.addEventListener("keydown", function(e) {
    if (e.key === "Escape" && !modalOverlay.classList.contains("hidden")) {
        toggleModal();
    }
});
