@extends('layouts.app')

@section('content')
<div class="row ">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3 class="mb-0">Cliente</h3>
                    </div>
                    <div class="">
                        <a href="{{ route('clients.create') }}" class="btn btn-primary">Nuevo</a>
                        <a href="{{ route('clients.import') }}" class="btn btn-primary">Cargar clientes</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
               
                <table class="table mx-left">
                    <thead>
                        @if( session('message'))
                        <div class="alert alert-success" role="alert" id="alert">
                            {{session('message')}}
                          </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert" id="alert">
                            {{session('error')}}
                          </div>
                        @endif
                        <tr>
                            <th scope="col">#</th>
                            <th >Nombre</th>
                            <th >Telefono</th>
                            <th scope="col" >Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td scope="row">{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->phone }}</td>
                                <td>
                                    <a href="#" class="btn btn-outline-secondary btn-sm">Ver</a>
                                    <button class="btn btn-outline-danger btn-sm btn-delete" data-id="{{ $client->id }}" >Borrar</button>
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
    $('body').on('click', '.btn-delete', function(event) {
        const id = $(this).data('id');

        const options = {
        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        };

        Swal.fire({
            title: '¿Estás seguro?',
            text: 'No podrás revertir esta acción',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borralo!'
        })
        .then((result) => {
            if (result.value) {
                axios.delete('{{ route('clients.index') }}/'+ id, options)  
                    .then(result => {
                        Swal.fire({
                            title: 'Borrado',
                            text: 'El cliente a sido borrado',
                            icon: 'success'
                        }).then(() => {
                            window.location.href='{{ route('clients.index') }}';
                        });
                    })
                    .catch(error => {
                        Swal.fire(
                            'Ocurrió un error',
                            'El cliente no ha podido borrarse.',
                            'error'
                        );
                    });
            }
        });
    });
</script>

<script>
    $('#alert').fadeIn();     
  setTimeout(function() {
       $("#alert").fadeOut();           
  },2000);
</script>
@endsection
