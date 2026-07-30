<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="card shadow">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="mb-0">
                Add New Item
            </h3>

            <a href="{{ route('items.index') }}"
               class="btn btn-outline-secondary">

                Back

            </a>

        </div>

        <div class="card-body">

            <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Item Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        required>

                </div>
                <div class="mb-3">

    <label class="form-label">

        Product Image

    </label>

    <input
        type="file"
        name="image"
        class="form-control"
        accept="image/*">

</div>

                <div class="mb-3">

                    <label class="form-label">
                        Price
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        class="form-control"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Stock
                    </label>

                    <input
                        type="number"
                        name="stock"
                        class="form-control"
                        value="0"
                        required>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select">

                        <option value="1">
                            Active
                        </option>

                        <option value="0">
                            Inactive
                        </option>

                    </select>

                </div>

                <button class="btn btn-success">

                    Save Item

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>