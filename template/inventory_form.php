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
<form id="logoutForm" action="user/logout" method="post">
    <button type="submit" class="btn btn-danger">Log Out</button>
</form>
<h1>Inventory List</h1>


<div class="container">

    <form id="inventoryForm" action="/inventoryTable/add_product" method="post">
        <div class="form-group">
            <label for="productId">Product ID:</label>
            <input type="text" id="productId" name="productId" class="form-control">
        </div>
        <div class="form-group">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" class="form-control">
        </div>
        <div class="form-group">
            <label for="productCategory">Category:</label>
            <input type="text" id="productCategory" name="productCategory" class="form-control">
        </div>
        <div class="form-group">
            <label for="productQuantity">Quantity:</label>
            <input type="number" id="productQuantity" name="productQuantity" class="form-control">
        </div>
        <div class="form-group">
            <label for="productPrice">Price:</label>
            <input type="number" step="0.01" id="productPrice" name="productPrice" class="form-control">
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
                $timestamp = date('Y-m-d H:i:s', strtotime($item['inserted_at']));
                echo '<li id="item-' . $item['productId'] . '"><strong>ID:</strong>' . $item['productId'] .
                    ',<strong>Name:</strong> ' . $item['productName'] .
                    ',<strong>Category:</strong>' . $item['productCategory'] .
                    ',<strong>Quantity:</strong> ' . $item['productQuantity'] .
                    ',<strong>Price:</strong> $' . $item['productPrice'] .
                    ',<strong>Inserted At:</strong> ' . $timestamp .
                    ' <button onclick="editItem(' . $item['productId'] . ')">Edit</button>' .
                    ' <button onclick="deleteItem(' . $item['productId'] . ')">Delete</button></li>';
            }
            ?>
        </ul>
    </div>
</div>
<script>
    document.getElementById('logoutForm').addEventListener('submit', function (event) {
        event.preventDefault();


        fetch('user/logout', {
            method: 'POST',
        })
            .then(response => {
                if (response.status === 200) {

                    window.location.href = '/user/logout';
                } else {
                    console.error('Logout failed.');
                }
            });
    });


    function editItem(productId) {

        $.post('/inventoryTable/edit_item',
            {"productId": productId}).done(function (response) {
            console.log(response);
            location.reload();
        });
    }


    function deleteItem(productId) {
        fetch('inventoryTable/delete_product', {
            method: 'POST',
            body: productId,
        }).then(response => {
            if (response.status === 200) {
                console.log(response)
            } else {
                console.log(response);
            }
        });
        // $.post('/inventoryTable/delete_product', {"productId": productId}).done(function (response) {
        //     console.log(response);
        //     location.reload();
        // });
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
</script>

</body>
</html>
