@extends('layouts.app')

@section('content')
<div class="container">
    <div id="ajaxForm" class="row justify-content-center m-2">
        <form action="" class="input-group mb-3input-group mb-3">
            {{ csrf_field() }}
            <input v-model.trim="message" class="form-control" type="text" name="message" id="">
            <input v-model="user_id" hidden value="{{ Auth::user()->id }}">
            <div class="input-group-append">
                <input  v-on:click="" type="button" value="Отправить" class="btn btn-outline-success">
            </div>
        </form>
    </div>

    @foreach ($messages as $message)
        <div class="row justify-content-center m-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header row justify-content-between"> <p>{{ $message->username }}</p> <p class="text-muted">{{$message->created_at}}</p></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ $message->message_text }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
