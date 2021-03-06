<div class="row">
    @forelse($datas as $data)
    <div class="col-sm-12 col-md-6 col-xl-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $data->vehicle_plate_number }}</h3>
                <div class="card-options">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">VEHICLE TYPE <span class="float-right">{{ $data->vehicleType->vehicle_type_name }}</span></li>
                    <li class="list-group-item">INSURANCE EXPIRE <span class="float-right">{{ date('d/m/Y', strtotime($data->vehicle_insurance_expire_date)) }}</span></li>
                    <li class="list-group-item">REGISTRATION EXPIRE <span class="float-right">{{ date('d/m/Y', strtotime($data->vehicle_registration_expire_date)) }}</span></li>
                    <li class="list-group-item">TAX TOKEN EXPIRE <span class="float-right">{{ date('d/m/Y', strtotime($data->vehicle_tax_token_expire_date)) }}</span></li>
                </ul>
            </div>
            <div class="card-footer">
                <div class="card-options d-flex justify-content-between">
                    <a href="{{ route('vehicle-reports', $data->vehicle_id) }}" class="btn btn-primary btn-sm ml-2">GPS Report</a>
                    <a href="{{ route('vehicle-temp-report', $data->vehicle_id) }}" class="btn btn-info btn-sm ml-2">Temp. Report</a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">No Vehicle Reports Exist</div>
            </div>
            <div class="card-body">
                <p class="">With supporting text below as a natural lead-in to additional content.</p>
            </div>
        </div>
    </div>
    @endforelse
</div>

<div class="row my-2">
    <div class="col-12 d-flex justify-content-center">
        {{$datas->links()}}
    </div>
</div>