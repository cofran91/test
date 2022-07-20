@extends('layouts.app')

@section('content')
@include('sections.navbar')
@include('sections.headers')
@include('sections.scripts')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Listado de envios</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Cedula</th>
                                        <th>Email</th>
                                        <th>Ver estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($shipments as $shipment)
                                    <tr>
                                        <td>{{$shipment->peopleReceiver}}</td>
                                        <td>{{$shipment->peopleIdentification}}</td>
                                        <td>{{$shipment->peopleEmail}}</td>
                                        <td><a href="{{route('status', $shipment->id)}}"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

