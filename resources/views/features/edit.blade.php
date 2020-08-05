@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Feature
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($feature, ['route' => ['features.update', $feature->id], 'method' => 'patch']) !!}

                        @include('features.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection