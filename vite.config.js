import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      buildDirectory: 'vendor/social-shareable',
      input: ['resources/assets/js/shareable-widget.js'],
      refresh: true,
    }),
  ],
  build: {
    lib: {
        entry: 'resources/assets/js/shareable-widget.js',
        name: 'ShareableWidget',
        formats: ['es'],
    },
    rollupOptions: {
      external: ['lit', /^@dile\/ui/, /^@dile\/iconlib/],
      output: {
        entryFileNames: 'assets/shareable-widget.js',
        assetFileNames: 'assets/[name].[ext]',
      },
    },
  },
});
