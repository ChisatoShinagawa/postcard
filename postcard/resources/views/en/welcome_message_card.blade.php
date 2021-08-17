@extends('layouts.boot_upload')
@section('content')
<div class="container mt-5">
    <p>Welcome to Message card App!</p>
    {{--<div style="text-align: right;">
        <a href="{{ route( 'welcome_message_card' ) }}" class="btn btn-outline-secondary btn-md">Japanese</a>
    </div>--}}
    <div class="mt-5">
        <p style="text-decoration-line: underline;">Outline</p>
        <p>
        You can make your original message card with photo.
        </p>
    </div>
    <div class="mt-5">
        <p style="text-decoration-line: underline;">How does it work?</p>
        <li>Select a favorite frame.</li>
        <p>You can choose what you want to use a template.</p>
        <li>Create a message card</li>
        <p>Upload an image and add text messages.</p>
        <li>Preview</li>
        <p>You can go back privious page if you want to change some parts of card.</p>
        <li>Create PDF</li>
        <p></p>
        <li>Download PDF</li>
    </div>
    <div class="my-5" style="display: inline-block;">
        <p>Let's get started!</p>
        <form action="{{ route( 'select_card_type', 'en' ) }}" method="post">
        @csrf
            <input type="text" name="language" value="1" hidden>
            <input type="text" name="order_id" value="3333" hidden>
            <input type="submit" class="btn btn-outline-secondary btn-md" value="Start">
        </form>
    </div>
</div>
@endsection