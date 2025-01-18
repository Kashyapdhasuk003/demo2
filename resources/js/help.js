function showForm(formType) {
    let formHtml = '';
    if (formType === 'form1') {
        formHtml = `
            <form id="form1" onsubmit="submitForm(event, 'form1')" method="post" action ="{{url('submit-form1')}}">
            @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit Form 1</button>
            </form>`;
    } else if (formType === 'form2') {
        formHtml = `
            <form id="form2" onsubmit="submitForm(event, 'form2')">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-secondary">Submit Form 2</button>
            </form>`;
    } else if (formType === 'form3') {
        formHtml = `
            <form id="form3" onsubmit="submitForm(event, 'form3')">
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit Form 3</button>
            </form>`;
    }
    $('#dynamicForm').html(formHtml);
}

function submitForm(event, formType) {
    // event.preventDefault();
    const formData = $(`#${formType}`).serialize();
    $.ajax({
        url: `{{url('submit-${formType}')}}`,
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            $('#modalForm').modal('hide');
        },
        error: function(error) {
            alert('Error: ' + error.responseJSON.message);
        }
    });
}