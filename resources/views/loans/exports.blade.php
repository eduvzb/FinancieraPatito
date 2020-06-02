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
            </tr>
        @endforeach
    </tbody>
</table>