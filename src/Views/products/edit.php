<div class="edit-container">
    <h1>Edit Product</h1>
    <form method="POST" action="/products/update?id=<?= $product['id'] ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" value="<?= htmlspecialchars($product['price']) ?>"
                required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?= htmlspecialchars($product['description']) ?></textarea>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-update">Update Product</button>
            <a href="/products" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>