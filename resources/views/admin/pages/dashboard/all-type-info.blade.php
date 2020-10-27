    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body d-flex">
                    <div class="card-order">
                        <h6 class="mb-2">Total Device Type</h6>
                        <h2 class="mb-1"><span class="number-font counter">{{ count($allDeviceType) }}</span></h2>
                        <span class="fs-12 text-muted">
                            Active Device Type
                            <span class="text-success mr-1">
                                <i class="fe fe-arrow-up ml-1 "></i> {{countDeviceTypeStatus(1)}}
                            </span>
                        </span>
                        <br />
                        <span class="fs-12 text-muted">
                            Inactive Device Type
                            <span class="text-danger mr-1">
                                <i class="fe fe-arrow-down ml-1 "></i> {{countDeviceTypeStatus(0)}}
                            </span>
                        </span>
                        <p class="text-muted fs-12 mb-0"><a href="{{ route('device-type.index') }}"> View Details..</a></p>
                    </div>
                    <div class="ml-auto">
                        <span class="bg-primary-transparent icon-service text-primary"><i class="fe fe-server fs-2"></i> </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="card ">
                <div class="card-body d-flex">
                    <div class="card-order">
                        <h6 class="mb-2">Total Vehicle Type</h6>
                        <h2 class="mb-1"><span class="number-font counter">{{ count($allVehicleType) }}</span></h2>
                        <span class="fs-12 text-muted">
                            Active Vehicle Type
                            <span class="text-success mr-1">
                                <i class="fe fe-arrow-up ml-1 "></i> {{ countVehicleTypeStatus(1) }}
                            </span>
                        </span>
                        <br />
                        <span class="fs-12 text-muted">
                            Inactive Vehicle Type
                            <span class="text-danger mr-1">
                                <i class="fe fe-arrow-down ml-1 "></i> {{ countVehicleTypeStatus(0) }}
                            </span>
                        </span>
                        <p class="text-muted fs-12 mb-0"><a href="{{ route('vehicle-type.index') }}"> View Details..</a></p>
                    </div>
                    <div class="ml-auto">
                        <span class="bg-secondary-transparent icon-service text-secondary"><i class="ion ion-model-s fs-2"></i> </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-body d-flex">
                    <div class="card-order">
                        <h6 class="mb-2">Total Expense Type</h6>
                        <h2 class="mb-1"><span class="number-font counter">{{ count($allExpenseType) }}</span></h2>
                        <span class="fs-12 text-muted">
                            Active Expense Type
                            <span class="text-success mr-1">
                                <i class="fe fe-arrow-up ml-1 "></i> {{ countExpensesTypeStatus(1) }}
                            </span>
                        </span>
                        <br />
                        <span class="fs-12 text-muted">
                            Inactive Expense Type
                            <span class="text-danger mr-1">
                                <i class="fe fe-arrow-down ml-1 "></i> {{ countExpensesTypeStatus(0) }}
                            </span>
                        </span>
                        <p class="text-muted fs-12 mb-0"><a href="{{ route('expenses-type.index') }}"> View Details..</a></p>
                    </div>
                    <div class="ml-auto">
                        <span class="bg-danger-transparent icon-service text-danger"><i class="fe fe-file-text fs-2"></i> </span>
                    </div>
                </div>
            </div>
        </div>
    </div>