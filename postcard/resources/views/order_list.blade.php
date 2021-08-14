@extends( 'layouts.admin' )

@section( 'content' )
<section class="content">
    <div class="container-fluid">
        <table class="table table-bordered table-striped">
            <tr>
                <td>Order ID</td>
                <td>Delivery Date</td>          
                <td>Order Date</td>
            </tr>
            @foreach( $orders as $order )
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->delivery_at->format('Y/m/d') }}</td>
                    <td>{{ $order->order_at->format('Y/m/d') }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</section>
@endsection
