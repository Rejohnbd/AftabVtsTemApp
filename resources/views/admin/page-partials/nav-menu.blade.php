<div class="sticky">
    <div class="horizontal-main hor-menu clearfix">
        <div class="horizontal-mainwrapper container clearfix">
            <nav class="horizontalMenu clearfix">
                <ul class="horizontalMenu-list">
                    <li aria-haspopup="true"><a href="#" class="sub-icon "><i class="fe fe-users"></i> Users <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('drivers.index') }}">Drivers</a></li>
                            <li aria-haspopup="true"><a href="{{ route('helpers.index') }}">Helpers</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="#" class="sub-icon "><i class="fe fe-server"></i> Devices <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('device-type.index') }}">Devices Types</a></li>
                            <li aria-haspopup="true"><a href="{{ route('devices.index') }}">All Devices</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="#" class=""><i class="ion ion-model-s"></i> Vehicles <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('vehicle-type.index') }}">Vehicle Types</a></li>
                            <li aria-haspopup="true"><a href="{{ route('vehicles.index') }}">All Vehicle</a></li>
                            <li aria-haspopup="true"><a href="{{ route('vehicle-device') }}">All Vehicle Devices</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="#" class=""><i class="fe fe-life-buoy"></i> Maintenance<i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('maintenance-type.index') }}">Maintenance Type</a></li>
                            <li aria-haspopup="true"><a href="{{ route('maintenance.index') }}">All Maintenance</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-file-text"></i> Expenses <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('expenses-type.index') }}">Expenses Types</a></li>
                            <li aria-haspopup="true"><a href="{{ route('all-expenses.index') }}">All Expenses</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-road"></i> Trips <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('trip-type.index') }}">Trip Types</a></li>
                            <li aria-haspopup="true"><a href="{{ route('trips.index') }}">All Trips</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="{{ route('all-vehicle-location') }}" class="sub-icon"><i class="fa fa-map-marker"></i> Maps</a></li>
                    <li aria-haspopup="true"><a href="{{ route('all-reports') }}" class="sub-icon"><i class="fe fe-layers"></i>Reports</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>