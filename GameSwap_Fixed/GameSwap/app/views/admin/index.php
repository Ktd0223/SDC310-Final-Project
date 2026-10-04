<div class="heading-row"><div><p class="eyebrow">Administration</p><h1>Manage products</h1></div><a class="button" href="index.php?route=admin/form">Add product</a></div>
<div class="table-wrap"><table>
<thead><tr><th>Name</th><th>Category</th><th>Platform</th><th>Price</th><th>Stock</th><th>Actions</th></tr></thead>
<tbody><?php foreach ($products as $product): ?><tr>
<td><?= htmlspecialchars($product['name']) ?></td><td><?= htmlspecialchars($product['category']) ?></td><td><?= htmlspecialchars($product['platform']) ?></td><td>$<?= number_format((float) $product['price'], 2) ?></td><td><?= (int) $product['stock_quantity'] ?></td>
<td class="actions"><a href="index.php?route=admin/form&id=<?= (int) $product['id'] ?>">Edit</a><form action="index.php?route=admin/delete" method="post" onsubmit="return confirm('Delete this product?')"><input type="hidden" name="id" value="<?= (int) $product['id'] ?>"><button class="link-danger">Delete</button></form></td>
</tr><?php endforeach; ?></tbody></table></div>

