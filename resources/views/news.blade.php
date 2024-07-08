<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">Management News</a>
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
            <button onclick="showCreateNewsForm()" class="btn btn-primary">
                Add New News
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
                    <th>News</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Vnews as $news)
                <tr>
                    <td>{{ $news->judul_news }}</td>
                    <td>
                        <a href="{{ $news->image_news }}" target="_blank">{{ $news->image_news }}</a>
                    </td>
                    <td>
                        <a href="{{ $news->link_news }}" target="_blank">{{ $news->link_news }}</a>
                    </td>
                    <td>
                        <button onclick="showEditNewsForm({{ json_encode($news) }})" class="btn btn-warning btn-sm">Edit</button>
                        <form action="{{ route('news.destroy', $news->kd_news) }}" method="POST" onsubmit="return confirmDelete(event, this);" class="d-inline">
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
        function showCreateNewsForm() {
            Swal.fire({
                title: 'Add New News',
                html: `
                    <form id="createNewsFormElement" action="{{ route('news.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="judul_news">News Title</label>
                            <input type="text" name="judul_news" id="judul_news" class="form-control" value="{{ old('judul_news') }}">
                        </div>
                        <div class="form-group">
                            <label for="image_news">News Image</label>
                            <input type="text" name="image_news" id="image_news" class="form-control" value="{{ old('image_news') }}">
                        </div>
                        <div class="form-group">
                            <label for="link_news">Link News</label>
                            <input type="text" name="link_news" id="link_news" class="form-control" value="{{ old('link_news') }}">
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Save',
                preConfirm: () => {
                    document.getElementById('createNewsFormElement').submit();
                }
            });
        }

        function showEditNewsForm(news) {
            Swal.fire({
                title: 'Edit News',
                html: `
                    <form id="editNewsFormElement" method="POST" action="/news/${news.kd_news}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_judul_news">Judul News</label>
                            <input type="text" name="judul_news" id="edit_judul_news" class="form-control" value="${news.judul_news}">
                        </div>
                        <div class="form-group">
                            <label for="edit_image_news">Gambar News</label>
                            <input type="text" name="image_news" id="edit_image_news" class="form-control" value="${news.image_news}">
                        </div>
                        <div class="form-group">
                            <label for="edit_link_news">Link News</label>v
                            <input type="text" name="link_news" id="edit_link_news" class="form-control" value="${news.link_news}">
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Update',
                preConfirm: () => {
                    document.getElementById('editNewsFormElement').submit();
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
