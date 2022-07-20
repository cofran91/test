@extends('layouts.app')

@section('content')
@include('sections.navbar')
@include('sections.headers')
@include('sections.scripts')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Estado del pedido</h3>
                </div>
                <div class="card-body">

                   {{$statu[0]}}
                </div>
                <div class="card-footer">
                  <a href="{{route('list')}}"><button  type="button" class="btn btn-primary">Regresar</button></a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

