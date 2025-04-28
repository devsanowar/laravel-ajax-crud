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
            <h2 class="mb-4 text-center">ডেটা টেবিল <span><button type="button" class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#addStudentModal">
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
                        @foreach ($students as $index => $student)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>
                                <button class="btn btn-sm btn-primary edit_student"
                                    data-id="{{ $student->id }}"
                                    data-name="{{ $student->name }}"
                                    data-email="{{ $student->email }}"
                                    data-phone="{{ $student->phone }}">
                                    Edit
                                </button>
                                <button class="btn btn-sm btn-danger delete_student" data-id="{{ $student->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @include('create')
    @include('edit')


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

<script>
    $(document).ready(function(){

        // Delete Button
        $(document).on('click', '.delete_student', function(e){
            e.preventDefault();
            let button = $(this);
            let id = $(this).data('id');
            let token = '{{ csrf_token() }}';

            if(confirm('আপনি কি নিশ্চিত যে ছাত্রটি মুছে ফেলতে চান?')){
                $.ajax({
                    type: "POST",
                    url: "{{ route('delete.student') }}", // ডিলিট রুট
                    data: {
                        _token: token,
                        id: id
                    },
                    success: function(response){
                        if(response.success){
                            // Row মুছে ফেলবো
                            button.closest('tr').remove();
                            showSuccessMessage('ছাত্র সফলভাবে মুছে ফেলা হয়েছে!');
                        }else{
                            alert('ডিলিট করা যায়নি!');
                        }
                    },
                    error: function(xhr){
                        alert('কিছু ভুল হয়েছে!');
                    }
                });
            }
        });

        // Success Message ফাংশন (আগের মতোই)
        function showSuccessMessage(message){
            let successAlert = `<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    ${message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`;
            $(".container").prepend(successAlert);

            setTimeout(function(){
                $('.alert').fadeOut('slow', function(){
                    $(this).remove();
                });
            }, 3000);
        }

    });
    </script>


    @stack('scripts')
</body>

</html>
