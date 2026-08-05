<x-layout>
    <div class="mx-auto max-w-2xl">
        <h1 class="text-3xl font-black">Edit deck</h1>

        <form id="update-deck-form" action="/decks/{{ $deck->id }}" method="POST" class="mt-8 space-y-6 rounded-2xl border border-base-300 bg-base-100 p-6 shadow-sm">
            @csrf
            @method('PATCH')

            <div>
                <label for="title" class="label">
                    <span class="label-text font-semibold">Deck title</span>
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title', $deck->title) }}"
                    class="input input-bordered w-full"
                    required
                >

                @error('title')
                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="label">
                    <span class="label-text font-semibold">Description</span>
                </label>

                <textarea
                    name="description"
                    id="description"
                    class="textarea textarea-bordered min-h-32 w-full"
                >{{ old('description', $deck->description) }}</textarea>

                @error('description')
                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-wrap items-center justify-between gap-3 pt-2">
                <a href="/decks" class="btn btn-ghost">Cancel</a>

                <div class="flex items-center gap-3">
                    <button type="submit" class="btn btn-primary">
                        Save changes
                    </button>
                </div>
            </div>
        </form>

        <form id="delete-deck-form" action="/decks/{{ $deck->id }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</x-layout>
