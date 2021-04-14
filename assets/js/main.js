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

    if ($('#uae-action-main-header').length) {
        const queryString = new URL(window.location.href);
        const urlParams = new URLSearchParams(queryString.search.slice(1));
        var perPage = urlParams.get('per_page');
        var pageNum = urlParams.get('page');
        var finalUrl = '';
        console.log(queryString);
        console.log(perPage, pageNum);

        // process per_page selected value on load.
        if (perPage === null) {
            perPage = 10
        } else if ( perPage === 'all'){
            $('#aue-num-of-entries option[value=' + perPage + ']').prop('selected', true);
            perPage = totalEntries;
        } else {
            perPage = parseInt(perPage);
            $('#aue-num-of-entries option[value=' + perPage + ']').prop('selected', true);
        }

        // process page number discription value on load.
        if (pageNum === null) {
            pageNum = 1;
            $('#uae-page-number').text(pageNum);
            $('#uae-page-total-number').text(Math.ceil(totalEntries / perPage));
        } else {
            pageNum = parseInt(pageNum);
            $('#uae-page-number').text(pageNum);
            $('#uae-page-total-number').text(Math.ceil(totalEntries / perPage));
        }

        // process prev btn on load.
        if (pageNum === 1) {
            $('#uae-prev-btn').attr('disabled', true);
        }

        console.log(totalEntries , pageNum , perPage)
        // process next btn on load.
        if ( (totalEntries / pageNum < perPage) && pageNum !== 1 || perPage === totalEntries || perPage >= totalEntries) {
            $('#uae-next-btn').attr('disabled', true);
        }

        $('#aue-num-of-entries').change((e) => {
            var perPageValue = $('#aue-num-of-entries option:selected').val();
            if (queryString.href.indexOf('?') > -1) {
                var tempParams = '';
                var counter = 1;
                for (param of urlParams.entries()) {
                    if (counter !== 1) {
                        tempParams += '&';
                    }
                    if (param[0] === 'per_page') {
                        tempParams += 'per_page=' + perPageValue;
                    } else {
                        tempParams += param[0] + '=' + param[1];
                    }
                    counter++;
                }

                if (tempParams.indexOf('per_page') === -1) {
                    tempParams += '&per_page=' + perPageValue
                }

                finalUrl = baseUrl + '?' + tempParams;
            } else {
                finalUrl = queryString.href + '?per_page=' + perPageValue;
            }
            window.location.href = finalUrl;
        });

        $('#uae-next-btn').click((e) => {
            var nextPage = ++pageNum;
            if (queryString.href.indexOf('?') > -1) {
                var tempParams = '';
                var counter = 1;
                for (param of urlParams.entries()) {
                    if (counter !== 1) {
                        tempParams += '&';
                    }
                    if (param[0] === 'page') {
                        tempParams += 'page=' + nextPage;
                    } else {
                        tempParams += param[0] + '=' + param[1];
                    }
                    counter++;
                }

                if (urlParams.get('page') === null) {
                    tempParams += '&page=' + nextPage
                }

                finalUrl = baseUrl + '?' + tempParams;
            } else {
                finalUrl = queryString.href + '?page=' + nextPage;
            }
            window.location.href = finalUrl;
        });

        $('#uae-prev-btn').click((e) => {
            var prevPage = --pageNum;
            if (queryString.href.indexOf('?') > -1) {
                var tempParams = '';
                var counter = 1;
                for (param of urlParams.entries()) {
                    if (counter !== 1) {
                        tempParams += '&';
                    }
                    if (param[0] === 'page') {
                        tempParams += 'page=' + prevPage;
                    } else {
                        tempParams += param[0] + '=' + param[1];
                    }
                    counter++;
                }

                if (urlParams.get('page') === null) {
                    tempParams += '&page=' + prevPage
                }

                finalUrl = baseUrl + '?' + tempParams;
            } else {
                finalUrl = queryString.href + '?page=' + prevPage;
            }
            window.location.href = finalUrl;
        });


    }

    if ($('.uae-toggle-pass').length) {
        $('.uae-toggle-pass').click((e) => {
            e.preventDefault();
            if ($(e.target).hasClass('bi-eye-fill')) {
                $(e.target).parent().siblings('input').attr('type', 'text');
            } else if ($(e.target).hasClass('bi-eye-slash-fill')) {
                $(e.target).parent().siblings('input').attr('type', 'password');
            }
            $(e.target).toggleClass('bi-eye-fill');
            $(e.target).toggleClass('bi-eye-slash-fill');


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