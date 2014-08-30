/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function createCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    } else {
        expires = "";
    }
    document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = escape(name) + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ')
            c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0)
            return unescape(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}
$(document).ready(function() {
    var doc = $(document);
    $('[name="last_payment"], [name="dominios[cdate]"], [name="cdate"], [name="holiday[holiday_date]"]').datepicker({"dateFormat": "yy-mm-dd"});
    doc.on('click', '.alert', function() {
        $(this).alert('close');
    });
    doc.on('submit', '.holiday_tasks', function(e) {
        if ($(this).find('[name="holiday_id"]').val().trim() == '') {
            e.stopPropagation();
            e.preventDefault();
            alert('Por favor seleciona uma data válida');
        }
    });
    doc.on('click', '.delete', function(e) {
        if (!confirm('Deseja realmente deletar esse item?')) {
            e.stopPropagation();
            e.preventDefault();
        }
    });
    var selected = new Array();
    var select_all = $('[name="select_all"]').size();
    var $bSortable = select_all ? [0, -1, -2] : [-1, -2];
    var $asSorting = select_all ? [1] : [0];
    var $aaSorting = select_all ? [1, 'asc'] : [0, 'asc'];
    tab = $('table').dataTable({
        "bStateSave": false,
        "bFilter": true,
        "sDom": "<'row-fluid'<'span6'l><'span6'T><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
        "aaSorting": [$aaSorting],
        "aoColumnDefs": [
            {"asSorting": ["asc", "desc"], "aTargets": $asSorting},
            {"bSortable": false, "aTargets": $bSortable},
            {
                "aTargets": [0],
                //"mData": "download_link",
                "mRender": function(data, type, full) {
                    if (select_all)
                        return data.indexOf('free') != -1 ? '' : '<input type="checkbox" value="' + data + '" name="id[]"/>';
                    return data;
                }
            }
        ],
        "fnInitComplete": function() {
            if (select_all) {
                $('[name="select_all"]').change(function() {
                    trs = $(tab).find('tbody tr');
                    chks = $('[name="id[]"]', tab);
                    chks.prop('checked', this.checked);
                    chks.each(function() {
                        index = selected.indexOf($(this).val());
                        if (this.checked) {
                            console.log(selected.indexOf($(this).val()))
                            if (index < 0) {
                                $(this).parent('td').parent('tr').addClass('row_selected');
                                selected[selected.length] = $(this).val();
                            }
                        } else {
                            $(this).parent('td').parent('tr').removeClass('row_selected');
                            if (index >= 0) {
                                selected.splice(index, 1);
                            }
                        }
                    });
                });
            }
        },
        "oLanguage": {
            "sUrl": "/hospedagem/js/dataTables.pt-br.txt"
        },
        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            $('table tbody tr').each(function() {
                if (jQuery.inArray($(this).data('id'), selected) != -1 || $(this).find('[type="checkbox"]').is(':checked')) {
                    $(this).addClass('row_selected');
                }
            });
            return nRow;
        },
        "fnDrawCallback": function(oSettings) {
            if (select_all) {
                trs = $(tab).find('tbody tr');
                chks = $('[name="id[]"]', trs);
                chkds = $('[name="id[]"]:checked', tab.fnGetNodes());
                nchkds = $('[name="id[]"]:not(:checked)', trs);
                chkds.each(function() {
                    if (this.checked) {
                        if (selected.indexOf($(this).val()) < 0) {
                            $(this).parent('td').parent('tr').addClass('row_selected');
                            selected[selected.length] = $(this).val();
                        }
                    }
                });
                tr = this;
                chks.change(function() {
                    index = selected.indexOf($(this).val());
                    if (this.checked) {
                        console.log(selected.indexOf($(this).val()))
                        if (index < 0) {
                            $(this).parent('td').parent('tr').addClass('row_selected');
                            selected[selected.length] = $(this).val();
                        }
                    } else {
                        $(this).parent('td').parent('tr').removeClass('row_selected');
                        if (index >= 0) {
                            selected.splice(index, 1);
                        }
                    }
                });
                $('[name="select_all"]').prop('checked', chks.length == chkds.length);
            }
        }
    });
    if (select_all) {
        tab.columnFilter({
            sPlaceHolder: "head:before",
            aoColumns: [
                null,
                {type: "text"},
                {type: "select", values: ['Gratis', 'Em aberto', 'Vencido']},
                {type: "select", values: ['Comunicar pagto']},
            ]
        });
    }
    $("#myModalSelecteds form").on('submit', function(e) {
        if (!selected.length) {
            e.preventDefault();
            alert('Por favor selecione algum item');
        } else {
            $('[name="domain_id_list"]').val(selected.join(','));
        }
    });
    $("#myModalSelectedsButton").on('click', function(e) {
        if (!selected.length) {
            e.preventDefault();
            e.stopPropagation();
            alert('Por favor selecione algum item');
        }
    });
    $('.alert-error').addClass('alert-danger');
    $('#clientid_tags').chosen({
        no_results_text: "Nenhum cliente encontrado"
    });
});