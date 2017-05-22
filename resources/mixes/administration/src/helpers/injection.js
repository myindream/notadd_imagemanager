import {
    mixinRouter,
    mixinSidebar,
} from '../mixes/injection';

const injection = {};

function install(instance) {
    Object.assign(injection, {
        http: instance.http,
        loading: instance.loading,
        message: instance.message,
        sidebar: instance.sidebar,
        trans: instance.trans,
    });
    mixinRouter(instance);
    mixinSidebar(instance);
}

export default Object.assign(injection, {
    install,
});