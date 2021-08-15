@extends('layouts.boot_upload')
@section('content')
    <div class="container mt-5">
    <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header" style="background-color: e7eafb;">
                        <div class="card-title">
                            <h4 style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;">{{ __( 'lang.success_createpdf' ) }}</h4>
                        </div>
                    </div>
                    <div class="card-body" style="background-color: e7eafb;">
                        <div>
                            <p>{{ __( 'lang.thankyou' ) }}</p>
                        </div>
                    </div>
                    <div class="card-footer" style="background-color: e7eafb; border: none;">
                        <a href="{{ route( 'single_download_proc', $id ) }}" class="btn btn-outline-secondary btn-md ml-3">{{ __( 'lang.button_download' ) }}</a>               
                        <a href="{{ route( 'welcome_message_card' ) }}" target="_self" class="btn btn-outline-secondary btn-sm ml-3">{{ __( 'lang.button_back_welcome' )}}</a>                                           
                    </div>
                </div>
            </div>
        </div>
    </div>