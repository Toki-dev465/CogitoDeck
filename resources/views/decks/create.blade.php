<x-layout>
    <div class="max-w-xl space-y-4">
        <h1 class="text-3xl font-bold">Create a deck</h1>

        <form action="{{ route('decks.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="label" for="title">Title</label>
                <input id="title" name="title" type="text" class="input input-bordered w-full" required>
            </div>

            <div>
                <label class="label" for="description">Description</label>
                <textarea id="description" name="description" class="textarea textarea-bordered w-full"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create deck</button>
        </form>
    </div>
</x-layout>
