<?php
require_once('database.php');

$produt_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
// Product data //
$query = 'SELECT * FROM products WHERE productID = :product_id';
$statement = $db->prepare($query);
$statement->bindValue(':product_id', $product_id);
$statement->execute();
$product = $statement->fetch();
$statement->closeCursor();
// gategories //
$query = 'SELECT * FROM categories ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <main>
        <h1>Edit Product</h1>
        <form action="update_product.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
            
            <label>Category:</label>
            <select name="category_id">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['categoryID']; ?>"
                        <?php if ($category['categoryID'] == $product['categoryID']) echo 'selected'; ?>>
                        <?php echo $category['categoryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select><br>
            
            <label>Code:</label>
            <input type="text" name="code" value="<?php echo $product['productCode']; ?>"><br>
            
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo $product['productName']; ?>"><br>
            
            <label>List Price:</label>
            <input type="text" name="price" value="<?php echo $product['listPrice']; ?>"><br>
            
            <label>&nbsp;</label>
            <input type="submit" value="Update Product"><br>
        </form>
        <p><a href="index.php">View Product List</a></p>
    </main>
</body>
</html>