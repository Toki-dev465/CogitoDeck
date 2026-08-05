<x-layout>
    <div class="mx-auto max-w-2xl">
        <h1 class="text-3xl font-black">Create a deck</h1>

        <form action="/decks" method="POST" class="mt-8 space-y-6 rounded-2xl border border-base-300 bg-base-100 p-6 shadow-sm">
            @csrf

            <div>
                <label for="title" class="label">
                    <span class="label-text font-semibold">Deck title</span>
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    class="input input-bordered w-full"
                    placeholder="Biology Chapter 1"
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
                    placeholder="What will you study in this deck?"
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="/decks" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Create deck</button>
            </div>
        </form>
    </div>
</x-layout>
