@extends('layouts.boot_upload')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 my-5" style="text-align: center;">
            <p class="py-5" style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;">Sample</p>
            <img src="{{ $templateImage }}" style="width: 70%; text_align: center;" alt="">
        </div>
        <div class="col-md-6 my-5" style="text-align: center;">
            <h2 class="py-5" style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;" class="mb-5 mt-1">Photo & Message</h2>
            <form action="{{ route( 'upload_proc', 'en' ) }}" method="post" enctype="multipart/form-data">
            @csrf
                <div>
                    <label for="image"></label>
                    <input type="file" name="image" class="form-control">
                    @isset( $original_image )
                    <p class="mt-2">{{ __( 'lang.message_current_image' ) }}</p>
                    <img src="{{ $original_image }}" style="width: 200;">
                    @endisset
                </div>
                @error( 'image' )
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mt-3" style="text-align: left;">
                    <label for="message">Dear - up to 22 letters -</label>
                    {{ $form['message_to'] }}
                </div>
                @error( 'message_to' )
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mt-2" style="text-align: left;">
                    <label for="message">Message - up to 112 letters -</label>
                    {{ $form['message_content'] }}
                </div>
                @error( 'message_content' )
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mt-2" style="text-align: left;">
                    <label for="message">From - up to 22 letters -</label>
                    {{ $form['message_from'] }}
                </div>
                @error( 'message_from' )
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mt-4">
                    <button type="submit" class="btn btn-outline-secondary btn-md">{{ __( 'lang.button_next' ) }}</button>
                </div>
            </form>
        </div>
    </div>
</div>