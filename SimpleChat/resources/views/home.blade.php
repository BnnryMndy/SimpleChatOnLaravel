@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center m-2">
        <form action="" class="form-inline">
            <input class="m-2" type="text" name="message" id="">
            <input type="submit" value="Отправить" class="btn btn-success">
        </form>
    </div>

    <div class="row justify-content-center m-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('username') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Message text') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
