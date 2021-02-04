@extends('layouts.admin-master')

@section('title', 'All Vehicle Reports')

@section('content')
<div class="container  content-area">
    <div class="section">
        <div class="page-header">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"><i class="fe fe-life-buoy mr-1"></i> Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">All Vehicle Reports</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Choose Company Name</label>
                            <select id="companyName" name="status" class="form-control select2 custom-select" data-placeholder="Choose one" required>
                                <option label="Choose one"></option>
                                @foreach($allCompanies as $company)
                                <option value="{{ $company->company_id }}">{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="vehicleItems">
            @include('admin.pages.nav-reports.single-item')
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/sweet-alert/sweetalert.css') }}" />
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}" />
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('js/select2.js') }}"></script>
<script>
    $(document).ready(function() {
        companyId = null;

        $(document).on('click', '.page-link', function(event) {
            event.preventDefault();
            console.log('called');
            page = $(this).attr('href').split('page=')[1];
            fetch_data(page);

        });

        function fetch_data(page) {
            $.ajax({
                url: "{{ route('report-paginate-render') }}",
                method: 'POST',
                data: {
                    _token: "{{csrf_token()}}",
                    page: page,
                    companyId: companyId,
                },
                success: function(participants) {
                    $('#vehicleItems').html(participants)
                }
            })
        }

        $('#companyName').on('change', function() {
            companyId = this.value;
            $.ajax({
                url: "{{ route('report-by-company') }}",
                method: 'POST',
                data: {
                    companyId: companyId,
                    _token: '{{csrf_token()}}',
                },
                success: function(response) {
                    $('#vehicleItems').html(response);
                }
            })
        });
    })
</script>

@if(session('error'))
<script>
    $(document).ready(function() {
        Swal.fire({
            title: "Alert",
            text: "{{ session('error') }}",
            icon: "error",
            showCancelButton: true,
            confirmButtonText: 'Exit',
            cancelButtonText: 'Stay on the page'
        });
    });
</script>
@endif
@endsection