@extends('layouts.auth')

@section('content')

    <div class="">
        {{-- <section class="">
            <h1 class="text-xl mb-5 font-bold">Create User</h1>

            @if($errors->any())
                {!! implode('', $errors->all('<div class="mb-1 text-xs text-red-500">:message</div>')) !!}
            @endif

            <form class="mt-5" action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-2 gap-2 ">

                    <div class="flex flex-col gap-1">
                        <label for="name" class="text-xs">Name</label>
                        <input type="text" name="name" class="py-2 px-4 rounded outline-none border border-gray-400 text-xs" placeholder="Name here...">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="email" class="text-xs">Email</label>
                        <input type="email" name="email" class="py-2 px-4 rounded outline-none border border-gray-400 text-xs" placeholder="Email here...">
                    </div>

                    <div>
                        <label for="email" class="text-xs">Choose Role</label>
                        <select name="role" value="{{ old('role') }}"
                        style="@error('role') border-bottom-color:#f97575; @enderror" class="w-full py-2 px-5 outline-none text-xs border border-gray-400 rounded" data-style="py-0">
                            <option disabled>Select Role</option>
                            @if (count($roles) > 0)
                                @foreach($roles as $role)
                                    <option value="{{ $role['id'] }}">
                                        {{ $role['description'] }}
                                    </option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                </div>
                <button type="submit" class="outline-none mt-4 py-2 px-5 rounded-md bg-blue-500 text-white text-sm">Update</button>

            </form>
        </section> --}}

        <x-user-list :roles="$roles"></x-user-list>


    </div>
@endsection
