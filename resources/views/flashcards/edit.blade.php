<x-layout>
    <div class="mx-auto max-w-2xl">
        <a href="/decks/{{ $flashcard->deck_id }}/study" class="text-sm font-semibold text-primary">
            ← Back to study
        </a>

        <h1 class="mt-4 text-3xl font-black">Edit flashcard</h1>

        <form action="/flashcards/{{ $flashcard->id }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6 rounded-2xl border border-base-300 bg-base-100 p-6 shadow-sm">
            @csrf
            @method('PATCH')

           <div>
            <label for="front_text" class="label">
                <span class="label-text font-semibold">Question text</span>
            </label>

            <textarea
                name="front_text"
                id="front_text"
                class="textarea textarea-bordered min-h-32 w-full"
                >{{ old('front_text', $flashcard->front_text) }}</textarea>

            @error('front_text')
            <p class="mt-2 text-sm text-error">{{ $message }}</p>
            @enderror
            </div>

<div>
    <label for="front_image" class="label">
        <span class="label-text font-semibold">Replace question image</span>
    </label>

    <input
        type="file"
        name="front_image"
        id="front_image"
        accept="image/jpeg,image/png,image/webp,image/gif"
        class="file-input file-input-bordered w-full"
    >

    @if ($flashcard->front_image_path)
        <img
            src="{{ asset('storage/' . $flashcard->front_image_path) }}"
            alt="Current question image"
            class="mt-4 max-h-48 rounded-xl object-contain"
        >

        <label class="label mt-2 cursor-pointer justify-start gap-2">
            <input
                type="checkbox"
                name="remove_front_image"
                value="1"
                class="checkbox checkbox-error"
            >

            <span class="label-text">Remove current question image</span>
        </label>
    @endif

    @error('front_image')
        <p class="mt-2 text-sm text-error">{{ $message }}</p>
    @enderror
</div>

            <div>
    <label for="back_text" class="label">
        <span class="label-text font-semibold">Answer text</span>
    </label>

    <textarea
        name="back_text"
        id="back_text"
        class="textarea textarea-bordered min-h-32 w-full"
    >{{ old('back_text', $flashcard->back_text) }}</textarea>

    @error('back_text')
        <p class="mt-2 text-sm text-error">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="back_image" class="label">
        <span class="label-text font-semibold">Replace answer image</span>
    </label>

    <input
        type="file"
        name="back_image"
        id="back_image"
        accept="image/jpeg,image/png,image/webp,image/gif"
        class="file-input file-input-bordered w-full"
    >

    @if ($flashcard->back_image_path)
        <img
            src="{{ asset('storage/' . $flashcard->back_image_path) }}"
            alt="Current answer image"
            class="mt-4 max-h-48 rounded-xl object-contain"
        >

        <label class="label mt-2 cursor-pointer justify-start gap-2">
            <input
                type="checkbox"
                name="remove_back_image"
                value="1"
                class="checkbox checkbox-error"
            >

            <span class="label-text">Remove current answer image</span>
        </label>
    @endif

    @error('back_image')
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