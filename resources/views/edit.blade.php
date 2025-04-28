<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="editStudentModalLabel">ছাত্র এডিট করুন</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form id="editStudentForm">
                @csrf
                <input type="hidden" id="edit_id">

                <div class="mb-3">
                  <label for="edit_name" class="form-label">নাম</label>
                  <input type="text" class="form-control" id="edit_name" placeholder="আপনার নাম লিখুন">
                </div>

                <div class="mb-3">
                    <label for="edit_email" class="form-label">ইমেইল</label>
                    <input type="email" class="form-control" id="edit_email" placeholder="আপনার ইমেইল লিখুন">
                </div>

                <div class="mb-3">
                    <label for="edit_phone" class="form-label">মোবাইল নাম্বার</label>
                    <input type="text" class="form-control" id="edit_phone" placeholder="আপনার মোবাইল নাম্বার লিখুন">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">বন্ধ করুন</button>
                    <button type="button" class="btn btn-primary update_student">আপডেট করুন</button>
                </div>
              </form>
        </div>

      </div>
    </div>
</div>


@push('scripts')
<script>
$(document).ready(function(){

// ১. Edit Button ক্লিক করলে Modal Open হবে এবং ডাটা বসবে
$(document).on('click', '.edit_student', function(){
    let id = $(this).data('id');
    let name = $(this).data('name');
    let email = $(this).data('email');
    let phone = $(this).data('phone');

    $('#edit_id').val(id);
    $('#edit_name').val(name);
    $('#edit_email').val(email);
    $('#edit_phone').val(phone);

    $('#editStudentModal').modal('show');
});

// ২. Update Button ক্লিক করলে Ajax দিয়ে Update হবে
$(document).on('click', '.update_student', function(e){
    e.preventDefault();

    let id = $('#edit_id').val();
    let name = $('#edit_name').val();
    let email = $('#edit_email').val();
    let phone = $('#edit_phone').val();
    let token = '{{ csrf_token() }}';

    $.ajax({
        type: "POST",
        url: "{{ route('update.student') }}", // তোমাকে route বানাতে হবে
        data: {
            id: id,
            name: name,
            email: email,
            phone: phone,
            _token: token
        },
        success: function(response){
            if(response.success){
                // টেবিলের পুরাতন Row Update করবো
                let row = $('button[data-id="'+id+'"]').closest('tr');

                row.find('td:eq(1)').text(response.student.name);
                row.find('td:eq(2)').text(response.student.email);
                row.find('td:eq(3)').text(response.student.phone);

                $('#editStudentModal').modal('hide');
                showSuccessMessage('ছাত্র সফলভাবে আপডেট হয়েছে!');
            }
        },
        error: function(xhr){
            alert('কিছু ভুল হয়েছে!');
        }
    });
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
@endpush
