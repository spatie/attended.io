import Views from 'laravel-javascript-views/react';

const views = new Views();

views.context(() => {
    const context = require.context('./components', true, /\.js$/i);

    if (module.hot) {
        module.hot.accept(context.id, () => {
            views.reload();
        });
    }

    return context;
});

views.mount();
