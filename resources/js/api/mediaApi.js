import {kvpToQueryParam} from "../util/stringHelper";

export async function fetchGenres() {
    return axios.get('/media/music/genre')
}

export async function fetchArtistAliasesByName(name) {
    return axios.get(`/media/artist/alias/filter?name=${name}`);
}

export async function fetchAlbums(filters) {
    return axios.get('/media/music/album/list?' + kvpToQueryParam(filters));
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


export async function fetchSongs(filters) {
    return axios.get('/media/music/song/list?' + kvpToQueryParam(filters));
}

export function getAlbumCoverUrl(id) {
    return `/media/music/album/${id}/cover`;
}
//albumCover -> get album cover if song doesnt have icon
export function getSongIconUrl(id, albumCover = true) {
    return `/media/music/song/${id}/icon?album=${albumCover}`;
}

export function getBlogImage(image) {
    return getImageUrl(image, 'blog')
}

export function getImageUrl(image, type) {
    return `/media/image/${image}/${type}`;
}
