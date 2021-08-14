@extends( 'layouts.upload' )
@section( 'content' )
<div class="container mt-5">
    <form action="{{ route( 'import_csv' ) }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
                <div class="card shadow">
                    <div class="card-header" style="background-color: e7eafb;">
                        <div class="card-title">
                            <h4 style="font-family: 'Dancing Script', cursive; font-size: 2rem;">Message card 取り込み</h4>
                        </div>
                    </div>
                    <div class="card-body" style="background-color: e7eafb;">
                        <div>
                            <label for="new_data">取り込みたいファイルを選択してください。</label>
                            <input type="file" name="new_data" id="new_data" class="form-control">
                        </div>
                        @error( 'file' )
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
                            <button type="submit" class="btn btn-outline-secondary btn-md">インポート</button>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection