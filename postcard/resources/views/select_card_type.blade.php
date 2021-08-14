@extends( 'layouts.boot_upload' )
@section( 'content' )
<div class="container">
    <div style="text-align:center;" class="my-5">
        <p class="mb-5 pt-5" style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;">Card Type</p>
        <p>お好きなテンプレートをお選びの上、下記のnextボタンを押してください。</p>
    </div>
    <form action="{{ route( 'upload' ) }}" method="post">
    @csrf
        <div class="row">        
            <div class="col-md-6 my-2">
                <div class="custom-control custom-radio image-checkbox">
                  <input type="radio" class="custom-control-input" name="cardType" value="flower" id="cardTaypeFlower">
                  <label class="custom-control-label" for="cardTaypeFlower">
                      <img class="img-fluid" src="/storage/img/photocard6.png" style="width: 300px">
                  </label>
                </div>                     
            </div>
            <div class="col-md-6 my-2">
                <div class="custom-control custom-radio image-checkbox">
                  <input type="radio" class="custom-control-input" name="cardType" value="leaf" id="cardTaypeLeaf">
                  <label class="custom-control-label" for="cardTaypeLeaf">
                      <img class="img-fluid" src="/storage/img/photocard4-1.png" style="width: 300px">
                  </label>
                </div>                     
            </div>       
        </div>
        <div class="my-5" style="text-align:center;">
            <button type="submit" class="btn btn-outline-secondary btn-md">next</button>
        </div> 
    </form>
</div>
       
