<?php
$sliderModel = new SliderModel();
$sliders = $sliderModel->getSliders(); // Ensure this uses GetActiveSliders() procedure
require './includes/head.php';
require './includes/sidebar.php';
require './includes/navbar.php';

$editSlider = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $editSlider = $sliderModel->getSliderById($_GET['id']);
}
?>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Manage Sliders</h3>
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
                    <a href="index.php?page=slider">Sliders</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Slider List</h4>
                            <button
                                class="btn btn-primary btn-round ms-auto"
                                data-bs-toggle="modal"
                                data-bs-target="#addSliderModal">
                                <i class="fa fa-plus"></i>
                                Add Slider
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="sliderTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th>Image</th>
                                        <th>Link</th>
                                        <th>Status</th>
                                        <th style="width: 15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($sliders as $slider): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($slider['slider_title'] ?? 'N/A') ?></td>
                                            <td><?= htmlspecialchars($slider['slider_subtitle'] ?? 'N/A') ?></td>
                                            <td>
                                                <img src="<?= htmlspecialchars("../" . $slider['slider_image'] ?? '') ?>"
                                                    alt="<?= htmlspecialchars($slider['slider_title'] ?? 'Slider') ?>"
                                                    style="max-width: 100px; height: auto;">
                                            </td>
                                            <td><?= htmlspecialchars($slider['slider_link'] ?? 'N/A') ?></td>
                                            <td>
                                                <span class="badge <?= $slider['slider_status'] ? 'bg-success' : 'bg-danger' ?>">
                                                    <?= $slider['slider_status'] ? 'Active' : 'Inactive' ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="form-button-action">
                                                    <form method="POST" action="index.php?page=slider&action=edit&id=<?= $slider['slider_id'] ?>" style="display:inline;">
                                                        <button type="submit" class="btn btn-link btn-primary btn-lg" title="Edit Slider">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </form>
                                                    <form method="POST" action="index.php?page=slider&action=delete&id=<?= $slider['slider_id'] ?>" style="display:inline;">
                                                        <button type="submit" class="btn btn-link btn-danger" title="Delete Slider">
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

<!-- Add Slider Modal -->
<div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">New <span class="fw-light">Slider</span></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Create a new slider using this form.</p>
                <form id="addSliderForm" method="POST" action="index.php?page=slider" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input name="slider_title" type="text" class="form-control" placeholder="Enter slider title" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Subtitle</label>
                                <input name="slider_subtitle" type="text" class="form-control" placeholder="Enter slider subtitle">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Image</label>
                                <input name="slider_image" type="file" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Link</label>
                                <input name="slider_link" type="text" class="form-control" placeholder="Enter target link">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="slider_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">Add Slider</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Slider Modal -->
<?php if ($editSlider): ?>
<div class="modal fade show" id="editSliderModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: block;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Edit <span class="fw-light">Slider</span></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.href='index.php?page=slider'">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">Edit the slider using this form.</p>
                <form id="editSliderForm" method="POST" action="index.php?page=slider&action=update&id=<?= $editSlider['slider_id'] ?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input name="slider_title" type="text" class="form-control" value="<?= htmlspecialchars($editSlider['slider_title']) ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Subtitle</label>
                                <input name="slider_subtitle" type="text" class="form-control" value="<?= htmlspecialchars($editSlider['slider_subtitle']) ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Image</label>
                                <input name="slider_image" type="file" class="form-control">
                                <img src="<?= htmlspecialchars("../" . $editSlider['slider_image']) ?>" alt="<?= htmlspecialchars($editSlider['slider_title']) ?>" style="max-width: 100px; height: auto;">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Link</label>
                                <input name="slider_link" type="text" class="form-control" value="<?= htmlspecialchars($editSlider['slider_link']) ?>">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="slider_status" class="form-control">
                                    <option value="1" <?= $editSlider['slider_status'] ? 'selected' : '' ?>>Active</option>
                                    <option value="0" <?= !$editSlider['slider_status'] ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">Update Slider</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="window.location.href='index.php?page=slider'">Close</button>
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