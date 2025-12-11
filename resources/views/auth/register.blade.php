<x-auth-layout title="Register">
    <x-slot name="header">Daftar</x-slot>

    @if (session('error'))
        <div class="mb-4 p-3 rounded-xl glass text-red-ios text-ios-caption">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
        @csrf
        
        <div>
            <label for="name" class="block text-ios-caption text-secondary-ios mb-2">Nama</label>
            <input type="text" name="name" id="name" class="input-ios" placeholder="Nama lengkap" required value="{{ old('name') }}">
            @error('name')
                <p class="text-red-ios text-ios-caption mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-ios-caption text-secondary-ios mb-2">Email</label>
            <input type="email" name="email" id="email" class="input-ios" placeholder="nama@email.com" required value="{{ old('email') }}">
            @error('email')
                <p class="text-red-ios text-ios-caption mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-ios-caption text-secondary-ios mb-2">Password</label>
            <input type="password" name="password" id="password" class="input-ios" placeholder="Minimal 8 karakter" required>
            @error('password')
                <p class="text-red-ios text-ios-caption mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-ios-caption text-secondary-ios mb-2">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="input-ios" placeholder="Ulangi password" required>
        </div>

        <div class="flex items-start gap-2">
            <input type="checkbox" name="terms" id="terms" class="mt-1 w-4 h-4 rounded border-0 bg-[var(--fill-primary)] text-accent-ios focus:ring-[var(--accent-color)]" required>
            <label for="terms" class="text-ios-caption text-tertiary-ios">
                Saya setuju dengan <a href="#" class="text-accent-ios">Syarat & Ketentuan</a>
            </label>
        </div>

        <button type="submit" class="btn-ios btn-ios-primary w-full">
            Daftar
        </button>
    </form>

    <div class="separator-ios my-6"></div>

    <p class="text-center text-ios-caption text-tertiary-ios">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="text-accent-ios">Masuk</a>
    </p>
</x-auth-layout>