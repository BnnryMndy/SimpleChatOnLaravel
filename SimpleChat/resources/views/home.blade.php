@extends('layouts.app')

@section('content')
<div class="container">
    <div id="ajaxForm" class="row justify-content-center m-2">
        <form action="" class="input-group mb-3input-group mb-3">
            {{ csrf_field() }}
            <input v-model.trim="message" class="form-control" type="text" name="message" id="">
            <input id="user_id" hidden value="{{ Auth::user()->id }}">
            <div class="input-group-append">
                <input  v-on:click="sendMessage" type="button" value="Отправить" class="btn btn-outline-success">
            </div>
        </form>
    </div>
    <div id="ajax-content">
    
    </div>
    @foreach ($messages as $message)
        <div class="row justify-content-center m-2" id="{{ $message->message_id }}">
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
<!-- headers: {
    
  } -->
<script>
    const ajaxSendForm = new Vue({
        el: '#ajaxForm',
        data: {
            message: null,
            user_id: null
        },
        methods: {
            sendMessage: function(event) {
                alert(document.getElementsByName('_token')[0].value);
                axios.get('/message/add?'+ "message_text="+this.message+"&sender_id="+document.getElementById('user_id').value)
                    .then(function (response) {
                        // handle success
                        console.log(response);

                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                    .then(function () {
                        // always executed
                    });
            }
        }
    });

    const ajaxContent = new Vue({
        el: "#ajax-content",
        data: {},
        methods: {}
    });
</script>

@endsection
