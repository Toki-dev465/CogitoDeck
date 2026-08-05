<x-layout>
    <div class="mx-auto max-w-2xl">
        <a href="/decks/{{ $deck->id }}/study" class="text-sm font-semibold text-primary">
            ← Back to study
        </a>

        <h1 class="mt-4 text-3xl font-black">
            Add flashcard to {{ $deck->title }}
        </h1>

        <form action="/decks/{{ $deck->id }}/flashcards" method="POST" class="mt-8 space-y-6 rounded-2xl border border-base-300 bg-base-100 p-6 shadow-sm">
            @csrf

            <div>
                <label for="front_text" class="label">
                    <span class="label-text font-semibold">Question</span>
                </label>

                <textarea
                    name="front_text"
                    id="front_text"
                    class="textarea textarea-bordered min-h-32 w-full"
                    required
                >{{ old('front_text') }}</textarea>

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
                >{{ old('back_text') }}</textarea>

                @error('back_text')
                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="/decks/{{ $deck->id }}/study" class="btn btn-ghost">Cancel</a>
                <button type="submit" class="btn btn-primary">Add flashcard</button>
            </div>
        </form>
    </div>
</x-layout>