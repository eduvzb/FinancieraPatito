@extends('layouts.app')

@section('content')


<div class="row ">
    <div class="col-md-8 mx-auto my-3">
        <div class="row mb-2 ">
            <div class="col-md-12 col-lg-6 mb-sm-4 ">
                <div class="card">
                    <div class="card-body ">
                        <ul class="list-unstyled">
                            <li class="h1">{{ $loans->client->name }}</li>
                            <li class="lead"><strong>Saldo abonado: </strong> $</li>
                            <li class="lead"><strong>Total pendiente: </strong> $ {{ $loans->payments->sum('received_amount')}} </li>
                        </ul>
                    <a href="{{ route('payments.pay',['id' => $loans->id]) }}" class="btn btn-outline-secondary btn-block">Abonar</a>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="card">
            <div class="card-header bg-secondary text-white">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3 class="mb-0">Detalle de pagos</h3>
                    </div>
                    <div class="">
                        <a href="#" class="btn btn-outline-dark text-white">Descargar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead >
                        <tr class="" >
                            <th>Número de pago</th>
                            <th>Cuota</th>
                            <th>Abonado</th>
                            <th>Fecha de pago</th>
                            <th>Fecha de abono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans->payments as $payment) 
                            <tr>
                                <td>{{ $payment->number }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->received_amount }}</td>
                                <td>{{ $payment->payment_date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


