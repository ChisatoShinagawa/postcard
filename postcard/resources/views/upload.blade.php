@extends('layouts.boot_upload')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 my-5" style="text-align: center;">
            <p class="pt-5" style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;">Sample</p>
            <img src="{{ $templateImage }}" style="width: 70%; text_align: center;" alt="">
        </div>
        <div class="col-md-6 my-5" style="text-align: center;">
            <h2 class="pt-5" style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;" class="mb-5 mt-1">Photo & Message</h2>
            <form action="{{ route( 'upload_proc' ) }}" method="post" enctype="multipart/form-data">
            @csrf
                <div>
                    <label for="image"></label>
                    <input type="file" name="image" class="form-control">
                    @isset( $original_image )
                    <p class="mt-2">現在アップロードされている写真</p>
                    <img src="{{ $original_image }}" style="width: 200;">
                    @endisset
                </div>
                @error( 'image' )
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mt-3" style="text-align: left;">
                    <label for="message">Dear - 11文字まで -</label>
                    {{ $form['message_to'] }}
                </div>
                @error( 'message_to' )
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mt-2" style="text-align: left;">
                    <label for="message">Message - 56文字まで -</label>
                    {{ $form['message_content'] }}
                </div>
                @error( 'message_content' )
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mt-2" style="text-align: left;">
                    <label for="message">From - 11文字まで -</label>
                    {{ $form['message_from'] }}
                </div>
                @error( 'message_from' )
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mt-4">
                    <button type="submit" class="btn btn-outline-secondary btn-md">next</button>
                </div>
            </form>
        </div>
    </div>
</div>



{{--<style>
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
    </div>
    <div class="item">
        <h2 style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;" class="mb-5 mt-1">Photo Card</h2>
        <form action="{{ route( 'upload_proc' ) }}" method="post" enctype="multipart/form-data">
        @csrf
            <div>
                <label for="image"></label>
                <input type="file" name="image" class="form-control">
                @isset( $original_image )
                <p class="mt-2">現在アップロードされている写真</p>
                <img src="{{ $original_image }}" style="width: 200;">
                @endisset
            </div>
            @error( 'image' )
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mt-3" style="text-align: left;">
                <label for="message">Dear - 11文字まで -</label>
                {{ $form['message_to'] }}
            </div>
            @error( 'message_to' )
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mt-2" style="text-align: left;">
                <label for="message">Message - 56文字まで -</label>
                {{ $form['message_content'] }}
            </div>
            @error( 'message_content' )
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mt-2" style="text-align: left;">
                <label for="message">From - 11文字まで -</label>
                {{ $form['message_from'] }}
            </div>
            @error( 'message_from' )
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mt-4">
                <button type="submit" class="btn btn-outline-secondary btn-md">next</button>
            </div>
        </form>
    </div>
</div>
--}}
    

