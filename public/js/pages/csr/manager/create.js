function create (){
    //init validate form
    var create_form = "#create-form";
    var create_rules = {
        judul: {
            required: true,
        },
        pretty_url: {
            required: true,
        },
        type: {
            required: true,
        },
        lokasi: {
            required: true,
        },
        short_content: {
            required: true,
        },
    };

    init_validate_form (create_form,create_rules);
}

function cropper () {
    $("#addimage").click(function (){
        var image_size = $(this).data("maxsize");
        var words_max_upload = $(this).data("maxwords");
        imageCropper ({
            target_form_selector : "#create-form",
            file_input_name : "image-file",
            data_crop_name : "data-image",
            image_ratio : 600/165,
            button_trigger_selector : "#addimage",
            image_preview_selector : "#preview-image-user",
            placeholder_path : "/img/placeholder/600x165.png",
            max_file_size : image_size,
            words_max_file_size : words_max_upload,
        } );
    });
}

var geocoder;
var map;
var marker;

function initialize(latitude, longitude) {
    var myLatlng = new google.maps.LatLng(latitude, longitude);
    var mapOptions = {
        zoom: 15,
        center: myLatlng
    }

    var bounds = new google.maps.LatLngBounds();

    var elem = document.getElementById('map');

    map = new google.maps.Map(elem, mapOptions);

    marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        draggable:true,
    });

    geocoder = new google.maps.Geocoder();

    marker.addListener('dragend', function() {
        var _markerlatlng = marker.getPosition();
        map.setCenter(_markerlatlng);
        //place latitude longitude
        $("#latitude").val(_markerlatlng.lat());
        $("#longitude").val(_markerlatlng.lng());
        geocodeLatLng(_markerlatlng);
    });
}

function getLocation(){
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(
    		function(position) {
    			google.maps.event.addDomListener(window, 'load', initialize(position.coords.latitude, position.coords.longitude));

                //place latitude longitude
                $("#latitude").val(position.coords.latitude);
                $("#longitude").val(position.coords.longitude);

                //get formated address
                var _latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                geocodeLatLng(_latlng);
    		},
    		function(error){
                google.maps.event.addDomListener(window, 'load', initialize(-7.2756141,112.6416435));
    			switch(error.code)  {
    				case error.PERMISSION_DENIED:
			            alert("User denied the request for Geolocation.");
                        break;
    				case error.POSITION_UNAVAILABLE:
			            alert("Location information is unavailable.");
		                break;
    				case error.TIMEOUT:
			            alert("The request to get user location timed out.");
		                break;
    				case error.UNKNOWN_ERROR:
			            alert("An unknown error occurred.");
		                break;
				}
    		},
            {
                enableHighAccuracy: true,
                timeout : 5000
            }
       );
    }
    else {
        x.innerHTML="Geolocation is not supported by this browser.";
    }
}

function codeAddress(address) {
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            marker.setPosition(results[0].geometry.location);

            //place latitude longitude
            $("#latitude").val(results[0].geometry.location.lat());
            $("#longitude").val(results[0].geometry.location.lng());

            var _latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
            geocodeLatLng(_latlng);

        }
        else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}

function geocodeLatLng(latlng) {
    geocoder.geocode({'location': latlng}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                var _addresscom = results[0].formatted_address;
                $("#map_address").val(_addresscom);
            }
            else {
                window.alert('No results found');
            }
        }
        else {
            window.alert('Geocoder failed due to: ' + status);
        }
    });
}

function setPositionMarker (lat_lang) {
    map.setCenter(lat_lang);
    marker.setPosition(lat_lang);
}

function init_artikel_select () {
    $( "select.artikel-select" ).select2({
        ajax: {
            url: "/manager/csr/csr-artikel/get-list-artikel",
            dataType: "json",
            delay: 500,
            data: function(params) {
                console.log(params);
                return {
                    q: params.term,
                    page: params.page,
                };
            },
            processResults: function(data, params) {

                params.page = params.page || 1;

                return {
                    results: $.map(data.datas, function(item) {
                        return {
                            text: item.judul,
                            id: item.id,
                        }
                    }),
                    pagination: {
                        more: (params.page * data.paging_size) < data.total_data,
                    }
                };
            },
            cache: true,
        },
        minimumInputLength: 0,
        allowClear: true,
        placeholder: "Pilih Artikel",
    });
}

$(document).ready(function() {
    init_tinymce();
    create();
    cropper();
    init_artikel_select();

    $("#latitude, #longitude").change(function(){
        var _latlng = new google.maps.LatLng($("#latitude").val(), $("#longitude").val());
        setPositionMarker (_latlng);
        geocodeLatLng(_latlng);
    });

    if ($("#id").val() != '' && typeof $("#id").val() != 'undefined') {
        google.maps.event.addDomListener(window, 'load', initialize($("#latitude").val(), $("#longitude").val()));
    }
    else {
        getLocation();
    }
});
