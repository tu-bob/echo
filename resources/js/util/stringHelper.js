export function kvpToQueryParam(kvArray) {
    let query = '';
    for (let key in kvArray) {
        query += `${key}=${kvArray[key]}&`;
    }
    return query;
}
