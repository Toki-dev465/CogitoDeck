<x-layout>
    <div class="mx-auto max-w-2xl">
        <a href="/decks/{{ $flashcard->deck_id }}/study" class="text-sm font-semibold text-primary">
            ← Back to study
        </a>

        <h1 class="mt-4 text-3xl font-black">Edit flashcard</h1>

        <form action="/flashcards/{{ $flashcard->id }}" method="POST" class="mt-8 space-y-6 rounded-2xl border border-base-300 bg-base-100 p-6 shadow-sm">
            @csrf
            @method('PATCH')

            <div>
                <label for="front_text" class="label">
                    <span class="label-text font-semibold">Question</span>
                </label>

                <textarea
                    name="front_text"
                    id="front_text"
                    class="textarea textarea-bordered min-h-32 w-full"
                    required
                >{{ old('front_text', $flashcard->front_text) }}</textarea>

                @error('front_text')
                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="back_text" class="label">
                    <span class="label-text font-semibold">Answer</span>
                </label>

                <textarea
                    name="back_text"
                    id="back_text"
                    class="textarea textarea-bordered min-h-32 w-full"
                    required
                >{{ old('back_text', $flashcard->back_text) }}</textarea>

                @error('back_text')
                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="/decks/{{ $flashcard->deck_id }}/study" class="btn btn-ghost">
                    Cancel
                </a>

                <button type="submit" class="btn btn-primary">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</x-layout>