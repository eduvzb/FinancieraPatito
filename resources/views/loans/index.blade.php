@extends('layouts.app')

@section('content')
<div class="row ">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3 class="mb-0">Prestamos</h3>
                    </div>
                    <div class="">
                        <a href="{{ route('loans.create') }}" class="btn btn-primary">Nuevo prestamo</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th >Nombre</th>
                            <th >Cantidad</th>
                            <th ># de pagos</th>
                            <th >Cuota</th>
                            <th >Fecha de ministración </th>
                            <th >Fecha de vencimiento </th>
                            <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($loans as $loan)
                            <tr>
                                <td>{{ $loan->client->name }}</td>
                                <td>{{ $loan->amount }}</td>
                                <td>{{ $loan->payments_number}}</td>
                                <td>{{ $loan->fee }}</td>
                                <td>{{ $loan->ministry_date }}</td>
                                <td>{{ $loan->due_date }}</td>
                                <td>
                                    <a href="#" class="btn btn-outline-secondary btn-sm">Ver</a>
                                    <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{ $loan->id }}" >Borrar</button>
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

@section('bottom-js')
    <script>
        $('body').on('click', '.btn-delete', function(event)
        {
            const id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => { 
               if (result.value){
                   axios.delete('{{ route('clients.index') }}/' + id)
                    .then(result => {
                        Swal.fire(
                            'Borrado',
                            'El cliente ha sido borrado',
                            'success'
                        );
                    })
                    .catch(error => {
                        Swal.fire(
                            'Ha ocurrido un error',
                            'El cliente no ha sido eliminado',
                            'error'
                        );
                    });
               }
            });
        });
    </script>
@endsection
