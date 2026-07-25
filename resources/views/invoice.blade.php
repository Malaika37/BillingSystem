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
        <div class="card-body px-5 py-5">
          <form action="{{ route('bills.store') }}" method = "POST">
            @csrf
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
         <input type="hidden" id="bill_id" value="{{ session('bill_id') }}">
              <div class="row mb-4">
                <div class="col-md-8">
                     <h1>Skyline Billing System</h1>
                </div>
                <div class="col-md-4 mt-3">
                    <strong>Invoice No: </strong>
                    <span id="invoice-no">INV0001</span>
                    <div class="mb-2">
                        <label for="" class="form-label">Date:</label>
                        <input type="date" name="bill_date" class="form-control" value="{{ old('bill_date', date('Y-m-d')) }}">
                    </div>
                </div>
            </div>
            <div class="row mt-2" >
                <div class="col-md-6">
                    <label for="" class="form-label">Customer</label>
                    <input type="text" name="customer_name" class="form-control" placeholder="Enter Customer Name" value="{{ old('customer_name') }}">
                </div>
            <div class="col-md-6">
                    <label for="" class="form-label">WhatsApp No.</label>
                    <input type="tel" name="whatsapp" class="form-control" placeholder="03xxxxxxxxxx" value="{{ old('whatsapp') }}">
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
               <tbody id="items-body">

               @if(old('item_id'))

                @foreach(old('item_id') as $index => $itemId)

           <tr>

               <td>
            <select class="form-select item-select" name="item_id[]">
                <option value="">--Select Item--</option>

                @foreach($items as $item)
                    <option
                        value="{{ $item->id }}"
                        data-price="{{ $item->price }}"
                        {{ $item->id == $itemId ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach

            </select>
        </td>

        <td>
            <input
                type="number"
                name="quantity[]"
                class="form-control quantity"
                value="{{ old('quantity')[$index] }}"
                min="1">
        </td>

        <td>
            <input
                type="number"
                name="price[]"
                class="form-control price"
                value="{{ old('price')[$index] }}"
                readonly>
        </td>

        <td>
            <input
                type="number"
                name="amount[]"
                class="form-control amount"
                value="{{ old('amount')[$index] }}"
                readonly>
        </td>

        <td width="10%">
            <button type="button" class="btn btn-danger mt-1 mb-1">
                <i class="bi bi-trash3"></i>
            </button>
        </td>

    </tr>

    @endforeach

@else

<tr>

    <td>
        <select class="form-select item-select" name="item_id[]">
            <option value="">--Select Item--</option>

            @foreach($items as $item)
                <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                    {{ $item->name }}
                </option>
            @endforeach

        </select>
    </td>

    <td>
        <input type="number" name="quantity[]" class="form-control quantity" value="1" min="1">
    </td>

    <td>
        <input type="number" name="price[]" class="form-control price" readonly>
    </td>

    <td>
        <input type="number" name="amount[]" class="form-control amount" readonly>
    </td>

    <td width="10%">
        <button type="button" class="btn btn-danger mt-1 mb-1">
            <i class="bi bi-trash3"></i>
        </button>
    </td>

</tr>

@endif

</tbody>
             </table>
             <button type ="button" class="btn btn-success" id="add-item">+ Add Item</button>
       <!-- template -->
       <template id="item-row-template">   
         <tr>
                        <td>
                        <select class="form-select item-select" name="item_id[]">
                            <option value="">--Select Item--</option>
                            @foreach($items as $item)
                            <option value="{{ $item->id }}" data-price="{{ $item->price }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                    </td>
                        <td>
                            <input type="number" name="quantity[]" class="form-control quantity" value="1" min="1">
                    </td>
                        <td>
                            <input type="number" name="price[]" class="form-control price" readonly>
                        </td>
                        <td>
                            <input type="number" name="amount[]" class="form-control amount" readonly>
                        </td>
                        <td width=10%>
                            <button class="btn btn-danger mt-1 mb-1"><i class="bi bi-trash3"></i></button></td>
                    </tr>
                </template>
             <!-- Invoice Summary -->
              <div class="summary row mt-4">
            <div class="col-md-8">

            </div>
             <div class="col-md-4 ">
                <table class="table">
                    <tr>
                        <td class="py-2">Gross Amount</td>
                        <td class="text-end" name="gross-amount" id="gross-amount">0</td>
                    </tr>
                     <tr>
                        <td>Discount (%)</td>
                        <td class="text-end">
                            <input type="number" name="discount" id="discount"  class="form-control form-control-sm d-inline-block text-end" style="width:90px;" value="{{ old('discount',0) }}"min="0" max="100">
                    </td>
                    </tr>
                    <tr>
                   <td>Discount Amount</td>
                   <td class="text-end" name="discount-amount" id="discount-amount">0</td>
                   </tr>
                     <tr>
                        <td><strong>Net Amount</strong></td>
                        <td class="text-end" name="net-amount" id="net-amount"> <strong>0</strong></td>
                    </tr>
                </table>
                <input type="hidden" name="gross_amount" id="gross_amount_input">
                <input type="hidden" name="discount_percentage" id="discount_percentage_input">
                <input type="hidden" name="discount_amount" id="discount_amount_input">
                <input type="hidden" name="net_amount" id="net_amount_input">
            </div>
              </div>
              <!-- buttons -->
 <div class="d-flex justify-content-between mt-4">

    <button type="button" id="clear-form" class="btn btn-secondary">
        Clear
    </button>

    <div>
        <button type="submit" class="btn btn-primary me-2">
            <i class="bi bi-floppy"></i> Save Invoice
        </button>

       <button type="button" id="generate-pdf" class="btn btn-danger me-2" {{session('bill_id') ? '' : 'disabled'}}>
    <i class="bi bi-file-earmark-pdf"></i> Generate PDF
</button>

        <button type="button" class="btn btn-success" id="send-whatsapp" {{session('bill_id') ? '' : 'disabled'}}>
            <i class="bi bi-whatsapp"></i> Send WhatsApp
        </button>
    </div>

</div>
          </form>
        </div>
    </div>
</div>
 
<script>

function initializeRow(row){

    let itemSelect = row.querySelector(".item-select");
    let quantity = row.querySelector(".quantity");
    let price = row.querySelector(".price");
    let amount = row.querySelector(".amount");

    function calculateAmount(){

        let qty = quantity.value;
        let itemPrice = price.value;

        amount.value = qty * itemPrice;
        CalculateGrossAmount();

    }

    itemSelect.addEventListener("change", function(){

        let selectedOption = itemSelect.options[itemSelect.selectedIndex];

        let itemPrice = selectedOption.dataset.price;

        price.value = itemPrice;

        calculateAmount();

    });

    quantity.addEventListener("input", function(){

        calculateAmount();

    });

}


document.querySelectorAll("#items-body tr").forEach(function(row){

    initializeRow(row);

});
 CalculateGrossAmount();

function CalculateGrossAmount(){
    let grossAmount = 0;

    document.querySelectorAll(".amount").forEach(function(amount){
        grossAmount += Number(amount.value);
    });

    let discount =  Number(document.getElementById("discount").value);
    let discountAmount = grossAmount * discount / 100;
    let netAmount = grossAmount - discountAmount;

    document.getElementById("gross-amount").innerText = grossAmount;
    document.getElementById("discount-amount").innerText = discountAmount;
    document.getElementById("net-amount").innerText = netAmount;

    document.getElementById("gross_amount_input").value = grossAmount; 
    document.getElementById("discount_percentage_input").value = discount;
    document.getElementById("discount_amount_input").value = discountAmount; 
    document.getElementById("net_amount_input").value = netAmount; 
}

const addItemButton = document.getElementById("add-item");
const itemsBody = document.getElementById("items-body");
const template = document.getElementById("item-row-template");

addItemButton.addEventListener("click", function(){

    let clone = template.content.cloneNode(true);
    let newRow = clone.querySelector("tr");
    itemsBody.appendChild(clone);
    initializeRow(newRow);
});
document.getElementById("discount").addEventListener("input", function(){

    CalculateGrossAmount();

});
document.getElementById("generate-pdf").addEventListener("click", function () {

    let billId = document.getElementById("bill_id").value;

    if (!billId) {
        alert("Please save invoice first.");
        return;
    }

    window.open("/bills/" + billId + "/pdf", "_blank");

});

document.getElementById("send-whatsapp").addEventListener("click", function () {
console.log("WhatsApp button clicked");
    let billId = document.getElementById("bill_id").value;
console.log("Bill ID:", billId);
    if (!billId) {
        alert("Please save invoice first.");
        return;
    }

    let form = document.createElement("form");
    form.method = "POST";
    form.action = "/bills/" + billId + "/whatsapp";

    let token = document.createElement("input");
    token.type = "hidden";
    token.name = "_token";
    token.value = "{{ csrf_token() }}";

    form.appendChild(token);

    document.body.appendChild(form);
console.log(form.action);

    form.submit();
});

document.getElementById("clear-form").addEventListener("click", function(){
    window.location.href = "/";
});

</script>
</body>
</html>