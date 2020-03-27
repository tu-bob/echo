import {kvpToQueryParam} from "../util/stringHelper";

export async function fetchPost(id) {
    return axios.get(`/blog/post/${id}`)
}

export async function fetchPosts(filters) {
    return axios.get('/blog/post/list?' + kvpToQueryParam(filters));
}
