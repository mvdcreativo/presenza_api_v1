@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Transaction Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($transactionType, ['route' => ['transactionTypes.update', $transactionType->id], 'method' => 'patch']) !!}

                        @include('transaction_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection