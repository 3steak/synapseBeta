<x-guest-layout>
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('magic.login.send') }}">
        @csrf

        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required autofocus />
        </div>

        <div class="mt-4">
            <button type="submit">Envoyer un lien magique</button>
        </div>
    </form>
</x-guest-layout>
