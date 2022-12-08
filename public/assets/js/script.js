$(document).ready(function () {
    window.livewire.on('scrollContenChat', () => {
        $('#contentChat').scrollTop($('#contentChat').height());
    })
    window.livewire.on('tes', (data) => {
        console.log('halo')
    })
    window.livewire.on('closeModalCreatPost', (data) => {
        // alert('oke')
        $('#modal-create-posting').trigger('click');
    })


});
function closeModalError() {
    $('#modalErrorValidationNewPost').removeClass('modal-open');
}
