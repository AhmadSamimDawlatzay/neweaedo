<div class="row">
    @foreach ($projects as $post)
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <article class="post">
                <div class="post__wrapper">
                    <div class="post__thumbnail"><a class="post__overlay" href="{{ $post->url }}" title="{{ $post->name }}"></a><img src="{{ RvMedia::getImageUrl($post->image, 'medium', false, RvMedia::getDefaultImage()) }}" alt="{{ $post->name }}" loading="lazy"/></div>
                    <div class="post__content">
                        <div class="post__header">
                            <h4 class="post__title"><a href="{{ $post->url }}">{!! BaseHelper::clean($post->name) !!}</a></h4> <span>{{ $post->created_at->translatedFormat('d M, Y') }}</span>
                        </div>
                        {{-- <p>{{ $post->description }}</p> --}}
                        <p>{!! strlen($post->description) > 50 ? substr($post->description, 0, 50) . '...' : $post->description !!}</p>

                    </div>
                </div>
            </article>
        </div>
    @endforeach
</div>
<div class="section__footer text-center">
    <div class="custom-pagination">
        {!! $projects->withQueryString()->links() !!}
    </div>
</div>
