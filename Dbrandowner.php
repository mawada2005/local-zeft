<?php
session_start();
require_once 'C:\wamp64\www\(Local-shop)\Controller\productcontroller.php';
require_once 'C:\wamp64\www\(Local-shop)\Controller\brandcontroller.php';
require_once 'C:\wamp64\www\(Local-shop)\connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Owner Dashboard - The Local Shop</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #e74c3c;
            --secondary: #34495e;
            --accent: #f1c40f;
            --light: #ecf0f1;
            --dark: #2c3e50;
            --success: #2ecc71;
        }
        
        .sidebar {
            background-color: var(--secondary);
            color: white;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            transition: all 0.3s;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
            border-left: 4px solid var(--accent);
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        
        .content-wrapper {
            margin-left: 250px;
            transition: all 0.3s;
        }
        
        .top-navbar {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .store-preview {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .store-preview .preview-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #ddd;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
            position: relative;
        }
        
        .product-card .product-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
        }
        
        .product-card .product-actions button {
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255,255,255,0.9);
            border: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .banner-editor {
            position: relative;
            background-image: url('path_to_banner_image.jpg');
            background-size: cover;
            background-position: center;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
            margin-bottom: 20px;
        }
        
        .banner-editor .banner-actions {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        
        .category-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .category-pill {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 5px 15px;
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }
        
        .category-pill.active {
            background-color: var(--accent);
            color: white;
            border-color: var(--accent);
        }
        
        .add-product-form {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .image-upload {
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .image-upload:hover {
            border-color: var(--primary);
            background-color: #f8f9fa;
        }
        
        .store-navigation {
            background-color: white;
            padding: 10px 0;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .store-navigation .brand {
            font-size: 24px;
            font-weight: bold;
            color: var(--dark);
        }
        
        .store-navigation .nav-items {
            display: flex;
            gap: 20px;
        }
        
        .store-navigation .nav-item {
            color: var(--dark);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .store-navigation .nav-item:hover {
            color: var(--primary);
        }
        
        .search-form {
            position: relative;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .search-form input {
            border-radius: 30px;
            padding-right: 40px;
        }
        
        .search-form button {
            position: absolute;
            right: 5px;
            top: 5px;
            border: none;
            background: none;
            color: #777;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="p-3 border-bottom">
            <h4 class="mb-0">Brand Dashboard</h4>
            <small class="text-light">Welcome</small>
        </div>
        <ul class="nav flex-column mt-3">
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="fas fa-store"></i> Storefront Editor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-box"></i> Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-chart-line"></i> Analytics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-cog"></i> Settings</a>
            </li>
            <li class="nav-item mt-5">
                <a class="nav-link text-danger" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>

    <!-- Main Content Area -->
    <div class="content-wrapper">
        <!-- Top Navigation -->
        <nav class="navbar top-navbar navbar-light">
            <div class="container-fluid">
                <div>
                    <button type="button" class="btn btn-sm"><i class="fas fa-bars"></i></button>
                    <span class="ms-2 fw-bold">Storefront Editor</span>
                </div>
                <div>
                    <button class="btn btn-success me-2"><i class="fas fa-save"></i> Save Changes</button>
                    <button class="btn btn-primary"><i class="fas fa-eye"></i> Preview Store</button>
                </div>
            </div>
        </nav>
        
        <!-- Main Content -->
        <div class="container-fluid p-4">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Store Branding</h5>
                            <button class="btn btn-sm btn-outline-primary"><i class="fas fa-pencil-alt"></i> Edit</button>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Store Name</label>
                                        <input type="text" class="form-control" value="LILLY">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="logo-upload">
                                            <button class="btn btn-outline-secondary" type="button">Upload</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Theme Colors</label>
                                        <div class="d-flex gap-2">
                                            <input type="color" class="form-control form-control-color" value="#e74c3c" title="Primary Color">
                                            <input type="color" class="form-control form-control-color" value="#34495e" title="Secondary Color">
                                            <input type="color" class="form-control form-control-color" value="#f1c40f" title="Accent Color">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Store Preview & Editor -->
            <div class="store-preview">
                <div class="preview-header">
                    <h6 class="mb-0">Store Preview</h6>
                    <div>
                        <button class="btn btn-sm btn-outline-secondary me-2"><i class="fas fa-desktop"></i> Desktop</button>
                        <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-mobile-alt"></i> Mobile</button>
                    </div>
                </div>
                <div class="preview-body">
                    <!-- Navigation Editor -->
                    <div class="store-navigation border-bottom px-4">
                        <div class="brand">LILLY</div>
                        <div class="nav-items">
                            <a href="#" class="nav-item">HOME</a>
                            <a href="#" class="nav-item">CART</a>
                            <a href="#" class="nav-item">PRE ORDER</a>
                            <a href="#" class="nav-item">ABOUT</a>
                            <a href="#" class="nav-item">CONTACT</a>
                        </div>
                    </div>
                    
                    <!-- Banner Editor -->
                    <div class="banner-editor">
                        <h1 id="banner-text" contenteditable="true">Our New Collection</h1>
                        <div class="banner-actions">
                            <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#bannerModal">
                                <i class="fas fa-pencil-alt"></i> Edit Banner
                            </button>
                        </div>
                        
                        <!-- Search Bar -->
                        <div class="search-form">
                            <input type="text" class="form-control" placeholder="Search">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    
                    <!-- Category Pills Editor -->
                    <div class="container mt-4">
                        <div class="category-pills">
                            <div class="category-pill active">New Collection</div>
                            <div class="category-pill">Special Promo</div>
                            <div class="category-pill">Casual Bag</div>
                            <div class="category-pill">Party Bag</div>
                            <div class="category-pill">
                                <i class="fas fa-plus"></i> Add Category
                            </div>
                        </div>
                    </div>
                    
                    <!-- Products Editor -->
                    <div class="container mt-4">
                        <div class="row">
                            <!-- Product Item -->
                            <div class="col-md-3">
                                <div class="product-card">
                                    <div class="product-actions">
                                        <button class="edit-product"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="delete-product text-danger"><i class="fas fa-trash"></i></button>
                                    </div>
                                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Product Image">
                                    <div class="card-body">
                                        <h5 class="card-title">Black lavi</h5>
                                        <p class="card-text">800.00 LE</p>
                                        <a href="#" class="btn btn-warning btn-sm w-100"><i class="fas fa-shopping-cart"></i> add</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Product Item -->
                            <div class="col-md-3">
                                <div class="product-card">
                                    <div class="product-actions">
                                        <button class="edit-product"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="delete-product text-danger"><i class="fas fa-trash"></i></button>
                                    </div>
                                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Product Image">
                                    <div class="card-body">
                                        <h5 class="card-title">Blue Demellier</h5>
                                        <p class="card-text">750.00 LE</p>
                                        <a href="#" class="btn btn-warning btn-sm w-100"><i class="fas fa-shopping-cart"></i> add</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Product Item -->
                            <div class="col-md-3">
                                <div class="product-card">
                                    <div class="product-actions">
                                        <button class="edit-product"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="delete-product text-danger"><i class="fas fa-trash"></i></button>
                                    </div>
                                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Product Image">
                                    <div class="card-body">
                                        <h5 class="card-title">Saddle bag</h5>
                                        <p class="card-text">999.00 LE</p>
                                        <a href="#" class="btn btn-warning btn-sm w-100"><i class="fas fa-shopping-cart"></i> add</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Add Product Card -->
                            <div class="col-md-3">
                                <div class="product-card h-100 d-flex align-items-center justify-content-center">
                                    <div class="text-center p-4">
                                        <button class="btn btn-outline-primary btn-lg rounded-circle mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <p>Add New Product</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form 
                    id="add-product-form" 
                    action="/(Local-shop)/Controller/productcontroller.php" 
                    method="post" 
                    enctype="multipart/form-data"
                >
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Product Name</label>
                                <input type="text" name="productName" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price (LE)</label>
                                <input type="number" name="productPrice" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="productCategory" class="form-select" required>
                                    <option value="New Collection">New Collection</option>
                                    <option value="Special Promo">Special Promo</option>
                                    <option value="Casual Bag">Casual Bag</option>
                                    <option value="Party Bag">Party Bag</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="productDescription" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Product Image</label>
                                <div class="image-upload">
                                    <input type="file" name="productImage" id="product-image" class="d-none" required>
                                    <div class="text-center" onclick="document.getElementById('product-image').click();">
                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                        <p>Click to upload image or drag and drop</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stock Quantity</label>
                                <input type="number" name="stockQuantity" class="form-control" value="10" required>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="isFeatured" id="featured" value="1">
                                    <label class="form-check-label" for="featured">
                                        Feature this product
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form submit and cancel buttons -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Edit Banner Modal -->
    <div class="modal fade" id="bannerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Banner Text</label>
                        <input type="text" class="form-control" value="Our New Collection">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Banner Image</label>
                        <input type="file" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Text Color</label>
                        <input type="color" class="form-control form-control-color" value="#ffffff">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple JavaScript for interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Click handler for image upload area
            const imageUpload = document.querySelector('.image-upload');
            const fileInput = document.getElementById('product-image');
            
            imageUpload.addEventListener('click', function() {
                fileInput.click();
            });
            
            // Edit banner text directly
            const bannerText = document.getElementById('banner-text');
            bannerText.addEventListener('blur', function() {
                console.log('Banner text updated to: ' + bannerText.textContent);
            });
            
            // Handlers for product actions
            const editProductButtons = document.querySelectorAll('.edit-product');
            editProductButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productCard = this.closest('.product-card');
                    const productName = productCard.querySelector('.card-title').textContent;
                    console.log('Editing product: ' + productName);
                    // Here you would typically open the edit modal with product data
                    $('#addProductModal').modal('show');
                });
            });
            
            const deleteProductButtons = document.querySelectorAll('.delete-product');
            deleteProductButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const productCard = this.closest('.product-card');
                    const productName = productCard.querySelector('.card-title').textContent;
                    if(confirm(`Are you sure you want to delete "${productName}"?`)) {
                        console.log('Deleting product: ' + productName);
                        // Here you would typically send an AJAX request to delete the product
                        productCard.remove();
                    }
                });
            });
            
            // Category pill selection
            const categoryPills = document.querySelectorAll('.category-pill');
            categoryPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    if(!this.classList.contains('active') && !this.querySelector('.fa-plus')) {
                        document.querySelector('.category-pill.active').classList.remove('active');
                        this.classList.add('active');
                        console.log('Category selected: ' + this.textContent.trim());
                    }
                });
            });
        });
    </script>
</body>
</html>