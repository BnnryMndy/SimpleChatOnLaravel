@extends('layouts.app')

@section('content')
<div class="container">
<form action="" class="form-inline">
            <input type="text" name="message" id="">
            <input type="submit" value="Отправить" class="btn btn-success">
        </form>
    <div class="row justify-content-center">
        

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection