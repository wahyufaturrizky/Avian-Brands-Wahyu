<?php
    $id                  = isset($item["id"]) ? $item["id"] : "";
    $title               = isset($item["title"]) ? $item["title"] : "";
    $position            = isset($item["position"]) ? $item["position"] : "";
    $location            = isset($item["location"]) ? $item["location"] : "";
    $detail              = isset($item["detail"]) ? $item["detail"] : "";
    $requirement         = isset($item["requirement"]) ? $item["requirement"] : "";
    $additional_info     = isset($item["additional_info"]) ? $item["additional_info"] : "";
    $available_from_date = isset($item["available_from_date"]) ? date("m/d/Y", strtotime($item["available_from_date"])) : "";
    $available_to_date   = isset($item["available_to_date"]) ? date("m/d/Y", strtotime($item["available_to_date"])) : "";
    $is_show             = isset($item["is_show"]) ? $item["is_show"] : "";
    $status              = isset($item["status"]) ? $item["status"] : "";
    $created_date        = isset($item["created_date"]) ? $item["created_date"] : "";
    $updated_date        = isset($item["updated_date"]) ? $item["updated_date"] : "";
    $deleted_date        = isset($item["deleted_date"]) ? $item["deleted_date"] : "";
    $meta_keys           = isset($item["meta_keys"]) ? $item["meta_keys"] : "";
    $meta_desc           = isset($item["meta_desc"]) ? $item["meta_desc"] : "";
    $type                = isset($item["type_pegawai"]) ? $item["type_pegawai"] : "";

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
                <button class="btn btn-warning back-button" onclick="window.location.href='/manager/career/job/lists';" title="Back" rel="tooltip" data-placement="left" data-original-title="Batal">
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

                        <form class="smart-form" id="create-form" action="/manager/career/job/process-form" method="POST">
                            <header>Job Offers form</header>
                            <?php if($id != 0): ?>
                                <input type="hidden" name="id" value="<?= $id ?>" />
                            <?php endif; ?>
                                <fieldset>
                                    <section>
                                        <label class="label">Title <sup class="color-red">*</sup></label>
                                        <label class="input">
                                            <input name="title" id="title" type="text"  class="form-control" placeholder="Title" value="<?php echo $title; ?>" />
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Position <sup class="color-red">*</sup></label>
                                        <label class="input">
                                                <input name="position" id="position" type="text"  class="form-control" placeholder="Position" value="<?php echo $position; ?>" />
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Location <sup class="color-red">*</sup></label>
                                        <label class="input">
                                                <input name="location" id="location" type="text"  class="form-control" placeholder="Lokasi" value="<?php echo $location; ?>" />
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Tipe Pegawai <sup class="color-red">*</sup></label>
                                        <label class="input">
                                               <select class="form-control" name="tipe_pegawai" id="tipe_pegawai" >
                                                   <option value="kontrak" <?= ($type == "kontrak") ? 'selected' : ''; ?> >Kontrak</option>
                                                   <option value="mt" <?= ($type == "mt") ? 'selected' : ''; ?> >MT</option>
                                                   <option value="pegawai_tetap" <?= ($type == "pegawai_tetap") ? 'selected' : ''; ?> >Pegawai Tetap</option>
                                               </select>
                                        </label>
                                    </section>
                                    <div class="row">
                                        <section class="col col-6">
                                            <label class="label">Available from date <sup class="color-red">*</sup></label>
                                            <label class="input">
                                                    <i class="icon-append fa fa-calendar"></i>
                                                    <input name="available_from_date" type="text" id="available_from_date"  class="form-control" data-dateformat="yy-mm-dd" placeholder="Available from date" value="<?php echo $available_from_date; ?>" readonly/>
                                            </label>
                                        </section>
                                        <section class="col col-6">
                                            <label class="label">Available to date <sup class="color-red">*</sup></label>
                                            <label class="input">
                                                    <i class="icon-append fa fa-calendar"></i>
                                                    <input name="available_to_date" type="text" id="available_to_date"  class="form-control" data-dateformat="yy-mm-dd" placeholder="Available to date" value="<?php echo $available_to_date; ?>" readonly/>
                                            </label>
                                        </section>
                                    </div>
                                    <section>
                                        <label class="label">Detail <sup class="color-red">*</sup></label>
                                        <label class="textarea">
                                            <textarea name="detail" id="detail" class="form-control tinymce" rows="1"><?= $detail; ?></textarea>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Requirement <sup class="color-red">*</sup></label>
                                        <label class="textarea">
                                            <textarea name="requirement" id="requirement" class="form-control tinymce" rows="1"><?= $requirement; ?></textarea>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Additional info <sup class="color-red">*</sup></label>
                                        <label class="textarea">
                                            <textarea name="additional_info" id="additional_info" class="form-control tinymce" rows="1"><?= $additional_info; ?></textarea>
                                        </label>
                                    </section>
                                     <section>
                                        <label class="label">Show / Hide </label>
                                        <label class="input"> 
                                            <?php echo select_is_show('is_show', $is_show); ?>
                                        </label>
                                    </section>
                                    <fieldset>
                                        <section>
                                            <label class="label">Meta description </label>
                                            <label class="input"> 
                                                <textarea name="meta_desc" id="meta_desc" class="form-control" rows="3" placeholder=" Untuk SEO, deskripsi dari Tips / Article, sebaiknya 70 karakter minimum."><?php echo $meta_desc; ?></textarea>
                                            </label>
                                        </section>
                                        <section>
                                            <label class="label">Meta keywords </label>
                                            <label class="input"> 
                                                <textarea name="meta_keys" id="meta_keys" class="form-control" rows="3" placeholder=" Kata kunci untuk SEO dari Tips / Article"><?php echo $meta_keys; ?></textarea>
                                            </label>
                                        </section>
                                    </fieldset>

                                    <?php if ($created_date != ""): ?>
                                    <section>
                                        <div class="row">
                                            <label class="label">Created date </label>
                                            <label class="input"> 
                                                <?php echo $created_date; ?>
                                            </label>
                                        </div>
                                    </section> 
                                    <?php endif; ?>
                                    
                                    <?php if ($updated_date != ""): ?>
                                    <section>
                                        <div class="row">
                                            <label class="label">Update date </label>
                                            <label class="input"> 
                                                <?php echo $updated_date; ?>
                                            </label>
                                        </div>
                                    </section> 
                                    <?php endif; ?>    
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
