@extends('common.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edit Order</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('order.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error!</strong> <br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('order.update',$order->id) }}" method="POST">
    @csrf
    @method('PUT')
  
     <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Customer Name:</strong>
                <input type="text" name="customer_name" class="form-control" value="{{$order->customer_name}}" placeholder="Customer Name" required>
                @error('customer_name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Phone:</strong>
                <input type="text" name="phone" class="form-control" value="{{$order->phone}}" placeholder="Phone" required>
                @error('phone')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Product:</strong>&nbsp;
                <select name="product_id"  class="form-control">
                    @foreach($products as $product)
                    <option value="{{$product->id}}" {{ $order->product_id==$product->id ? 'selected' : '' }}>{{$product->name}}</option>
                    @endforeach    
                </select>
                @error('product_id')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Quantity:</strong>
                <input type="number" name="quantity" class="form-control" value="{{$order->quantity}}" placeholder="Quantity" required>
                @error('quantity')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
@endsection