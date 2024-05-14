<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin | Category</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="admin/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="admin/assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="admin/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      <div class="container-fluid page-body-wrapper">
        @include('admin.navbar')
        <div class="main-panel">
          <div class="content-wrapper">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
            @endif
            <div class="text-center pt-4 pb-5">
                <h2>Add Category Option</h2>
            </div>
            <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Thêm thuộc tính sản phẩm</h4>
                            <form method="POST" action="{{route('admin.add_category_option')}}">
                                @csrf
                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Tên thuộc tính</label>
                                    <div class="col-sm-8">
                                        <input style="color: #fff" type="text" name="category_option_name[]" class="form-control" id="category" placeholder="..." required>
                                    </div>
                                    <div class="col-sm-1">
                                        <select class="form-select" name="status[]" aria-label="Default select example">
                                            <option value="1">Hiện</option>
                                            <option value="2">Ẩn</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-primary" id="addInput">+</button>
                                    </div>
                                </div>
                                <div id="additionalInputs"></div>
                                <div class="form-group row">
                                    <label for="category" class="col-sm-2 col-form-label">Chọn danh mục hiển thị thuộc tính</label>
                                    <div class="col-sm-9">
                                        <select class="form-select"name="category_id"  aria-label="Default select example">
                                            @foreach ($categories as $category)
                                                @if($category->parent_id == 0)
                                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                @endif    
                                            @endforeach
                                        </select>
                                    </div>   
                                </div>
                                <br>
                                <div>
                                    <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                                    <a class="btn btn-dark" href="{{route('admin.category')}}">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          @include('admin.footer')
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="admin/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="admin/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="admin/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="admin/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="admin/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="admin/assets/js/off-canvas.js"></script>
    <script src="admin/assets/js/hoverable-collapse.js"></script>
    <script src="admin/assets/js/misc.js"></script>
    <script src="admin/assets/js/settings.js"></script>
    <script src="admin/assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="admin/assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->

    <!--function-->
    <script>
        document.getElementById('addInput').addEventListener('click', function () {
            const additionalInputs = document.getElementById('additionalInputs');
            const newInputDiv = document.createElement('div');
            newInputDiv.classList.add('form-group', 'row', 'mb-3');
            newInputDiv.innerHTML = `
                <label for="category" class="col-sm-2 col-form-label">Tên thuộc tính</label>
                <div class="col-sm-8">
                    <input style="color: #fff" type="text" name="category_option_name[]" class="form-control" placeholder="..." required>
                </div>
                <div class="col-sm-1">
                    <select class="form-select" name="status[]" aria-label="Default select example">
                        <option value="1">Hiện</option>
                        <option value="2">Ẩn</option>
                    </select>
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-danger removeInput">-</button>
                </div>
            `;
            additionalInputs.appendChild(newInputDiv);

            newInputDiv.querySelector('.removeInput').addEventListener('click', function () {
                additionalInputs.removeChild(newInputDiv);
            });
        });
    </script>
  </body>
</html>