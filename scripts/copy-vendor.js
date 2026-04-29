const fs = require('fs');
const path = require('path');

const copies = [
  // Vue 3
  {
    src: 'node_modules/vue/dist/vue.global.prod.js',
    dest: 'assets/vendor/vue.global.prod.js'
  },
  // GSAP core
  {
    src: 'node_modules/gsap/dist/gsap.min.js',
    dest: 'assets/vendor/gsap.min.js'
  },
  // GSAP ScrollTrigger
  {
    src: 'node_modules/gsap/dist/ScrollTrigger.min.js',
    dest: 'assets/vendor/ScrollTrigger.min.js'
  },
  // Chart.js
  {
    src: 'node_modules/chart.js/dist/chart.umd.min.js',
    dest: 'assets/vendor/chart.umd.min.js'
  },
  // Swiper Web Components bundle
  {
    src: 'node_modules/swiper/swiper-element-bundle.min.js',
    dest: 'assets/vendor/swiper-element-bundle.min.js'
  },
  // Cally (calendar web component)
  {
    src: 'node_modules/cally/dist/cally.js',
    dest: 'assets/vendor/cally.js'
  },
  // Lenis (smooth scroll — replaces ScrollSmoother)
  {
    src: 'node_modules/lenis/dist/lenis.min.js',
    dest: 'assets/vendor/lenis.min.js'
  },
];

// Create required directories
fs.mkdirSync('assets/vendor', { recursive: true });
fs.mkdirSync('assets/css', { recursive: true });
fs.mkdirSync('assets/fonts', { recursive: true });

let success = 0;
let failed = 0;

copies.forEach(({ src, dest }) => {
  if (fs.existsSync(src)) {
    fs.mkdirSync(path.dirname(dest), { recursive: true });
    fs.copyFileSync(src, dest);
    console.log(`\x1b[32m✓\x1b[0m Copied: ${dest}`);
    success++;
  } else {
    console.warn(`\x1b[33m✗\x1b[0m Not found: ${src}`);
    failed++;
  }
});

console.log(`\n\x1b[32m${success} files copied\x1b[0m${failed > 0 ? `, \x1b[33m${failed} not found\x1b[0m` : ''}`);
console.log('\nNext steps:');
console.log('  npm run build:css   (build Tailwind once)');
console.log('  npm run dev:css     (watch mode for development)');
