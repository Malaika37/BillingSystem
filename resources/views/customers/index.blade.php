<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skyline Customers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Customer History</h3>
                <a href="{{url('/')}}">Back to Billing</a>
           <!-- card header div  -->
        </div>
        <div class="card-body">
            <!-- search bar -->
             <div class="card mb-3 shadow-sm">
    <div class="card-body">

        <form method="GET" action="{{ route('customers.index') }}">

            <div class="row g-2">

                <div class="col-md-10">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search by Name or WhatsApp..."
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary">
                        <i class="bi bi-search me-2"></i>Search
                    </button>
                </div>

            </div>

        </form>

    </div>
</div>
            <!-- search bar end -->
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Whatsapp No.</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->whatsapp }}</td>
                        <td><a href="{{route('customers.show', $customer->id)}}" class="btn btn-sm btn-primary">View</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class=""text-center>No Customer Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
    {{ $customers->links() }}
</div>
            <!-- card body div -->
        </div>
       <!-- card div  -->
    </div>
   <!-- container div  -->
</div>
    
</body>
</html>