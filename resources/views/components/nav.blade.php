<nav class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex min-h-16 max-w-7xl items-center gap-6 px-5 lg:px-8">
        <a  class="text-2xl font-black tracking-tight text-[#4255ff]">Flashcard</a>

        <div class="hidden items-center gap-6 text-sm font-semibold text-slate-700 md:flex">
            @auth
                <a href="/decks" class="transition hover:text-[#4255ff]">My decks</a>
            @endauth
        </div>

      

        <div class="ml-auto flex items-center gap-4 text-sm font-semibold">
            @guest
                <a href="/login" class="hidden text-slate-700 transition hover:text-[#4255ff] sm:inline">Log in</a>
                <a href="/register" class="rounded-full bg-[#4255ff] px-5 py-2.5 text-white transition hover:bg-[#3044e8]">Sign up</a>
            @endguest

            @auth
                <form method="POST" action="/logout">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-slate-700 transition hover:text-[#4255ff]">Log out</button>
                </form>
            @endauth
        </div>
    </div>
</nav>
