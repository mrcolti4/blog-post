import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/ckeditor-dark.css",
                "resources/js/app.js",
                "resources/js/ckeditor.js",
                "resources/js/comments-sort.js",
            ],
            refresh: true,
        }),
    ],
});
