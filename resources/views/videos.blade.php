<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">Management Videos</a>
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
            <button onclick="showCreateVideosForm()" class="btn btn-primary">
                Add New Videos
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
                    <th>Video</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Vvideos as $videos)
                <tr>
                    <td>{{ $videos->judul_videos }}</td>
                    <td>
                        <a href="{{ $videos->image_videos }}" target="_blank">{{ $videos->image_videos }}</a>
                    </td>
                    <td>
                        <a href="{{ $videos->link_videos }}" target="_blank">{{ $videos->link_videos }}</a>
                    </td>
                    <td>
                        <button onclick="showEditVideosForm({{ json_encode($videos) }})" class="btn btn-warning btn-sm">Edit</button>
                        <form action="{{ route('videos.destroy', $videos->kd_videos) }}" method="POST" onsubmit="return confirmDelete(event, this);" class="d-inline">
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
        function showCreateVideosForm() {
            Swal.fire({
                title: 'Add New Videos',
                html: `
                    <form id="createVideosFormElement" action="{{ route('videos.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="judul_videos">Videos Title</label>
                            <input type="text" name="judul_videos" id="judul_videos" class="form-control" value="{{ old('judul_videos') }}">
                        </div>
                        <div class="form-group">
                            <label for="image_videos">Video Image</label>
                            <input type="text" name="image_videos" id="image_videos" class="form-control" value="{{ old('image_videos') }}">
                        </div>
                        <div class="form-group">
                            <label for="link_videos">Link Videos</label>
                            <input type="text" name="link_videos" id="link_videos" class="form-control" value="{{ old('link_videos') }}">
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Save',
                preConfirm: () => {
                    document.getElementById('createVideosFormElement').submit();
                }
            });
        }

        function showEditVideosForm(videos) {
            Swal.fire({
                title: 'Edit Videos',
                html: `
                    <form id="editVideosFormElement" method="POST" action="/videos/${videos.kd_videos}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_judul_videos">Judul Videos</label>
                            <input type="text" name="judul_videos" id="edit_judul_videos" class="form-control" value="${videos.judul_videos}">
                        </div>
                        <div class="form-group">
                            <label for="edit_image_videos">Gambar Video</label>
                            <input type="text" name="image_videos" id="edit_image_videos" class="form-control" value="${videos.image_videos}">
                        </div>
                        <div class="form-group">
                            <label for="edit_link_videos">Link Videos</label>v
                            <input type="text" name="link_videos" id="edit_link_videos" class="form-control" value="${videos.link_videos}">
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Update',
                preConfirm: () => {
                    document.getElementById('editVideosFormElement').submit();
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
