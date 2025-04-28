<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bootstrap Template</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <section class="py-5">
        <div class="container">
          <h2 class="mb-4 text-center">ডেটা টেবিল <span><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">
            ওপেন মডাল
          </button></span></h2>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="table-dark">
                <tr>
                  <th>#</th>
                  <th>নাম</th>
                  <th>ইমেইল</th>
                  <th>মোবাইল</th>
                  <th>অ্যাকশন</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>মোহাম্মদ হাসান</td>
                  <td>hasan@example.com</td>
                  <td>০১৭xxxxxxxx</td>
                  <td>
                    <button class="btn btn-sm btn-primary">Edit</button>
                    <button class="btn btn-sm btn-danger">Delete</button>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>সাদিয়া রহমান</td>
                  <td>sadias@example.com</td>
                  <td>০১৮xxxxxxxx</td>
                  <td>
                    <button class="btn btn-sm btn-primary">Edit</button>
                    <button class="btn btn-sm btn-danger">Delete</button>
                  </td>
                </tr>
                <!-- আরো Row দিতে পারো -->
              </tbody>
            </table>
          </div>
        </div>
      </section>
      @include('create')


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>



    @stack('scripts')
</body>

</html>
