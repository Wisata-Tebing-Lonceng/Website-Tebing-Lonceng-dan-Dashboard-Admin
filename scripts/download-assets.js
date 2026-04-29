const fs = require('fs');
const path = require('path');
const https = require('https');

const UIconsCSSUrls = [
  { url: 'https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css', dest: 'assets/vendor/uicons-regular-rounded/css/uicons-regular-rounded.css' },
  { url: 'https://cdn-uicons.flaticon.com/2.1.0/uicons-brands/css/uicons-brands.css', dest: 'assets/vendor/uicons-brands/css/uicons-brands.css' },
  { url: 'https://cdn-uicons.flaticon.com/uicons-solid-rounded/css/uicons-solid-rounded.css', dest: 'assets/vendor/uicons-solid-rounded/css/uicons-solid-rounded.css' }
];

const GoogleFontsUrl = 'https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter:wght@300;400;500;600;700;800&display=swap';

function downloadFile(url, dest, options = {}) {
  return new Promise((resolve, reject) => {
    fs.mkdirSync(path.dirname(dest), { recursive: true });
    const file = fs.createWriteStream(dest);
    https.get(url, options, (response) => {
      if (response.statusCode === 200) {
        response.pipe(file);
        file.on('finish', () => {
          file.close(resolve);
        });
      } else if (response.statusCode === 301 || response.statusCode === 302) {
        downloadFile(response.headers.location, dest, options).then(resolve).catch(reject);
      } else {
        reject(`Failed with status: ${response.statusCode}`);
      }
    }).on('error', (err) => {
      fs.unlink(dest, () => reject(err.message));
    });
  });
}

async function downloadUIcons() {
  console.log('Downloading UIcons CSS...');
  for (const item of UIconsCSSUrls) {
    await downloadFile(item.url, item.dest);
    console.log(`✓ Downloaded ${item.dest}`);
    
    // Read the CSS to find font files (woff2, woff, ttf)
    let css = fs.readFileSync(item.dest, 'utf-8');
    const urlRegex = /url\(['"]?(.*?\.(woff2|woff|ttf|eot|svg)(\?.*?)?)['"]?\)/g;
    let match;
    const fontUrls = [];
    while ((match = urlRegex.exec(css)) !== null) {
      fontUrls.push(match[1]);
    }
    
    // Download font files
    const baseUrl = new URL(item.url);
    const basePath = path.dirname(baseUrl.pathname);
    
    for (const fontUrl of [...new Set(fontUrls)]) {
      // Resolve URL relative to the CSS URL
      let fullUrl;
      if (fontUrl.startsWith('http')) {
        fullUrl = fontUrl;
      } else {
        fullUrl = `${baseUrl.origin}${path.resolve(basePath, fontUrl).replace(/\\/g, '/')}`;
      }
      
      const fileName = path.basename(fontUrl).split('?')[0];
      const fontDest = path.join(path.dirname(item.dest), '../fonts', fileName);
      
      try {
        await downloadFile(fullUrl, fontDest);
        console.log(`  ✓ Downloaded font ${fileName}`);
        
        // Rewrite CSS to point to local fonts
        css = css.replace(new RegExp(fontUrl.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'), 'g'), `../fonts/${fileName}`);
      } catch (err) {
        console.error(`  ✗ Failed to download font ${fullUrl}: ${err}`);
      }
    }
    fs.writeFileSync(item.dest, css);
  }
}

async function downloadGoogleFonts() {
  console.log('Downloading Google Fonts...');
  const cssDest = 'assets/css/fonts.css';
  const options = {
    headers: {
      // Use a modern Chrome User-Agent to ensure we get WOFF2
      'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
    }
  };
  
  await downloadFile(GoogleFontsUrl, cssDest, options);
  console.log(`✓ Downloaded Google Fonts CSS`);
  
  let css = fs.readFileSync(cssDest, 'utf-8');
  const urlRegex = /url\((https:\/\/fonts\.gstatic\.com\/s\/.*?\.woff2)\)/g;
  let match;
  const fontUrls = [];
  while ((match = urlRegex.exec(css)) !== null) {
    fontUrls.push(match[1]);
  }
  
  for (const fontUrl of [...new Set(fontUrls)]) {
    // Extract a nice filename from the font URL
    const parts = fontUrl.split('/');
    const family = parts[4];
    const fileName = `${family}-${parts[parts.length-1]}`;
    const fontDest = path.join('assets/fonts', fileName);
    
    try {
      await downloadFile(fontUrl, fontDest);
      console.log(`  ✓ Downloaded font ${fileName}`);
      
      // Rewrite CSS to point to local fonts
      css = css.replace(new RegExp(fontUrl.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&'), 'g'), `../fonts/${fileName}`);
    } catch (err) {
      console.error(`  ✗ Failed to download font ${fontUrl}: ${err}`);
    }
  }
  fs.writeFileSync(cssDest, css);
}

async function run() {
  try {
    await downloadUIcons();
    await downloadGoogleFonts();
    console.log('\n\x1b[32mAll assets downloaded successfully!\x1b[0m');
  } catch (err) {
    console.error('Error:', err);
  }
}

run();
