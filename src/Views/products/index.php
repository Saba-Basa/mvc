<?php if (empty($products)): ?>
  <p>No products found.</p>
<?php else: ?>
  <ul>
    <?php foreach ($products as $p): ?>
      <li>
        <?= htmlspecialchars($p['name']) ?> —
        <?= htmlspecialchars(number_format($p['price'], 2)) ?> €
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>