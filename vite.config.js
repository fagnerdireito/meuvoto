import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: [
                ...refreshPaths,
                'resources/views/livewire/**/*.blade.php',
                'app/Http/Livewire/**',
                'app/Livewire/**',
                'app/Tables/Columns/**',
                'app/Forms/Components/**',
                'app/Filament/**',
                'app/Http/**',
                'resources/**',
                'resources/css/**/**/**',
                'resources/views/**',
                'resources/views/filament/pub/**',
                'resources/routes/**',
                'routes/**',
                'app/**',
                'app/Providers/Filament/**',
            ],
        }),
    ],
});
