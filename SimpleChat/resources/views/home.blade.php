@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="container">
    <div id="ajaxForm" class="row justify-content-center m-2">
        <form action="" class="input-group mb-3input-group mb-3">
            {{ csrf_field() }}
            <input v-model.trim="message" class="message_text form-control" type="text" name="message" id="">
            <input id="user_id" hidden value="{{ Auth::user()->id }}">
            <div class="input-group-append">
                <input  v-on:click="sendMessage" type="button" value="Отправить" class="btn btn-outline-success">
            </div>
        </form>
    </div>
    <div id="ajax-content">
    
    </div>
</div>
<script>
    const ajaxSendForm = new Vue({
        el: '#ajaxForm',
        data: {
            message: null,
            user_id: null
        },
        methods: {
            sendMessage: function(event) {
                axios.get('/message/add?'+ "message_text="+this.message+"&sender_id="+document.getElementById('user_id').value)
                    .then(function (response) {
                        $('.message_text').val("");
                        addNewMessages();
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                    .then(function () {
                    });
            }
        }
    });

    function messagesCompare(FirstMessage, SecondMessage){
        if(FirstMessage.message_id > SecondMessage.message_id) return 1;
        if(FirstMessage.message_id < SecondMessage.message_id) return -1;
        return 0;
    }

    function loadAllMessages(){
        
        $.ajax({
            method: "GET",
            url: "/message"
        }).done(function (data){
            var messagesArray = [];
            $.each(data.messages, function(index, value){
                messagesArray.push(value);
            });
            messagesArray.sort( messagesCompare );
            $.each(messagesArray, function(index, value){
                $("#ajax-content").prepend('<div class="row justify-content-center m-2" id="'+value.message_id+'"><div class="col-md-8"><div class="card"><div class="card-header row justify-content-between"><p>'+value.username+'</p> <p class="text-muted">'+ value.created_at+'</p></div><div class="card-body">'+value.message_text+'</div></div></div></div>');
            });
        });
        
    }

    loadAllMessages();

    function addNewMessages(){
        var max = 0 , id;
        $(".ajax-content").each(function(){
            id = $(this).data('id'); 
            max = (max < id) ?id:max; 
        })

        $.ajax({
            method: "GET",
            url: "/message/from/"+max+"/"
        }).done(function (data){
            var messagesArray = [];
            $.each(data.messages, function(index, value){
                messagesArray.push(value);
            });
            messagesArray.sort( messagesCompare );
            $.each(messagesArray, function(index, value){
                $("#ajax-content").prepend('<div class="row justify-content-center m-2" id="'+value.message_id+'"><div class="col-md-8"><div class="card"><div class="card-header row justify-content-between"><p>'+value.username+'</p> <p class="text-muted">'+ value.created_at+'</p></div><div class="card-body">'+value.message_text+'</div></div></div></div>');
            });
        });
    }

    let updateMessagesTimer = setInterval(addNewMessages, 500);
</script>

@endsection
