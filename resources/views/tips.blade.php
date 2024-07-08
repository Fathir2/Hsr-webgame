<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guide Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">Management Guide</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news.index') }}">{{ __('News') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tips.index') }}">{{ __('Tips') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('videos.index') }}">{{ __('Videos') }}</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5 pt-4">
        <div class="d-flex justify-content-between mb-4">
            <button onclick="showCreateTipsForm()" class="btn btn-primary">
                Add New Tips
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Tips</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Vtips as $tips)
                <tr>
                    <td>{{ $tips->judul_tips }}</td>
                    <td>
                        <a href="{{ $tips->image_tips }}" target="_blank">{{ $tips->image_tips }}</a>
                    </td>
                    <td>
                        <a href="{{ $tips->link_tips }}" target="_blank">{{ $tips->link_tips }}</a>
                    </td>
                    <td>
                        <button onclick="showEditTipsForm({{ json_encode($tips) }})" class="btn btn-warning btn-sm">Edit</button>
                        <form action="{{ route('tips.destroy', $tips->kd_tips) }}" method="POST" onsubmit="return confirmDelete(event, this);" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function showCreateTipsForm() {
            Swal.fire({
                title: 'Add New Tips',
                html: `
                    <form id="createTipsFormElement" action="{{ route('tips.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="judul_tips">Tips Title</label>
                            <input type="text" name="judul_tips" id="judul_tips" class="form-control" value="{{ old('judul_tips') }}">
                        </div>
                        <div class="form-group">
                            <label for="image_tips">Tips Image</label>
                            <input type="text" name="image_tips" id="image_tips" class="form-control" value="{{ old('image_tips') }}">
                        </div>
                        <div class="form-group">
                            <label for="link_tips">Link Tips</label>
                            <input type="text" name="link_tips" id="link_tips" class="form-control" value="{{ old('link_tips') }}">
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Save',
                preConfirm: () => {
                    document.getElementById('createTipsFormElement').submit();
                }
            });
        }

        function showEditTipsForm(tips) {
            Swal.fire({
                title: 'Edit Tips',
                html: `
                    <form id="editTipsFormElement" method="POST" action="/tips/${tips.kd_tips}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_judul_tips">Judul Tips</label>
                            <input type="text" name="judul_tips" id="edit_judul_tips" class="form-control" value="${tips.judul_tips}">
                        </div>
                        <div class="form-group">
                            <label for="edit_image_tips">Gambar Tips</label>
                            <input type="text" name="image_tips" id="edit_image_tips" class="form-control" value="${tips.image_tips}">
                        </div>
                        <div class="form-group">
                            <label for="edit_link_tips">Link Tips</label>v
                            <input type="text" name="link_tips" id="edit_link_tips" class="form-control" value="${tips.link_tips}">
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Update',
                preConfirm: () => {
                    document.getElementById('editTipsFormElement').submit();
                }
            });
        }

        function confirmDelete(event, form) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>'
                });
            @endif
        });
    </script>
</body>
</html>
