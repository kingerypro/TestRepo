<?php
require_once 'database.php';

$pageTitle = 'Product Catalog';
require_once 'partials/header.php';

try {
    $pdo = getDbConnection();
    $stmt = $pdo->query('SELECT * FROM products ORDER BY name ASC');
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    $products = [];
    echo '<p style="color: red;">Error fetching products: ' . $e->getMessage() . '</p>';
}
?>

<section class="products-grid">
  <?php if (empty($products)): ?>
    <p>No products found. Please add some to the database.</p>
  <?php else: ?>
    <?php foreach ($products as $product): ?>
      <div class="product-card">
        <img src="<?php echo htmlspecialchars($product['image_url'] ?: 'https://via.placeholder.com/150'); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
        <p class="product-description"><?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
        <p class="product-price">$<?php echo htmlspecialchars(number_format($product['price'], 2)); ?></p>
        <button>Add to Cart</button>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</section>

<?php require_once 'partials/footer.php'; ?>
