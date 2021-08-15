@extends('layouts.boot_upload')
@section('content')
<div class="container mt-5">
    <p>{{ __( 'lang.welcome' ) }}</p>
    <div style="text-align: right;">
        <a href="{{ route( 'welcome_message_card' ) }}" class="btn btn-outline-secondary btn-md">Japanese</a>
    </div>
    <div class="mt-5">
        <p style="text-decoration-line: underline;">{{ __( 'lang.outline' ) }}</p>
        <p>
        {{ __( 'lang.outline_text' ) }} 
        </p>
    </div>
    <div class="mt-5">
        <p style="text-decoration-line: underline;">{{ __( 'lang.detail' ) }}</p>
        <li>{{ __( 'lang.select' ) }}</li>
        <p>{{ __( 'lang.select_text' ) }}</p>
        <li>{{ __( 'lang.create_card' ) }}</li>
        <p>{{ __( 'lang.create_card__text' ) }}</p>
        <li>{{ __( 'lang.preview' ) }}</li>
        <p>{{ __( 'lang.preview_text' ) }}</p>
        <li>{{ __( 'lang.create_pdf' ) }}</li>
        <p></p>
        <li>{{ __( 'lang.download_pdf' ) }}</li>
    </div>
    <div class="my-5" style="display: inline-block;">
        <p>{{ __( 'lang.get_started' ) }}</p>
        <form action="{{ route( 'check_orderid' ) }}" method="post">
        @csrf
            <input type="text" name="language" value="1" hidden>
            <input type="text" name="order_id" value="3333" hidden>
            <input type="submit" class="btn btn-outline-secondary btn-md" value="Start">
        </form>
    </div>
</div>
@endsection