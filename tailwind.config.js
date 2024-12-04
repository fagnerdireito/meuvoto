import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './app/Livewire/**/*.php',
        './resources/views/filament/resources/**/*.blade.php',
        './app/Filament/Resources/**/*.php',
        './app/Filament/App/**/*.php',
        './resources/views/filament/app/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './resources/views/vendor/filament-forms/components/**',
        './resources/views/vendor/filament-tables/components/**',
        './resources/views/filament/app/pages/legado/**',
        './resources/views/filament/app/pages/legado/**/*.blade.php',
        './resources/views/filament/app/pages/**/*.blade.php',
        './app/Filament/**/*.php',
        './resources/css/filament/app/**/*.css',
        './resources/views/filament/admin/**/*.blade.php',
        './resources/views/livewire/**/*.blade.php',
    ],
}
