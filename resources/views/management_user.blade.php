<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/dashboard.css'])
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Management User</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>UID</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Akses Level</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $uid => $user)
                <tr>
                    <td>{{ $uid }}</td>
                    <td>{{ $user['username'] ?? '' }}</td>
                    <td>{{ $user['nama'] ?? '' }}</td>
                    <td>{{ $user['akses_level'] ?? '' }}</td>
                    <td>{{ $user['password'] ?? '' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">No user data available</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
