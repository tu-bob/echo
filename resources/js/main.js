export function getStoreOrUpdateAction(id, url) {console.log(id);
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
