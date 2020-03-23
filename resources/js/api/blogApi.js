export async function fetchPost(id) {
    return axios.get(`/blog/post/${id}`)
}
