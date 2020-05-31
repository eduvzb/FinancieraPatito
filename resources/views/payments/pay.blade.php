@extends('layouts.app')

@section('content')
<div class="row  ">
    <div class="col-sm-8 col-md-3 col-lg-4 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3>Abonar</h3>
                    </div>
                    <div class="">
                        <a href="{{ route('payments.show',['id' => $loan->id]) }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('payments.store', ['id'=>$loan->id]) }}">
                    @csrf
                    <div class="form-group form-row">
                        <div class=" col-md-8 mx-auto">
                            <label for="name">Ingrese cantidad</label>
                            <input type="text" name="received_amount" id="received_amount" type="number" class="form-control @error('received_amount') is-invalid @enderror">
                            @error('received_amount')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success btn-block">Pagar</button>
                            </div>
                        </div>
                        
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>
@endsection
