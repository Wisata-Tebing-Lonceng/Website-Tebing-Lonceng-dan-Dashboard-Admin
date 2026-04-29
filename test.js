const fs = require('fs');
const { compile } = require('vue/compiler-dom');

const html = fs.readFileSync('views/user/home.php', 'utf8');
const startIndex = html.indexOf('<div id=\"app\"');
const endIndex = html.indexOf('</div> <!-- END #app -->') + 24;
const appHtml = html.substring(startIndex, endIndex);

try {
    compile(appHtml, {
        onError: (err) => {
            console.error('Compiler Error:', err.message, 'at line', err.loc?.start?.line);
        }
    });
    console.log('Compiled successfully');
} catch (e) {
    console.error('Crash:', e.message);
}
