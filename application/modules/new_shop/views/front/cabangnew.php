
<div id="content" class="mr horizontal-wrapper pemasaran" data-aos="fade">
  <div class="kantor-map map-box not-hscroll">
    <div class="map not-hscroll" id="map"></div>
  </div>
  <div class="map-filter row bg-light-green" id="kantorFilter">
    <div class="col-md-12">
      <h3 class="font-sofia-bold font-md  font-green">Cari Kantor Pemasaran</h3>
    </div>
    <div class="col-md-9">
      <!-- <input type="text"  placeholder="Lokasi Anda"> -->
      <select class="font-sofia-light input-form" id="select_place">
          
             <option value="0">Semua</option>
            <?php foreach ($lokasi as $mod): ?>
                <option value="<?= $mod['province'] ?>"><?= $mod['province'] ?></option>
            <?php endforeach ?>
        
      </select>
    </div>
    <div class="col-md-3">
      <button onclick="do_search()" class="font-sofia-bold button button-rounded button-block btn-inline-green font-green" type="button">Cari</button>
    </div>
  </div>

  <div class="map-info left bg-light-green md">
    <div id="marker-detail" class="marker-detail"></div>
  </div>

  <div class="map-info bg-light-green">
    <a href="#" class="fa fa-remove" onclick="$('.map-info').fadeOut()"></a>
    <img src="/avian_new/images/cabang/tirtakencana.png" width="50%">
    <p class="font-sofia-light font-sm">Kami memastikan seluruh produk Avian Brands tersedia secara merata di seluruh pelosok Indonesia melalui jalur distribusi terintegrasi <br>PT Tirtakencana Tatawarna.</p>
  </div>
</div>


<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAdfB-1tzijt8NQRVY6SLNft9_JwxWxu1s&libraries=geometry'
  type="text/javascript"></script>
<script type="text/javascript" src="/avian_new/js/store-location.js"></script>
<script>
    var marker;
    var markers = new Array();
    var zoom = 5.5;
    var style=[];
    var styledMap = new google.maps.StyledMapType(style,{name: "Styled Map"});
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: zoom,
        center: new google.maps.LatLng(-11.920871, 114.916439),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_BOTTOM
        },
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
        },
        disableDefaultUI: true
    });

    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');
    var infowindow = new google.maps.InfoWindow({
        maxWidth: 200
    });
    // displayLocation(window['indonesia']);
    $(".location").change(function(e) {
        var place = $(this).val().toLowerCase().replace(/ /g, '');
        displayLocation(window[place]);
        e.preventDefault()
    });

    $("#x-close").click(function() {
       $('#cardMap').hide();
    });

    $(document).ready(function() {

        $.ajax({
            url: '<?= base_url() ?>new_shop/Store/read_cabang/',
            method: 'POST',
            dataType: 'json',
            data : {
                filter_places:'0',
            },
            success:function (resp){
                displayLocation(resp.result);
            }
        });

    });

    function do_search(){

        var filter_places = $("#select_place").val();

        $.ajax({
            url: '<?= base_url() ?>new_shop/Store/read_cabang/',
            method: 'POST',
            dataType: 'json',
            data : {
                filter_places:filter_places,
            },
            success:function (resp){
                if (resp.status == 200) {
                    map.setZoom(100);
                    displayLocation2(resp.result);

                    $("#marker-detail").html('<b>'+resp.result[0].name+'</b><br>'+'<i class="fa fa-map-marker"></i><span>'+resp.result[0].province+'</span><br>'+'<i class="fa fa-building"></i>'+resp.result[0].map_address+'<br>'+'<i class="fa fa-phone"></i>'+resp.result[0].telephone+'<br>'+'<i class="fa fa-envelope"></i>'+resp.result[0].email);
                    $('.map-info.md').show();
                    
                } else {
                    alert('Tidak ada CSR yang terkait dengan filter');
                }
                // console.log(resp.result)
            }
        });
    }

    function clearMarkers() {
        if (isInfoWindowOpen(infowindow)) {
            infowindow.close()
        }
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null)
        }
    }

    function resetMarkers() {
        if (isInfoWindowOpen(infowindow)) {
            infowindow.close()
        }
        for (var i = 0; i < markers.length; i++) {
            markers[i].setIcon(markers[i].icon)
            // markers[i].setIcon('/avian_new/images/icon/marker.png')
        }
    }

    function displayLocation(locations) {
        clearMarkers();
        resetZoom();
        markers.length = 0;
        var icon_url ;
        for (var i = 0; i < locations.length; i++) {

            var icon_url = "/avian_new/images/icon/marker.png";
          
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i]['latitude'], locations[i]['longitude']),
                map: map,
                icon: icon_url,
            });

            markers.push(marker);

            // console.log(markers)
            google.maps.event.addListener(map, 'click', (function(marker, i) {
                return function() {
                    infowindow.close();
                    AutoCenter()
                }
            })(marker, i));
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    if (isInfoWindowOpen(infowindow)) {
                        // resetMarkers();
                        infowindow.close();
                        AutoCenter()
                    } else {
                        map.setZoom(12);
                        map.setCenter(marker.getPosition());

                       $("#marker-detail").html('<b>'+locations[i]['name']+'</b><br>'+'<i class="fa fa-map-marker"></i><span>'+locations[i]['province']+'</span><br>'+'<i class="fa fa-building"></i>'+locations[i]['map_address']+'<br>'+'<i class="fa fa-phone"></i>'+locations[i]['telephone']+'<br>'+'<i class="fa fa-envelope"></i>'+locations[i]['email']);
                       $('.map-info.md').show();

                    }
                }
            })(marker, i));
            google.maps.event.addListener(infowindow, 'closeclick', (function(marker, i) {
                return function() {
                    AutoCenter();
                }
            })(marker, i))
        }
        AutoCenter();
    }

    function displayLocation2(locations) {
        clearMarkers();
        resetZoom();
        markers.length = 0;
        var icon_url ;
        for (var i = 0; i < locations.length; i++) {

            var icon_url = "/avian_new/images/icon/marker.png";
          
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i]['latitude'], locations[i]['longitude']),
                map: map,
                icon: icon_url,
            });

            markers.push(marker);


            // console.log(markers)
            google.maps.event.addListener(map, 'click', (function(marker, i) {
                return function() {
                    infowindow.close();
                    AutoCenter()
                }
            })(marker, i));
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    if (isInfoWindowOpen(infowindow)) {
                        // resetMarkers();
                        infowindow.close();
                        AutoCenter()
                    } else {
                        // map.setZoom(20);
                        // map.setCenter(marker.getPosition());
                       
                       $("#marker-detail").html('<b>'+locations[i]['name']+'</b><br>'+'<i class="fa fa-map-marker"></i><span>'+locations[i]['province']+'</span><br>'+'<i class="fa fa-building"></i>'+locations[i]['map_address']+'<br>'+'<i class="fa fa-phone"></i>'+locations[i]['telephone']+'<br>'+'<i class="fa fa-envelope"></i>'+locations[i]['email']);
                       $('.map-info.md').show();
                    }
                }
            })(marker, i));
            google.maps.event.addListener(infowindow, 'closeclick', (function(marker, i) {
                return function() {
                    AutoCenter();
                }
            })(marker, i))
        }
        AutoCenter();
    }

    function resetZoom() {
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(5.5);
            google.maps.event.removeListener(boundsListener)
        })
    }

    function isInfoWindowOpen(infoWindow) {
        var map = infoWindow.getMap();
        return (map !== null && typeof map !== "undefined")
    }

    function AutoCenter() {
        var bounds = new google.maps.LatLngBounds();
        $.each(markers, function(index, marker) {
            bounds.extend(marker.position)
        });
        map.fitBounds(bounds)
    }
    AutoCenter()
  </script>
  
<script type="text/javascript" src="/avian_new/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="/avian_new/js/jquery.matchHeight-min.js"></script>