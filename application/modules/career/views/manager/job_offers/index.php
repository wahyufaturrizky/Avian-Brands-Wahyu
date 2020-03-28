<!-- MAIN CONTENT -->
<div id="content">
	<div class="row">
		<div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
			<h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
		</div>
		<div class="col-xs-12 col-sm-5 col-md-5 col-lg-4 col-lg-offset-1 text-right">
			<h1>
                <a class="btn btn-primary" href="/manager/career/job/create" rel="tooltip" title="Add new Vacancy" data-placement="left">
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
						<h2>Vacancy List</h2>
					</header>
					<!-- widget div-->
					<div>
						<!-- widget content -->
						<div class="widget-body no-padding">
							<table id="dataTable" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th class="hasinput" style="width:7%">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="filter[id]" class="form-control filter-this" placeholder="Id" />
                                                    <div class="input-group-btn"><button type="button" class="clear-filter btn"><i class="fa fa-close"></i></button></div>
                                                </div>
                                            </div>

                                        </th>
                                        <th class="hasinput" style="width:27%">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="filter[title]" class="form-control filter-this" placeholder="Title" />
                                                    <div class="input-group-btn"><button type="button" class="clear-filter btn"><i class="fa fa-close"></i></button></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="hasinput" style="width:17%">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="filter[position]" class="form-control filter-this" placeholder="Position" />
                                                    <div class="input-group-btn"><button type="button" class="clear-filter btn"><i class="fa fa-close"></i></button></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th></th>
                                        <th class="hasinput" style="width:14%">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="filter[start]" class="form-control filter-this date-range-picker" placeholder="Start Date" readonly />
                                                    <div class="input-group-btn"><button class="btn open-calendar-button" type="button"><i class="fa fa-calendar" aria-hidden="true"></i></button></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="hasinput" style="width:14%;">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" name="filter[end]" class="form-control filter-this date-range-picker" placeholder="End Date" readonly />
                                                    <div class="input-group-btn"><button class="btn open-calendar-button" type="button"><i class="fa fa-calendar" aria-hidden="true"></i></button></div>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="hasinput" style="width:8%">
                                            <center><div class="btn-group btn-group-sm" data-toggle="buttons">
                                                <label class="btn btn-default btn-sm active">
                                                    <input type="radio" class="filter-this" name="filter[show]" value="active" autocomplete="off" checked> S
                                                </label>
                                                <label class="btn btn-default btn-sm">
                                                    <input type="radio" class="filter-this" name="filter[show]" value="inactive" autocomplete="off"> H
                                                </label>
                                            </div></center>
                                        </th>
                                        <th style="width:15%"></th>
                                    </tr>
                                    <tr>
                                        <th data-hide="phone,tablet">Id</th>
                                        <th data-class="expand"> Title</th>
                                        <th data-hide="phone,tablet"> Position</th>
                                        <th data-hide="phone,tablet"> Location</th>
                                        <th data-hide="phone,tablet"> Start Date</th>
                                        <th data-hide="phone,tablet"> End Date</th>
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
