$(document).ready(function (){
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
