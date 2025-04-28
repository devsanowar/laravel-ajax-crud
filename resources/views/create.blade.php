<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ছাত্র যোগ করুন</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form id="addStudentForm">
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">নাম</label>
                  <input type="text" class="form-control" id="name" placeholder="আপনার নাম লিখুন">
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">ইমেইল</label>
                    <input type="email" class="form-control" id="email" placeholder="আপনার ইমেইল লিখুন">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">মোবাইল নাম্বার</label>
                    <input type="text" class="form-control" id="phone" placeholder="আপনার মোবাইল নাম্বার লিখুন">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                    <button type="button" class="btn btn-primary add_student">সেভ করুন</button>
                  </div>
              </form>


        </div>



      </div>
    </div>
  </div>

  @push('scripts')
  <script>
    $(document).ready(function () {
        $(document).on('click','.add_student',function(e){
            e.preventDefault();
            let name = $('#name').val();
            let email = $('#email').val();
            let phone = $('#phone').val();
            $.ajax({
                type: "post",
                url: "{{ route('add.student') }}",
                data: {name:name,email:email,phone:phone},
                _token: '{{ csrf_token() }}',
                success: function (response) {
                    alert('Student added successfully!');
                    $('#addStudentForm')[0].reset();
                },
                error: function(xhr){
                    alert('Something went wrong!');
                }
            });
        })

    });
</script>
  @endpush
