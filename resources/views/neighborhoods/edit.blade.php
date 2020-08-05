@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Neighborhood
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($neighborhood, ['route' => ['neighborhoods.update', $neighborhood->id], 'method' => 'patch']) !!}

                        @include('neighborhoods.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection