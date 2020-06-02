@extends('layouts.app')

@section('content')


<div class="row ">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3 class="mb-0">Pagps realizados</h3>
                    </div>
                    <div class="">
                        <a href="{{ route('loans.exportExcel') }}" class="btn btn-primary">Descargar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead >
                        <tr >
                            <th >#</th>
                            <th >Nombre</th>
                            <th >Monto ministrado</th>
                            <th >Cuota</th>
                            <th ># de pagos</th>
                            <th >Pagos completados</th>
                            <th >Saldo abonado</th>
                            <th >Saldo pendiente </th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                            <tr>
                                <td> {{ $loan->id }}</td>
                                <td>{{ $loan->client->name }}</td>
                                <td>$ {{ $loan->amount }}</td>
                                <td>$ {{ $loan->fee}}  </td>
                                <td> {{ $loan->payments_number }}</td>
                                <td>$ {{ $loan->pagosCompletados}} </td>
                                <td>$ {{ $loan->saldoAbonado}}</td>
                                <td>$ {{ $loan->saldoPendiente}} </td>
                                <td> 
                                    <a href="{{ route('payments.show',['id' => $loan->id]) }}" class="btn btn-outline-secondary btn-sm">Ver</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

