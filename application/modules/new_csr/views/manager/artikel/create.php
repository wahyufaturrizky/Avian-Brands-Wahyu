<?php
    $id               = isset($item["id"]) ? $item["id"] : "";
    $judul            = isset($item["judul"]) ? $item["judul"] : "";
    $pretty_url       = isset($item["pretty_url"]) ? $item["pretty_url"] : "";
    $short_content          = isset($item["short_content"]) ? $item["short_content"] : "";
    $content          = isset($item["content"]) ? $item["content"] : "";
    $content_device   = isset($item["content_device"]) ? $item["content_device"] : "";
    $is_show          = isset($item["is_show"]) ? $item["is_show"] : "";
    $meta_desc          = isset($item["meta_desc"]) ? $item["meta_desc"] : "";
    $meta_keys          = isset($item["meta_keys"]) ? $item["meta_keys"] : "";

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
                <button class="btn btn-warning back-button" onclick="window.location.href='/manager/csr/csr-artikel/lists';" title="Back" rel="tooltip" data-placement="left" data-original-title="Batal">
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

                        <form class="smart-form" id="create-form" action="/manager/csr/csr-artikel/process-form" method="POST">
                            <header>CSR Artikel form</header>
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
                                        <label class="label">URL <sup class="color-red">*</sup></label>
                                        <label class="input">
                                            <input name="pretty_url" id="pretty_url" type="text"  class="form-control" placeholder="URL" value="<?php echo $pretty_url; ?>" />
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Short Content <sup class="color-red">*</sup></label>
                                        <label class="textarea">
                                            <textarea name="short_content" id="short_content" class="form-control" rows="5"><?= $short_content; ?></textarea>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Content</label>
                                        <label class="textarea">
                                            <textarea name="content" id="content" class="form-control tinymce" rows="1"><?= $content; ?></textarea>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Meta Description</label>
                                        <label class="textarea">
                                            <textarea name="meta_desc" id="meta_desc" class="form-control" rows="5"><?= $meta_desc; ?></textarea>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Meta Keys</label>
                                        <label class="textarea">
                                            <textarea name="meta_keys" id="meta_keys" class="form-control" rows="3"><?= $meta_keys; ?></textarea>
                                        </label>
                                    </section>
                                    <section class="col col-4">
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
