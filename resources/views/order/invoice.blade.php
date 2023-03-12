@extends('common.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Invoice</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('order.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Order ID</th>
            <td>{{$order->order_id;}}</th>
        </tr>
        <tr>
            <th>Products</th>
            <td>{{$order->product->name;}} X {{$order->quantity;}} ={{$order->product->price*$order->quantity;}} </th>
        </tr>
        <tr>
            <th>Total</th>
            <td>{{$order->product->price*$order->quantity;}}</th>
        </tr>

    </table>
@endsection
