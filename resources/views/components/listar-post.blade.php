<div>
    @if($posts->count())
        <div class="grid md:grid-cols-2 gap-6 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads').'/'.$post->imagen }}" alt="imagen del {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center">No hay posts, sigue a alguien para que te aparezcan sus posts</p>
    @endif
</div>
