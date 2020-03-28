var geocoder;
var map;
var marker;
var markers = [];
var data_markers = [];
var distance;
var _lat;
var _lng;
var _lat_user;
var _lng_user;
var _search_box;
var _search_type;
var infoWindowContent = [];
var markerCluster;
var flag = false;
var infoWindow;
var infobox;

function initmaps () {
	_search_box = $("#search-box").data("search");
	_search_type = $("#search-type").data("search");
	google.maps.event.addDomListener(window, 'load', initialize());

}

function setlatlng (latitude,longitude) {
	_lat = latitude;
	_lng = longitude;
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (var i = 0; i < data_markers.length; i++) {
    data_markers[i].setMap(map);
  }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setMapOnAll(null);
}

function deleteMarkers() {
  clearMarkers();
  data_markers = [];
}

function getData (search, search_type ,callback) {
	markers = [];

	$.ajax({
		type: "post",
		url: "/csr/get-data",
		cache: false,
		data: {search: search, search_type: search_type},
		dataType:'json',
		success: function(json) {
			if (json.datas.length > 0) {
                $(".csrlist").empty();

                var row = 1;
				var no = 0;
                var elems = '';
				$.each( json.datas, function( key, data ) {
					markers[no] = [data.latitude,data.longitude,data.type];
					infoWindowContent[no] = ['<div class="storeinfobox csrinfobox" id="addressfloat">'+
													'   <div class="storeinfoboxfull">'+
													'      <div class="image">'+
                                                            ((data.image_landing) ?
													'          <img width="100%" src="' + data.image_landing + '" alt="' + data.judul + '" />' : '') +

													'      </div>'+
													'      <div class="judul" >'+ data.judul +'</div>'+
													'      <div class="short_desc" >'+ data.short_content +' <a target="_blank" href="/csr/'+ data.pretty_url +'">selanjutnya..</a></div>'+
													'   </div>'+
													'</div>'];

                    elems +=  '<a target="_blank" href="/csr/'+ data.pretty_url +'" class="csrbox col-lg-4 col-md-4 col-sm-6 col-xs-12">' +
                                    '<div class="csrbox-inside">' +
                                        '<div class="imagecsr">' +
                                            '<img src="'+ data.image_landing +'" width="100%" />' +
                                        '</div>' +
                                        '<div class="csr_desc">' +
                                            '<div class="judul" >'+ data.judul +'</div>'+
                                            '<div class="short_desc" >'+ data.short_content.substr(0, 145) +' <span class="link">selanjutnya..</span></div>'+
                                        '</div>' +
                                    '</div>' +
                                '</a>';

					no++;
				});

                $(".csrlist").append(elems);

			} else {
				$(".csrlist").empty();
			}

            $("#csr-total").html("Total: <span>" + json.datas.length + "</span>");

			callback(true);
		},
		error: function() {
            $('#loading').removeClass('active');
            $('#popup .modal-title').html("Error !!!");
            $('#popup .modal-text').html('<p>Ada Kesalahan Sistem.</p>');
            $('#popup').addClass('active');
		}
	});
}

function getsearchdatas () {
    if(infobox){
        infobox.close();
    }

	deleteMarkers();

	//find lat long
	getData (_search_box, _search_type,function(data){
		var bounds = new google.maps.LatLngBounds();
		var marker;

		// Loop through our array of markers & place each one on the map
		for( i = 0; i < markers.length; i++ ) {
			var position = new google.maps.LatLng(markers[i][0], markers[i][1]);
			bounds.extend(position);

			if (markers[i][2] == 1) {
				//change icon
				icon = "/img/ui/pin-csr-education-20.png";
			} else if (markers[i][2] == 2) {
				icon = "/img/ui/pin-csr-vacation-20.png";
			} else if (markers[i][2] == 3) {
                icon = "/img/ui/pin-csr-disaster-20.png";
            } else {
                icon = "/img/ui/pin-csr-misc-20.png";
            }

			var marker = new google.maps.Marker({
				position: position,
				map: map,
				animation: google.maps.Animation.DROP,
				icon: icon,
			});

			// Allow each marker to have an info window
			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
                    if(infobox){
                        infobox.close();
                    }

					infobox.setContent(infoWindowContent[i][0]);
					infobox.open(map, marker);

					if (marker.getAnimation() != null) {
						marker.setAnimation(null);
					} else {
						marker.setAnimation(google.maps.Animation.BOUNCE);
						setTimeout(function() {
								marker.setAnimation(null);
						}, 700);
					}
				}
			})(marker, i));

			data_markers.push(marker);
		}

	});
}

function initialize() {
	var myLatlng = new google.maps.LatLng("-1.7364578", "117.5134753");

	var mapOptions = {
        zoom: 5,
        minZoom: 5, // for min zoom
        center: myLatlng,
        styles : [
          {
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#f5f5f5"
              }
            ]
          },
          {
            "elementType": "labels.icon",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#616161"
              }
            ]
          },
          {
            "elementType": "labels.text.stroke",
            "stylers": [
              {
                "color": "#f5f5f5"
              }
            ]
          },
          {
            "featureType": "administrative.land_parcel",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "administrative.land_parcel",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#bdbdbd"
              }
            ]
          },
          {
            "featureType": "administrative.neighborhood",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#eeeeee"
              }
            ]
          },
          {
            "featureType": "poi",
            "elementType": "labels.text",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#757575"
              }
            ]
          },
          {
            "featureType": "poi.business",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#e5e5e5"
              }
            ]
          },
          {
            "featureType": "poi.park",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#9e9e9e"
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#ffffff"
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "road",
            "elementType": "labels.icon",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "road.arterial",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "road.arterial",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#757575"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#dadada"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "labels",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "road.highway",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#616161"
              }
            ]
          },
          {
            "featureType": "road.local",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "road.local",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#9e9e9e"
              }
            ]
          },
          {
            "featureType": "transit",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "transit.line",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#e5e5e5"
              }
            ]
          },
          {
            "featureType": "transit.station",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#eeeeee"
              }
            ]
          },
          {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
              {
                "color": "#c9c9c9"
              }
            ]
          },
          {
            "featureType": "water",
            "elementType": "labels.text",
            "stylers": [
              {
                "visibility": "off"
              }
            ]
          },
          {
            "featureType": "water",
            "elementType": "labels.text.fill",
            "stylers": [
              {
                "color": "#9e9e9e"
              }
            ]
          }
      ],
	}

	var elem = document.getElementById('gmap_object');

	map = new google.maps.Map(elem, mapOptions);

    var strictBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(-9.853878, 92.846048),
        new google.maps.LatLng(7.783096, 140.175149)
    );

    // Listen for the dragend event
    google.maps.event.addListener(map, 'dragend', function() {
        if (strictBounds.contains(map.getCenter())) return;

        // We're out of bounds - Move the map back within the bounds

        var c = map.getCenter(),
            x = c.lng(),
            y = c.lat(),
            maxX = strictBounds.getNorthEast().lng(),
            maxY = strictBounds.getNorthEast().lat(),
            minX = strictBounds.getSouthWest().lng(),
            minY = strictBounds.getSouthWest().lat();

        if (x < minX) x = minX;
        if (x > maxX) x = maxX;
        if (y < minY) y = minY;
        if (y > maxY) y = maxY;

        map.setCenter(new google.maps.LatLng(y, x));
    });

	geocoder = new google.maps.Geocoder();

	infoWindow = new google.maps.InfoWindow();

	infobox = new InfoBox({
			 disableAutoPan: false,
			 maxWidth: 400,
			 pixelOffset: new google.maps.Size(-200, 0),
			 zIndex: null,
			 boxStyle: {
				background: "url('/img/ui/segitiga-store.png') 176px 0px no-repeat",
				opacity: 1,
				width: "400px"
			},
			closeBoxMargin: "8px -5px 2px 2px;",
			closeBoxURL: "/img/ui/close_store_button.png",
			infoBoxClearance: new google.maps.Size(1, 1)
		});

	var latitude = "2.5471049";
	var longitude = "122.3035143";

	//set lat long
	setlatlng (latitude,longitude);

	getsearchdatas ();
}

function init_event () {
    $("#search-box").change(function(){
    	var search_box = $("#search-box").val();
    	_search_box = search_box;
    	getsearchdatas ();
    });

    $("#search-type").change(function(){
    	var search_type = $("#search-type").val();
    	_search_type = search_type;
    	getsearchdatas ();
    });
}

$(document).ready(function () {
    init_event();
    initmaps();
    var searchbox = $('#search-box').selectBoxIt().data("selectBox-selectBoxIt");
    var searchtype = $('#search-type').selectBoxIt().data("selectBox-selectBoxIt");

    searchbox.setOptions({ autoWidth: false });
    searchtype.setOptions({ autoWidth: false });
});
