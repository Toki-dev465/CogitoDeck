<x-layout>
    <div class="mx-auto max-w-2xl">
        <a href="/decks/{{ $deck->id }}/study" class="text-sm font-semibold text-primary">
            ← Back to study
        </a>

        <h1 class="mt-4 text-3xl font-black">
            Add flashcard to {{ $deck->title }}
        </h1>

        <form action="/decks/{{ $deck->id }}/flashcards" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6 rounded-2xl border border-base-300 bg-base-100 p-6 shadow-sm">
            @csrf

            <div>
                <label for="front_text" class="label">
                    <span class="label-text font-semibold">Question</span>
                </label>

                <textarea
                    name="front_text"
                    id="front_text"
                    class="textarea textarea-bordered min-h-32 w-full"
                    placeholder = "Write the question, or upload an image"
    
                >{{ old('front_text') }}</textarea>

                @error('front_text')
                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="front_image" class="label">
                    <span class="label-text font-semibold">Question Image</span>
                </label>

                <input
                    type="file"
                    name="front_image"
                    id="front_image"
                    accept="image/jpeg,image/png,image/webp,image/gif"
                    class="file-input file-input-bordered w-full max-w-xs"
                >

                @error('front_image')
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
                    placeholder = "Write the answer, or upload an image"
                >{{ old('back_text') }}</textarea>

                @error('back_text')
                    <p class="mt-2 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="back_image" class="label">
                    <span class="label-text font-semibold">Answer Image</span>
                </label>

                <input
                    type="file"
                    name="back_image"
                    id="back_image"
                    accept="image/jpeg,image/png,image/webp,image/gif"
                    class="file-input file-input-bordered w-full max-w-xs"
                >
                @error('back_image')
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
