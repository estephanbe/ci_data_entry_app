$(function () {

    var listCheckAll = false;

    if ($('#uae-select-all-wrapper').length) {
        $('#uae-select-all-wrapper').change(function (e) {
            listCheckAll = !listCheckAll;
            e.preventDefault();
            var checkboxes = $('#aue-main-table .uae-select');
            checkboxes.each((i, e) => {
                $(e).prop('checked', false);
            });
            checkboxes.prop('checked', listCheckAll);
        });
    }

    if ($('#uae-group-action-print')) {
        $('#uae-group-action-print').click(() => {
            window.print();
        });
    }

    if ($('#aue-users-table').length) {
        var myModal = new bootstrap.Modal(document.getElementById('passwordUpdate'));
        $('.uae-user-action-btn').click((e) => {
            e.preventDefault();
            myModal.show();
        });

        $('#uae-form-submit-btn').click((e) => {
            e.preventDefault();
            var empty_validation = true;
            var match_validation = true;
            if ($('#uae-pass').val() === '' || $('#uae-pass-again').val() === '') {
                $('#uae-pass-validation-error-empty').removeClass('d-none');
                empty_validation = false
            } else {
                $('#uae-pass-validation-error-empty').addClass('d-none');
                empty_validation = true
            }
            
            if ($('#uae-pass').val() !== $('#uae-pass-again').val()) {
                $('#uae-pass-validation-error').removeClass('d-none');
                match_validation = false
            } else {
                $('#uae-pass-validation-error').addClass('d-none');
                match_validation = true
            }
            
            
            if (empty_validation && match_validation) {
                $('#uae-pass-submission-form').submit();
            }
        });
    }

});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#aue-single-add-img')
                .attr('src', e.target.result)
        };

        reader.readAsDataURL(input.files[0]);
    }
}