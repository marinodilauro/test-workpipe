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
                  <button type="button"
                    class="action flex items-center border-2 border-sky-500 text-sky-500 hover:bg-sky-500 hover:text-white p-3 rounded-md me-1"
                    data-modal-trigger="editUserModal" data-user-id="{{ $user->id }}"
                    data-user-first-name="{{ $user->first_name }}" data-user-last-name="{{ $user->last_name }}"
                    data-user-email="{{ $user->email }}">
                    {{-- Icon --}}
                    <span class="material-symbols-rounded">
                      edit_square
                    </span>
                  </button>

                  {{-- Delete action --}}
                  <button type="button"
                    class="action flex items-center border-2 border-red-500 text-red-500 hover:bg-red-500 hover:text-white p-3 rounded-md me-1"
                    data-modal-trigger="deleteUserModal" data-user-id="{{ $user->id }}"
                    data-user-first-name="{{ $user->first_name }}" data-user-last-name="{{ $user->last_name }}">
                    {{-- Icon --}}
                    <span class="material-symbols-rounded">
                      delete
                    </span>
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

    {{-- Edit User Modal --}}
    <div id="editUserModal" data-modal class="relative z-10 hidden" aria-labelledby="editUserModal" role="dialog"
      aria-modal="true">
      <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <form id="editForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div
              class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
              <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="">
                  <div class="mt-3 text-center">
                    <div
                      class="flex justify-between gap-x-5 items-center py-5 border-b border-solid rounded-t border-blueGray-200">
                      <div
                        class="flex size-12 shrink-0 items-center justify-center rounded-full bg-sky-100 text-sky-500">
                        <span class="material-symbols-rounded">
                          edit_square
                        </span>
                      </div>
                      <h3 class="text-lg font-semibold" id="editUserModalTitle">Edit User</h3>
                    </div>
                    <div class="p-6">
                      <input type="hidden" id="editUserId" name="user_id">
                      <div class="flex flex-col items-start mb-4">
                        <label for="editFirstName" class="mb-2 text-sm font-bold text-gray-700">First
                          Name</label>
                        <input type="text" id="editFirstName" @error('first_name') is-invalid @enderror
                          name="first_name"
                          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                      </div>
                      <div class="flex flex-col items-start mb-4">
                        <label for="editLastName" class="mb-2 text-sm font-bold text-gray-700">Last Name</label>
                        <input type="text" id="editLastName" name="last_name"
                          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                      </div>
                      <div class="flex flex-col items-start mb-4">
                        <label for="editEmail" class="mb-2 text-sm font-bold text-gray-700">Email</label>
                        <input type="email" id="editEmail" name="email"
                          class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="bg-gray-50 px-4 py-3 flex justify-end px-6">
                <button type="button" data-modal-close
                  class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                <button type="submit"
                  class="inline-flex w-full justify-center rounded-md bg-sky-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-sky-500 sm:ml-3 sm:w-auto">Save
                  changes</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    </div>

    {{-- Delete User Modal --}}
    <div id="deleteUserModal" data-modal class="relative z-10 hidden" aria-labelledby="deleteUserModal" role="dialog"
      aria-modal="true">
      <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"></div>
      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start">
                <div
                  class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                  <svg class="size-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                  </svg>
                </div>
                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                  <h3 class="text-base font-semibold text-gray-900" id="deleteUserModalTitle">Delete user</h3>
                  <span></span>
                  <div class="mt-2">
                    <p class="text-sm text-gray-500">Are you sure you want to deactivate your account? All of your data
                      will be permanently removed. This action cannot be undone.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 flex justify-end px-6">
              <button type="button" data-modal-close
                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
              <button type="submit"
                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- JavaScript for Modal Interactions --}}
    @vite('resources/js/modal.js')

    {{-- <script src="{{ asset('js/modal.js') }}"></script> --}}

  </body>

</html>
