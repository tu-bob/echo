function handleUnauthorized() {
    app.$router.push({
        name: 'login',
        query: {
            redirectUrl: window.location.pathname.slice(4, window.location.pathname.length)
        }
    })
}

function handleServerValidationError(e) {
    // window.Vue.prototype.$eventHub.$emit('validation-failed', e);
}

export function handleHtmlError(e) {
    app.$store.commit('ADD_HTML_ERROR', e);
    switch (e.status) {
        case 401:
            handleUnauthorized();
            break;
        case 422:
            handleServerValidationError(e);
            break;
        default:
            console.log('unexpected error', e, e.status);
            break;
    }
}
