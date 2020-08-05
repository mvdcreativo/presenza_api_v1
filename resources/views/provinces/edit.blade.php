@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Province
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($province, ['route' => ['provinces.update', $province->id], 'method' => 'patch']) !!}

                        @include('provinces.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection