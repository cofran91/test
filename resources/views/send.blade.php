@extends('layouts.app')

@section('content')
@include('sections.headers')
@include('sections.scripts')
@include('sections.navbar')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Solicititar envio</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            @if( !$errors->isEmpty() )
                               <div class="alert alert-danger">
                                   @foreach ( $errors->all() as $error )
                                       <strong>{{$error}}</strong><br>
                                   @endforeach
                               </div>
                           @endif
                            <!-- form start -->
                            <form id="quickForm" method="POST" action="{{ route('shipment')}}">
                                 @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label>Ciudad de envio</label>
                                                <select class="form-control select2bs4" style="width: 100%;" name="peopleCity">
                                                    @foreach($cities as $city)
                                                    <option value="{{$city->code}}">{{$city->city}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="address">Dirección</label>
                                                <input required type="text" name="address" class="form-control" value="{{ old('address') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="peopleReceiver">Nombre de quien recibe</label>
                                                <input required type="text" name="peopleReceiver" class="form-control" value="{{ old('peopleReceiver') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="peopleIdentification">Cedula</label>
                                                <input  type="number" name="peopleIdentification" required class="form-control" id="peopleIdentification" value="{{ old('peopleIdentification') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="peoplePhone">Celular</label>
                                                <input required type="number" name="peoplePhone" class="form-control" id="peoplePhone" value="{{ old('peoplePhone') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="peopleEmail">Email de destinatario</label>
                                                <input type="email" required name="peopleEmail" class="form-control" id="peopleEmail" value="{{ old('peopleEmail') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="declaredValue">Valor declarado</label>
                                                <input required type="number" name="declaredValue" class="form-control" id="declaredValue" value="{{ old('declaredValue') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="amountToReceive">Valor a recibir</label>
                                                <input required type="number" name="amountToReceive" class="form-control" id="amountToReceive" value="{{ old('amountToReceive') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="width">Ancho</label>
                                                <input  type="text" name="width" class="form-control" id="width" value="{{ old('width') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="high">Altura</label>
                                                <input type="text" class="form-control" id="high" name="high" value="{{ old('high') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="long">Largo</label>
                                                <input  type="text" name="long" class="form-control" id="long" value="{{ old('long') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="weight">Peso</label>
                                                <input type="text" class="form-control" id="weight" name="weight" value="{{ old('weight') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group">
                                                <label for="toCollectDate">Fecha de recogida</label>
                                                <input  type="date" name="toCollectDate" class="form-control" id="toCollectDate" value="{{ old('toCollectDate') }}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Solicitar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
