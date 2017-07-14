export function $(selector, scope = document) {
    return scope.querySelector(selector);
}

export function $$(selector, scope = document) {
    return [...scope.querySelectorAll(selector)];
}

export function on(event, element, handler) {
    element.addEventListener(event, e => { 
        handler.call(element, e);
    });
}
