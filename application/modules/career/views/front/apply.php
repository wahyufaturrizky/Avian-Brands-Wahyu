<div class="container">
    <div class="section section-crumb">
        <div class="section_content">
            <div class="breadcrumbs">
                <a href="/">BERANDA</a>
                <a href="/career">KARIR</a>
                <span><?= strtoupper($model['title']) ?></span>
            </div>
            <div class="halfpages">
                <div class="halfpage halfpagepadded">
                    <div class="halfpage_title"><h2><?= $model['title'] ?></h2></div>
                    <div class="halfpage_section">
                        <div class="halfpage_section_title"><h3>Posisi : <?= $model['position'] ?></h3></div>
                        <?php //<span class="subhead">Kewajiban</span> ?>
                        <div class="subcontent"><?= $model['detail'] ?></div>
                        <span class="subhead">Syarat</span>
                        <div class="subcontent"><?= $model['requirement'] ?></div>
                        <?php if($model['additional_info'] != ""): ?>
                        <span class="subhead">Informasi Tambahan</span>
                        <div class="subcontent"><?= $model['additional_info'] ?></div>
                        <?php endif; ?>
                        <div class="note">tersedia sampai <?= dateformatonly_indonesia($model['available_to_date'])  ?></div>
                    </div>
                </div>
                <div class="halfpage">
                    <div class="grey_form">
                        <div class="grey_form_name">MELAMAR PEKERJAAN</div>
                        <form class="smart-form" id="career-fm" method="POST" action="/career/one-apply">
                            <?php  echo '<input type="hidden" id="apply_for" name="apply_for" value="'.$model['id'].'"/>'; ?>
                            <div class="formitext"><input type="text" id="name" name="name" placeholder="Nama Lengkap"/></div>
                            <div class="formitext"><input class="datepicker" type="text" id="dob" name="dob" placeholder="Tanggal Lahir"/></div>
                            <div class="formitext"><input type="text" id="email" name="email" placeholder="Email"/></div>
                            <div class="formitext"><input type="text" id="address" name="address" placeholder="Alamat"/></div>
                            <div class="formiupload"><div class="filename" id="filename">Upload CV</div><div class="upload_btn">Upload<input type="file" name="inputfile" id="inputfile"/></div></div>
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
                    Terima kasih untuk aplikasi Anda. Kami akan menghubungi Anda dalam waktu 5 hari kerja.
                </p>
            </div>
        </div>
    </div>
</div>
