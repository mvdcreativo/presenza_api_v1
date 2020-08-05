@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Municipality
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($municipality, ['route' => ['municipalities.update', $municipality->id], 'method' => 'patch']) !!}

                        @include('municipalities.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection