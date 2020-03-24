export function getStoreOrUpdateAction(id, url) {
    let action = {
        url: url,
        method: 'post'
    };

    if (id) {
        action.url += id;
        action.method = 'put';
    }

    return action;
}

export function generateId() {
    return Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
}

export function uploadFiles(files, uploadUrl, name = 'files') {
    let data = new FormData();
    for (let i = 0; i < files.length; i++) {
        data.append(`${name}[]`, files[i], files[i].name)
    }

    return axios.post(uploadUrl, data)
}

export function setLaravelBackground() {
    $('body').addClass('bg-laravel')
}

export function removeLaravelBackground() {
    $('body').removeClass('bg-laravel')
}

export function movingBorder() {
    let moveToActive = function (el) {
        if (typeof el === 'object' && el.length > 0) {
            el.each(function () {
                let width = $(this).width();
                let left = $(this).position().left;
                $(this).parents('.moving-border').next('.border-hr').css({
                    'width': width + 'px',
                    'margin-left': left + 'px',
                });
            });
        }
    }

    moveToActive($('.moving-border .m-item .active').parents('.m-item'));

    $(window).on('resize', function () {
        moveToActive($('.moving-border .m-item .active').parents('.m-item'));
    });

    $(document).on({
        mouseenter: function (event) {
            moveToActive($(this));
        },
        mouseleave: function () {
            moveToActive($('.moving-border .m-item .active').parents('.m-item'));
        }
    }, '.moving-border .m-item');
}
