import {divideAdnRoundToInt} from './math'

export function kvpToQueryParam(kvArray) {
    let query = '';
    for (let key in kvArray) {
        query += `${key}=${kvArray[key]}&`;
    }
    return query;
}

export function concatStrings(array, delimiter) {
    let result = '';
    for (let i = 0; i < array.length; i++) {
        result += array[i];
        if (i < array.length - 1)
            result += delimiter + ' ';
    }
    return result;
}

export function secondsToFormattedMinutes(second) {
    let sec = second % 60;
    let result = `${divideAdnRoundToInt(second, 60)}:${sec}`;
    if (sec < 10)
        result += '0';
    return result;
}
