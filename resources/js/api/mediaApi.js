import {kvpToQueryParam} from "../util/stringHelper";

export async function fetchGenres() {
    return axios.get('/media/music/genre')
}

export async function fetchArtistAliasesByName(name) {
    return axios.get(`/media/artist/alias/filter?name=${name}`);
}

export async function fetchFilteredAlbums(params) {
    return axios.get('/media/music/album/filter?' + kvpToQueryParam(params));
}

export async function fetchSong(id) {
    return axios.get(`/media/music/song/${id}`);
}


