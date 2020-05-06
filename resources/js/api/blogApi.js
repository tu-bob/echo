import {kvpToQueryParam} from "../util/stringHelper";

export async function fetchCategories() {
    return axios.get(`/blog/category/list`);
}

export async function fetchPost(idOrSlug) {
    return axios.get(`/blog/post/${idOrSlug}`)
}

export async function fetchPosts(filters, options) {
    return axios.get('/blog/post/list?' + kvpToQueryParam(filters), options);
}

export async function search(query) {
    return axios.get(`/blog/search/${query}`);
}
