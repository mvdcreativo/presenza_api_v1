<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje desde la Web</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900&display=swap" rel="stylesheet">
    <style>
        #body{
            padding:0;
            margin:0;
            font-family: 'Nunito', "Helvetica Neue", sans-serif;
            background-color:  #ffb031;
            width:100%;
            padding: 30px;
        }
        h1{
            font-size: 20px;
        }
        .container{

            margin-top:16px;
            margin-left:auto;
            margin-right: auto;
           width: 100%;
           max-width: 500px;
           border-radius: 20px;
           -webkit-box-shadow: 0px 0px 18px -4px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 18px -4px rgba(0,0,0,0.75);
            box-shadow: 0px 0px 18px -4px rgba(0,0,0,0.75);
            position: relative;
            padding: 32px;
            background-color:  #FFF;
        }
        .container.content{

            position: relative;

        }
        .container.content p{
            width: 100%;
            margin-bottom: 16px!important;
        }
        .container.image{
            width:100%;
        }
        .container.image{
            width: 100%;
            padding: 32px;
            height: 300px;
            min-height: 300px;
            display: block;
            /* background-image: url({{ asset('storage/images/mails/bg-mail.svg') }}); */
            /* background-position: center; */
            position: relative;
        }
        .container.image img{
            width: 100%;
            max-width: 300px;
        }
    </style>
</head>
<body>
<div id="body">
    <div class="container">
            <div class="content">
                <h1>Mensaje recibido desde la Web</h1>
                    @if (isset($msg['property']))
                    <p>Cliente interesado en la propiedad:</p>
                    <p><strong>{{ $msg['property'] }}</strong></p>
                    @endif
                <p><strong>{{ $msg['name'] }}</strong> escribió...</p>
                <p>{{ $msg['message'] }}</p>
                <p>
                <strong>Contactar a:</strong> <br>
                    {{ $msg['email'] }} o via telefónica {{ $msg['phone'] }}
                </p>
            </div>
            <div class="image">
            <!-- <img src="https://api.nuevaerauruguay.com/storage/images/mails/bg-mail.png" alt=""> -->

                {{-- <img src="{{ asset('storage/images/mails/bg-mail.png') }}" alt=""> --}}

            </div>
    </div>
</div>

</body>
</html>
