<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Edit User</h1>
        <form action="{{ route('management.user.update', $uid) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ $user['username'] ?? '' }}" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $user['nama'] ?? '' }}" required>
            </div>            <div class="mb-3">
                <label for="akses_level" class="form-label">Role</label>
                <select name="akses_level" id="akses_level" class="form-select" required>
                    <option value="">Select Role</option>
                    <option value="user" {{ ($user['akses_level'] ?? '') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ ($user['akses_level'] ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" name="password" id="password" class="form-control" value="{{ $user['password'] ?? '' }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="{{ route('management.user') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
