<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
    <title>Inventory</title>
    <style>
        h1 {
            background-color: #1b393d;
            color: white;
            margin: 10px;
            text-align: center;
            padding: 10px 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            margin-bottom: 10px;
        }

        input[type="button"] {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>

<body>
<h1>Inventory List</h1>

<div class="container">

    <form id="inventoryForm" action="./inventoryTable/add_inventory" method="post">
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
        <button type="button" class="btn btn-secondary" onclick="clearForm()">Clear Form</button>
        <button type="button" class="btn btn-success" onclick="exportInventoryToExcel()">Export to Excel</button>
    </form>


    <h2>Inventory List</h2>
    <div class="container">
        <ul id="inventoryList">
            <?php
            require_once __DIR__ . "/../controller/inventoryTable_controller.php";
            $inventoryData = fetch_from_database();
            foreach ($inventoryData as $item) {
                $timestamp = date('Y-m-d H:i:s', strtotime($item['inserted_at']));
                echo '<li id="item-' . $item['product_id'] . '"><strong>ID:</strong>' . $item['product_id'] .
                    ',<strong>Name:</strong> ' . $item['product_name'] .
                    ',<strong>Category:</strong>' . $item['product_category'] .
                    ',<strong>Quantity:</strong> ' . $item['product_quantity'] .
                    ',<strong>Price:</strong> $' . $item['product_price'] .
                    ',<strong>Inserted At:</strong> ' . $timestamp .
                    ' <button onclick="editItem(' . $item['product_id'] . ')">Edit</button>' .
                    ' <button onclick="deleteItem(' . $item['product_id'] . ')">Delete</button></li>';
            }
            ?>
        </ul>
    </div>
</div>

<script>

    function addItem() {

        var productId = document.getElementById('productId').value;
        var productName = document.getElementById('productName').value;
        var productCategory = document.getElementById('productCategory').value;
        var productQuantity = document.getElementById('productQuantity').value;
        var productPrice = document.getElementById('productPrice').value;


        var listItem = document.createElement('li');
        listItem.innerHTML =
            '<strong>ID:</strong> ' + productId +
            ', <strong>Name:</strong> ' + productName +
            ', <strong>Category:</strong> ' + productCategory +
            ', <strong>Quantity:</strong> ' + productQuantity +
            ', <strong>Price:</strong> $' + productPrice +
            ' <button onclick="editItem(' + productId + ')">Edit</button>' +
            ' <button onclick="deleteItem(' + productId + ')">Delete</button>';


        document.getElementById('inventoryList').appendChild(listItem);


        clearForm();
    }


    function clearForm() {
        document.getElementById('productId').value = '';
        document.getElementById('productName').value = '';
        document.getElementById('productCategory').value = '';
        document.getElementById('productQuantity').value = '';
        document.getElementById('productPrice').value = '';
    }


    function editItem(productId) {

        var inventoryList = document.getElementById('inventoryList');
        var items = inventoryList.getElementsByTagName('li');
        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            var itemId = item.getElementsByTagName('strong')[0].textContent.split(':')[1].trim();
            if (itemId === productId) {

                item.innerHTML =
                    '<strong>ID:</strong> ' + productId +
                    ', <strong>Name:</strong> <input type="text" id="editedName" value="' + item.getElementsByTagName('strong')[2].textContent.split(':')[1].trim() + '">' +
                    ', <strong>Category:</strong> <input type="text" id="editedCategory" value="' + item.getElementsByTagName('strong')[4].textContent.split(':')[1].trim() + '">' +
                    ', <strong>Quantity:</strong> <input type="number" id="editedQuantity" value="' + item.getElementsByTagName('strong')[6].textContent.split(':')[1].trim() + '">' +
                    ', <strong>Price:</strong> <input type="number" step="0.01" id="editedPrice" value="' + item.getElementsByTagName('strong')[8].textContent.split(':')[1].trim() + '">' +
                    ' <button onclick="saveEdit(' + productId + ')">Save</button>' +
                    ' <button onclick="deleteItem(' + productId + ')">Delete</button>';
                break;
            }
        }
    }


    function saveEdit(productId) {
        var editedName = document.getElementById('editedName').value;
        var editedCategory = document.getElementById('editedCategory').value;
        var editedQuantity = document.getElementById('editedQuantity').value;
        var editedPrice = document.getElementById('editedPrice').value;

        var inventoryList = document.getElementById('inventoryList');
        var items = inventoryList.getElementsByTagName('li');
        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            var itemId = item.getElementsByTagName('strong')[0].textContent.split(':')[1].trim();
            if (itemId === productId) {
                item.innerHTML =
                    '<strong>ID:</strong> ' + productId +
                    ', <strong>Name:</strong> ' + editedName +
                    ', <strong>Category:</strong> ' + editedCategory +
                    ', <strong>Quantity:</strong> ' + editedQuantity +
                    ', <strong>Price:</strong> $' + editedPrice +
                    ' <button onclick="editItem(' + productId + ')">Edit</button>' +
                    ' <button onclick="deleteItem(' + productId + ')">Delete</button>';
                break;
            }
        }
    }

    function deleteItem(productId) {

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './inventoryTable/delete_inventory', true);
        xhr.setRequestHeader('Content-Type', 'application/json');


        var data = JSON.stringify({productId: productId});

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {

                var response = JSON.parse(xhr.responseText);
                if (response.success) {

                    var item = document.getElementById('item-' + productId);
                    item.parentNode.removeChild(item);
                } else {

                    console.error('Item deletion failed.');
                }
            }
        }


        xhr.send(data);
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
