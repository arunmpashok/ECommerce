@extends('common.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Product List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('product.create') }}"> Create New Product</a>
                <a class="btn btn-success" href="{{ route('order.index') }}">Order List</a>
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
            <th>Name</th>
            <th>Category</th>
            <th>Image</th>
            <th>Price</th>
            <th width="280px">Action</th>
        </tr>
        @forelse ($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $product->name??'' }}</td>
                <td>{{ $product->category->name??'' }}</td>
                <td><img src="{{ Storage::url($product->image) }}" height="75" width="75" alt="" /></td>
                <td>{{ $product->price??'' }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('product.edit', $product->id) }}">Edit</a>

                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
       
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    
                </td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align: center">No Data Found!</td></tr>
        @endforelse

    </table>
@endsection
