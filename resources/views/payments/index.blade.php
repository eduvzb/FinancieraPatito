@extends('layouts.app')

@section('content')
<div class="row ">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3 class="mb-0">Pagps realizados</h3>
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
                            <th >Nombre</th>
                            <th >Monto ministrado</th>
                            <th >Cuota</th>
                            <th ># de pagos</th>
                            <th >Pagos realizados</th>
                            <th >Saldo abonado</th>
                            <th >Saldo pendiente </th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->loan->client->name }}</td>
                                <td>$ {{ $payment->loan->amount }}</td>
                                <td>{{ $payment->loan->fee }}</td>
                                <td>{{ $payment->loan->payments_number}}</td>
                                <td> </td>
                                <td>$ {{ $payment->sum('received_amount')}}</td>
                                <td>$ {{ $payment->loan->amount - $payment->sum('received_amount') }}</td>
                                <td>
                                <a href="{{ route( 'payments.show',['id'=>$payment->loan->id] ) }}" class="btn btn-outline-secondary btn-sm">Ver</a>
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

