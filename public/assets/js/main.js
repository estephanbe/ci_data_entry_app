$(function () {

    var listCheckAll = false;

    if ($('#uae-select-all-wrapper').length) {
        $('#uae-select-all-wrapper').change(function (e) {
            listCheckAll = !listCheckAll;
            e.preventDefault();
            var checkboxes = $('#aue-main-table .uae-select');
            checkboxes.each((i, e) => {
                $(e).prop('checked', false);
                if (listCheckAll) {
                    $(e).parent().parent().addClass('selected-item-for-action');
                } else {
                    $(e).parent().parent().removeClass('selected-item-for-action');
                }
            });
            checkboxes.prop('checked', listCheckAll);
        });
        $('.uae-select').change((e) => {
            $(e.target).parent().parent().toggleClass('selected-item-for-action');
        })
    }

    $('#uae-group-action-excel').click((e) => {
        e.preventDefault();

        var entriesToBeExported = [];

        $('.selected-item-for-action').each((i, e) => {
            var id = parseInt($(e).attr('data-id'));
            entriesToBeExported.push(id);
        });

        var form = $(`
        <form action="${baseUrl}entries/excel_export" method="POST">
            <input type="hidden" name="entries_to_be_exported" value="${entriesToBeExported}">
        </form>
        `);
        form.appendTo('body').submit();
    });

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
                url = window.location.href.slice(0, window.location.href.indexOf('?') + 1);
                const queryString = new URL(window.location.href);
                const urlParams = new URLSearchParams(queryString.search.slice(1));
                var counter = 1;
                for (pair of urlParams.entries()) {
                    var paramVal = pair[0] === 'per_page' ? value : pair[1];
                    if (counter === 1) {
                        url += pair[0] + '=' + paramVal;
                    } else {
                        url += '&' + pair[0] + '=' + paramVal;
                    }
                    counter++;
                }
            } else {
                url += '?per_page=' + value;
            }
            window.location.href = url;
        });

        const queryString = new URL(window.location.href);
        const urlParams = new URLSearchParams(queryString.search);
        const perPage = parseInt(urlParams.get('per_page'));
        if (perPage) {
            $('#aue-num-of-entries option[value=' + perPage + ']').prop('selected', true);
        }

        const pageNum = parseInt(urlParams.get('page'));
        if (pageNum) {
            $('#uae-page-number').text(pageNum);
            $('#uae-page-total-number').text(Math.ceil(totalEntries / perPage));
        } else {
            $('#uae-page-number').text(1);
            $('#uae-page-total-number').text(1);
        }

        if (pageNum <= 1 || urlParams.get('page') === null) {
            $('#uae-prev-btn').attr('disabled', true);
        }

        if (pageNum >= Math.ceil(totalEntries / perPage) || urlParams.get('per_page') === 'all' || perPage >= totalEntries) {
            $('#uae-next-btn').attr('disabled', true);
        }



        $('#uae-prev-btn').click((e) => {
            var currentPage = pageNum ? pageNum : 1;
            var nextPage = --currentPage;
            var url = window.location.href;
            if (url.indexOf('?') > -1) {
                url = window.location.href.slice(0, window.location.href.indexOf('?') + 1);
                const queryString = new URL(window.location.href);
                const urlParams = new URLSearchParams(queryString.search.slice(1));
                var counter = 1;
                for (pair of urlParams.entries()) {
                    var paramVal = pair[0] === 'page' ? nextPage : pair[1];
                    if (counter === 1) {
                        url += pair[0] + '=' + paramVal;
                    } else {
                        url += '&' + pair[0] + '=' + paramVal;
                    }
                    counter++;
                }
            } else {
                url += '?page=' + nextPage;
            }
            window.location.href = url;
        })
        $('#uae-next-btn').click((e) => {
            var currentPage = urlParams.get('page') ? pageNum : 1;
            var nextPage = ++currentPage;
            var url = window.location.href;
            if (url.indexOf('?') > -1) {
                url = window.location.href.slice(0, window.location.href.indexOf('?') + 1);
                const queryString = new URL(window.location.href);
                const urlParams = new URLSearchParams(queryString.search.slice(1));
                var counter = 1;
                for (pair of urlParams.entries()) {
                    var paramVal = pair[0] === 'page' ? nextPage : pair[1];
                    if (counter === 1) {
                        url += pair[0] + '=' + paramVal;
                    } else {
                        url += '&' + pair[0] + '=' + paramVal;
                    }
                    counter++;
                }
            } else {
                url += '?page=' + nextPage;
            }

            if (!urlParams.get('page')) {
                url += '&page=' + nextPage;
            }
            window.location.href = url;
        });

    }

    // if ($('#uae-single-update').length) {
    //     $('#uae-single-update form').submit((e) => {
    //         e.preventDefault();
    //         var id = $('#uae-single-update input[name="id"]').val();
    //         var name = $('#uae-single-update input[name="name"]').val();
    //         var country = $('#uae-single-update input[name="country"]').val();
    //         var nationality = $('#uae-single-update input[name="nationality"]').val();
    //         var occupation = $('#uae-single-update input[name="occupation"]').val();
    //         $.ajax({
    //             type: "PUT",
    //             url: baseUrl + 'entries/' + id,
    //             data: JSON.stringify({
    //                 "name": name,
    //                 "country": country,
    //                 "nationality": nationality,
    //                 "occupation": occupation,
    //             }),
    //             contentType: "application/json",
    //         }).done((data, textStatus, jqXHR) => {
    //             alert('تم تحديث المتعاون بنجاح!');
    //             console.log(data, textStatus, jqXHR);
    //             window.location.href = '../';
    //         }).fail((data, textStatus, jqXHR) => {
    //             console.log(data, textStatus, jqXHR);
    //             alert('لقد حدث خطأ!');
    //         });
    //     });
    // }

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

function deleteEntryTable(id, name) {
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

function deleteSingleEntry(id, name) {
    if (window.confirm('هل أنت متأكد من حذف المتعاون ' + name + '؟')) {
        $.ajax({
            type: "DELETE",
            url: baseUrl + 'entries/' + id,
        }).done((res) => {
            alert('لقد تم حذف المعاون!');
            window.location.href = baseUrl;
        }).fail((res) => {
            console.log('failed');
        });
    }
}