import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import "../../css/ckeditor-dark.css";

function setListenerOnFileInput(preview, input) {
    input.addEventListener("change", function (e) {
        const [file] = input.files;

        if (file) {
            preview.src = URL.createObjectURL(file);
        }
    });
}

const posterUpload = document.querySelector("input.poster_image-upload");
const poster = document.querySelector("img.poster_image");
const heroUpload = document.querySelector("input.hero_image-upload");
const hero = document.querySelector("img.hero_image");

setListenerOnFileInput(poster, posterUpload);
setListenerOnFileInput(hero, heroUpload);

window.ClassicEditor = ClassicEditor;
