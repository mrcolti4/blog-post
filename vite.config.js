import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/ckeditor-dark.css",
                "resources/js/app.js",
                "resources/js/posts/ckeditor.js",
                "resources/js/posts/comments-sort.js",
                "resources/js/posts/profile-slider.js",
                "resources/js/swiper-bundle.min.js",
                "resources/js/posts/show-post.js",
                'resources/js/follow.js',
                'resources/js/posts/modal.js'
            ],
            refresh: true,
        }),
    ],
});
