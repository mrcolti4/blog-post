document.addEventListener("DOMContentLoaded", function () {
    const flashMessage = document.getElementById("flash-message");

    setTimeout(function () {
        flashMessage.style.opacity = "0";

        setTimeout(function () {
            flashMessage.style.display = "none";
        }, 300); // Время анимации исчезновения
    }, 3000); // Время отображения сообщения
});
