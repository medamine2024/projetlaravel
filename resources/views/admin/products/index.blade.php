<!doctype html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>The Empire of Technology</title>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('dashboardassest/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('dashboardassest/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('dashboardassest/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('dashboardassest/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('dashboardassest/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('dashboardassest/img/favicons/mstile-150x150.png') }}">

    <link href="{{ asset('dashboardassest/css/phoenix.min.css') }}" rel="stylesheet" id="style-default">
    <link href="{{ asset('dashboardassest/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
    <style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">body {
            opacity: 0;
        }
    </style>
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-danger');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const url = this.getAttribute('href');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });
        });
    </script>
    <main class="main" id="top">
        <div class="container-fluid px-0">

            <!-- Include the sidebar -->
            @Include('includes.admin.sidebar')
            <!-- Include the nav -->
            @Include('includes.admin.nav')


            <div class="content">
                <div class="pb-5">
                    <a href="#" class="btn btn-primary"
                        data-bs-toggle="modal"data-bs-target="#addCategoryModal">Add Product</a>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID </th>
                                <th scope="col">NAME</th>
                                <th scope="col">DESCRIPTION</th>
                                <th scope="col">PRICE</th>
                                <th scope="col">QTE</th>
                                <th scope="col">PHOTO</th>
                                <th scope="col">CATEGORY</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }} </td>
                                    <td>{{ $p->name }} </td>
                                    <td>{{ $p->description }} </td>
                                    <td>{{ $p->price }} </td>
                                    <td>{{ $p->qte }} </td>
                                    <td>
                                        <img src="{{ asset('uploads') }}/{{ $p->photo }}" width="50"
                                            alt="">
                                    </td>
                                    <td>{{ $p->category->name }} </td>
                                    <td>
                                        <a data-bs-toggle="modal"data-bs-target="#editProduct{{ $p->id }}"
                                            class="btn btn-success">Edit</a>
                                        <a href="{{ url('/admin/products/' . $p->id . '/delete') }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>




                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <footer class="footer">
                    <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-900">Thank you for creating with phoenix<span
                                    class="d-none d-sm-inline-block"></span><span class="mx-1">|</span><br
                                    class="d-sm-none">2022 &copy; <a href="https://themewagon.com">Themewagon</a></p>
                        </div>
                        <div class="col-12 col-sm-auto text-center">
                            <p class="mb-0 text-600">v1.1.0</p>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog"
                aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCategoryModalLabel">Add Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ url('/admin/products/store') }}" id="addCategoryForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Category Name</label>
                                    <select name="category_id" class="form-select" id="categoryName" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    <div class="invalid-feedback" id="categoryNameError"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Product Name</label>
                                    <input name="name" type="text" class="form-control" id="categoryName"
                                        placeholder="Enter product name" required>
                                    <div class="invalid-feedback" id="categoryNameError"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="categoryDescription" class="form-label">Product Description</label>
                                    <textarea name="description" class="form-control" id="categoryDescription" rows="3"
                                        placeholder="Enter product description" required></textarea>
                                    <div class="invalid-feedback" id="categoryDescriptionError"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="categoryPrice" class="form-label">Product Price</label>
                                    <input type="number" name="price" class="form-control" id="categoryPrice"
                                        placeholder="Enter Product Price" required>
                                    <div class="invalid-feedback" id="ProductpriceError"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="categoryqte" class="form-label">Product Qte</label>
                                    <input type="number" name="qte" class="form-control" id="categoryqte"
                                        placeholder="Enter Product Qte" required>
                                    <div class="invalid-feedback" id="ProductqteError"></div>
                                </div>

                                <div class="mb-3">
                                    <label for="categoryphoto" class="form-label">Product Photo</label>
                                    <input type="file" name="photo" class="form-control" id="categoryphoto"
                                        required>
                                    <div class="invalid-feedback" id="ProductphotoError"></div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>






            @foreach ($products as $index => $p)
            <tr>
                <td>{{ $index + 1 }} </td>
                <td>{{ $p->name }} </td>
                <td>{{ $p->description }} </td>
                <td>{{ $p->price }} </td>
                <td>{{ $p->qte }} </td>
                <td>
                    <img src="{{ asset('uploads') }}/{{ $p->photo }}" width="50" alt="">
                </td>
                <td>{{ $p->category->name }} </td>
                <td>
                    <a data-bs-toggle="modal" data-bs-target="#editProduct{{ $p->id }}" class="btn btn-success">Edit</a>
                    <a href="{{ url('/admin/products/' . $p->id . '/delete') }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            
            <!-- Edit Product Modal -->
            <div class="modal fade" id="editProduct{{ $p->id }}" tabindex="-1" aria-labelledby="editProductLabel{{ $p->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ url('/admin/products/update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Remove @method('PUT') -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="editProductLabel{{ $p->id }}">Edit Product</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="idproduct" value="{{ $p->id }}">
                                <div class="mb-3">
                                    <label for="productName{{ $p->id }}" class="form-label">Product Name</label>
                                    <input name="name" type="text" class="form-control" id="productName{{ $p->id }}" value="{{ $p->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="productDescription{{ $p->id }}" class="form-label">Product Description</label>
                                    <textarea name="description" class="form-control" id="productDescription{{ $p->id }}" rows="3" required>{{ $p->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="productPrice{{ $p->id }}" class="form-label">Product Price</label>
                                    <input type="number" name="price" class="form-control" id="productPrice{{ $p->id }}" value="{{ $p->price }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="productQte{{ $p->id }}" class="form-label">Product Qte</label>
                                    <input type="number" name="qte" class="form-control" id="productQte{{ $p->id }}" value="{{ $p->qte }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="productCategory{{ $p->id }}" class="form-label">Category</label>
                                    <select name="category_id" class="form-select" id="productCategory{{ $p->id }}" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $p->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="productPhoto{{ $p->id }}" class="form-label">Product Photo</label>
                                    <input type="file" name="photo" class="form-control" id="productPhoto{{ $p->id }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                        

                    </div>
                </div>
            </div>
            @endforeach







    </main>
    <script src="{{ asset('dashboardassest/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashboardassest/js/ecommerce-dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
