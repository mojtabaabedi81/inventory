<!DOCTYPE html>
<html lang="en">

<head>
    <title>Inventory</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/jquery-3.7.1.min.js"></script>
</head>

<body>
<form class="position-absolute ps-4" id="logoutForm" action="../user/logout" method="post">
    <button type="submit" class="btn btn-danger">Log Out</button>
</form>
<h1 class="title-h1">Inventory</h1>
<div class="modal-body row">
    <div class="col-md-4">
        <form class="form-control" id="inventoryForm" action="/inventoryTable/add_product" method="post">
            <div class="form-group">
                <label for="productId">Product Number:</label>
                <input type="number" id="product_no" name="product_no" class="form-control">
            </div>
            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" id="product_name" name="product_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="productCategory">Category:</label>
                <input type="text" id="product_category" name="product_category" class="form-control">
            </div>
            <div class="form-group">
                <label for="productQuantity">Quantity:</label>
                <input type="number" id="product_quantity" name="product_quantity" class="form-control">
            </div>
            <div class="form-group">
                <label for="productPrice">Price:</label>
                <input type="number" step="0.01" id="product_price" name="product_price" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Item</button>
            <button type="reset" class="btn btn-secondary">Clear Form</button>
        </form>
    </div>
    <div class="col-md-8">
        <table class="table table-light table-bordered">
            <thead>
            <tr>
                <th scope="col">Product Number</th>
                <th scope="col">Product Name</th>
                <th scope="col">Category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Created At</th>
                <th scope="col">Operation</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($data as $item) {
                echo '<tr> 
                        <td>' . $item['product_no'] . '</td>
                        <td>' . $item['product_name'] . '</td>
                        <td>' . $item['product_category'] . '</td>
                        <td>' . $item['product_quantity'] . '</td>
                        <td>' . $item['product_price'] . '</td>
                        <td>' . $item['created_at'] . '</td>
                        <td>
                            <button onclick="edit(' . $item['id'] . ')" id="edit" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-id="' . $item['id'] . '" class="btn btn-warning">Edit</button>
                            <button class="btn btn-danger" onclick="deleteItem(' . $item['id'] . ')">Delete</button>
                        </td>
                        </tr>';
            }
            ?>
            <
        </table>
            <form action="/inventoryTable/excel_export" method="post" name="export_to_excel">
                <button type="submit" name="export_excel_btn" class="btn btn-primary">Export</button>
            </form>

        </tbody>
    </div>
</div>


<!--modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">edit item</h1>
            </div>
            <div class="modal-body">
                <form id="edit-form" method="post" action="/inventoryTable/edit_item">
                    <input name="id" id="sendId" type="hidden" value="">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Product Number:</label>
                        <input name="product_no" type="number" class="form-control" id="Product-number">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Product Name:</label>
                        <input name="product_name" type="text" class="form-control" id="Product-name">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Category:</label>
                        <input name="product_category" type="text" class="form-control" id="category">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Quantity:</label>
                        <input name="product_quantity" type="number" class="form-control" id="quantity">
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Price:</label>
                        <input name="product_price" type="number" class="form-control" id="Price">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    function deleteItem(id) {
        $.post('/inventoryTable/delete_product', {"id": id}).done(function (response) {
            location.reload();
        });
    }


    function edit(product_id) {
        $.ajax({
            type: "GET", //we are using GET method to get data from server side
            url: '/inventoryTable/get_product', // get the route value
            data: {product_id: product_id}, //set data
            success: function (response) {//once the request successfully process to the server side it will return result here
                response = JSON.parse(response);
                $("#edit-form [name=\"product_no\"]").val(response[0].product_no);
                $("#edit-form [name=\"product_name\"]").val(response[0].product_name);
                $("#edit-form [name=\"product_category\"]").val(response[0].product_category);
                $("#edit-form [name=\"product_quantity\"]").val(response[0].product_quantity);
                $("#edit-form [name=\"product_price\"]").val(response[0].product_price);
            }
        });
    }


    //bootstrap modal

    const exampleModal = document.getElementById('exampleModal')
    if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const ProductID = button.getAttribute('data-bs-id')
            const ProductName = button.getAttribute('data-bs-name')
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.
            // Update the modal's content.
            const modalTitle = exampleModal.querySelector('.modal-title')
            const modalBodyInput = exampleModal.querySelector('#sendId')

            modalBodyInput.value = ProductID
        })
    }
</script>

</body>
</html>
