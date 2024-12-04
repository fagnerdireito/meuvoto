import { defineConfig } from 'vite'
import laravel, { refreshPaths } from 'laravel-vite-plugin'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                'resources/js/app.js',
                'resources/css/filament/admin/theme.css'
            ],
            refresh: [
                ...refreshPaths,
                'app/Filament/**',
                'app/Forms/Components/**',
                'app/Livewire/**',
                'app/Infolists/Components/**',
                'app/Providers/Filament/**',
                'app/Tables/Columns/**',
                'resources/views/filament/resources/**',
                'app/Filament/Resources/**',
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
})
