<x-app-layout>
    <div class="max-w-lg w-full bg-white text-center p-10 rounded-md shadow-sm space-y-6">
        @auth()
            <h1 class="font-semibold text-2xl text-gray-600">{{ auth()->user()->name }}</h1>
            <a class="hover:text-blue-600" href="{{ route('auth.logout') }}">Logout</a>
        @endauth

        @guest()
                <a class="hover:text-blue-600" href="{{ route('auth.login') }}">Login</a>
                <a class="hover:text-blue-600" href="{{ route('auth.register') }}">Register</a>
        @endguest
    </div>
</x-app-layout>
