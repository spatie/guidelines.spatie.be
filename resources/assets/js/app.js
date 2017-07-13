import Highlight from './modules/highlight';
import Turbolinks from 'turbolinks';

Turbolinks.start();

document.addEventListener('turbolinks:load', () => {
    Highlight.start();
});

document.addEventListener('touchstart', () => {
    document.documentElement.classList.add('touch');
});
