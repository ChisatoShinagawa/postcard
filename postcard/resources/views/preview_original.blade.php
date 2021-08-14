<html style="height: 100%;">
    <head>
        <meta name="viewport" content="width=device-width, minimum-scale=0.1">
        <title>preview (771×551)</title>
    </head>
    <body style="margin: 0px; background: #0e0e0e; height: 100%">
    <div class="box" style=" top:50px; left:250px; position: relative; display: inline-block;">   
            <div class="" style="color: white;
                                    font-style: italic;
                                    font-size: 22px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 60px;
                                    bottom: 100px;
                                    ">Dear</div>
            <div class="" style="color: white;
                                    font-style: normal;
                                    font-size: 22px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 70px;
                                    bottom: 60px;
                                    width:220px;
                                    ">{{$message_to}}</div>
            {{--@if( !empty( $text_message_4 ) )       
            <div class="" style="color: white; 
                                    font-size: 15px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    right: 20px;
                                    bottom: 50px;
                                    word-wrap: normal;
                                    width:220px;
                                    ">{{$text_message_4}}</div>
            @endif--}}
            @if( !empty( $message_content_3 ) )       
            <div class="" style="color: white; 
                                    font-size: 15px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    right: 20px;
                                    bottom: 80px;
                                    word-wrap: normal;
                                    width:220px;
                                    ">{{$message_content_3}}</div>
            @endif
            @if( !empty( $message_content_2 ) )       
            <div class="" style="color: white; 
                                    font-size: 18px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    right: 20px;
                                    bottom: 90px;
                                    word-wrap: normal;
                                    width:220px;
                                    ">{{$message_content_2}}</div>
            @endif
            @if( !empty( $message_content_1 ) )       
            <div class="" style="color: white; 
                                    font-size: 18px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    right: 20px;
                                    bottom: 110px;
                                    word-wrap: normal;
                                    width:220px;
                                    ">{{$message_content_1}}</div>
            @endif
            <div class="" style="color: white;
                                    font-style: italic;
                                    font-size: 22px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 520px;
                                    bottom: 55px;
                                    word-wrap: normal;                                    
                                    ">From</div>
            <div class="" style="color: white; 
                                    font-size: 22px;
                                    position: absolute;
                                    font-family:Arial,sans-serif;
                                    z-index: 100;
                                    left:573px;
                                    bottom: 50px;
                                    word-wrap: normal;                                    
                                    ">{{$message_from}}</div>            
            <img style="-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="{{$url_img}}">    
    </div>
</body>
</html>