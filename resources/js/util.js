// Source: https://medium.com/@_jh3y/throttling-and-debouncing-in-javascript-b01cad5c8edf
export function debounce(callback, delay) {
    let inDebounce;
    return function() {
        const context = this;
        const args = arguments;
        clearTimeout(inDebounce);
        inDebounce = setTimeout(() => callback.apply(context, args), delay);
    };
}
