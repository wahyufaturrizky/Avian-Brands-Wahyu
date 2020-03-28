<?php
    $id           = isset($item["id"]) ? $item["id"] : "";
    $vacancy_name = isset($item["vacancy"]) ? $item["vacancy"] : "";
    $fullname     = isset($item["fullname"]) ? $item["fullname"] : "";
    $email        = isset($item["email"]) ? $item["email"] : "";
    $gender       = isset($item["gender"]) ? $item["gender"] : "";
    $dob          = isset($item["dob"]) ? $item["dob"] : "";
    $address      = isset($item["address"]) ? $item["address"] : "";
    $file_path    = isset($item["file_path"]) ? $item["file_path"] : "";
    $created_date = isset($item["created_date"]) ? $item["created_date"] : "";
    $btn_msg   = ($id == 0) ? "Create" : " Detail";
    $title_msg = ($id == 0) ? "Create" : " Detail";
?>
<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
			<h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
		</div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
			<h1>
                <button class="btn btn-warning back-button" onclick="window.location.href='/manager/career/applicants/lists/';" title="Back" rel="tooltip" data-placement="left" data-original-title="Batal">
					<i class="fa fa-arrow-circle-left fa-lg"></i>
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
                    <!-- Widget div-->
                    <div>
                        <form class="smart-form" id="create-form" action=" " method="POST" enctype="multipart/form-data">
                            <header>
                                Applicants detail form
                                    <div class="pull-right">
                                        <label class="input">
                                            CV <?php echo ($file_path) ? "<a href='".$file_path."'>Download</a>" : "-"; ?>
                                        </label>
                                    </div>
                            </header>
                                <fieldset>
                                    <section>
                                        <label class="label">Vacancy</label>
                                        <label class="input">
                                            <input name="vacancy" type="text"  class="form-control" value="<?php echo $vacancy_name; ?>" readonly/>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Full Name</label>
                                        <label class="input">
                                            <input name="fullname" type="text"  class="form-control" value="<?php echo $fullname; ?>" readonly/>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">E-Mail</label>
                                        <label class="input">
                                            <input name="email" type="text"  class="form-control" value="<?php echo $email; ?>" readonly/>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Date of Birth</label>
                                        <label class="input">
                                            <input name="dob" type="text"  class="form-control" value="<?php echo date('d F Y', strtotime($dob)); ?>" readonly/>
                                        </label>
                                    </section>
                                    <section>
                                        <label class="label">Address</label>
                                        <label class="input">
                                            <input name="address" type="text"  class="form-control" value="<?php echo $address; ?>" readonly/>
                                        </label>
                                    </section>
                                    <?php if ($created_date != ""){ ?>
                                    <section>
                                        <label class="label">Apply Date</label>
                                        <label class="input">
                                            <input name="address" type="text"  class="form-control" value="<?php echo date('d F Y', strtotime($created_date)); ?>" readonly/>
                                        </label>
                                    </section>
                                    <?php } ?>
                                </fieldset>
                        </form>
                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget div -->
            </article>
        </div>
    </section>
    <!-- end widget grid -->
</div>
<!-- END MAIN CONTENT -->
