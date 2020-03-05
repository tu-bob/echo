export function validateAudio(file) {
    let types = /(\.|\/)(mp3|ogg|wav)$/i;

    return types.test(file.type) || types.test(file.name);
}
