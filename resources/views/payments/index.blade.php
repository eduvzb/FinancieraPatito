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
                    <thead>
                        <tr>
                            <th >Nombre</th>
                            <th >Monto ministrado</th>
                            <th >Cuota</th>
                            <th >Número de pagos</th>
                            <th >Pagos realizados </th>
                            <th >Saldo abonado</th>
                            <th >Saldo pendiente </th>
                            <th >Acciones</th>
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
