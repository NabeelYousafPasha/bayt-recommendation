<a
    href="{{ route('articles.show', ['article' => $article->id,]) }}"
    class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500"
>
    <div class="mt-2 mb-2">

        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
            {{ $article->title }}
        </h2>

        <hr>

        <div class="mt-1 mb-1 p-2">
            @if($ratingCount ?? false)
                <div class="font-semibold text-gray-800">
                    Total Ratings: {{ $ratingCount ?? 0 }}
                </div>
            @endif

            @if($ratingAvg ?? false)
                <div class="font-semibold text-gray-800">
                    Average Rating: {{ $ratingAvg ?? 0 }}/5
                </div>
            @endif

            @if($visitCount ?? false)
                <div class="font-semibold text-gray-800">
                    Visits: {{ $visitCount ?? 0 }}
                </div>
            @endif

            <p class="mt-2 text-gray-600 dark:text-gray-800 text-sm leading-relaxed">
                {{ $article->body }}
            </p>
        </div>
    </div>
</a>
