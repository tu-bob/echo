function handleUnauthorized() {
    window.location.href = '/login';
}

function handleServerValidationError(e) {
    window.Vue.prototype.$eventHub.$emit('validation-failed', e);
}

export function handleHtmlError(e) {
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
