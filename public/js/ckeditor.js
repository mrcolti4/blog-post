const { ClassicEditor } = require("ckeditor5");

document.addEventListener("DOMContentLoaded", function () {
    ClassicEditor.create(document.querySelector("#editor")).catch((error) => {
        console.error(error);
    });
});
