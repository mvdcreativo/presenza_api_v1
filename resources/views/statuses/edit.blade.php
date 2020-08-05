@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Status
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($status, ['route' => ['statuses.update', $status->id], 'method' => 'patch']) !!}

                        @include('statuses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection