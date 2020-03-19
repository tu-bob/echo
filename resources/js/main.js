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

export function generateId() {
    return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
}

export function uploadFiles(files, uploadUrl, name = 'files') {
    let data = new FormData();
    for (let i = 0; i < files.length; i++) {
        data.append(`${name}[]`, files[i], files[i].name)
    }

    return axios.post(uploadUrl, data)
}
