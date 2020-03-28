        <div id="content" class="mr horizontal-wrapper berita peduli" data-aos="fade">
        <div class="h-col fw bg-light-green">
            <div class="col-md-12">
                <div class="berita-featured peduli-text">
                    <h2 class="font-sofia-bold font-green font-md">Avian Brands Peduli</h2>
                    <div class="peduli-desc">
                        <p class="font-sofia-light">
                            Avian brands berkomitmen untuk meningkatkan taraf hidup dengan membangun 
                            bisnis yang memiliki dampak positif bagi masyarakat kini dan nanti yang kami salurkan melalui 
                            Avian Brands Peduli, sebuah wadah tanggung jawab sosial terhadap  dunia pendidikan ,
                            lingkungan , dan aksi tanggap bencana. 
                        </p>
                        
                    </div>

                    <div class="peduliFilter font-sofia-light font-green font-sm" style="background:none;top:200px !important">
                        <select  id="filter_places" class="selectpicker custom-selectpicker">
                            <option value="0" selected >Pilih Lokasi</option>
                            <option value="0">Semua</option>
                            <?php foreach ($location as $mod): ?>
                                <option value="<?= $mod['lokasi'] ?>"><?= $mod['lokasi'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <select class="selectpicker custom-selectpicker" id="filter_type" >
                            <option value="0" selected >Pilih Tipe CSR</option>
                            <option value="0">Semua</option>
                            <option value="1">Pendidikan</option>
                            <option value="2">Lingkungan</option>
                            <option value="3">Bencana Alam</option>
                        </select>
                        <div>
                            <a href="#" class="btn btn-default btn-select" onclick="do_search();">
                                Cari
                            </a>
                        </div>

                    </div>

                    <div id="cardMap" style="display:none;">
                        <!-- <i class="fa fa-times"></i> -->
                        <a href="#" class="fa fa-remove" onclick="$('#cardMap').fadeOut()" style="float: right;"></a>
                        <p class="title font-sofia-bold font-sm font-green" id="title_csr"></p>
                        <p class="font-sofia-light font-xs font-black" id="sc_csr">
                            
                        </p>
                        <p class="link-selanjutnya font-sofia-light font-sm font-green"><a id="url_csr" href="#">Selanjutnya ></a></p>
                        <img src="/avian_new/images/icon/shadow.png" alt="">
                    </div>
                    <div class="peduli-map not-hscroll" id="map"></div>
                </div>

                <?php $count = count($csr); $i=0;?>
                <?php foreach ($csr as $data) { ?>
                <?php if($i % 3 == 0){ ?>
                  <div class="berita-col">
                <?php } ?>
                    <div class="berita-panel">
                        <img src="<?= $data['image_landing'] ?>">
                        <div class="berita-panel-text nol-padmarg">
                            <h3 class="font-green font-sofia-bold font-sm"><?= $data['judul'] ?></h3>
                            <p class="content font-sofia-light font-xs"><?= $data['short_content'] ?></p>

                            <p class="text-right font-green link-selanjutnya">
                                <a href="/articles/detail/<?= $data['pretty_url'] ?>" class="font-sm">Selanjutnya ></a>
                            </p>
                        </div>
                        <img class="shadow-img" src="/avian_new/images/icon/shadow.png">
                    </div>
                <?php if($i % 3 == 2 || $i == 2 ){ ?>
                </div>
                <?php } ?>
                <?php $i++; ?>
                <?php } ?>
                    

            
                
            </div>
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
                url: '<?= base_url() ?>new_csr/Csr/read_csr/',
                method: 'POST',
                dataType: 'json',
                data : {
                    filter_places:'0',
                    filter_tipe:'0',
                },
                success:function (resp){
                    displayLocation(resp.result);
                }
            });

        });

        function do_search(){

            var filter_places = $("#filter_places").val();
            var filter_tipe = $("#filter_type").val();

            $.ajax({
                url: '<?= base_url() ?>new_csr/Csr/read_csr/',
                method: 'POST',
                dataType: 'json',
                data : {
                    filter_places:filter_places,
                    filter_tipe:filter_tipe,
                },
                success:function (resp){
                    if (resp.status == 200) {
                        displayLocation(resp.result);
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

                if (locations[i]['type'] == 1) {
                   var icon_url = "/avian_new/images/icon/marker_blue.png";
                } else if(locations[i]['type'] == 2){
                   var icon_url = "/avian_new/images/icon/marker.png";
                } else {
                   var icon_url = "/avian_new/images/icon/marker_red.png";
                }

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
                            map.setZoom(16);
                            map.setCenter(marker.getPosition());
                            // var code = locations[i][2]== ""?"":locations[i][2]+"-",
                            //     phonetext = locations[i][3]==""?"":"<a href='tel:"+code+locations[i][3]+"'><i class='fa fa-phone'></i> "+code+locations[i][4]+"</a>";
                            // infowindow.setContent('<b>'+locations[i][0]+'</b><br>'+'<i class="fa fa-map-marker"></i> '+locations[i][1]+'<br>'+'<i class="fa fa-building"></i> '+locations[i][2]+'<br>'+'<i class="fa fa-phone"></i> '+locations[i][3]+'<br>'+'<i class="fa fa-envelope"></i> '+locations[i][4]);
                            // marker.setIcon(icon_url);
                            $("#sc_csr").html(locations[i]['short_content']);
                            $("#title_csr").html(locations[i]['judul']);
                            $("#url_csr").attr('href', '<?= base_url() ?>articles/detail/'+locations[i]['pretty_url']);
                            $("#cardMap").fadeIn(500);
                            // $("#url_csr").html(locations[i]['pretty_url']);
                            // infowindow.open(map, marker)
                        }
                    }
                })(marker, i));
                google.maps.event.addListener(infowindow, 'closeclick', (function(marker, i) {
                    return function() {
                        AutoCenter();
                    }
                })(marker, i))
            }
            AutoCenter()
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