<div id="replaceMe" class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 sm:mx-auto lg:max-w-full">
    @foreach($posts as $post)
    <div class="overflow-hidden transition-shadow duration-300 rounded shadow-sm">
        <img src="{{ route('getImage',['filename' => 'default.jpg']) }}" class="object-cover w-full h-48 sm:h-56"
            alt="" />
        <div class="pt-5">
            <p class="mb-3 text-xs font-semibold tracking-wide uppercase">
                <span class="text-base-content">{{ $post->user->name . ' - ' .
                    $post->created_at->diffForHumans() }}</span>
            </p>
            <a href="/"
                class="text-base-content inline-block mb-3 text-xl font-semibold transition-colors duration-200">{{
                $post->title }}</a>
            <p class="mb-2 text-base-content">
                {!! $post->shortBody() !!}
            </p>
            <div class="mt-4 space-x-2">
                <div class="badge badge-outline border-2 border-secondary-focus  text-base-content">
                    {{ $post->category->name }}
                </div>
                <div class="badge badge-outline border-2 text-base-content">#tutorial</div>
            </div>
        </div>
    </div>
    @endforeach
</div>