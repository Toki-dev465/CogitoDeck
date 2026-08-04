<x-layout>
    <div class="space-y-8">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
               

                <h1 class="mt-2 text-4xl font-black">
                    Your decks
                </h1>

                
            </div>

            <a href="/decks/create" class="btn btn-primary">
                Add new deck
            </a>
        </div>

        @if ($decks->isEmpty())
            <div class="rounded-2xl border border-base-300 bg-base-100 p-12 text-center">
                <h2 class="text-2xl font-bold">No decks yet</h2>

                <p class="mt-2 text-base-content/70">
                    Create your first deck to start studying.
                </p>

                <a href="/decks/create" class="btn btn-primary mt-6">
                    Create a deck
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($decks as $deck)
                    <div class="group rounded-2xl border border-base-300 bg-base-100 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h2 class="text-xl font-bold">
                                    {{ $deck->title }}
                                </h2>

                                <p class="mt-2 text-sm text-base-content/70">
                                    {{ $deck->description ?: 'No description added.' }}
                                </p>
                            </div>

                            <span class="badge badge-primary">
                                {{ $deck->cards_count }} cards
                            </span>
                        </div>

                        <div class="mt-6 flex flex-wrap gap-2">
                            <a href="/decks/{{ $deck->id }}/study" class="btn btn-primary btn-sm">
                                Study
                            </a>

                            <a href="/decks/{{ $deck->id }}/edit" class="btn btn-outline btn-sm">
                                Edit
                            </a>

                            <form action="/decks/{{ $deck->id }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-error btn-outline btn-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>