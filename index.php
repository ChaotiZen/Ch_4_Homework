<?php
require_once('database.php');

// Get category ID
$home_type = filter_input(INPUT_GET, 'home_type');

    
// Get name for selected category
$queryCategory = 'SELECT * FROM chapter_4_homework
                      WHERE home_type = :home_type';
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':home_type', $home_type);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['home_type'];
$statement1->closeCursor();

// Get all categories
$queryAllCategories = 'SELECT * FROM chapter_4_homework
                           ORDER BY home_id';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get products for selected category
$queryProducts = 'SELECT * FROM products
              WHERE home_type = :home_type
              ORDER BY home_id';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':home_type', $home_type);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();
?>
<!DOCTYPE html>
<html>
<!-- the head section -->
<head>
    <title>Bad Home Listings</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
<main>
    <h1>Home List</h1>
    <aside>
        <!-- display a list of categories -->
        <h2>Types Of Homes</h2>
        <nav>
        <ul>
            <?php foreach ($categories as $category) : ?>
            <li>
                <a href="?home_type=<?php echo $category['home_type']; ?>">
                    <?php echo $category['home_type']; ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        </nav>           
    </aside>

    <section>
        <!-- display a table of products -->
        <h2><?php echo $home_type; ?></h2>
        <table>
            <tr>
                <th>Home Code</th>
                <th># Available</th>
                <th class="right"># of Rooms</th>
            </tr>

            <?php foreach ($products as $product) : ?>
            <tr>
                <td><?php echo $product['home_id']; ?></td>
                <td><?php echo $product['home_available']; ?></td>
                <td class="right"><?php echo $product['home_size']; ?></td>
            </tr>
            <?php endforeach; ?>            
        </table>
    </section>
</main>    
<footer></footer>
</body>
</html>