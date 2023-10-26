<!DOCTYPE html>
<html lang="en">

<head>
    <title>Inventory</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
<form id="logoutForm" action="../user/logout" method="post">
    <button type="submit" class="btn btn-danger">Log Out</button>
</form>
<h1>Inventory List</h1>


<div class="container">

    <form id="inventoryForm" action="/inventoryTable/add_product" method="post">
        <div class="form-group">
            <label for="product_no">Product No:</label>
            <input type="text" id="product_no" name="product_no" class="form-control">
        </div>
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" class="form-control">
        </div>
        <div class="form-group">
            <label for="product_category">Category:</label>
            <input type="text" id="product_category" name="product_category" class="form-control">
        </div>
        <div class="form-group">
            <label for="product_quantity">Quantity:</label>
            <input type="number" id="product_quantity" name="product_quantity" class="form-control">
        </div>
        <div class="form-group">
            <label for="product_price">Price:</label>
            <input type="number" step="0.01" id="product_price" name="product_price" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Item</button>
        <button type="reset" class="btn btn-secondary">Clear Form</button>
        <button type="button" class="btn btn-success" onclick="exportInventoryToExcel()">Export to Excel</button>
    </form>


    <h2>Inventory List</h2>
    <div class="container">
        <div class="my-row"
        <ul id="inventoryList">
            <?php
            foreach ($data as $item) {

                $timestamp = date('Y-m-d H:i:s', strtotime($item['created_at']));
                echo '<li id="item-' . $item['product_no'] . '"><strong>ID:</strong>' . $item['product_no'] .
                    ',<strong>Name:</strong> ' . $item['product_name'] .
                    ',<strong>Category:</strong>' . $item['product_category'] .
                    ',<strong>Quantity:</strong> ' . $item['product_quantity'] .
                    ',<strong>Price:</strong> $' . $item['product_price'] .
                    ',<strong>Inserted At:</strong> ' . $timestamp .
                    ' <button onclick="editItem(' . $item['id'] . ')">Edit</button>' .
                    ' <button onclick="deleteItem(' . $item['id'] . ')">Delete</button></li>';
            }
            ?>
        </ul>
    </div>
</div>
<script>

    function editItem(product_no) {

        $.post('/inventoryTable/edit_item',
            {"product_no": product_no}).done(function (response) {
            console.log(response);
            location.reload();
        });
    }


    function deleteItem(product_no) {
        $.post('/inventoryTable/delete_product', {"product_no": product_no}).done(function (response) {
            console.log(response);
            location.reload();
        });
    }


    function exportInventoryToExcel() {
        var data = [];

        var inventoryListItems = document.querySelectorAll('#inventoryList li');


        data.push(["Product ID", "Product Name", "Category", "Quantity", "Price"]);


        inventoryListItems.forEach((item) => {
            var itemData = item.textContent.split(', ');
            data.push(itemData);
        });


        var csvContent = "data:text/csv;charset=utf-8," + data.map(e => e.join(",")).join("\n");
        var encodedUri = encodeURI(csvContent);


        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "inventory.csv");
        link.style.display = 'none';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }




    //bootstrap


    const exampleModal = document.getElementById('exampleModal')
    if (exampleModal) {
        exampleModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const recipient = button.getAttribute('data-bs-whatever')
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.

            // Update the modal's content.
            const modalTitle = exampleModal.querySelector('.modal-title')
            const modalBodyInput = exampleModal.querySelector('.modal-body input')

            modalTitle.textContent = `New message to ${recipient}`
            modalBodyInput.value = recipient
        })
    }
</script>

</body>
</html>
