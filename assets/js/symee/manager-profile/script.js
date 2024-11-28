$(document).ready(function() {
    //* valida confirmação de nova senha
    $('#confirm-new-password').change(function() {
        validatePasswords();
    });

    $('#new-password').blur(function() {
        if ($(this).val() == $('#password').val()) {
            $('#modal-alert').modal('show', { backdrop: 'static'});
            $('#modal-alert .modal-body').html('<p>Informe uma senha nova.</p>');
            $('#new-password').val('');
            $('#erroSenhaForca').hide();
        }
    });
});

function validPasswordForce() {
	var $password = $('#new-password').val();
	var $power = 0;

    if ($password != '') {
        if (($password.length >= 4) && ($password.length <= 7)) {
            $power += 10;
        } else if($password.length > 7) {
            $power += 25;
        }

        if (($password.length >= 5) && ($password.match(/[a-z]+/))) {
            $power += 10;
        }

        if (($password.length >= 6) && ($password.match(/[A-Z]+/))) {
            $power += 20;
        }

        if (($password.length >= 7) && ($password.match(/[@#$%&;*]/))) {
            $power += 25;
        }

        if ($password.match(/([1-9]+)\1{1,}/)) {
            $power += -25;
        }

        viewForce($power);
    }
}

const viewForce = (power) => {
	if (power < 30 ) {
		document.getElementById("erroSenhaForca").innerHTML = "<span style='color: #ff0000'>Fraca</span>";
    } 
    else if ((power >= 30) && (power < 50)) {
		document.getElementById("erroSenhaForca").innerHTML = "<span style='color: #FFD700'>Média</span>";
    } 
    else if ((power >= 50) && (power < 70)) {
		document.getElementById("erroSenhaForca").innerHTML = "<span style='color: #7FFF00'>Forte</span>";
    } 
    else if ((power >= 70) && (power < 100)) {
		document.getElementById("erroSenhaForca").innerHTML = "<span style='color: #008000'>Excelente</span>";
    }
}

//* validate passwords
const validatePasswords = () => {
    var password = document.getElementById('new-password').value,
        confirm_password = document.getElementById('confirm-new-password').value;
    
    if (password != confirm_password) {
        $('#modal-alert').modal('show', { backdrop: 'static'});
        $('#modal-alert .modal-body').html('<p>Senhas diferentes! <br> Favor digitar Senhas iguais.</p>');
        
        $('#confirm-new-password').val('');

        return false;
    }
    
    return true;
}