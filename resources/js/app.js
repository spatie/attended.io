import Refraction from '../../vendor/spatie/laravel-refraction/runtime/react';

const refraction = new Refraction();

refraction.context(() => {
    const context = require.context('./components', true, /\.js$/i);

    if (module.hot) {
        module.hot.accept(context.id, () => {
            refraction.reload();
        });
    }

    return context;
});

refraction.mount();
