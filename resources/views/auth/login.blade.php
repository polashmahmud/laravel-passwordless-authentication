<x-app-layout>
    <form action="{{ route('auth.login') }}" method="post"
          class="max-w-lg w-full bg-white text-center p-10 rounded-md shadow-sm space-y-6">
        @csrf
        <h1 class="font-semibold text-2xl text-gray-600">Login</h1>

        <div>
            <label for="email" class="sr-only">Email address</label>
            <input type="email" name="email" id="email" placeholder="polashmahmud@gmail.com"
                   class="bg-slate-50 px-2 py-4 border-2 border-slate-200 w-full rounded-md">
            @error('email')
            <p class="text-red-600 text-sm mt-3">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="bg-slate-600 text-white px-6 h-11 rounded-md font-medium w-full">Log in</button>

        @if(session()->has('success'))
            <p>{{ session('success') }}</p>
        @endif
    </form>
</x-app-layout>
