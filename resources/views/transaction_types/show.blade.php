@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Transaction Type
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('transaction_types.show_fields')
                    <a href="{{ route('transactionTypes.index') }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
