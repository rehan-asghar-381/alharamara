@extends('layouts.app')

@section('title', 'New Labor Cost')

@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body card-breadcrumb d-flex align-items-center justify-content-between">
                        <div class="page-title-box mb-0">
                            <h4 class="mb-0">New Labor Cost</h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.labor-costs.index') }}" class="btn btn-outline-secondary btn-sm">
                                Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Labor Cost Details</h4>
                        </div>

                        <form method="POST" action="{{ route('admin.labor-costs.store') }}">
                            @include('admin.labor_costs.form', [
                                'submitLabel' => 'Save Labor Cost',
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

