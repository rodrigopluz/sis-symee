var map,
    marker,
    geocoder,
    latitude,
    longitude;

const initialize = () => {
    var latlng = new google.maps.LatLng(-26.971874270635112,-48.63727580587465);
    var options = {
        zoom: 17,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);
    geocoder = new google.maps.Geocoder();
    marker = new google.maps.Marker({
        map: map,
        draggable: true,
    });

    marker.setPosition(latlng);
}

function loadOnMap(address) {
    geocoder.geocode({ 'address': address }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                latitude = results[0].geometry.location.lat();
                longitude = results[0].geometry.location.lng();

                $('#address').val(results[0].formatted_address);

                $('#latitude').val(latitude);
                $('#longitude').val(longitude);

                $('.latitude').val(latitude);
                $('.longitude').val(longitude);

                var location = new google.maps.LatLng(latitude, longitude);
                marker.setPosition(location);
                map.setCenter(location);
                map.setZoom(16);
            }
        }
    });
}

$(document).ready(function() {
    //* google-maps
    initialize();
    $('#address').blur(function() {
        if ($(this).val() != "")
            loadOnMap($(this).val());
    });

    google.maps.event.addListener(marker, 'drag', function() {
        geocoder.geocode({ 'latLng': marker.getPosition() }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    $('#address').val(results[0].formatted_address);
                    $('.latitude').val(marker.getPosition().lat());
                    $('.longitude').val(marker.getPosition().lng());
                }
            }
        });
    });

    $('#address').autocomplete({
        source: function(request, response) {
            geocoder.geocode({ 'address': request.term + ', Brasil', 'region': 'BR' }, function(results, status) {
                response($.map(results, function(item) {
                    return {
                        label: item.formatted_address,
                        value: item.formatted_address,
                        latitude: item.geometry.location.lat(),
                        longitude: item.geometry.location.lng()
                    }
                }));
            });
        },
        select: function(event, ui) {
            $('.latitude').val(ui.item.latitude);
            $('.longitude').val(ui.item.longitude);

            var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);

            marker.setPosition(location);
            map.setCenter(location);
            map.setZoom(16);

            // console.log(ui.item);

            var map_address = ui.item.value;
            var result = map_address.split(', ');

            console.log(result);
            zipcode(result[1], result[3]);
        }
    });

    $('.yes-address').hide();
    $('.no-address').hide();

    //* yes-address
    $('#s-address').click(function() {
        if ($('#id-company').val() !== '') {
            $('.yes-address').show();
            $('.no-address').hide();

            /** ajax return data company */
            $.ajax({
                method: 'post',
                dataType: 'json',
                data: { company: $('#id-company').val() },
                url: baseurl + 'admin/locais-trabalho/ajax-empresa',
                success: function (data) {
                    $('#s-map-id-address').val(data.result.id_address);
                    $('#s-map-place').val(data.result.place_name).attr('readonly', true);
                    $('#s-map-number').val(data.result.number).attr('readonly', true);
                    $('#s-map-complement').val(data.result.complement).attr('readonly', true);
                    $('#s-map-neighborhood').val(data.result.neighborhood_name).attr('readonly', true);
                    $('#s-map-city').val(data.result.city_name).attr('readonly', true);
                    $('#s-map-state').val(data.result.sigla).attr('disabled', true);
                    $('#s-map-country').val(data.result.id_country).attr('disabled', true);

                    var place = data.result.place_name,
                        number = data.result.number,
                        neighborhood = data.result.neighborhood_name,
                        city = data.result.city_name,
                        state = data.result.sigla,
                        zipcode = data.result.zipcode,
                        country = data.result.name;

                    // R. 418, 1069 - Morretes, Itapema - SC, 88220-000, Brasil
                    var address = place +', '+ number +' - '+ neighborhood +', '+ city +' - '+ state +', '+ zipcode +', '+ country;
                    loadOnMap(address);
                }
            });
        } else {
            $('#modal-alert').modal('show', { backdrop: 'static'});
            $('#modal-alert .modal-body').html('<p>Selecione a empresa</p>');
            $('#s').prop('checked', false);
            $('#s-address').removeClass('checked');
        }
    });

    //* no-address
    $('#n-address').click(function() {
        $('.no-address').show();
        $('.yes-address').hide();

        // R. Libéria, 427 - Nações, Balneário Camboriú - SC, 88338-233, Brasil
    });

    //* validation submit
    $('#form-validate').submit(function() {
        if ($('#s').is(':checked') === false && $('#n').is(':checked') === false) {
            $('.work-place').html('<span for="work_place_info" class="col-lg-12 p-0 validate-error">campo obrigatório</span>');
            $('#radio-info').addClass('validate-has-error');
            $('.cb-wrapper').css('border-color', '#cc2424');
            $('.validate-error').css('color', '#cc2424');

            $('#form-work').attr('disabled', true);
            return false;
        }
    });

    $('.radio').on('click', function() {
        $('.work-place').remove();
        $('.cb-wrapper').removeAttr('style');
        $('#form-work').removeAttr('disabled');
        $('#radio-info').removeClass('validate-has-error');
    });
});

const zipcode = (number, zipcode) => {
    var result = number.split(' - ');
    if (zipcode != undefined) {
        $.ajax({
            url: 'https://viacep.com.br/ws/' + zipcode + '/json/',
            success: function (data) {
                $('#n-map-country').val('1');
                $('#n-map-state').val(data.uf);
                $('#n-map-number').val(result[0]);
                $('#n-map-zipcode').val(zipcode);
                $('#n-map-city').val(data.localidade);
                $('#n-map-place').val(data.logradouro);
                $('#n-map-neighborhood').val(data.bairro);
            }
        });
    } else {
        $('#modal-alert').modal('show', { backdrop: 'static'});
        $('#modal-alert .modal-body').html('<p>Informe o numero do endereço.</p>');
    }
}

var btnSetItem = document.querySelector('#form-work');
const setLocalStorage = () => {
    btnSetItem.addEventListener('click', () => {
        localStorage.setItem('name', $('#name').val());
    });
}

setLocalStorage();