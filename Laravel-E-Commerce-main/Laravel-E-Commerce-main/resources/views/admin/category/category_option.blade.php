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
                <h2>Xem toàn bộ thuộc tính sản phẩm đã tạo</h2>
            </div>
            <div class="row">
              <div class="col-sm-9">
                  <div class="input-group-append">
                      <a href="{{route('admin.create_category_option')}}" class="btn btn-sm btn-success" type="">Thêm thuộc tính sản phẩm sản phẩm</a>
                  </div>                  
              </div>   
              <div class="col-sm-3">
                  <div class="input-group-append">
                  <form method="GET" action="{{ route('admin.view_category_option') }}">
                      <input type="text" name="search" placeholder="Tìm kiếm...">
                      <button type="submit" class="btn btn-sm btn-danger">Tìm kiếm</button>
                  </form>
                  </div>                  
              </div>  
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card"> 
                        <table class="table" style="color:white;">
                            <thead>
                                <tr>
                                   <th scope="col">Tên danh mục</th>
                                   <th scope="col">Tên thuộc tính</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach($categories as $category)
                                @if($category->parent_id == 0)
                                <tr>
                                    <td>{{$category->category_name}}</td>
                                    <td>
                                        @foreach($category->categoryOptionRelation as $option)
                                          <form method="POST" action="{{route('admin.update_category_option',$option->id)}}"> @csrf
                                            <div>
                                                <input type="text" name="category_option_name" value="{{$option->category_option_name}}">
                                                <a href="{{url('delete_category_option',$category->id)}}" class="btn btn-sm btn-danger" type="Delete">Xóa</a>
                                                <button  class="btn btn-sm btn-warning" type="Edit">Sửa</button>
                                            </div>
                                          </form>  
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                              @endforeach
                            </tbody>
                        </table>
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
  </body>
</html>