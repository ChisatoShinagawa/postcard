<html style="">
    <head>
        <meta name="viewport" content="width=device-width, minimum-scale=0.1">
        <title>preview(771×551)</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    </head>    
    <body style="margin: 0px; background: #f4e2c1; height: 100%; color: #777571;">
        <div class="mt-3">
            <p style="color: #777571; text-align: center; font-family: 'Dancing Script', cursive; font-size: 2.5rem;">Preview</p>
        </div>
        <div class="box mb-5" style="top: 50px;
                                     position: relative;
                                     display: inline-block;
                                     left: 50%;
                                     transform: translate(-50%);">   
            <div class="" style="color: #2e1763;
                                    {{--font-style: italic;--}}
                                    font-size: 17px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    {{--left: 55px;--}}
                                    top: 300px;
                                    margin: 0 79;
                                    width : 14em;
                                    {{--background:#ffff00;--}}
                                    text-align: center;
                                    ">Dear　{{ $message_to }}</div>
            @if( !empty( $message_content_4 ) )       
            <div class="" style="color: #2e1763; 
                                    font-size: 17px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 46px;
                                    top: 345px;
                                    word-wrap: normal;
                                    width:310px;
                                    line-height: 2;
                                    ">{{$message_content_4}}</div>
            @endif
            @if( !empty( $message_content_3 ) )       
            <div class="" style="color: #2e1763; 
                                    font-size: 17px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 46px;
                                    top: 345px;
                                    word-wrap: normal;
                                    width:310px;
                                    line-height: 2;
                                    ">{{$message_content_3}}</div>
            @endif
            @if( !empty( $message_content_2 ) )       
            <div class="" style="color: #2e1763; 
                                    font-size: 17px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 46px;
                                    top: 345px;
                                    word-wrap: normal;
                                    width:310px;
                                    line-height: 2;
                                    ">{{$message_content_2}}</div>
            @endif
            @if( !empty( $message_content_1 ) )       
            <div class="" style="color: #2e1763; 
                                    font-size: 17px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 46px;
                                    top: 345px;
                                    word-wrap: normal;
                                    width:310px;
                                    line-height: 2;
                                    ">{{$message_content_1}}</div>
            @endif
            <div class="" style="color: #2e1763;
                                    {{--font-style: italic;--}}
                                    font-size: 17px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    {{--left: 55px;--}}
                                    top: 475px;
                                    word-wrap: normal;
                                    margin: 0 79;
                                    width : 14em;
                                    {{--background:#ffff00;--}}
                                    text-align: center;                                    
                                    ">From　{{ $message_from }}</div>
            <img style="-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="{{$url_img}}">    
        </div>
        <div class="mt-5 pb-5" style="text-align: center">
            <div class="mt-5 mr-3" style="color: #777571;">Once you create PDF, you wouldn't be able to change it.</br>Are you sure to create PDF?</div>
            <div class="mt-5 ml-3">
                <a href="{{ route( 'upload' ) }}" class="btn btn-outline-secondary btn-md">back</a>
                <a href="{{ route( 'register_proc' ) }}" class="btn btn-outline-secondary btn-md ml-3">Create PDF</a>
            </div>
        </div>
    </body>
</html>