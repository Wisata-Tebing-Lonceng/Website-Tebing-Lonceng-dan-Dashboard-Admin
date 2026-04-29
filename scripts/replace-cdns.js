const fs = require('fs');
const path = require('path');

const filesToUpdate = [
  { path: 'views/user/home.php', prefix: 'assets/' },
  { path: 'views/user/sejarah.php', prefix: 'assets/' },
  { path: 'views/user/galeri.php', prefix: 'assets/' },
  { path: 'views/admin/dashboard.php', prefix: '../assets/' },
  { path: 'views/admin/overview.php', prefix: '../assets/' },
  { path: 'views/admin/fasilitas.php', prefix: '../assets/' },
  { path: 'views/admin/galleries.php', prefix: '../assets/' },
  { path: 'views/admin/reviews.php', prefix: '../assets/' },
  { path: 'views/admin/settings.php', prefix: '../assets/' },
  { path: 'admin/dashboard.php', prefix: '../assets/' }, // Wait, the actual files in admin/ just include the views/admin/ files!
  { path: 'views/admin/login.php', prefix: '../assets/' }
];

// Let me verify which files actually have the HTML <head>.
// It's the ones in views/user/ and views/admin/.

const cdnRegexes = [
  /<link href="https:\/\/cdn\.jsdelivr\.net\/npm\/daisyui@5".*?>\s*/g,
  /<script src="https:\/\/cdn\.tailwindcss\.com"><\/script>\s*/g,
  /<script>\s*tailwind\.config = {[\s\S]*?}\s*<\/script>\s*/g,
  /<link rel="preconnect" href="https:\/\/fonts\.googleapis\.com">\s*/g,
  /<link rel="preconnect" href="https:\/\/fonts\.gstatic\.com" crossorigin>\s*/g,
  /<link href="https:\/\/fonts\.googleapis\.com\/css2\?family=Instrument\+Serif.*?rel="stylesheet".*?>\s*/g,
  /<script src="https:\/\/unpkg\.com\/vue@3\/dist\/vue\.global\.(prod\.)?js"><\/script>\s*/g,
  /<script src="https:\/\/cdn\.jsdelivr\.net\/npm\/vue@3\/dist\/vue\.global\.prod\.js"><\/script>\s*/g,
  /<script src="https:\/\/cdn\.jsdelivr\.net\/npm\/gsap@3\.15\/dist\/gsap\.min\.js"><\/script>\s*/g,
  /<script src="https:\/\/cdn\.jsdelivr\.net\/npm\/gsap@3\.15\/dist\/ScrollTrigger\.min\.js"><\/script>\s*/g,
  /<!-- GSAP ScrollSmoother.*?-->\s*/g,
  /<script src="https:\/\/assets\.codepen\.io\/16327\/ScrollSmoother\.min\.js"><\/script>\s*/g,
  /<script src="https:\/\/cdn\.jsdelivr\.net\/npm\/swiper@11\/swiper-element-bundle\.min\.js"><\/script>\s*/g,
  /<script type="module" src="https:\/\/unpkg\.com\/cally"><\/script>\s*/g,
  /<link rel='stylesheet' href='https:\/\/cdn-uicons\.flaticon\.com\/2\.1\.0\/uicons-regular-rounded\/css\/uicons-regular-rounded\.css'>\s*/g,
  /<link rel='stylesheet' href='https:\/\/cdn-uicons\.flaticon\.com\/2\.1\.0\/uicons-brands\/css\/uicons-brands\.css'>\s*/g,
  /<link rel='stylesheet' href='https:\/\/cdn-uicons\.flaticon\.com\/uicons-regular-rounded\/css\/uicons-regular-rounded\.css'>\s*/g,
  /<link rel='stylesheet' href='https:\/\/cdn-uicons\.flaticon\.com\/uicons-solid-rounded\/css\/uicons-solid-rounded\.css'>\s*/g,
  /<script src="https:\/\/cdn\.jsdelivr\.net\/npm\/chart\.js"><\/script>\s*/g,
];

filesToUpdate.forEach(item => {
  const filePath = path.resolve(__dirname, '..', item.path);
  if (!fs.existsSync(filePath)) {
    console.log(`Skipping ${item.path} (not found)`);
    return;
  }
  
  let content = fs.readFileSync(filePath, 'utf8');
  
  // 1. Remove all old CDNs
  cdnRegexes.forEach(regex => {
    content = content.replace(regex, '');
  });
  
  // 2. Inject local paths
  // Find </title>
  const titleMatch = content.match(/<title>.*?<\/title>\s*/);
  if (titleMatch) {
    const p = item.prefix;
    
    let injected = `
    <!-- CSS -->
    <link rel="stylesheet" href="${p}css/fonts.css">
    <link rel="stylesheet" href="${p}css/app.css">
    <link rel="stylesheet" href="${p}vendor/uicons-regular-rounded/css/uicons-regular-rounded.css">`;
    
    if (content.includes('brands') || item.path === 'views/user/home.php') {
      injected += `\n    <link rel="stylesheet" href="${p}vendor/uicons-brands/css/uicons-brands.css">`;
    }
    if (content.includes('solid') || item.path === 'views/admin/overview.php') {
      injected += `\n    <link rel="stylesheet" href="${p}vendor/uicons-solid-rounded/css/uicons-solid-rounded.css">`;
    }
    
    injected += `\n
    <!-- JS -->
    <script src="${p}vendor/vue.global.prod.js"></script>
    <script src="${p}vendor/gsap.min.js"></script>`;
    
    if (item.path.includes('user/home.php') || item.path.includes('user/sejarah.php') || item.path.includes('user/galeri.php')) {
      injected += `\n    <script src="${p}vendor/ScrollTrigger.min.js"></script>`;
      injected += `\n    <script src="${p}vendor/lenis.min.js"></script>`;
    }
    if (item.path.includes('user/home.php')) {
      injected += `\n    <script src="${p}vendor/swiper-element-bundle.min.js"></script>`;
      injected += `\n    <script type="module" src="${p}vendor/cally.js"></script>`;
    }
    if (item.path.includes('admin/overview.php')) {
      injected += `\n    <script src="${p}vendor/chart.umd.min.js"></script>`;
    }
    
    injected += '\n';
    
    // Insert after title
    content = content.replace(titleMatch[0], titleMatch[0] + injected);
  }
  
  // 3. Lenis specific changes
  if (item.path.includes('user/home.php') || item.path.includes('user/sejarah.php')) {
    // Remove wrapper tags
    content = content.replace(/<div id="smooth-wrapper">\s*<div id="smooth-content">\s*/g, '');
    content = content.replace(/<\/div>\s*<!-- \/smooth-content -->\s*<\/div>\s*<!-- \/smooth-wrapper -->\s*/g, '');
    content = content.replace(/<\/div>\s*<\/div>\s*<script>/g, '<script>'); // In case no comments
    
    // Replace GSAP ScrollSmoother init with Lenis
    if (item.path.includes('user/home.php')) {
      content = content.replace(/let smootherInstance = null;\s*\/\/ Global reference for ScrollSmoother/g, 'let lenisInstance = null;');
      content = content.replace(/gsap\.registerPlugin\(ScrollTrigger, ScrollSmoother\);/g, 'gsap.registerPlugin(ScrollTrigger);');
      content = content.replace(/\/\/ Create the smooth scroller FIRST before any ScrollTriggers[\s\S]*?smootherInstance = ScrollSmoother\.create\({[\s\S]*?}\);/g, `
                // Initialize Lenis
                lenisInstance = new Lenis({
                    duration: 1.5,
                    easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
                    smoothWheel: true,
                    touchMultiplier: 2
                });
                
                function raf(time) {
                    lenisInstance.raf(time);
                    requestAnimationFrame(raf);
                }
                requestAnimationFrame(raf);

                lenisInstance.on('scroll', ScrollTrigger.update);
                gsap.ticker.add((time) => {
                    lenisInstance.raf(time * 1000);
                });
                gsap.ticker.lagSmoothing(0);
      `);
      // Update data-speed parallax reference
      content = content.replace(/\/\/ Parallax Hero Video via ScrollSmoother data-speed effects/g, '// Parallax Hero Video via GSAP ScrollTrigger');
    }
    
    if (item.path.includes('user/sejarah.php')) {
      content = content.replace(/gsap\.registerPlugin\(ScrollTrigger, ScrollSmoother\);/g, 'gsap.registerPlugin(ScrollTrigger);');
      content = content.replace(/const smoother = ScrollSmoother\.create\({[\s\S]*?}\);/g, `
            // Initialize Lenis
            const lenis = new Lenis({
                duration: 1.5,
                easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t))
            });
            
            function raf(time) {
                lenis.raf(time);
                requestAnimationFrame(raf);
            }
            requestAnimationFrame(raf);

            lenis.on('scroll', ScrollTrigger.update);
            gsap.ticker.add((time) => {
                lenis.raf(time * 1000);
            });
            gsap.ticker.lagSmoothing(0);
      `);
    }
  }

  fs.writeFileSync(filePath, content, 'utf8');
  console.log(`Updated ${item.path}`);
});
