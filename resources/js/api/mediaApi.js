import {kvpToQueryParam} from "../util/stringHelper";

export async function fetchGenres() {
    return axios.get('/media/music/genre')
}

export async function fetchGenresList() {
    return axios.get('/media/music/genre/list')
}

export async function fetchArtistAliasesByName(name) {
    return axios.get(`/media/artist/alias/filter?name=${name}`);
}

export async function fetchAlbums(filters, options) {
    return axios.get('/media/music/album/list?' + kvpToQueryParam(filters), options);
}

export async function findAlbums(queries) {
    return axios.get('/media/music/album/filter?' + kvpToQueryParam(queries));
}

export async function fetchAlbum(id) {
    return axios.get(`/media/music/album/${id}`);
}

export async function fetchAlbumTypes() {
    return axios.get('/media/music/album/types');
}

export async function fetchAlbumSongs(id) {
    return axios.get(`/media/music/album/${id}/songs`);
}

export async function fetchSong(id) {
    return axios.get(`/media/music/song/${id}`);
}

export async function fetchSongs(filters, options) {
    return axios.get('/media/music/song/list?' + kvpToQueryParam(filters), options);
}

export function fetchArtists(filters, options) {
    return axios.get('/media/artist/list?' + kvpToQueryParam(filters), options);
}

export function getAlbumCoverUrl(id) {
    return `/media/music/album/${id}/cover`;
}

// export async function increaseAlbumPlayCount(id) {
//     return axios.put(`/media/music/album/${id}/play`);
// }

//albumCover -> get album cover if song doesnt have icon
export function getSongIconUrl(id, params, albumCover = true) {
    return `/media/music/song/${id}/icon?album=${albumCover}&` + kvpToQueryParam(params);
}

export function getBlogImage(image) {
    return getImageUrl(image, 'blog')
}

export function getCoverImage(image) {
    return getImageUrl(image, 'cover')
}

export function getAvatarImage(image) {
    return getImageUrl(image, 'avatar')
}

export function getImageUrl(image, type) {
    return `/media/image/${image}/${type}`;
}

export function fetchVideos(filters, options) {
    return axios.get('/media/video/list?' + kvpToQueryParam(filters), options);
}

export function fetchAudioFile(id) {
    return `/media/music/song/${id}/audio`;
}

export function increaseMediaPlayCount(id, type) {
    return axios.put(`/media/music/${type}/${id}/play`).catch();
}

export function increaseMediaCount(id, type, counter) {
    let base = '/media/music/';
    if (type === 'video')
        base = '/media/';
    return axios.put(`${base}${type}/${id}/${counter}
    `).catch();
}

//CHART
// export async function fetchTopSongs() {
//     return axios.get('/media/music/chart/songs');
// }

//Search
export async function search(query) {
    return axios.get(`/media/search/${query}`);
}
