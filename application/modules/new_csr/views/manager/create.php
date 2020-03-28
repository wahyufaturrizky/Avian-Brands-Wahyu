<?php
    $id               = isset($item["id"]) ? $item["id"] : "";
    $judul            = isset($item["judul"]) ? $item["judul"] : "";
    $pretty_url       = isset($item["pretty_url"]) ? $item["pretty_url"] : "";
    $lokasi           = isset($item["lokasi"]) ? $item["lokasi"] : "";
    $type             = isset($item["type"]) ? $item["type"] : "";
    $latitude         = isset($item["latitude"]) ? $item["latitude"] : "";
    $longitude        = isset($item["longitude"]) ? $item["longitude"] : "";
    $image_landing    = isset($item["image_landing"]) ? $item["image_landing"] : "";
    $short_content          = isset($item["short_content"]) ? $item["short_content"] : "";
    $content          = isset($item["content"]) ? $item["content"] : "";
    $content_device   = isset($item["content_device"]) ? $item["content_device"] : "";
    $is_show          = isset($item["is_show"]) ? $item["is_show"] : "";
    $created_date     = isset($item["created_date"]) ? $item["created_date"] : date('Y-m-d');
    $updated_date     = isset($item["updated_date"]) ? $item["updated_date"] : "";
    $judul_artikel     = isset($item["judul_artikel"]) ? $item["judul_artikel"] : "";
    $artikel_csr_id     = isset($item["artikel_csr_id"]) ? $item["artikel_csr_id"] : "";

    $btn_msg   = ($id == 0) ? "Create" : " Update";
    $title_msg = ($id == 0) ? "Create" : " Update";
    $data_edit = ($id == 0) ? 0 : 1;

    $btn_msg   = ($id == 0) ? "Create" : " Update";
    $title_msg = ($id == 0) ? "Create" : " Update";
    $data_edit = ($id == 0) ? 0 : 1;
?>

<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
			<h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
		</div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
			<h1>
                <button class="btn btn-warning back-button" onclick="window.location.href='/manager/csr';" title="Back" rel="tooltip" data-placement="left" data-original-title="Batal">
					<i class="fa fa-arrow-circle-left fa-lg"></i>
				</button>
				<button class="btn btn-primary submit-form" data-form-target="create-form" title="Simpan" rel="tooltip" data-placement="top" >
					<i class="fa fa-floppy-o fa-lg"></i>
				</button>
			</h1>
		</div>
	</div>

    <!-- widget grid -->
    <section id="widget-grid" class="">

        <div class="row">
            <!-- NEW WIDGET ROW START -->
            <article class="col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-0"
                data-widget-editbutton="false"
                data-widget-deletebutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-pencil-square-o"></i> </span>
                        <h2><?= $title_msg ?></h2>
                    </header>

                    <!-- widget div-->
                    <div>

                        <form class="smart-form" id="create-form" action="/manager/csr/process-form" method="POST">
                            <header>CSR form</header>
                                <?php if($id != 0): ?>
                                    <input type="hidden" name="id" id="id" value="<?= $id ?>" />
                                <?php endif; ?>
                                <fieldset>
                                    <section>
                                        <label class="label">Judul <sup class="color-red">*</sup></label>
                                        <label class="input">
                                            <input name="judul" id="judul" type="text"  class="form-control" placeholder="Judul" value="<?php echo $judul; ?>" />
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Tipe <sup class="color-red">*</sup></label>
                                        <label class="select">
                                            <?= select_tipe_csr("type", $type, 'class="form-control" id="type"' ); ?>
                                            <i></i>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Lokasi <sup class="color-red">*</sup></label>
                                        <label class="input">
                                            <input name="lokasi" id="lokasi" type="text"  class="form-control" placeholder="Lokasi" value="<?php echo $lokasi; ?>" />
                                        </label>
                                    </section>

                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="label">Latitude <sup class="color-red">*</sup></label>
                                            <label class="input">
                                                <input name="latitude" id="latitude" type="text"  class="form-control" value="<?= $latitude; ?>"/>
                                            </label>
                                        </section>
                                        <section  class="col col-6">
                                            <label class="label">Longitude <sup class="color-red">*</sup></label>
                                            <label class="input">
                                                <input name="longitude" id="longitude" type="text"  class="form-control" value="<?= $longitude; ?>"/>
                                            </label>
                                        </section>
                                    </div>

                                    <section>
    									<label class="label">MAP</label>
    									<label class="input">
    									</label>
                                        <div id="map" style="height:300px"></div>
    								</section>

                                    <section>
                                        <label class="label">Image Preview (600x165 px)<sup class="color-red">*</sup></label>
                                        <div class="input">
                                            <div class="add-image-preview" id="preview-image-user">
                                                <?php if($image_landing): ?>
                                                <img src="<?= $image_landing ?>" height="100px"/>
                                                <?php endif; ?>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-sm" id="addimage" data-maxsize="<?= MAX_UPLOAD_IMAGE_SIZE ?>" data-maxwords="<?= WORDS_MAX_UPLOAD_IMAGE_SIZE ?>" data-edit="<?= $data_edit ?>"><?= ($image_landing != "") ? "Change" : "Add" ?> Image</button>
                                        </div>
                                    </section>

                                    <section>
                                        <label class="label">Artikel <sup class="color-red">*</sup></label>
                                        <label class="input">
                                            <select class="form-control select2 artikel-select" name="artikel_csr_id" style="width:100%">
                                                <?php if($artikel_csr_id != ""): ?>
                                                <option value="<?= $artikel_csr_id ?>"><?= $judul_artikel ?></option>
                                                <?php endif; ?>
                                            </select>
                                        </label>
                                    </section>

                                    <section >
                                        <label class="label">Show / Hide </label>
                                        <label class="input">
                                            <?php echo select_is_show('is_show', $is_show); ?>
                                        </label>
                                    </section>


                                    <section>
                                        <label class="label">Tanggal </label>
                                        <label class="input">
                                            <i class="icon-append fa fa-calendar"></i>
                                            <input name="date" id="date" type="text"  class="form-control datepicker" data-dateformat="yy-mm-dd" placeholder="Tanggal" value="<?= date('Y-m-d', strtotime($created_date)); ?>" />
                                        </label>
                                    </section>
                                </fieldset>
                        </form>

                    </div>
                    <!-- end widget content -->


                </div>
                <!-- end widget div -->

            </article>

        </div>
    </section> <!-- end widget grid -->
</div> <!-- END MAIN CONTENT -->
