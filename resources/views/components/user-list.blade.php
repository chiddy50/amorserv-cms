<div>
    <section class="mt-10">
        @if (count($roles) > 0)

        @foreach ($roles as $role)
            <div class="text-sm mb-5">
                <p class="capitalize font-bold mb-2 text-gray-500">{{ $role->name }}s</p>
                <div>
                    @if ($role->users && count($role->users) > 0)

                        @foreach ($role->users as $user)

                            @if (Auth::user()->id !== $user->id)
                                <div class="py-2 px-4 text-sm flex items-center justify-between bg-white border border-gray-300 mb-1 rounded-lg">

                                    <p class="text-xs">{{ $user->name }}</p>
                                    <div class="flex items-center gap-3">

                                        <form action="{{ route('users.toggleactivation') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">

                                            @if ($user->is_active === 1)
                                                <button type="submit" class="py-1 px-4 rounded-lg text-xs bg-red-600 text-white">
                                                    Deactivate
                                                </button>
                                            @else
                                                <button type="submit" class="py-1 px-4 rounded-lg text-xs bg-blue-500 text-white">
                                                Activate
                                                </button>
                                            @endif
                                        </form>

                                        <a href="{{ route('users.edit', $user->id) }}">
                                            <i class='bx bxs-edit cursor-pointer text-lg text-green-500'></i>
                                        </a>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <i class='bx bx-trash cursor-pointer text-lg text-red-500'></i>
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            @endif
                        @endforeach

                    @endif

                </div>

            </div>
        @endforeach

        @else
            <div class="p-3 bg-gray-400 text-white gap-3 rounded-lg w-3/6 flex items-center justify-center">
                <i class='bx bxs-error-alt text-4xl'></i>
                <p class="text-sm">No Role added yet</p>
            </div>
        @endif

    </section>
</div>
