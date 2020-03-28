<!-- MAIN CONTENT -->
<div id="content">
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
			<h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
		</div>
		<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
			<h1>
                <a class="btn btn-primary" href="/manager/csr/csr-artikel/create" rel="tooltip" title="Add new CSR Artikel" data-placement="left">
					<i class="fa fa-plus fa-lg"></i>
				</a>
            </h1>
		</div>
	</div>

	<!-- widget grid -->
	<section id="widget-grid" class="">
		<!-- row -->
		<div class="row">
			<!-- NEW WIDGET START -->
			<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<!-- Widget ID (each widget will need unique ID)-->
				<div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-001"
					data-widget-editbutton="false"
					data-widget-deletebutton="false"
					data-widget-attstyle="jarviswidget-color-blueLight">

					<header>
						<span class="widget-icon"> <i class="fa fa-table"></i> </span>
						<h2>CSR Artikel List</h2>
					</header>
					<!-- widget div-->
					<div>
						<!-- widget content -->
						<div class="widget-body no-padding">
							<table id="dataTable" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th class="hasinput" style="width:100px">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="filter[id]" class="form-control filter-this" placeholder="Id" />
                                                    <div class="input-group-btn"><button type="button" class="clear-filter btn"><i class="fa fa-close"></i></button></div>
                                                </div>
                                            </div>

                                        </th>
                                        <th class="hasinput">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="filter[judul]" class="form-control filter-this" placeholder="Judul" />
                                                    <div class="input-group-btn"><button type="button" class="clear-filter btn"><i class="fa fa-close"></i></button></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="filter[short_content]" class="form-control filter-this" placeholder="Short Content" />
                                                    <div class="input-group-btn"><button type="button" class="clear-filter btn"><i class="fa fa-close"></i></button></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="hasinput" style="width:11%">
                                            <center><div class="btn-group btn-group-sm" data-toggle="buttons">
                                                <label class="btn btn-default btn-sm active">
                                                    <input type="radio" class="filter-this" name="filter[show]" value="active" autocomplete="off" checked> S
                                                </label>
                                                <label class="btn btn-default btn-sm">
                                                    <input type="radio" class="filter-this" name="filter[show]" value="inactive" autocomplete="off"> H
                                                </label>
                                            </div></center>
                                        </th>
                                        <th style="width:11%"></th>
                                    </tr>
                                    <tr>
                                        <th data-hide="phone,tablet">Id</th>
                                        <th data-class="expand"> Judul</th>
                                        <th data-hide="phone"> short_content</th>
                                        <th data-hide="phone,tablet"> Show</th>
                                        <th style="text-align: center;"> Action</th>
                                    </tr>
                                </thead>

							</table>
						</div> <!-- end widget content -->
					</div> <!-- end widget div -->
				</div> <!-- end widget -->
			</article> <!-- WIDGET END -->
		</div> <!-- end row -->
	</section> <!-- end widget grid -->
</div> <!-- END MAIN CONTENT -->
