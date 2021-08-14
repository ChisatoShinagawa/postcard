@extends( 'layouts.upload' )
@section( 'content' )
<style>
.contents{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    padding-top: 30px;
}
.item{
    width: calc( 100% / 2 - 30px );
    margin-bottom: 30px;
    padding: 50px 50px;
    text-align: center;
    float: left;
}
</style>
<div style="text-align:center;" class="mt-5">
<p style="font-family: 'Dancing Script', cursive; font-size: 2.5rem;">Card Type</p>
</div>
<div class="contents">
    <form action="{{ route( 'upload' ) }}" method="post">
        @csrf
        <div style="text-align:center; font-size: 20px;">
            <p>Select a template then enter 'next'.</p>
        </div>
        <div class="item">
            <div class="mb-5">
                <input type="radio" name="cardType" value="flower" id="cardTaypeFlower">
                <label for="cardTaypeFlower"></label>
            </div>
            <img src="/storage/img/photocard6.png" style="width: 350px;" alt="">
        </div>
        <div class="item">
            <div class="mb-5">
                <input type="radio" name="cardType" value="leaf" id="cardTaypeLeaf">
                <label class="form-check-label" for="cardTaypeLaef"></label>
            </div>
            <img src="/storage/img/photocard4-1.png" style="width: 350px;" alt=""> 
        </div>
        <div style="text-align:center;">
            <button type="submit" class="btn btn-outline-secondary btn-md">next</button>
        </div>
    </form>
</div>