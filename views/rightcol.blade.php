<!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-5 connectedSortable">
    <!-- Calendar -->
    <div class="card bg-gradient-success">
        <div class="card-header border-0">
            <h3 class="card-title">
                <i class="far fa-calendar-alt"></i>
                Calendar
            </h3>
            <!-- tools card -->
            <div class="card-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                    <button type="button" class="btn
                        btn-success btn-sm
                        dropdown-toggle" data-toggle="dropdown"
                        data-offset="-52">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" role="menu">
                        <a href="#" class="dropdown-item">Add
                            new event</a>
                        <a href="#" class="dropdown-item">Clear
                            events</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">View
                            calendar</a>
                    </div>
                </div>
                <button type="button" class="btn
                    btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn
                    btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pt-0">
            <!--The calendar -->
            <div id="calendar" style="width: 100%"></div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    
    <!-- Map card -->
    <div class="card bg-gradient-primary">
        <div class="card-header border-0">
            <h3 class="card-title">
                <i class="fas fa-map-marker-alt
                    mr-1"></i>
                Visitors
            </h3>
            <!-- card tools -->
            <div class="card-tools">
                <button type="button" class="btn
                    btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                </button>
                <button type="button" class="btn
                    btn-primary btn-sm" data-card-widget="collapse"
                    title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
            <!-- /.card-tools -->
        </div>
        <div class="card-body">
            <div id="world-map" style="height:
                250px; width: 100%;"></div>
        </div>
        <!-- /.card-body-->
        <div class="card-footer bg-transparent">
            <div class="row">
                <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Visitors</div>
                </div>
                <!-- ./col -->
                <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Online</div>
                </div>
                <!-- ./col -->
                <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Sales</div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.card -->




</section>
<!-- right col -->