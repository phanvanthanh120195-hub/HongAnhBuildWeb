<div
    x-data="{
        rating: $wire.entangle('{{ $getStatePath() }}'),
        hoverRating: 0,
        maxRating: 5,
        setRating(value) {
            this.rating = value;
        }
    }"
    class="flex items-center gap-1"
>
    <template x-for="star in maxRating" :key="star">
        <button
            type="button"
            @click="setRating(star)"
            @mouseenter="hoverRating = star"
            @mouseleave="hoverRating = 0"
            class="focus:outline-none transition-transform hover:scale-110"
        >
            <svg
                class="w-8 h-8 transition-colors duration-150"
                :class="{
                    'text-yellow-400 fill-yellow-400': star <= (hoverRating || rating),
                    'text-gray-300 dark:text-gray-600': star > (hoverRating || rating)
                }"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
            >
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
        </button>
    </template>

    <span x-show="rating" class="ml-2 text-sm text-gray-500 dark:text-gray-400" x-text="rating + ' / ' + maxRating"></span>
</div>
