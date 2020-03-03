export function getStoreOrUpdateAction(id, url) {
    let action = {
        url: url,
        method: 'post'
    };

    if (id) {
        action.url += id;
        action.method = 'put';
    }

    return action;
}
