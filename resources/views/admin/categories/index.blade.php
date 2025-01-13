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
                        data-bs-toggle="modal"data-bs-target="#addCategoryModal">Add Category</a>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">NAME</th>
                                <th scope="col">DESCRIPTION</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        <a data-bs-toggle="modal"data-bs-target="#editCategory{{ $category->id }}"
                                            class="btn btn-success">Edit</a>
                                        <a href="{{ url('/admin/category/' . $category->id . '/delete') }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
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
                            <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ url('/admin/category/store') }}" id="addCategoryForm">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Category Name</label>
                                    <input name="name" type="text" class="form-control" id="categoryName"
                                        placeholder="Enter category name" required>
                                    <div class="invalid-feedback" id="categoryNameError"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="categoryDescription" class="form-label">Category Description</label>
                                    <textarea name="description" class="form-control" id="categoryDescription" rows="3"
                                        placeholder="Enter category description" required></textarea>
                                    <div class="invalid-feedback" id="categoryDescriptionError"></div>
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

            <!-- Ensure the modal is shown if there are validation errors -->
            @if ($errors->any())
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var myModal = new bootstrap.Modal(document.getElementById('addCategoryModal'));
                        myModal.show();

                        var errors = @json($errors->all());
                        var nameError = @json($errors->first('name'));
                        var descriptionError = @json($errors->first('description'));

                        if (nameError) {
                            var categoryNameInput = document.getElementById('categoryName');
                            var categoryNameError = document.getElementById('categoryNameError');
                            categoryNameInput.classList.add('is-invalid');
                            categoryNameError.textContent = nameError;
                        }

                        if (descriptionError) {
                            var categoryDescriptionInput = document.getElementById('categoryDescription');
                            var categoryDescriptionError = document.getElementById('categoryDescriptionError');
                            categoryDescriptionInput.classList.add('is-invalid');
                            categoryDescriptionError.textContent = descriptionError;
                        }
                    });
                </script>
            @endif
            <!-- Modal -->
            <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog"
                aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ url('/admin/category/store') }}" id="addCategoryForm">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Category Name</label>
                                    <input name="name" type="text" class="form-control" id="categoryName"
                                        placeholder="Enter category name" required>
                                    <div class="invalid-feedback" id="categoryNameError"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="categoryDescription" class="form-label">Category Description</label>
                                    <textarea name="description" class="form-control" id="categoryDescription" rows="3"
                                        placeholder="Enter category description" required></textarea>
                                    <div class="invalid-feedback" id="categoryDescriptionError"></div>
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
            <!-- Modal -->
            @foreach ($categories as $category)
                <div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Category:
                                    <span>{{ $category->name }}</span></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{ url('/admin/category/update') }}"
                                id="editCategoryForm{{ $category->id }}">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="id_category" value="{{ $category->id }}">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="categoryName{{ $category->id }}" class="form-label">Category
                                            Name</label>
                                        <input name="name" type="text" class="form-control"
                                            id="categoryName{{ $category->id }}" value="{{ $category->name }}"
                                            placeholder="Enter category name" required>
                                        <div class="invalid-feedback" id="categoryNameError{{ $category->id }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoryDescription{{ $category->id }}"
                                            class="form-label">Category Description</label>
                                        <textarea name="description" class="form-control" id="categoryDescription{{ $category->id }}" rows="3"
                                            placeholder="Enter category description" required>{{ $category->description }}</textarea>
                                        <div class="invalid-feedback"
                                            id="categoryDescriptionError{{ $category->id }}"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
    <script src="{{ asset('dashboardassest/js/phoenix.js') }}"></script>
    <script src="{{ asset('dashboardassest/js/ecommerce-dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>