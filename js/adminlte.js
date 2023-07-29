/*
 * Copyright (c) 2023.
 * @author David Xu <david.xu.uts@163.com>
 * All rights reserved.
 */

function successMsg (msg) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        title: msg,
        showConfirmButton: false,
        timerProgressBar: true,
        icon: 'success',
        timer: 1500
    })
}

function infoMsg (msg) {
    Swal.fire({
        toast: true,
        position: 'center',
        title: msg,
        showConfirmButton: false,
        icon: 'info',
    })
}

function errorMsg (msg) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        title: msg,
        showConfirmButton: false,
        icon: 'error'
    })
}

function getAjaxUpdateUrl(url) {
    if (url === undefined || url === '') {
        url = location.pathname.split('/')
    } else {
        url = url.split('/')
    }
    url.splice($.inArray(url[url.length - 1]), 1)
    return url.join('/') + '/sort-order'
}

function editOrder(obj) {
    let id = $(obj).attr('data-id')
    if (!id) {
        id = $(obj).parent().parent().attr('id')
    }
    if (!id) {
        id = $(obj).parent().parent().attr('data-key')
    }
    let order = $(obj).val()
    if (isNaN(order)) {
        errorMsg($(obj).attr('data-message'))
        return false
    } else {
        let url = getAjaxUpdateUrl($(obj).attr('data-current-url'))
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {
                id: id,
                order: order,
            },
            success: function (response) {
                console.log(response, typeof response)
                if (parseInt(response.code) !== 200) {
                    errorMsg(response.message)
                }
            }
        })
    }
}

$(document).ready(function () {
    $('#modal').on('hidden.bs.modal', function (event) {
        let modal = $(this)
        modal.find('.modal-content').html('Loading ...');
        modal.removeData('bs.modal')
    }).on('show.bs.modal', function (event) {
        let modal = $(this)
        let target = $(event.relatedTarget)
        let modalDialog = modal.find('.modal-dialog')
        const modalClasses = ['modal-sm', 'modal-lg', 'modal-xl']
        if ($.inArray(target.data('modal-class'), modalClasses) > -1) {
            modalDialog.addClass(target.data('modal-class'))
        }
        modal.find('.modal-content').load(target.attr('href'))
    })
})
