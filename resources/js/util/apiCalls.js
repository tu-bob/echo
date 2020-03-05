export async function fetchGenres() {
    return axios.get('/media/music/genre')
}

export async function fetchArtistAliasesByName(name) {
    return axios.get(`/media/artist/alias/filter?name=${name}`);
}
