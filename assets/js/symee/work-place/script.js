var $checkboxes;
$(document).ready(function() {
    $('#reservation').daterangepicker({
        timePickerIncrement: 30,
        dateLimit: { days: 30 },
        format: 'DD/MM/YYYY',
        locale: {
            applyLabel: 'Aplicar',
            cancelLabel: "Cancelar",
            fromLabel: 'Data inicial',
            toLabel: 'Data final',
            customRangeLabel: 'Custom Range',
            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex','Sab'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            firstDay: 0
        }
    });

    $('.daterangepicker').show();
    $('#div-work-day').hide();
});

const sys_modal_workday = (url) => {
    // loading the ajax modal
    $('#work-day').modal('show', { backdrop: 'true' });
    
    // show ajax response on request success
    $.ajax({
        url: url,
        success: function(response) {
            $('#work-day .modal-body').html(response);
        }
    });    
}

function workDay(data_start, data_end) {    
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: { inicio: data_start, final: data_end },
        url: baseurl + 'admin/jornada-trabalho/ajax-jornada',
        success: function(response) {
            if (response.status == 'ok') {
                if ($('#table-work-day').hasClass('table')) {
                    $('#tbody tr').remove();
                }

                var $result = response.result;
                $('#div-work-day').show();
                $.each($result, function(i, val) {
                    var $tr,
                        dia_semana,
                        data = val.split(' - ');

                    switch (data[1]) {
                        case '0':
                            dia_semana = 'Domingo';
                            break;
                        case '1':
                            dia_semana = 'Segunda-Feira';
                            break;
                        case '2':
                            dia_semana = 'Terça-Feira';
                            break;
                        case '3':
                            dia_semana = 'Quarta-Feira';
                            break;
                        case '4':
                            dia_semana = 'Quinta-Feira';
                            break;
                        case '5':
                            dia_semana = 'Sexta-Feira';
                            break;
                        case '6':
                            dia_semana = 'Sábado';
                            break;
                    }
                    
                    $tr = $(''+
                        '<tr id="tr-check-'+ i +'" class="tcheck week-'+ data[2] +'">'+
                            '<td>'+ data[2] +'º - '+ dia_semana +'</td>'+
                            '<td>'+ data[0] +'</td>'+
                            '<td><input type="time" name="start_hour[]" id="start-hour-'+ i +'" class="form-control"></td>'+
                            '<td><input type="time" name="end_hour[]" id="end-hour-'+ i +'" class="form-control"></td>'+
                            '<td align="center">'+
                                '<input type="checkbox" name="checkbox[]" id="check-box-'+ i +'-'+ data[2] +'" style="width:30px;height:20px;">'+
                            '</td>'+
                        '</tr>');
                    
                    $tr.appendTo('#tbody');

                    // count days weeks
                    
                });
            }
        }
    });
}
