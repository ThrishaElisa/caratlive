<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Ticket - Carat Live</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    .card {
        display: flex;
        flex-direction: column;
        gap: 15px;
        max-width: 600px;
        margin: auto;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        flex: 1 1 calc(50% - 15px);
    }

    .form-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: space-between;
    }

    label {
        margin-bottom: 5px;
    }

    h2 {
        text-align: center;
    }
    </style>
</head>

<?php include('header.php'); ?>

<body class="app">
    <div style="display: flex; justify-content: center; align-items: center;">
        <div class="card">
            <h2>Manage Ticket</h2>

            <div class="form-group">
                <label for="eventname">Ticket Name:</label>
                <input type="text" id="eventname" name="eventname"
                    <?php echo !empty($eventname) ? 'value="' . htmlspecialchars($eventname) . '"' : ''; ?>>
            </div>

            <div class="form-container">
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" id="price" name="price"
                        <?php echo !empty($price) ? 'value="' . htmlspecialchars($price) . '"' : ''; ?>>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="text" id="quantity" name="quantity"
                        <?php echo !empty($quantity) ? 'value="' . htmlspecialchars($quantity) . '"' : ''; ?>>
                </div>
                <div class="form-group">
                    <label for="section">Section:</label>
                    <input type="text" id="section" name="section"
                        <?php echo !empty($section) ? 'value="' . htmlspecialchars($section) . '"' : ''; ?>>
                </div>

            </div>
            <button class="buttonSecondary">Add Ticket</button>
        </div>

    </div>
    <div></div>
    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Ticket Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Section</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</body>

</html>