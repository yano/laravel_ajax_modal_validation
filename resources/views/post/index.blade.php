<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>


<div class="container">

<h1><a href="#" data-toggle="modal" data-target="#ModalPost">Open Post Content Window</a></h1>

{{--<h1>普通のフォーム</h1>--}}
{{--<form method="POST" id="Post">--}}
    {{--{{ csrf_field() }}--}}
    {{--<div class="form-group has-feedback">--}}
        {{--<input type="text" name="content" value="{{ old('content') }}" class="form-control" placeholder="Content">--}}
        {{--<span class="glyphicon glyphicon-user form-control-feedback"></span>--}}
        {{--<span class="text-danger"><strong id="content-error"></strong></span>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
        {{--<div class="col-xs-12 text-center">--}}
            {{--<button type="button" id="submitForm" class="btn btn-primary btn-prime white btn-flat">Post Content</button>--}}
            {{--<button type="submit" id="submitForm" class="btn btn-primary btn-prime white btn-flat">Post Content</button>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</form>--}}

<ul>
    @foreach($posts as $post)
        <li> {{ $post->content }}</li>
    @endforeach
</ul>

</div>

{{--Modal Windowのフォーム--}}

<div id="ModalPost" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-title text-center primecolor">Post Content</h3>
            </div>

            <div class="modal-body" style="overflow: hidden;">

                <div id="success-msg" class="hide">
                    <div class="alert alert-info alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Success!</strong> Contentの投稿に成功しました!!
                    </div>
                </div>

                <div class="col-md-offset-1 col-md-10">

                    <form method="POST" id="FormPost">
                        {{ csrf_field() }}

                        <div class="form-group has-feedback">
                            <input type="text" name="content" value="{{ old('content') }}" class="form-control" placeholder="Content">
                            {{--<span class="glyphicon glyphicon-user form-control-feedback"></span>--}}
                            <span class="text-danger"><strong id="content-error"></strong></span>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 text-center">
                                <button type="button" id="submitForm" class="btn btn-primary btn-prime white btn-flat">Post Content</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </div>
</div>


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>


<script type="text/javascript">

    $('body').on('click', '#submitForm', function(){

        console.log("start submitForm !");

        var registerForm = $("#FormPost");

        var formData = registerForm.serialize();

        $( '#content-error' ).html( "" );
        // $( '#email-error' ).html( "" );
        // $( '#password-error' ).html( "" );

        $.ajax({
            url:'/post2',
            type:'POST',
            data:formData,
            success:function(data) {
                console.log(data);
                if(data.errors) {
                    if(data.errors.content){
                        $( '#content-error' ).html( data.errors.content[0] );
                    }
                    // if(data.errors.email){
                    //     $( '#email-error' ).html( data.errors.email[0] );
                    // }
                    // if(data.errors.password){
                    //     $( '#password-error' ).html( data.errors.password[0] );
                    // }
                }
                if(data.success) {
                    $('#success-msg').removeClass('hide');
                    setInterval(function(){
                        $('#ModalPost').modal('hide');
                        $('#success-msg').addClass('hide');
                    }, 3000);
                }
            },
        });
    });
</script>



</body>
</html>