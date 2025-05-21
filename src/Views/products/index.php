<div class="products-container">
  <h1>Products</h1>

  <div class="actions">
    <a href="/products/create" class="btn-create">Add New Product</a>
  </div>

  <?php if (empty($products)): ?>
    <p class="no-products">No products found.</p>
  <?php else: ?>
    <ul class="products-list">
      <?php foreach ($products as $p): ?>
        <li class="product-item">
          <div class="product-name"><?= htmlspecialchars($p['name']) ?></div>
          <div class="product-price"><?= htmlspecialchars(number_format($p['price'], 2)) ?> €</div>
          <?php if (!empty($p['description'])): ?>
            <div class="product-description"><?= htmlspecialchars($p['description']) ?></div>
          <?php endif; ?>
          <div class="product-actions">
            <a href="/products/show?id=<?= $p['id'] ?>" class="btn-view">View</a>
            <a href="/products/edit?id=<?= $p['id'] ?>" class="btn-edit">Edit</a>
            <form method="POST" action="/products/delete" class="delete-form">
              <input type="hidden" name="id" value="<?= $p['id'] ?>">
              <input type="hidden" name="_method" value="DELETE">
              <button type="submit" class="btn-delete">Delete</button>
            </form>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>