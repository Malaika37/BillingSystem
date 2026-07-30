<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class= "bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center" >
                <h3 class="mb-0">Items Management</h3>
                <div>
                    <a href="{{url('/')}}" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-arrow-left">Back to Billing</i>
                    </a>
                     <a href="{{ route('items.create') }}" class="btn btn-success me-2">
                        <i class="bi bi-circle-plus">Add Item</i>
                    </a>
                </div>
               
                <!-- card header div -->
            </div>
             <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
                @endif
<div class="table-responsive">

<table class="table table-hover align-middle">

    <thead class="table-dark">

        <tr>

            <th>#</th>

            <th>Item Name</th>

            <th>Image</th>

            <th>Price</th>

            <th>Stock</th>

            <th>Status</th>

            <th width="180">Action</th>

        </tr>

    </thead>

    <tbody>

    @forelse($items as $item)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ $item->name }}</td>
            <td>

@if($item->image)

<img
    src="{{ asset('storage/'.$item->image) }}"
    width="60"
    height="60"
    class="rounded border object-fit-cover">

@else

<span class="text-muted">

No Image

</span>

@endif

</td>

            <td>Rs. {{ number_format($item->price,2) }}</td>

            <td>{{ $item->stock }}</td>

            <td>

                @if($item->status)

                    <span class="badge bg-success">
                        Active
                    </span>

                @else

                    <span class="badge bg-danger">
                        Inactive
                    </span>

                @endif

            </td>

            <td>

                <a href="{{ route('items.edit',$item->id) }}" class="btn btn-sm btn-warning">
                 <i class="bi bi-pencil-square me-1"></i> Edit</a>

               <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash me-1"></i>
                 Delete</button>

               </form>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="6"
                class="text-center text-muted">

                No Items Found

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

</div>
                    <!-- card body div -->
                </div>
<!-- card div -->

        </div>
<!-- container div -->
    </div>
    <script>
        

document.querySelectorAll(".delete-form").forEach(function(form){

    form.addEventListener("submit", function(e){

        if(!confirm("Are you sure you want to delete this item?")){

            e.preventDefault();

        }

    });

});


    </script>
</body>
</html>