function handleUnauthorized() {
    window.location.href = '/login';
}

export function handleHtmlError(e) {
    switch (e.status) {
        case '401':
            handleUnauthorized();
            break;
        case '403':
            console.log(2);
            break;
        default:
            console.log('unexpected error', e);
            break;
    }
}
