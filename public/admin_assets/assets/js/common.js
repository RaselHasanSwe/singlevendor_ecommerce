function deleteAlert(formId) {
    $.confirm({
        title: 'Alert!',
        content: 'Are you sure to delete this item?',
        buttons: {
            confirm: function () {
                formId.submit();
            },
            cancel: function () {

            },
        }
    });
}
// Image viewer
$(document).ready(function(){
    $(document).on('change', '.wizard-picture', function(){
        readURL(this);
    })
});
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(input).closest('.picture').find('.picture-src').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
