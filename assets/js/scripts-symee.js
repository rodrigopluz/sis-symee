var redirect_url = baseurl;

$(document).ready(function() {
    //* no cache inputs
    $(':input').attr('autocomplete', 'off');
    
    setTimeout(function() {
        $('#password').attr('type', 'password');
        $('#confirm-password').attr('type', 'password');
    }, 500);

    //* checked pf
    $('#pf').click(function() {
        $('#pf').attr("checked", "checked");
        $('#pj').removeAttr('checked');
        $('#cpf-cnpj').val('');
        $('#cpf-cnpj').removeAttr('data-mask');
        $('#cpf-cnpj').removeAttr('readonly');

        $('#cpf-cnpj').attr("data-mask", "cpf");
        $('#cpf-cnpj').inputmask({
            keepStatic: true,
            mask: ['999.999.999-99']
        });
    });

    //* checked pj
    $('#pj').click(function() {
        $('#pj').attr("checked", "checked");
        $('#pf').removeAttr('checked');
        $('#cpf-cnpj').val('');
        $('#cpf-cnpj').removeAttr('data-mask');
        $('#cpf-cnpj').removeAttr('readonly');

        $('#cpf-cnpj').attr("data-mask", "cnpj");
        $('#cpf-cnpj').inputmask({
            keepStatic: true,
            mask: ['99.999.999/9999-99']
        });
    });

    //* mask cep
    $('.mask-cep').inputmask({
        keepStatic: true,
        mask: ['99999-999']
    });

    //* mask cnpj
    $('.mask-cnpj').inputmask({
        keepStatic: true,
        mask: ['99.999.999/9999-99']
    });

    //* mask cpf
    $('.mask-cpf').inputmask({
        keepStatic: true,
        mask: ['999.999.999-99']
    });

    //* mask phone
    $('.mask-phone').inputmask({
        keepStatic: true,
        mask: ['(99) 9999-9999']
    });

    //* mask phone-cell
    $('.mask-phone-cell').inputmask({
        keepStatic: true,
        mask: ['(99) 99999-9999']
    });

    //* mask date
    $('.mask-date').inputmask({
        keepStatic: true,
        mask: ['99/99/9999']
    });

    //* mask time
    $('.mask-time').inputmask({
        keepStatic: true,
        mask: ['99:99']
    });

    //* mask money
    $('.mask-money').maskMoney({
        symbol:'R$ ', 
        showSymbol:true,
        thousands:'.',
        decimal:',',
        symbolStay: true
    });

    //* return de busca do cep atraves do link - https://viacep.com.br
    $("#zipcode").change(function () {
        $.ajax({
            url: 'https://viacep.com.br/ws/' + $(this).val() + '/json/',
            success: function (data) {
                $("#city").val(data.localidade);
                $("#place").val(data.logradouro);
                $("#neighborhood").val(data.bairro);

                $('#state option[value=""]').removeAttr('selected', true);
                $('#state option[value="'+ data.uf +'"]').attr('selected', true);

                $('#country option[value=""]').removeAttr('selected', true);
                $('#country option[value="1"]').attr('selected', true);
            }
        });
    });

    //* validate and format at the same time
    $('.cpf_cnpj_mask').blur(function() {
        if ($(this).val() != '') {
            // testa a validação e formata se estiver OK
            if (formata_cpf_cnpj($(this).val())) {
                $(this).val(formata_cpf_cnpj($(this).val()));

                $("#ajax_loader").show();
                //* ajax - consult employee
                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    data: { document: $(this).val() },
                    url: baseurl + 'admin/vinculos/ajax-vinculo',
                    success: function (response) {
                        if (response != null) {
                            if (response.entail.type == 'F') {
                                $('label[for="label-name"]').html('Nome');
                                $('.applicant').html('Candidato');
                            }

                            if (response.entail.type == 'J') {
                                $('label[for="label-name"]').html('Empresa');
                                $('.applicant').html('Prestador de Serviço');
                            }

                            //* dados do candidato
                            $('#name').val(response.entail.person_name);
                            $('#email').val(response.entail.email);
                            $('#phone').val(response.entail.phone);
                            $('#uuid').val(response.entail.uuid);
                            $('#token').val(response.entail.token);
                            $('#model').val(response.entail.model);
                            $('#device').val(response.entail.id_device);
                            $('#company').val(response.company.business_name);

                            $('.table-entail').show();
                            $('.btns-entail').show();

                            $('.mask-money').maskMoney({
                                decimal:',',
                                symbol:'R$ ', 
                                thousands:'.',
                                showSymbol:true,
                                symbolStay: true
                            });
                        } else {
                            alert('O CPF informado, já está com um contrato em atividade com essa empresa.');
                            window.location.href = redirect_url + 'admin/vinculos';
                        }

                        $("#ajax_loader").hide();
                    }
                });
            } else {
                alert('CPF ou CNPJ inválido!');
                $(this).val('');
            }
        }
    });

    //* search-function-categorys
    $('#search-category').removeAttr('autocomplete');
    $('#search-category').autocomplete({
        source: function(request, response) {
            $.ajax({
                method: 'post',
                dataType: "json",
                data: { query: request.term },
                url: baseurl + 'admin/empresas/ajax-search',
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            log(ui.item.label,ui.item.id, ui.item.id_company);
            $('.btn-activity').removeClass('not-active').removeClass('disabled');
        },
        open: function() {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function() {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        }
    });
    
    //* add-activity
    $('.btn-activity').on('click', function() {
        if ($('#id-category').val() != '') {
            $.ajax({
                method: 'post',
                dataType: "json",
                url: baseurl + 'admin/empresas/ajax-add-activity',
                data: { id_category: $('#id-category').val(), id_company: $('#id-company').val() },
                success: function(data) {
                    if (data.status == 'ok') {
                        alert('Ramo de atividade, adicionado com sucesso.');
                        location.reload();
                    }
                }
            });
        }
    });

    //* return search cnaes
    $('#category').change(function() {
        if ($(this).val() != '') {
            $.ajax({
                method: 'post',
                dataType: "json",
                data: { category: $(this).val() },
                url: baseurl + 'admin/vinculos/ajax-search-function',
                success: function(data) {
                    if (data.status == 'ok') {
                        var options = '<option value="">Selecione</option>';
                        $.each(data.froles, function (key, val) {
                            options += '<option value="' + val.id + '">' + val.name + '</option>';
                        });

                        $("#role").html(options);
                        $('#role').removeAttr('disabled');
                    }
                }
            });
        }
    });

    //* save notification
    $('.save-entail').on('click', function() {
        if ($('#role').val() != '') {
            $("#ajax_loader").show();

            $.ajax({
                method: 'post',
                dataType: "json",
                data: {
                    name: $('#name').val(),
                    role: $('#role').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    token: $('#token').val(),
                    model: $('#model').val(),
                    device: $('#device').val(),
                    cnaes: $('#category').val(),
                    company: $('#company').val(),
                    cpf_cnpj: $('#cpf-cnpj').val(),
                    time_hour: $('#time-hour').val(),
                    dt_start: $('#data-start').val()
                },
                url: baseurl + 'admin/vinculos/ajax-call-notification',
                success: function(data) {
                    alert('Notificação de Vinculo foi enviado com sucesso.');
                    $("#ajax_loader").hide();
                    window.location.href = redirect_url + 'admin/vinculos';
                }
            });
        }
    });

    //* callback listener entails
    const getListener = () => {
        $.ajax({
            method: 'post',
            dataType: 'json',
            url: baseurl + 'admin/vinculos/ajax-listener',
            success: function(data) {
                // console.log(data);
                $('.badge-info').html();
            }
        });
    }

    getListener();
    setInterval(getListener, 50000);

    //* box-individual
    $('.bx-individual').css('display', 'none');
    $('.bx-coletivo').css('display', 'none');

    $('.ck-i').on('click', function() {
        $('.bx-individual').css('display', 'block');
        $('.bx-coletivo').css('display', 'none');
    });

    $('.ck-g').on('click', function() {
        $('.bx-coletivo').css('display', 'block');
        $('.bx-individual').css('display', 'none');
    });

    $('#confirm-password').change(function() {
        // validatePasswords();
    });
});

//* validate passwords
// const validatePasswords = () => {
//     var password = document.getElementById('password').value,
//         confirm_password = document.getElementById('confirm-password').value;
    
//     if (password != confirm_password) {
//         alert("Senhas diferentes!\\n Favor digitar Senhas iguais.");
//         $('#confirm-password').val('');

//         return false;
//     }
    
//     return true;
// }

//* save mac-address 
const mac_address = (id_company) => {
    $.ajax({
        method: 'post',
        dataType: 'json',
        data: { id_company: id_company },
        url: baseurl + 'admin/mac-address/ajax-mac-address',
        success: function(data) {
            console.log(data);
        }
    });
}

//* save date-end closure contract
const submitCloseForm = () => {
    if ($('#data-end').val() != '') {
        $('#modal-closure').modal('show', { backdrop: 'static'});
    }
}

const submitFormClosureYes = () => {
    $('#ajax_loader').show();
    $.ajax({
        method: 'post',
        dataType: "json",
        data: { contract: $('#contract').val(), dt_end: $('#data-end').val() },
        url: baseurl + 'admin/vinculos/ajax-close',
        success: function(data) {
            // alert('Data de encerramento do contrato foi salva com sucesso.');
            $("#ajax_loader").hide();
            window.location.href = redirect_url + 'admin/vinculos';
        }
    });
}

const submitFormClosureNo = () => {
    window.location.href = redirect_url + 'admin/vinculos';
}

//* fill in the hidden fields
const log = (label,id,id_company) => {
    $('#id-category').val(id);
    $('#category').val(label);

    if ($('#id-company').val() == '') $('#id-company').val(id_company);
}

//* verifica se é CPF ou CNPJ
const verifica_cpf_cnpj = (valor) => {
    // garante que o valor é uma string
    valor = valor.toString();

    // remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, '');
    
    if (valor.length === 11) {        // verifica CPF
        return 'CPF';
    } 
    else if (valor.length === 14) {   // verifica CNPJ
        return 'CNPJ';
    } 
    else {                            // não retorna nada
        return false;
    }
}

//* calcula digitos
const calc_digitos_posicoes = (digitos, posicoes = 10, soma_digitos = 0) => {
    // faz a soma dos dígitos com a posição
    // ex. para 10 posições:
    //   0    2    5    4    6    2    8    8   4
    // x10   x9   x8   x7   x6   x5   x4   x3  x2
    //   0 + 18 + 40 + 28 + 36 + 10 + 32 + 24 + 8 = 196
    for (var i = 0; i < digitos.length; i++) {
        // preenche a soma com o dígito vezes a posição
        soma_digitos = soma_digitos + (digitos[i] * posicoes);

        // subtrai 1 da posição
        posicoes--;

        // parte específica para CNPJ
        // ex.: 5-4-3-2-9-8-7-6-5-4-3-2
        if (posicoes < 2) {
            // retorno a posição para 9
            posicoes = 9;
        }
    }

    // captura o resto da divisão entre soma_digitos dividido por 11
    // ex.: 196 % 11 = 9
    soma_digitos = soma_digitos % 11;

    // verifica se soma_digitos é menor que 2
    if (soma_digitos < 2) {
        // soma_digitos agora será zero
        soma_digitos = 0;
    } else {
        // se for maior que 2, o resultado é 11 menos soma_digitos
        // ex.: 11 - 9 = 2
        // nosso dígito procurado é 2
        soma_digitos = 11 - soma_digitos;
    }

    // concatena mais um dígito aos primeiro nove dígitos
    // ex.: 025462884 + 2 = 0254628842
    var cpf = digitos + soma_digitos;

    // retorna
    return cpf;
}

//* valida CPF
const valida_cpf = (valor) => {
    // garante que o valor é uma string
    valor = valor.toString();
    
    // remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, '');

    // captura os 9 primeiros dígitos do CPF
    // ex.: 02546288423 = 025462884
    var digitos = valor.substr(0, 9);

    // faz o cálculo dos 9 primeiros dígitos do CPF para obter o primeiro dígito
    var novo_cpf = calc_digitos_posicoes(digitos);

    // faz o cálculo dos 10 dígitos do CPF para obter o último dígito
    var novo_cpf = calc_digitos_posicoes(novo_cpf, 11);

    // verifica se o novo CPF gerado é idêntico ao CPF enviado
    if (novo_cpf === valor) {
        return true;  // CPF válido
    } else {
        return false; // CPF inválido
    }
}

//* valida CNPJ
const valida_cnpj = (valor) => {
    // garante que o valor é uma string
    valor = valor.toString();
    
    // remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, '');

    // o valor original
    var cnpj_original = valor;

    // captura os primeiros 12 números do CNPJ
    var primeiros_numeros_cnpj = valor.substr(0, 12);

    // faz o primeiro cálculo
    var primeiro_calculo = calc_digitos_posicoes(primeiros_numeros_cnpj, 5);

    // o segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
    var segundo_calculo = calc_digitos_posicoes(primeiro_calculo, 6);

    // concatena o segundo dígito ao CNPJ
    var cnpj = segundo_calculo;

    // verifica se o CNPJ gerado é idêntico ao enviado
    if (cnpj === cnpj_original) {
        return true;
    }
    
    // retorna falso por padrão
    return false;
}

//* valida o CPF ou CNPJ
const valida_cpf_cnpj = (valor) => {
    // verifica se é CPF ou CNPJ
    var valida = verifica_cpf_cnpj( valor );

    // garante que o valor é uma string
    valor = valor.toString();
    
    // remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, '');
    
    if (valida === 'CPF') {                 // valida CPF
        // retorna true para cpf válido
        return valida_cpf(valor);
    } else if (valida === 'CNPJ') {         // valida CNPJ
        // retorna true para CNPJ válido
        return valida_cnpj(valor);
    } else {                                // não retorna nada
        return false;
    }
}

//* formata o CPF ou CNPJ
const formata_cpf_cnpj = (valor) => {
    // o valor formatado
    var formatado = false;
    
    // verifica se é CPF ou CNPJ
    var valida = verifica_cpf_cnpj( valor );

    // garante que o valor é uma string
    valor = valor.toString();
    
    // remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, '');

    // valida CPF
    if ( valida === 'CPF' ) {
        // verifica se o CPF é válido
        if ( valida_cpf( valor ) ) {
            // formata o CPF ###.###.###-##
            formatado  = valor.substr( 0, 3 ) + '.';
            formatado += valor.substr( 3, 3 ) + '.';
            formatado += valor.substr( 6, 3 ) + '-';
            formatado += valor.substr( 9, 2 ) + '';   
        }
    }
    
    // valida CNPJ
    else if ( valida === 'CNPJ' ) {
        // verifica se o CNPJ é válido
        if ( valida_cnpj( valor ) ) {
            // formata o CNPJ ##.###.###/####-##
            formatado  = valor.substr( 0,  2 ) + '.';
            formatado += valor.substr( 2,  3 ) + '.';
            formatado += valor.substr( 5,  3 ) + '/';
            formatado += valor.substr( 8,  4 ) + '-';
            formatado += valor.substr( 12, 14 ) + '';   
        }
    } 

    // retorna o valor 
    return formatado;
}