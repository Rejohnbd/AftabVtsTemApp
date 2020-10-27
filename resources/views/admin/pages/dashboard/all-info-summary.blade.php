<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-3">
        <div class="card">
            <div class="card-body d-flex">
                <div class="card-order">
                    <h6 class="mb-2">Total Devices</h6>
                    <h2 class="mb-1"><span class="number-font counter">{{ count($allDevices) }}</span></h2>
                    <span class="fs-12 text-muted">
                        Active Devices
                        <span class="text-success mr-1">
                            <i class="fe fe-arrow-up ml-1 "></i> {{countDeviceStatus(1)}}
                        </span>
                    </span>
                    <br />
                    <span class="fs-12 text-muted">
                        Inactive Devices
                        <span class="text-danger mr-1">
                            <i class="fe fe-arrow-down ml-1 "></i> {{countDeviceStatus(0)}}
                        </span>
                    </span>
                    <p class="text-muted fs-12 mb-0"><a href="{{ route('devices.index') }}"> View Details..</a></p>
                </div>
                <div class="ml-auto">
                    <span class="bg-primary-transparent icon-service text-primary"><i class="fe fe-server fs-2"></i> </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-3">
        <div class="card ">
            <div class="card-body d-flex">
                <div class="card-order">
                    <h6 class="mb-2">Total Vehicles</h6>
                    <h2 class="mb-1"><span class="number-font counter">{{ count($allVehicle) }}</span></h2>
                    <p class="text-muted fs-12 mb-0"><a href="{{ route('vehicles.index') }}"> View Details..</a></p>
                </div>
                <div class="ml-auto">
                    <span class="bg-secondary-transparent icon-service text-secondary"><i class="ion ion-model-s fs-2"></i> </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-3">
        <div class="card">
            <div class="card-body d-flex">
                <div class="card-order">
                    <h6 class="mb-2">Total Drivers</h6>
                    <h2 class="mb-1"><span class="number-font counter">{{ count($allDrivers) }}</span></h2>
                    <span class="fs-12 text-muted">
                        Active Drivers
                        <span class="text-success mr-1">
                            <i class="fe fe-arrow-up ml-1 "></i> {{countDriverStatus(1)}}
                        </span>
                    </span>
                    <br />
                    <span class="fs-12 text-muted">
                        Inactive Drivers
                        <span class="text-danger mr-1">
                            <i class="fe fe-arrow-down ml-1 "></i> {{countDriverStatus(0)}}
                        </span>
                    </span>
                    <p class="text-muted fs-12 mb-0"><a href="{{ route('drivers.index') }}"> View Details..</a></p>
                </div>
                <div class="ml-auto">
                    <span class="bg-primary-transparent icon-service text-primary"><i class="icon icon-people fs-2"></i> </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-3">
        <div class="card">
            <div class="card-body d-flex">
                <div class="card-order">
                    <h6 class="mb-2">Total Helpers</h6>
                    <h2 class="mb-1"><span class="number-font counter">{{ count($allHelper) }}</span></h2>
                    <span class="fs-12 text-muted">
                        Active Helpers
                        <span class="text-success mr-1">
                            <i class="fe fe-arrow-up ml-1 "></i> {{ countHelperStatus(1) }}
                        </span>
                    </span>
                    <br />
                    <span class="fs-12 text-muted">
                        Inactive Helpers
                        <span class="text-danger mr-1">
                            <i class="fe fe-arrow-down ml-1 "></i> {{ countHelperStatus(0) }}
                        </span>
                    </span>
                    <p class="text-muted fs-12 mb-0"><a href="{{ route('helpers.index') }}"> View Details..</a></p>
                </div>
                <div class="ml-auto">
                    <span class="bg-danger-transparent icon-service text-danger"><i class="ion ion-person-stalker fs-2"></i> </span>
                </div>
            </div>
        </div>
    </div>
</div>