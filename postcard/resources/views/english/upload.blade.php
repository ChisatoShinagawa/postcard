@extends('layouts.upload')
@section('content')
<style>
.contents{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;   
    /* margin: 30px 0; */
    padding-top: 30px;
    background-color: #f4e2c1;
    color: #777571;    
}
.item{
    width: calc( 100% / 2 - 30px );
    margin-bottom: 30px;
    padding: 50px 10px;
    text-align: center;
    float: left;
}
.form-control{
    display: unset;
    width: 70%;
}
</style>
<div class="contents">
    <div class="item">
        <p style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;">Sample</p>
        <img src="{{ $templateImage }}" style="width: 60%; text_align: center;" alt="">
        <!-- <img src="/l6x/storage/img/pre_6.png" style="width: 60%; text_align: center;" alt=""> -->
    </div>
    <!-- <div class="contents">
        <div class="item">
            <img src="/l6x/storage/img/gift_ex2.png" style="width: 350px;" alt="">
        </div>
        <div class="item">
            <img src="/l6x/storage/img/gift_ex2.png" style="width: 350px;" alt="">
        </div>
        <div class="item">
            <img src="/l6x/storage/img/gift_ex2.png" style="width: 350px;" alt="">
        </div>
    </div> -->
    <div class="item">
        <h2 style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;" class="mb-5 mt-1">Photo Card</h2>
        <form action="{{ route( 'upload_proc' ) }}" method="post" enctype="multipart/form-data">
        @csrf
            <div>
                <label for="image"></label>
                <input type="file" name="image" class="form-control">
                @isset( $original_image )
                <p class="mt-2">Current uploaded image</p>
                <img src="{{ $original_image }}" style="width: 200;">
                @endisset
            </div>
            @error( 'image' )
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mt-3" style="text-align: left;">
                <label for="message">Dear - up to 22 letters -</label>
                {{--<input type="text" name="message_to" id="message" class="form-control">--}}
                {{ $form['message_to'] }}
            </div>
            @error( 'message_to' )
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mt-2" style="text-align: left;">
                <label for="message">Message - up to 112 letters -</label>
                {{--<input type="textbox" name="message_content" id="message" class="form-control">--}}
                {{ $form['message_content'] }}
            </div>
            @error( 'message_content' )
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mt-2" style="text-align: left;">
                <label for="message">From - up to 22 letters -</label>
                {{--<input type="text" name="message_from" id="message" class="form-control">--}}
                {{ $form['message_from'] }}
            </div>
            @error( 'message_from' )
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mt-4">
                {{--<input type="submit" class="btn btn-outline-secondary btn-md" value="next">--}}
                <button type="submit" class="btn btn-outline-secondary btn-md">next</button>
            </div>
        </form>
    </div>
</div>