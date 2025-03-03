<?php
require_once __DIR__ . '/../../models/CategoryModel.php';

$productModel = new ProductModel();
$products = $productModel->getProducts();
$categories = getCategories();
require './includes/head.php';
require './includes/sidebar.php';
require './includes/navbar.php';

$editProduct = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $editProduct = $productModel->getProductById($_GET['id']);
}
?>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Manage Products</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="index.php?page=index">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=product">Products</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Product List</h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                <i class="fa fa-plus"></i> Add Product
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="productTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($product['productName']) ?></td>
                                            <td><?= htmlspecialchars($product['categoryName'] ?? 'N/A') ?></td>
                                            <td>
                                                <img src="<?= htmlspecialchars("../" . $product['image_path']) ?>"
                                                    alt="<?= htmlspecialchars($product['productName']) ?>"
                                                    style="max-width: 50px; height: auto;">
                                            </td>
                                            <td>$<?= number_format($product['price'], 2) ?></td>
                                            <td><?= htmlspecialchars($product['description']) ?></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <form method="POST" action="index.php?page=product&action=edit&id=<?= $product['productID'] ?>" style="display:inline;">
                                                        <button type="submit" class="btn btn-link btn-primary btn-lg" title="Edit Product">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="index.php?page=product&action=delete&id=<?= $product['productID'] ?>" style="display:inline;">
                                                        <button type="submit" class="btn btn-link btn-danger" title="Delete Product">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">New <span class="fw-light">Product</span></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Create a new product using this form.</p>
                <form id="addProductForm" method="POST" action="index.php?page=product" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input name="productName" type="text" class="form-control" placeholder="Enter product name" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="catID" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= htmlspecialchars($category['categoryID']) ?>">
                                            <?= htmlspecialchars($category['catName']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Price ($)</label>
                                <input name="price" type="number" step="0.01" class="form-control" placeholder="Enter price" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Product Image</label>
                                <input name="image" type="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" placeholder="Enter product description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Product Modal -->
<?php if ($editProduct): ?>
<div class="modal fade show" id="editProductModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: block;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Edit <span class="fw-light">Product</span></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.href='index.php?page=product'">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Edit the product using this form.</p>
                <form id="editProductForm" method="POST" action="index.php?page=product&action=update&id=<?= $editProduct['productID'] ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input name="productName" type="text" class="form-control" value="<?= htmlspecialchars($editProduct['productName']) ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="catID" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= htmlspecialchars($category['categoryID']) ?>" <?= isset($editProduct['categoryID']) && $editProduct['categoryID'] == $category['categoryID'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($category['catName']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Price ($)</label>
                                <input name="price" type="number" step="0.01" class="form-control" value="<?= htmlspecialchars($editProduct['price']) ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Product Image</label>
                                <input name="image" type="file" class="form-control">
                                <img src="<?= htmlspecialchars("../" . $editProduct['image_path']) ?>" alt="<?= htmlspecialchars($editProduct['productName']) ?>" style="max-width: 50px; height: auto;">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control" required><?= htmlspecialchars($editProduct['description']) ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="window.location.href='index.php?page=product'">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
require './includes/footer.php';
require './includes/foot.php';
?>