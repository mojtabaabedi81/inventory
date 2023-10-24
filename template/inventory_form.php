<!DOCTYPE html>
<html lang="en">

<head>
    <title>Inventory</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/Style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../assets/js/main.js"></script>

</head>

<body>
<form id="logoutForm" action="user/logout" method="post">
    <button type="submit" class="btn btn-danger">Log Out</button>
</form>
<h1>Inventory List</h1>

<div class="container">

    <form id="inventoryForm" action="/inventoryTable/add_inventory" method="post">
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
        console.log("Edit button clicked for product for ID:" + productId);

        var inventoryList = document.getElementById('inventoryList');
        var items = inventoryList.getElementsByTagName('li');

        for (var i = 0; i < items.length; i++) {
            var item = items[i];
            var itemId = item.getElementsByTagName('strong')[0].textContent.split(':')[1].trim();

            if (itemId === productId) {
                var itemData = item.textContent.split(', ');
                var editedName = itemData[1].split(':')[1].trim();
                var editedCategory = itemData[2].split(':')[1].trim();
                var editedQuantity = itemData[3].split(':')[1].trim();
                var editedPrice = itemData[4].split(':')[1].trim();

                item.innerHTML =
                    '<strong>ID:</strong> ' + productId +
                    ', <strong>Name:</strong> <input type="text" id="editedName" value="' + editedName + '">' +
                    ', <strong>Category:</strong> <input type="text" id="editedCategory" value="' + editedCategory + '">' +
                    ', <strong>Quantity:</strong> <input type="number" id="editedQuantity" value="' + editedQuantity + '">' +
                    ', <strong>Price:</strong> <input type="number" step="0.01" id="editedPrice" value="' + editedPrice + '">' +
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

        console.log("Edited Name:" + editedName);
        console.log("Edited Category:" + editedCategory);
        console.log("Edited Quantity:" + editedQuantity);
        console.log("Edited Price:" + editedPrice);

        var editeData = {
            productId: productId,
            editedName: editedName,
            editedCategory: editedCategory,
            editedQuantity: editedQuantity,
            editedPrice: editedPrice
        };

        $.post('/inventoryTable/update_inventory', editeData).done(function (response) {
            console.log(response);
        });

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


        $.post('/inventoryTable/delete_inventory', {"productId": productId}).done(function (response) {
            console.log(response);
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
</script>

</body>
</html>
