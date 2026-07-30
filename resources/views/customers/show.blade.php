<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
    <div class="container py-4">
        <h2 class="mb-4">Customer Profile</h2>
        <!-- container div -->
         <div class="card shadow-sm mb-4 ">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>{{ $customer->name }}</h4>
                        <p>
                            <strong>Whatsapp:</strong>
                            {{$customer->whatsapp }}
                        </p>
                        <!-- col-md-6 row -->
                    </div>
                 <!-- row div -->
                </div>
                <!-- card body div -->
            </div>
            <!-- card div -->
         </div>
         <!-- statistics card -->
         <div class="row g-3 mb-4">

    <div class="col-12 col-md-4">
        <div class="card border-primary shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Invoices</h6>
                <h2 class="text-primary">{{ $totalBills }}</h2>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card border-success shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Purchase</h6>
                <h2 class="text-success">
                    Rs. {{ number_format($totalPurchase,2) }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="card border-warning shadow-sm h-100">
            <div class="card-body text-center">
                <h6 class="text-muted">Outstanding Balance</h6>
                <h2 class="text-warning">
                    Rs. 0.00
                </h2>
                <small class="text-muted">
                    Payment module coming soon
                </small>
            </div>
        </div>
    </div>

</div>
<!-- statistics card end -->
 <!-- Invoice History -->
 <div class="card shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0">
            Invoice History
        </h5>

    </div>

    <div class="card-body">
      <div class="table-responsive">

<table class="table table-hover align-middle">

    <thead class="table-light">

        <tr>

            <th>Invoice</th>

            <th>Date</th>

            <th>Gross</th>

            <th>Discount</th>

            <th>Net</th>

            <th></th>

        </tr>

    </thead>

    <tbody>

    @forelse($customer->bills as $bill)

        <tr>

            <td>{{ $bill->invoice_number }}</td>

            <td>{{ $bill->invoice_date }}</td>

            <td>Rs. {{ number_format($bill->gross_amount,2) }}</td>

            <td>{{ $bill->discount_percentage }}%</td>

            <td>

                <strong>

                    Rs. {{ number_format($bill->net_amount,2) }}

                </strong>

            </td>

            <td>

                <button
                    class="btn btn-sm btn-outline-primary view-invoice" data-id="{{$bill->id}}">
                 View
                </button>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="6" class="text-center text-muted">

                No invoices found.

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

</div>
    </div>

</div>
<!-- Invoice history end -->
         <!-- container div -->
    </div>
   
    <!-- model -->
     <div class="modal fade" id="invoiceModal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    Invoice Details
                </h5>

                <button
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body" id="invoice-content">

                Loading...

            </div>

        </div>

    </div>

</div>
<!-- modal end -->
 <script>

    document.querySelectorAll(".view-invoice").forEach(function(button){

    button.addEventListener("click", function(){

        let billId = this.dataset.id;

        fetch("/bills/" + billId)

        .then(response => response.json())

        .then(function(bill){
            console.log(bill);

            let html = `

                <div class="row mb-3">

                    <div class="col-md-6">
                        <strong>Invoice:</strong> ${bill.invoice_number}
                    </div>

                    <div class="col-md-6 text-md-end">
                        <strong>Date:</strong> ${bill.invoice_date}
                    </div>

                </div>

                <div class="mb-3">

                    <strong>Customer:</strong>
                    ${bill.customer.name}

                </div>

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>Item</th>

                            <th>Qty</th>

                            <th>Price</th>

                            <th>Amount</th>

                        </tr>

                    </thead>

                    <tbody>

            `;

            bill.bill_items.forEach(function(item){

                html += `

                    <tr>

                        <td>${item.item.name}</td>

                        <td>${item.quantity}</td>

                        <td>Rs. ${item.price}</td>

                        <td>Rs. ${item.amount}</td>

                    </tr>

                `;

            });

            html += `

                    </tbody>

                </table>

                <div class="text-end">

                    <h5>

                        Gross :
                        Rs. ${bill.gross_amount}

                    </h5>

                    <h6>

                        Discount :
                        ${bill.discount_percentage}%

                    </h6>

                    <h4>

                        Net :
                        Rs. ${bill.net_amount}

                    </h4>

                </div>

            `;

            document.getElementById("invoice-content").innerHTML = html;

            let modal = new bootstrap.Modal(document.getElementById("invoiceModal"));

            modal.show();

        });

    });

});
 </script>
</body>
</html>