<?php
    $csr_id           = isset($csr["id"]) ? $csr["id"] : "";
    $slider_id        = isset($slider["id"]) ? $slider["id"] : "";
    $image_slider     = isset($slider["image_slider"]) ? $slider["image_slider"] : "";
    $is_show          = isset($slider["is_show"]) ? $slider["is_show"] : "1";

    $btn_msg   = ($slider_id == 0) ? "Create" : " Update";
    $title_msg = ($slider_id == 0) ? "Create" : " Update";
    $data_edit = ($slider_id == 0) ? 0 : 1;

    $btn_msg   = ($slider_id == 0) ? "Create" : " Update";
    $title_msg = ($slider_id == 0) ? "Create" : " Update";
    $data_edit = ($slider_id == 0) ? 0 : 1;
?>

<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
			<h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
		</div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
			<h1>
                <a href="<?= $back ?>"><button class="btn btn-warning back-button" title="Back" rel="tooltip" data-placement="left" data-original-title="Batal">
					<i class="fa fa-arrow-circle-left fa-lg"></i>
				</button></a>
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

                        <form class="smart-form" id="create-form" action="/manager/csr/process-slider" method="POST">
                        	<!-- HIDDEN INPUT -->
                        	<input type="hidden" name="csr_id" value="<?= $csr_id ?>" />
                        	<input type="hidden" name="slider_id" value="<?= $slider_id ?>" />

                            <header>Slider for CSR <?= $csr['judul'] ?></header>
                                <fieldset>
                                    <section>
                                        <label class="label">Slider Image (660x410 px)<sup class="color-red">*</sup></label>
                                        <div class="input">
                                            <div class="add-image-preview" id="preview-image-user">
                                                <?php if($image_slider): ?>
                                                <img src="<?= $image_slider ?>" height="100px"/>
                                                <?php endif; ?>
                                            </div>
                                            <button type="button" class="btn btn-primary btn-sm" id="addimage" data-maxsize="<?= MAX_UPLOAD_IMAGE_SIZE ?>" data-maxwords="<?= WORDS_MAX_UPLOAD_IMAGE_SIZE ?>" data-edit="<?= $data_edit ?>"><?= ($image_slider != "") ? "Change" : "Add" ?> Image</button>
                                        </div>
                                    </section>
                                    <section>
                                        <label class="label">Show / Hide </label>
                                        <label class="input">
                                            <?php echo select_is_show('is_show', $is_show); ?>
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
