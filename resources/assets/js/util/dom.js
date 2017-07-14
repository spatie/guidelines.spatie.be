export function on(event, element, handler) {
    element.addEventListener(event, e => { 
        handler.call(element, e);
    });
}

export function $(selector, scope = document) {
    const elements = [...scope.querySelectorAll(selector)];

    return {
        on(event, handler) {
            elements.forEach(el => on(event, el, handler))
        },
    }
}
