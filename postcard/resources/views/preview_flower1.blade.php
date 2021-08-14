<html style="height: 100%;">
    <head>
        <meta name="viewport" content="width=device-width, minimum-scale=0.1">
        <title>preview(771×551)</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <p style="color: white; position: absolute; font-size: 22px; left: 70px; top: 10px;">Preview</p>
    </head>
    <body style="margin: 0px; background: #0e0e0e; height: 100%">
        <div class="box" style=" top:50px; left:250px; position: relative; display: inline-block;">   
            <div class="" style="color: #1a3888;
                                    font-style: italic;
                                    font-size: 22px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 30px;
                                    top: 40px;
                                    ">Dear</div>
            <div class="" style="color: #1a3888;
                                    font-style: normal;
                                    font-size: 22px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 90px;
                                    top: 40px;
                                    width:250px;
                                    ">{{$message_to}}</div>
            {{--@if( !empty( $text_message_4 ) )       
            <div class="" style="color: #1a3888; 
                                    font-size: 15px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    right: 20px;
                                    bottom: 50px;
                                    word-wrap: normal;
                                    width:250px;
                                    ">{{$text_message_4}}</div>
            @endif--}}
            @if( !empty( $message_content_3 ) )       
            <div class="" style="color: #1a3888; 
                                    font-size: 13px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 30px;
                                    top: 90px;
                                    word-wrap: normal;
                                    width:250px;
                                    ">{{$message_content_3}}</div>
            @endif
            @if( !empty( $message_content_2 ) )       
            <div class="" style="color: #1a3888; 
                                    font-size: 18px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 30px;
                                    top: 100px;
                                    word-wrap: normal;
                                    width:250px;
                                    ">{{$message_content_2}}</div>
            @endif
            @if( !empty( $message_content_1 ) )       
            <div class="" style="color: #1a3888; 
                                    font-size: 18px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 30px;
                                    top: 110px;
                                    word-wrap: normal;
                                    width:250px;
                                    ">{{$message_content_1}}</div>
            @endif
            <div class="" style="color: #1a3888;
                                    font-style: italic;
                                    font-size: 22px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 30px;
                                    top: 200px;
                                    word-wrap: normal;                                    
                                    ">From</div>
            <div class="" style="color: #1a3888; 
                                    font-size: 22px;
                                    position: absolute;
                                    font-family:Arial,sans-serif;
                                    z-index: 100;
                                    left: 90px;
                                    top: 200px;
                                    word-wrap: normal;                                    
                                    ">{{$message_from}}</div>            
            <img style="-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="{{$url_img}}">    
        </div>
    </body>
    <footer style="text-align: right;">
        <div class="text-danger">一度確定すると変更できません。</br>こちらの内容でお作りしてよろしいですか？</div>
        <div>
            <a href="{{ route( 'upload', $id ) }}" class="btn btn-success btn-md">戻る</a>
            <a href="{{ route( 'register_proc', $id ) }}" class="btn btn-success btn-md ml-3">確定</a>
        </div>
    </footer>
</html>