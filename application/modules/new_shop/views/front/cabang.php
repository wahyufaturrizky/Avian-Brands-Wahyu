<div id="content" class="mr horizontal-wrapper pemasaran" data-aos="fade">
		<div id="kantorMap"></div>
		<div class="map-filter row bg-light-green" id="kantorFilter">
			<div class="col-md-12">
				<h3 class="font-sofia-bold font-md  font-green">Cari Kantor Pemasaran</h3>
			</div>
			<div class="col-md-9">
				<input type="text" class="font-sofia-light input-form" placeholder="Lokasi Anda">
			</div>
			<div class="col-md-3">
				<button class="font-sofia-bold button button-rounded button-block btn-inline-green font-green" type="submit">Cari</button>
			</div>
		</div>

		<div class="map-info bg-light-green">
			<a href="#" class="fa fa-remove" onclick="$('.map-info').fadeOut()"></a>
			<img src="/avian_new/images/cabang/tirtakencana.png" width="50%">
			<p class="font-sofia-light font-sm">Kami memastikan seluruh produk Avian Brands tersedia secara merata di seluruh pelosok Indonesia melalui jalur distribusi terintegrasi PT Tirtakencana Tatawarna.</p>
		</div>
	</div>

 <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyAdfB-1tzijt8NQRVY6SLNft9_JwxWxu1s&libraries=geometry'
  type="text/javascript"></script>
<script>
    function initialize() {
      // Tampilan peta
      var propertiPeta = {
        center:new google.maps.LatLng(-4.37573,120.517431),//titik posisi maps di halaman browser
        zoom:4.5,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      };      
      var peta = new google.maps.Map(document.getElementById("kantorMap"), propertiPeta);

      // Membuat Marker Maps
      var marker1=new google.maps.Marker({
          position: new google.maps.LatLng(-6.17702,106.7267727),//titik lokasi maps
          map: peta
      });
      var marker2=new google.maps.Marker({
          position: new google.maps.LatLng(-7.79,113.7267727),//titik lokasi maps
          map: peta
      });
      var marker3=new google.maps.Marker({
          position: new google.maps.LatLng(-7.3,109.4727),//titik lokasi maps
          map: peta
      });
      var marker4=new google.maps.Marker({
          position: new google.maps.LatLng(-2.539,115.67727),//titik lokasi maps
          map: peta
      });
      

    }
    // event jendela di-load  
    google.maps.event.addDomListener(window, 'load', initialize);

    // marker klik
    google.maps.event.addListener(marker1, 'click', function() {
    	alert('tes');
    });
  </script>
  
<script type="text/javascript" src="/avian_new/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="/avian_new/js/jquery.matchHeight-min.js"></script>