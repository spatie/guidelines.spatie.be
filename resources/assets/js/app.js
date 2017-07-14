import Highlight from './modules/highlight';
import Sidebar from './modules/sidebar';
import Turbolinks from 'turbolinks';

Turbolinks.start();

document.addEventListener('turbolinks:load', () => {
    Highlight.start();
    Sidebar.init();
});

document.addEventListener('touchstart', () => {
    document.documentElement.classList.add('touch');
});
