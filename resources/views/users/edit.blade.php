@extends('layouts.app')

@section('content')
<div class="row  ">
    <div class="col-sm-8 col-md-8 col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3>Nuevo cliente</h3>
                    </div>
                    <div class="">
                        <a href="{{ route('clients.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('clients.store') }}">
                    @csrf
                    <h1></h1>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
