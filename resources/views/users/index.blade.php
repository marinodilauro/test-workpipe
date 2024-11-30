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

    {{-- Icon font --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />
  </head>

  <body>
    <div class="container mx-auto">
      <header class="mx-auto py-8">
        <img src="{{ asset('img/workpipe_logo.png') }}" alt="Workpipe logo">
      </header>
    </div>
    <div class="container px-4 mx-auto my-8">
      <main>
        <div class="table-header flex justify-center items-center mb-10">
          <h1 class="text-2xl font-bold me-auto">Users table</h1>
          <button type="button" class="action bg-sky-500 hover:bg-sky-600 p-2 rounded-md">
            <a class="text-decoration-none text-white flex items-center" href="" title="View">
              {{-- Icon --}}
              <span class="material-symbols-rounded">
                add
              </span>
              Add user
            </a>
          </button>
        </div>

        {{-- Users table --}}
        <table class="table-auto w-full">
          <thead>
            <tr>
              <th>First name</th>
              <th>Last name</th>
              <th>Email address</th>
              <th>Creation date</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $user)
              <tr>
                {{-- User first name --}}
                <td>{{ $user->first_name }}</td>

                {{-- User last name --}}
                <td>{{ $user->last_name }}</td>

                {{-- User email --}}
                <td>{{ $user->email }}</td>

                {{-- User creation date --}}
                <td>{{ $user->created_at->format('Y-m-d') }}</td>

                {{-- Actions --}}
                <td class="flex justify-center">
                  {{-- Edit action --}}
                  <button type="button" class="action border-2 border-sky-500 hover:bg-sky-500 p-3 rounded-md me-1">
                    <a class="text-decoration-none text-sky-500 flex items-center" href="" title="View">
                      {{-- Icon --}}
                      <span class="material-symbols-rounded">
                        edit_square
                      </span>
                    </a>
                  </button>

                  {{-- Delete action --}}
                  <button type="button" class="action border-2 border-red-500 hover:bg-red-500 p-3 rounded-md me-1">
                    <a class="text-decoration-none text-red-500 flex items-center" href="" title="View">
                      {{-- Icon --}}
                      <span class="material-symbols-rounded">
                        delete
                      </span>
                    </a>
                  </button>
                </td>

              </tr>
            @empty
              <tr>
                <td colspan="5">
                  <p>No user to view. Please create at least one user and try again.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>

        {{-- Pagination --}}
        <div colspan="5" class="table-pagination">
          {{ $users->links() }}
        </div>

      </main>
    </div>
  </body>

</html>
