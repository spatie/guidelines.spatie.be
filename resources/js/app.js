const Highlight = require('./modules/highlight');
const Sidebar = require('./modules/sidebar');
const Turbolinks = require('turbolinks');

Turbolinks.start();

document.addEventListener('turbolinks:load', () => {
    Highlight.init();
    Sidebar.init();
});
