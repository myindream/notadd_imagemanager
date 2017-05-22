import ImageManager from '../pages/ImageManager.vue';

export default function (injection) {
    injection.useExtensionRoute([
        {
            beforeEnter: injection.middleware.requireAuth,
            component: ImageManager,
            path: 'imagesmanager',
        },
    ]);
}