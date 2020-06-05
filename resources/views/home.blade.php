@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
                        <div class="card-body">
                          <h5 class="card-title">Total de clientes:</h5>
                          <p class="card-text display-3 text-center">{{ $num_clients }}</p>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
