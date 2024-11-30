<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test Workpipe</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Style -->
    @vite('resources/css/app.css')

  </head>

  <body>
    <div class="container mx-auto px-4">
      <table class="table-fixed">
        <thead>
          <tr>
            <th>First name</th>
            <th>Last name</th>
            <th>Email address</th>
            <th>Creation date</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
            <tr>
              <td>{{ $user->first_name }}</td>
              <td>{{ $user->last_name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->created_at->format('Y-m-d') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="4">
                <p>No user to view. Please create at least one user and try again.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" class="table-pagination">
              {{ $users->links() }}
            </td>
          </tr>
        </tfoot>
      </table>
    </div>

  </body>

</html>
