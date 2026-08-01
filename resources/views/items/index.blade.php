<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        <style>

.item-card{
    transition: all .25s ease;
    border-radius:16px;
    overflow:hidden;
    border:1px solid #ececec;
}

.item-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(0,0,0,.12);
}

.item-card img{
    transition:.35s;
}

.item-card:hover img{
    transform:scale(1.05);
}

.item-price{
    font-size:20px;
    font-weight:700;
    color:#0d6efd;
}

.item-name{
    font-size:17px;
    font-weight:600;
    margin-bottom:8px;
}

.stock-badge{
    border-radius:30px;
    padding:6px 12px;
    font-size:13px;
}

.action-btn{
    width:38px;
    height:38px;
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:10px;
}

</style>
    </style>
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
<div class="row g-4">

@forelse($items as $item)

<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

<div class="card item-card h-100">

 <div class="position-relative overflow-hidden rounded-top">
    <div class="bg-light rounded-4 m-3 d-flex justify-content-center align-items-center"
         style="height:150px;">

      @if($item->image)

<img
    src="{{ asset('storage/'.$item->image) }}"
    class="card-img-top rounded-top"
    style="
        height:170px;
        object-fit:contain;
        transition:.3s;
    ">

@else

<div
    class="d-flex justify-content-center align-items-center bg-light rounded-top"
    style="
        height:170px;
    ">

    <i
        class="bi bi-box-seam text-secondary"
        style="font-size:45px;">
    </i>

</div>

@endif
    </div>
       

       @if($item->status)

    <span class="badge bg-success position-absolute top-0 end-0 m-3">
        Active
    </span>

@else

    <span class="badge bg-secondary position-absolute top-0 end-0 m-3">
        Inactive
    </span>

@endif

    </div>

    <div class="card-body p-3">

       <h5 class="item-name">

            {{ $item->name }}

        </h5>

        <div class="mb-2">

             <div class="item-price">
                Rs. {{ number_format($item->price,2) }}

                 </div>

        </div>

        <div class="mb-3">

            @if($item->stock==0)

                <span class="badge bg-danger stock-badge">

                    Out Of Stock

                </span>

            @elseif($item->stock<=10)

                <span class="badge bg-warning text-dark stock-badge">

                    {{ $item->stock }} Low Stock

                </span>

            @else

                <span class="badge bg-primary stock-badge">

                    {{ $item->stock }} In Stock

                </span>

            @endif

        </div>

    </div>

    <div class="card-footer bg-white border-0">

         <div class="d-flex justify-content-between">

    <a href="{{ route('items.edit',$item->id) }}"
       class="btn btn-light border action-btn">

        <i class="bi bi-pencil"></i>

    </a>

    <form
        action="{{ route('items.destroy',$item->id) }}"
        method="POST"
        class="delete-form action-btn">

        @csrf
        @method('DELETE')

        <button
            class="btn btn-light border text-danger">

            <i class="bi bi-trash"></i>

        </button>

    </form>

</div>

    </div>

</div>

</div>

@empty

<div class="col-12">

<div class="alert alert-warning text-center">

No Products Found

</div>

</div>

@endforelse

</div>

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