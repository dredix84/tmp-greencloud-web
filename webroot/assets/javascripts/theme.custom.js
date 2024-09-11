

$(function () {

    $(".ajaxform").click(function (e) {
        e.preventDefault();
        $('#basic').modal('show');
        var url = $(this).attr('href');
        $("#basic .modal-title").html($(this).html());
        $("#basic .modal-body").html('<p>Loading ...</p>');
        $.get(url, function (data) {
            $("#basic .modal-body").html(data);
            //$("#basic .modal-body .breadcrumb").parent().parent().remove();
            /*eval($('#basic .modal-body script.foreval').html());
             alert($('#basic .modal-body script.foreval').html());*/
        });
    });

    $(".ajaxlink").click(function (e) {
        e.preventDefault();
        //$('#basic').modal('show');
        $('.modal-basic').magnificPopup().open();
        var url = $(this).attr('href');
        $(".modal-basic .modal-title").html($(this).html());
        $(".modal-basic .modal-body").html('<p>Loading ...</p>');
        $.get(url, function (data) {
            $(".modal-basic .modal-body").html(data);
            //$("#basic .modal-body .breadcrumb").parent().parent().remove();
            /*eval($('#basic .modal-body script.foreval').html());
             alert($('#basic .modal-body script.foreval').html());*/
        });
    });

    $('.ajaxrowdelete').click(function (e) {
        e.preventDefault();
        //$(this).is('[date-title]')
        var titleName = 'Are you sure you want to delete this record?';
        var dparent = $(this).closest('tr');

        if (typeof dparent.find('.data-title').html() !== "undefined") {
            titleName += "\n" + dparent.find('.data-title').html();
        }

        if (confirm(titleName)) {
            var targeturl = $(this).attr('href');
            //var dparent = $(this).closest('tr')
            $.ajax({
                url: targeturl,
                type: 'POST',
                statusCode: {
                    403: function () {
                        alert("You dont have permission to delete this item.");
                    },
                    500: function () {
                        alert("There was an error whie attempting to delete this record.");
                    },
                    200: function () {
                        dparent.addClass('error').hide('slow', function () {
                            dparent.remove();
                        });
                    }
                }
            });

        }
    });

    $('.modalbox').magnificPopup({
        type: 'inline',
        enableEscapeKey: true,
        preloader: false,
        modal: false
    });
    $(document).on('click', '.modal-dismiss', function (e) {
        e.preventDefault();
        $.magnificPopup.close();
    });

});


/**
 * Used to add the Date picker to a control
 * @param {type} jSelector
 * @returns {undefined}
 */
function setDatePicker(jSelector) {
    if ($.isFunction($.fn[ 'datepicker' ])) {

        $(function () {
            $(jSelector).each(function () {
                var $this = $(this),
                        opts = {};

                var pluginOptions = $this.data('plugin-options');
                if (pluginOptions)
                    opts = pluginOptions;

                $this.themePluginDatePicker(opts);
            });
        });
    }
}

function niceEditor(jSelector) {
    $(function () {
        $(jSelector).each(function () {
            var $this = $(this),
                    opts = {};

            var pluginOptions = $this.data('plugin-options');
            if (pluginOptions)
                opts = pluginOptions;

            $this.themePluginSummerNote(opts);
        });
    });
}


function exportTableToCSV($table, filename) {
    //Used to export an HTML table as a CSV file
    //Example: exportTableToCSV.apply(this, [$('#mainData'), 'export.csv']);
    var $rows = $table.find('tr:has(th),tr:has(td)'),
            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character

            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',
            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row),
                        $cols = $row.find('th,td');

                return $cols.map(function (j, col) {
                    var $col = $(col),
                            text = $col.text().trim();

                    return text.replace('"', '""'); // escape double quotes

                }).get().join(tmpColDelim);

            }).get().join(tmpRowDelim)
            .split(tmpRowDelim).join(rowDelim)
            .split(tmpColDelim).join(colDelim) + '"',
            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

    $(this)
            .attr({
                'download': filename,
                'href': csvData,
                'target': '_blank'
            });
}

/**
 * This function will make a table be exportable to a CSV file
 * @param {String} tableSelector  CSS Selector for table
 * @param {String} buttonSelector CSS selectot for button or link
 * @param {String} exportFilename Filename in which the output must be exported as
 * @returns {undefined}
 */
function addCSVExport(tableSelector, buttonSelector, exportFilename) {
    $(buttonSelector).on('click', function (event) {
        exportTableToCSV.apply(this, [$(tableSelector), exportFilename]);
    });
}
