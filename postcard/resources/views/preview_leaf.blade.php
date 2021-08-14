<html style="height: 100%;">
    <head>
        <meta name="viewport" content="width=device-width, minimum-scale=0.1">
        <title>preview(771×551)</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <p style="color: white; position: absolute; font-size: 22px; left: 70px; top: 10px;">Preview</p>
    </head>
    <body style="margin: 0px; background: #f4e2c1; height: 100%">
        <div class="box" style="top:50px; left:30%; position: relative; display: inline-block;">   
            <div class="" style="color: #628968;
                                    font-style: italic;
                                    font-size: 18px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 40px;
                                    top: 100px;
                                    ">Dear {{ $message_to }}</div>
            {{--<div class="" style="color: #628968;
                                    font-style: normal;
                                    font-size: 18px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 100px;
                                    top: 100px;
                                    width:250px;
                                    ">{{ $message_to }}</div>--}}
            @if( !empty( $text_message_4 ) )       
            <div class="" style="color: #628968; 
                                    font-size: 18px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 40px;
                                    top: 140px;
                                    word-wrap: normal;
                                    width:250px;
                                    ">{{ $text_message_4 }}</div>
            @endif
            @if( !empty( $message_content_3 ) )       
            <div class="" style="color: #628968; 
                                    font-size: 18px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 40px;
                                    top: 150px;
                                    word-wrap: normal;
                                    width:250px;
                                    ">{{ $message_content_3 }}</div>
            @endif
            @if( !empty( $message_content_2 ) )       
            <div class="" style="color: #628968; 
                                    font-size: 18px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 40px;
                                    top: 160px;
                                    word-wrap: normal;
                                    width:250px;
                                    ">{{ $message_content_2 }}</div>
            @endif
            @if( !empty( $message_content_1 ) )       
            <div class="" style="color: #628968; 
                                    font-size: 18px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 40px;
                                    top: 170px;
                                    word-wrap: normal;
                                    width:250px;
                                    ">{{ $message_content_1 }}</div>
            @endif
            <div class="" style="color: #628968;
                                    font-style: italic;
                                    font-size: 18px;
                                    position: absolute;                                    
                                    z-index: 100;
                                    left: 40px;
                                    top: 260px;
                                    word-wrap: normal;                                    
                                    ">From</div>
            <div class="" style="color: #628968; 
                                    font-size: 18px;
                                    position: absolute;
                                    font-family:Arial,sans-serif;
                                    z-index: 100;
                                    left: 100px;
                                    top: 260px;
                                    word-wrap: normal;                                    
                                    ">{{ $message_from }}</div>            
            <img style="-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="{{$url_img}}">    
        </div>
        <div class="mt-5 pb-5" style="text-align: center">
            <div class="mt-5 mr-3" style="color: #777571;">一度確定すると変更できません。</br>こちらの内容でお作りしてよろしいですか？</div>
            <div class="mt-5 ml-3">
                <a href="{{ route( 'upload', $id ) }}" class="btn btn-outline-secondary btn-md">戻る</a>
                <a href="{{ route( 'register_proc', $id ) }}" class="btn btn-outline-secondary btn-md ml-3">確定</a>
            </div>
        </div>
    </body>
</html>