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

    if ($('#uae-action-main-header').length) {
        $('#aue-num-of-entries').change((e) => {
            var value = $('#aue-num-of-entries option:selected').val();
            var url = window.location.href;
            if (url.indexOf('?') > -1) {
                url = window.location.href.slice(0, window.location.href.indexOf('?')+1);
                const queryString = new URL(window.location.href);
                const urlParams = new URLSearchParams(queryString.search.slice(1));
                var counter = 1;
                for (pair of urlParams.entries()){
                    var paramVal = pair[0] === 'per_page' ? value : pair[1];
                    if(counter === 1) {
                        url += pair[0] + '=' + paramVal;
                    } else {
                        url += '&' + pair[0] + '=' + paramVal;
                    }
                    counter++;
                }                
            } else {
                url += '?per_page=' + value;
            }
            // console.log(url);
            window.location.href = url;
        });

        if (window.location.href.indexOf('per_page') > -1) {
            const queryString = new URL(window.location.href);
            const urlParams = new URLSearchParams(queryString.search);
            const perPage = urlParams.get('per_page')
            console.log(perPage);
            $('#aue-num-of-entries option[value=' + perPage + ']').prop('selected', true);
        }
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

function deleteEntry(id, name) {
    if (window.confirm('هل أنت متأكد من حذف المتعاون ' + name + '؟')) {
        $.ajax({
            type: "DELETE",
            url: baseUrl + 'entries/' + id,
        }).done((res) => {
            $('#uae-table-single-entry-' + id).hide();
            console.log('done');
        }).fail((res) => {
            console.log('failed');
        });
    }
}