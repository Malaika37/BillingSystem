<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="card shadow">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-8">
                     <h1>Skyline Billing System</h1>
                </div>
                <div class="col-md-4 mt-3">
                    <strong>Invoice No: </strong>
                    <span id="invoice-no:">INV0001</span>
                    <div class="mb-2">
                        <label for="" class="form-label">Date:</label>
                        <input type="date" class="form-control" value="{{date('Y-m-d')}}">
                    </div>
                </div>
            </div>
            <div class="row mt-2" >
                <div class="col-md-6">
                    <label for="" class="form-label">Customer</label>
                    <input type="text" class="form-control" placeholder="Enter Customer Name">
                </div>
            <div class="col-md-6">
                    <label for="" class="form-label">WhatsApp No.</label>
                    <input type="tel" class="form-control" placeholder="03xxxxxxxxxx">
            </div>
            </div>

            <!-- Items Section -->
             <table width=100% class="table table-bordered align-middle text-center mt-4">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                        <select class="form-select item-select">
                            <option value="">--Select Item--</option>
                            <option value="1">Product 1</option>
                            <option value="2">Product 2</option>
                            <option value="3">Product 3</option>
                        </select>
                    </td>
                        <td>
                            <input type="number" class="form-control" vlaue="1" min="1">
                    </td>
                        <td>
                            <input type="number" class="form-control" vlaue="1" min="1">
                        </td>
                        <td>
                            <input type="number" class="form-control" vlaue="1" min="1">
                        </td>
                        <td width=10%>
                            <button class="btn btn-danger mt-1 mb-1"><i class="bi bi-trash3"></i></button></td>
                    </tr>
                </tbody>
             </table>
             <button class="btn btn-success">+ Add Item</button>

             <!-- Invoice Summary -->
              <div class="summary row mt-4">
            <div class="col-md-8">

            </div>
             <div class="col-md-4 ">
                <table class="table">
                    <tr>
                        <td class="py-2">Gross Amount</td>
                        <td class="text-end">15000</td>
                    </tr>
                     <tr>
                        <td>Discount (%)</td>
                        <td class="text-end">
                            <input type="number"  class="form-control form-control-sm d-inline-block text-end"
               style="width:90px;" value="0">
                    </td>
                    </tr>
                     <tr>
                        <td><strong>Net Amount</strong></td>
                        <td class="text-end"> <strong>12000</strong></td>
                    </tr>
                </table>
            </div>
              </div>
              <!-- buttons -->
 <div class="d-flex justify-content-between mt-4">

    <button class="btn btn-secondary">
        Clear
    </button>

    <div>
        <button class="btn btn-primary me-2">
            <i class="bi bi-floppy"></i> Save Invoice
        </button>

        <button class="btn btn-danger me-2">
            <i class="bi bi-file-earmark-pdf"></i> Generate PDF
        </button>

        <button class="btn btn-success">
            <i class="bi bi-whatsapp"></i> Send WhatsApp
        </button>
    </div>

</div>
        </div>
    </div>
</div>
    
</body>
</html>