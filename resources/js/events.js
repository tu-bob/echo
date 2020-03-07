export function invokeErrorResetRequested() {
    window.Vue.prototype.$eventHub.$emit('error-reset-requested');
}
