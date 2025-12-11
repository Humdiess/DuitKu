<x-auth-layout title="Login">
    <x-slot name="header">Masuk</x-slot>

    @if (session('success'))
        <div class="mb-4 p-3 rounded-xl glass text-green-ios text-ios-caption">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-3 rounded-xl glass text-red-ios text-ios-caption">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label for="email" class="block text-ios-caption text-secondary-ios mb-2">Email</label>
            <input type="email" name="email" id="email" class="input-ios" placeholder="nama@email.com" required value="{{ old('email') }}">
            @error('email')
                <p class="text-red-ios text-ios-caption mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-ios-caption text-secondary-ios mb-2">Password</label>
            <input type="password" name="password" id="password" class="input-ios" placeholder="••••••••" required>
            @error('password')
                <p class="text-red-ios text-ios-caption mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-0 bg-[var(--fill-primary)] text-accent-ios focus:ring-[var(--accent-color)]">
                <span class="text-ios-caption text-secondary-ios">Ingat saya</span>
            </label>
            <a href="#" class="text-ios-caption text-accent-ios">Lupa password?</a>
        </div>

        <button type="submit" class="btn-ios btn-ios-primary w-full">
            Masuk
        </button>
    </form>

    <div class="separator-ios my-6"></div>

    <p class="text-center text-ios-caption text-tertiary-ios">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="text-accent-ios">Daftar</a>
    </p>
</x-auth-layout>