@extends('common.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Order List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('order.create') }}"> Create New Order</a>
                <a class="btn btn-success" href="{{ route('product.index') }}"> Product List</a>
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
            <th>ID</th>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Phone</th>
            <th>Net amount</th>
            <th>Order Date</th>
            <th width="280px">Action</th>
        </tr>
        @forelse ($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->order_id??'' }}</td>
                <td>{{ $order->customer_name??'' }}</td>
                <td>{{ $order->phone??'' }}</td>
                <td>{{ $order->product->price }}</td>
                <td>{{ date_format($order->created_at,'d M Y') }}</td>
                <td>
                    <a class="" href="{{ route('order.edit', $order->id) }}">Edit</a>

                    <form action="{{ route('order.destroy', $order->id) }}" method="POST">
       
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    <a class="" href="{{ route('order.show', $order->id) }}">Invoice</a>
                    
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align: center">No Data Found!</td></tr>
        @endforelse

    </table>
@endsection
