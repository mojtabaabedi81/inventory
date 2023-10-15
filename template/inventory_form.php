<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
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
    <!-- Inventory item input form -->
    <form id="inventoryForm" action="./inventoryTable/add_inventory" method="post">
        <div class="form-group">
            <label for="productId">Product ID:</label>
            <input type="text" id="productId" name="productId" class="form-control">
        </div>
        <div class="form-group">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name = "productName" class="form-control">
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

    <!-- Inventory list to display added items -->
    <h2>Inventory List</h2>
    <ul id="inventoryList">
        <!-- Inventory items will be displayed here -->
    </ul>
</div>

<script>
    // Function for add a new item to the inventory list
    function addItem() {
        // Get input values
        var productId = document.getElementById('productId').value;
        var productName = document.getElementById('productName').value;
        var productCategory = document.getElementById('productCategory').value;
        var productQuantity = document.getElementById('productQuantity').value;
        var productPrice = document.getElementById('productPrice').value;

        // Create a new list item to display the item
        var listItem = document.createElement('li');
        listItem.innerHTML =
            '<strong>ID:</strong> ' + productId +
            ', <strong>Name:</strong> ' + productName +
            ', <strong>Category:</strong> ' + productCategory +
            ', <strong>Quantity:</strong> ' + productQuantity +
            ', <strong>Price:</strong> $' + productPrice;

        // Add the list item to the inventory list
        document.getElementById('inventoryList').appendChild(listItem);

        // Clear the form
        clearForm();
    }

    // Function to clear the input form
    function clearForm() {
        document.getElementById('productId').value = '';
        document.getElementById('productName').value = '';
        document.getElementById('productCategory').value = '';
        document.getElementById('productQuantity').value = '';
        document.getElementById('productPrice').value = '';
    }

    // Function to export the inventory to Excel
    function exportInventoryToExcel() {
        var data = [];
        // Get inventory list items
        var inventoryListItems = document.querySelectorAll('#inventoryList li');

        // Push column headers
        data.push(["Product ID", "Product Name", "Category", "Quantity", "Price"]);

        // Push inventory data
        inventoryListItems.forEach((item) => {
            var itemData = item.textContent.split(', ');
            data.push(itemData);
        });

        // Create a data URI for the Excel file
        var csvContent = "data:text/csv;charset=utf-8," + data.map(e => e.join(",")).join("\n");
        var encodedUri = encodeURI(csvContent);

        // Create a download link for the Excel file
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
