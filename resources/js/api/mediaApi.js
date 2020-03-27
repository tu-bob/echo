import {kvpToQueryParam} from "../util/stringHelper";

export async function fetchGenres() {
    return axios.get('/media/music/genre')
}

export async function fetchArtistAliasesByName(name) {
    return axios.get(`/media/artist/alias/filter?name=${name}`);
}

export async function fetchFilteredAlbums(filters) {
    return axios.get('/media/music/album/filter?' + kvpToQueryParam(filters));
}

export async function fetchSong(id) {
    return axios.get(`/media/music/song/${id}`);
}

export async function fetchAlbum(id) {
    return axios.get(`/media/music/album/${id}`);
}

export async function fetchAlbumTypes() {
    return axios.get('/media/music/album/types');
}

//Music
export async function fetchSongs(filters) {
    return axios.get('/media/music/song/list?' + kvpToQueryParam(filters));
}

export function getAlbumCoverUrl(id) {
    return `/media/music/album/${id}/cover`;
}

export function getSongIconUrl(id) {
    return `/media/music/song/${id}/icon`;
}
