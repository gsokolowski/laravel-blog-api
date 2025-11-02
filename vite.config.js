import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    // 👇 Add this section
    server: {
        host: "localhost", // or '0.0.0.0' if you want to access it externally
        port: 5173, // change this to the port you want
        strictPort: true, // optional: will fail if the port is already in use (instead of auto-switching)
        hmr: {
            host: "localhost", // sometimes needed for Laravel/Vite hot reload to work correctly
        },
    },
});
