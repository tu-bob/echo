import {divideAdnRoundToInt} from './math'

export function kvpToQueryParam(kvArray) {
    let query = '';
    for (let key in kvArray) {
        query += `${key}=${kvArray[key]}&`;
    }
    return query;
}

export function concatStrings(array, delimiter = ' ') {
    let result = '';
    for (let i = 0; i < array.length; i++) {
        result += array[i];
        if (i < array.length - 1)
            result += delimiter + ' ';
    }
    return result;
}

export function secondsToFormattedMinutes(seconds) {
    let sec = seconds % 60;
    if (sec < 10)
        sec = `0${sec}`;
    return `${divideAdnRoundToInt(seconds, 60)}:${sec}`;
}

export function getYoutubeVideoId(url) {
    let reg = /(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com(?:\/embed\/|\/v\/|\/watch\?v=))([\w-]{10,12})/g;
    let res = reg.exec(url);
    return res?.length > 1 ? res[1] : null;
}

export function getYoutubeEmbedPreview(url) {
    let id = getYoutubeVideoId(url);
    return id ? `https://img.youtube.com/vi/${id}/0.jpg` : null;
}
