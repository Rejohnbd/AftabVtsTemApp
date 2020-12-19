<div class="sticky">
    <div class="horizontal-main hor-menu clearfix">
        <div class="horizontal-mainwrapper container clearfix">
            <nav class="horizontalMenu clearfix">
                <ul class="horizontalMenu-list">
                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-cog"></i> Settings <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('company.index') }}">Companies</a></li>
                            <li aria-haspopup="true"><a href="{{ route('settings.index') }}">Settings</a></li>
                        </ul>
                    </li>
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
                            <li aria-haspopup="true"><a href="{{ route('maintenance-type.index') }}">Maintenance Type</a></li>
                            <li aria-haspopup="true"><a href="{{ route('maintenance.index') }}">All Maintenance</a></li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="#" class="sub-icon">Trips &amp; Expenses <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Trips</a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="{{ route('trip-type.index') }}">Trip Types</a></li>
                                    <li aria-haspopup="true"><a href="{{ route('trips.index') }}">All Trips</a></li>
                                    <li aria-haspopup="true"><a href="{{ route('trip-reports') }}">Trips Reports</a></li>
                                </ul>
                            </li>
                            <li aria-haspopup="true" class="sub-menu-sub"><a href="#">Expenses</a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="{{ route('expenses-type.index') }}">Expenses Types</a></li>
                                    <li aria-haspopup="true"><a href="{{ route('all-expenses.index') }}">All Expenses</a></li>
                                    <li aria-haspopup="true"><a href="{{ route('expenses-reports') }}">Expenses Report</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fe fe-layers"></i>Reports <i class="fa fa-angle-down horizontal-icon"></i></a>
                        <ul class="sub-menu">
                            <li aria-haspopup="true"><a href="{{ route('all-reports') }}">Reports</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>