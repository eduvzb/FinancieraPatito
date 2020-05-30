@extends('layouts.app')

@section('content')
<div class="row ">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3 class="mb-0">Detalle de pagos</h3>
                    </div>
                    <div class="">
                        <a href="#" class="btn btn-primary">Descargar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead >
                        <tr >
                            <th>Número de pago</th>
                            <th>Cuota</th>
                            <th>Abonado</th>
                            <th>Fecha de pago</th>
                            <th>Fecha de abono</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


