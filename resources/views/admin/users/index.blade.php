<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-slate-200 text-left">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($users as $user)
                                <tr class="even:bg-slate-50 odd:bg-slate-100">
                                    <td class="p-2">{{ $user->id }}</td>
                                    <td class="p-2">{{ $user->name }}</td>
                                    <td class="p-2">{{ $user->email }}</td>
                                    <td class="p-2"></td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="p-2" colspan="4">
                                        No users found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
