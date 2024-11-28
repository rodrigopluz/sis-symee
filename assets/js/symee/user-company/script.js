var redirect_url = baseurl;

$(document).ready(function() {
    //* verifica se o email informado, ja esta cadastrado no sistema.
    $('#email').blur(function() {
        var email = $(this).val();
        if (email != '') {
            $("#ajax_loader").show();
            $.ajax({
                method: 'post',
                dataType: 'json',
                url: baseurl + 'admin/usuario-empresa/ajax-email',
                data: { email: email },
                success: function(data) {
                    $("#ajax_loader").hide();
                    if (data.email == $('#email').val()) {
                        $('#modal-alert').modal('show', { backdrop: 'static'});
                        $('#modal-alert .modal-body').html('<p>E-mail já cadastrado no sistema.</p>');
                        $('#email').val('');
                    }
                }
            });
        }
    });

    //* validação do cpf e verifica se o cpf informado, já esta cadastrado no sistema.
    $('#login').blur(function() {
        var login = $(this).val();
        if (login != '') {
            $("#ajax_loader").show();
            if (valida_cpf_cnpj(login)) {
                $.ajax({
                    method: 'post',
                    dataType: 'json',
                    url: baseurl + 'admin/usuario-empresa/ajax-login',
                    data: { login: login },
                    success: function(data) {
                        $("#ajax_loader").hide();

                        if (data.login == $('#login').val()) {
                            $('#modal-alert').modal('show', { backdrop: 'static'});
                            $('#modal-alert .modal-body').html('<p>CPF já cadastrado no sistema.</p>');
                            $('#login').val('');
                        } else {
                            $('#modal-alert').modal('show', { backdrop: 'static'});
                            $('#modal-alert .modal-body').html('<p>OK, CPF informado é valido.</p>');
                        }
                    }
                });
            } else {
                $("#ajax_loader").hide();
                $('#modal-alert').modal('show', { backdrop: 'static'});
                $('#modal-alert .modal-body').html('<p>Informe o CPF do usuário para ser o login de acesso.</p>');
                $(this).val('');
            }
        }
    });
});

const checkForm = () => {
    var $name = $('#name').val(),
        $email = $('#email').val(),
        $company = $('#id-company').val();

    if ($name != '' || $email != '' || $company != '') {
        $('#aba-address').addClass('active');
        $('#list_address').addClass('active');

        $('#aba-user').removeClass('active');
        $('#list_user').removeClass('active');
    }

    var $zipcode = $('#zipcode').val();

    if ($zipcode != '') {
        $('#aba-pass').addClass('active');
        $('#list_pass').addClass('active');

        $('#aba-address').removeClass('active');
        $('#list_address').removeClass('active');
    }
}