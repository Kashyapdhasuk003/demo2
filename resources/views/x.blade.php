<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch User Data</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Fetch User Data</h1>
        <div class="mb-3">
            <label for="user" class="form-label">Select User</label>
            <select id="user" class="form-select">
                <option value="">Select a user</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" id="city" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label for="Mo_Number" class="form-label">Number</label>
            <input type="text" id="Mo_Number" class="form-control" readonly>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#user').change(function () {
                const userId = $(this).val();
                if (userId) {
                    $.ajax({
                        url: `/get-user-data/${userId}`,
                        type: 'GET',
                        success: function (data) {
                            $('#city').val(data.city);
                            $('#Mo_Number').val(data.Mo_Number);
                        },
                        error: function () {
                            alert('Failed to fetch data.');
                        }
                    });
                } else {
                    $('#city').val('');
                    $('#Mo_Number').val('');
                }
            });
        });
    </script>
</body>
</html>
