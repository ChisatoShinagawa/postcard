@extends('layouts.upload')
@section('content')
    <style>
    
    </style>
    <div class="container mt-5">
    <form action="{{ route( 'check_orderid' ) }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header" style="background-color: e7eafb;">
                        <div class="card-title">
                            <h4 style="font-family: 'Dancing Script', cursive; font-size: 2rem;">Entry Order Number</h4>
                        </div>
                    </div>
                    <div class="card-body" style="background-color: e7eafb;">
                        <div>
                            <label for="order_id">注文番号を入力してください。</label>
                            <input type="text" name="order_id" id="order_id" class="form-control">
                        </div>
                        @error( 'order_id' )
                            <div class="form-group">
                                <span class="text-danger">{{ $message }}</span>                    
                            </div>
                        @enderror
                        @if( !empty( $message ) )
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>         
                            </div>
                        @endif
                    </div>
                    <div class="card-footer" style="background-color: e7eafb; border: none;">
                        <div class="form-group">
                        <button type="submit" class="btn btn-outline-secondary btn-md">next</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection