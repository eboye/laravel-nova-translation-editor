Nova.booting((Vue, router, store) => {
    router.addRoutes([
        {
            name: 'laravel-nova-translation-editor',
            path: '/laravel-nova-translation-editor',
            component: require('./components/Tool'),
        },
    ])
})
