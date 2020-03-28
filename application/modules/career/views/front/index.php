<div class="container">
    <div class="section section-crumb">
        <div class="section_content">
            <div class="breadcrumbs">
                <a href="/">BERANDA</a>
                <span>KARIR</span>
            </div>
            <div class="halfpages">
                <div class="halfpage halfpagepadded">
                    <div class="halfpage_title"><h2>LOWONGAN PEKERJAAN</h2></div>
                    <img src="/img/ui/career.jpg"/>
                    <?php if(count($models) > 0): foreach ($models as $model): ?>
                    <div class="halfpage_section">
                        <div class="halfpage_section_title"><h3><?= $model['title'] ?></h3></div>
                        <span class="subhead">Posisi</span>
                        <div class="subcontent"><?= $model['position'] ?></div>
                        <div class="subcontent"><?= $model['detail'] ?></div>
                        <div class="note">tersedia sampai <?= dateformatonly_indonesia($model['available_to_date'])  ?></div>
                        <a href="/career/apply/<?= $model['id'] ?>" class="btn">Detil</a>
                    </div>
                    <?php endforeach; else: ?>
                    <p class="career-nothing">Maaf untuk sementara tidak ada lowongan yang tersedia</p>
                    <?php endif; ?>
                </div>
                <div class="halfpage">
                    <div class="grey_form">
                        <div class="grey_form_name">LAMARAN SPONTAN</div>
                        <p>
                            Dengan cara yang cepat dan mudah, Anda dapat mendaftarkan diri Anda ke database kami. Informasi Anda akan tetap dalam database kami untuk sampai dengan 12 bulan sejak Anda memasukkan data. Setiap kali lowongan pekerjaan baru tersedia, tim kami akan mencari informasi di dalam database tersebut untuk diproses lebih lanjut. Semua informasi yang Anda berikan dijaga kerahasiaannya.
                        </p>
                        <form class="smart-form" id="career-fm" method="POST" action="/career/instant-apply">
                            <div class="formitext"><input type="text" id="name" name="name" placeholder="Nama Lengkap"/></div>
                            <div class="formitext"><input class="datepicker" type="text" id="dob" name="dob" placeholder="Tanggal Lahir"/></div>
                            <div class="formitext"><input type="text" id="email" name="email" placeholder="Email"/></div>
                            <div class="formitext"><input type="text" id="address" name="address" placeholder="Alamat"/></div>
                            <div class="formibtn"><button class="btn" type="submit"/>Kirim</button></div>
                        </form>
                    </div>
                </div>
                <div class="lead"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal-contain targetmess" id="success_pop">
    <div class="modal-shade"></div>
    <div class="modal-window modal-free">
        <div class="modal-content">
            <div class="modal-close trigger" targid="mess"></div>
            <div class="modal-title">
                Berhasil !!!
            </div>
            <div class="modal-text">
                <p>
                    Terima kasih untuk aplikasi Anda. Kami akan menghubungi Anda segera setelah ada lowongan pekerjaan yang sesuai dengan anda.
                </p>
            </div>
        </div>
    </div>
</div>
