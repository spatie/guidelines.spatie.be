import { $ } from '../util/dom';

/*
 * Sidebar
 */

function showSidebar() {
    document.documentElement.classList.add('-mobile-sidebar-visible');
}

function hideSidebar() {
    document.documentElement.classList.remove('-mobile-sidebar-visible');
}

function toggleSidebar() {
    document.documentElement.classList.toggle('-mobile-sidebar-visible');
}

function registerSidebarEvents() {
    $('.js-sidebar-show').on('click', showSidebar);
    $('.js-sidebar-hide').on('click', hideSidebar);
    $('.js-sidebar-toggle').on('click', toggleSidebar);
}

/*
 * Sidebar toggler
 */

function showSidebarToggler() {
    document.documentElement.classList.remove('-sidebar-toggler-hidden');
}

function hideSidebarToggler() {
    document.documentElement.classList.add('-sidebar-toggler-hidden');
}

function applySidebarTogglerState(prevState) {
    const y = window.scrollY;

    // If we're on top of the page, show the toggler.
    if (y < (window.outerHeight / 2)) {
        showSidebarToggler();
        return { lastChange: y };
    }

    // If the scroll position hasn't changed more than 40px in a single 
    // direction, do nothing.
    if (Math.abs(y - prevState.lastChange) < 40) {
        return prevState;
    }

    // If we've scrolled up, show the toggler, otherwide, hide it.
    if (y < prevState.lastChange) {
        showSidebarToggler();
    } else {
        hideSidebarToggler();
    }

    return { lastChange: y };
}

function registerSidebarTogglerEvents() {
    const updateSidebarTogglerState = state => {
        const newState = applySidebarTogglerState(state);
        
        requestAnimationFrame(
            () => updateSidebarTogglerState(newState)
        );
    };

    updateSidebarTogglerState({ lastChange: window.scrollY });
}

/*
 * Main export
 */

function init() {
    registerSidebarEvents();
    registerSidebarTogglerEvents();
}

export default { init }
