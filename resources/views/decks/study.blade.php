<x-layout>
    <div class="mx-auto w-full max-w-5xl space-y-8">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <a href="/decks" class="text-sm font-semibold text-primary">
                    ← Back to decks
                </a>

                <h1 class="mt-3 text-4xl font-black">
                    {{ $deck->title }}
                </h1>

                <p class="mt-2 text-base-content/70">
                    Review your flashcards.
                </p>
            </div>

            <a href="/decks/{{ $deck->id }}/flashcards/create" class="btn btn-primary">
                Add flashcard
            </a>
        </div>

        @if ($deck->cards->isEmpty())
            <div class="rounded-2xl border border-base-300 bg-base-100 p-12 text-center">
                <h2 class="text-2xl font-bold">This deck is empty</h2>

                <p class="mt-2 text-base-content/70">
                    Add a flashcard to begin studying.
                </p>

              
            </div>
        @else
            <div>
                @foreach ($deck->cards as $card)
                    <div
                        data-study-card
                        class="{{ $loop->first ? '' : 'hidden' }} relative h-[32rem] w-full cursor-pointer sm:h-[35rem] lg:h-[30rem]"
                        style="perspective: 1000px;"
                    >
                        <div data-flip-card class="absolute inset-0 transition-transform duration-500" style="transform-style: preserve-3d;">
                            <div class="absolute inset-0 rounded-3xl border border-base-300 bg-base-100 p-8 sm:p-16 text-center shadow-xl flex flex-col" data-side="front" style="backface-visibility: hidden; -webkit-backface-visibility: hidden;">
                                <div class="mb-4">
                                    <p class="text-sm font-bold uppercase tracking-widest text-primary">
                                        Question
                                    </p>
                                </div>

                                <div class="flex flex-1 items-center justify-center px-4">
                                    <p class="text-2xl font-bold">
                                        {{ $card->front_text }}
                                    </p>
                                </div>
                            </div>

                            <div class="absolute inset-0 rounded-3xl border border-base-300 bg-base-100 p-8 sm:p-16 text-center shadow-xl flex flex-col" data-side="back" style="backface-visibility: hidden; -webkit-backface-visibility: hidden; transform: rotateY(180deg);">
                                <div class="mb-4">
                                    <p class="text-sm font-bold uppercase tracking-widest text-red-600">
                                        Answer
                                    </p>
                                </div>

                                <div class="flex flex-1 items-center justify-center px-4">
                                    <p class="text-2xl font-bold">
                                        {{ $card->back_text }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute right-4 top-4 flex items-center gap-2">
                            <a href="/flashcards/{{ $card->id }}/edit" class="btn btn-ghost btn-square btn-sm" aria-label="Edit flashcard">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 fill-current">
                                    <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zm18-11.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0L14.13 4.96l3.75 3.75 2.12-2.12z" />
                                </svg>
                            </a>

                            <form action="/flashcards/{{ $card->id }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-ghost btn-square btn-sm" aria-label="Delete flashcard">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 fill-current">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm3.46-9.12l1.41 1.41L12 10.83l1.12 1.12 1.41-1.41L13.41 9.41l1.12-1.12-1.41-1.41L12 8l-1.12-1.12-1.41 1.41L10.59 9.41 9.46 10.53zM15.5 4l-1-1h-5l-1 1H5v2h14V4h-3.5z" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-between gap-4">
                <button type="button" data-previous class="btn btn-outline">
                    ← Previous
                </button>

                <span data-progress class="text-sm font-semibold text-base-content/60"></span>

                <button type="button" data-next class="btn btn-outline">
                    Next →
                </button>
            </div>
        @endif
    </div>

    @if ($deck->cards->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const cards = [...document.querySelectorAll('[data-study-card]')];
                const previousButton = document.querySelector('[data-previous]');
                const nextButton = document.querySelector('[data-next]');
                const progress = document.querySelector('[data-progress]');

                let currentIndex = 0;
                let showingAnswer = false;
                let isAnimating = false;

                function updateFlip() {
                    const currentCard = cards[currentIndex];
                    const flipCard = currentCard.querySelector('[data-flip-card]');

                    flipCard.style.transform = showingAnswer ? 'rotateY(180deg)' : 'rotateY(0deg)';
                }

                function updateProgressAndButtons() {
                    previousButton.disabled = currentIndex === 0;
                    nextButton.disabled = currentIndex === cards.length - 1;
                    progress.textContent = `${currentIndex + 1} of ${cards.length}`;
                }

                function renderCard() {
                    cards.forEach((card, cardIndex) => {
                        const flipCard = card.querySelector('[data-flip-card]');
                        card.classList.toggle('hidden', cardIndex !== currentIndex);
                        if (cardIndex === currentIndex) {
                            flipCard.style.transform = showingAnswer ? 'rotateY(180deg)' : 'rotateY(0deg)';
                        }
                    });

                    updateProgressAndButtons();
                }

                function moveCard(direction) {
                    if (isAnimating) {
                        return;
                    }

                    const nextIndex = direction === 'next'
                        ? currentIndex + 1
                        : currentIndex - 1;

                    if (nextIndex < 0 || nextIndex >= cards.length) {
                        return;
                    }

                    isAnimating = true;

                    const currentCard = cards[currentIndex];
                    const distance = direction === 'next' ? '1.5rem' : '-1.5rem';

                    currentCard.style.transition = 'transform 180ms ease, opacity 180ms ease';
                    currentCard.style.transform = `translateX(${distance})`;
                    currentCard.style.opacity = '0';

                    window.setTimeout(() => {
                        currentCard.style.transition = '';
                        currentCard.style.transform = '';
                        currentCard.style.opacity = '';

                        currentIndex = nextIndex;
                        showingAnswer = false;
                        renderCard();
                        isAnimating = false;
                    }, 180);
                }

                cards.forEach((card) => {
                    card.addEventListener('click', (event) => {
                        const clickable = event.target.closest('button, a');

                        if (clickable) {
                            return;
                        }

                        showingAnswer = !showingAnswer;
                        updateFlip();
                    });
                });

                document.addEventListener('keydown', (event) => {
                    const target = event.target;
                    const isTyping = ['INPUT', 'TEXTAREA', 'SELECT'].includes(target.tagName) || target.isContentEditable;

                    if (isTyping) {
                        return;
                    }

                    if (event.key === 'ArrowLeft') {
                        event.preventDefault();
                        moveCard('previous');
                    }

                    if (event.key === 'ArrowRight') {
                        event.preventDefault();
                        moveCard('next');
                    }

                    if (event.code === 'Space' || event.key === ' ') {
                        event.preventDefault();
                        showingAnswer = !showingAnswer;
                        updateFlip();
                    }
                });

                previousButton.addEventListener('click', () => {
                    moveCard('previous');
                });

                nextButton.addEventListener('click', () => {
                    moveCard('next');
                });

                renderCard();
            });
        </script>
    @endif
</x-layout>
