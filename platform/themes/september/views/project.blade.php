<article class="post--detail">
    <div class="post__header">
        <h1>{!! BaseHelper::clean($project->name) !!}</h1>
        <p>{{ $project->created_at->translatedFormat('d M, Y') }} </p>
    </div>
    <div class="post__content">
        <div class="ck-content">{!! BaseHelper::clean($project->description) !!}</div>
        {{-- @if (!$project->tags->isEmpty())
            <strong>{{ __('Tags') }}: </strong>
            <span>
                @foreach ($project->tags as $tag)
                    <a href="{{ $tag->url }}">{{ $tag->name }}</a>@if (!$loop->last),@endif
                @endforeach
            </span>
        @endif --}}
        <br />
        {!! apply_filters(BASE_FILTER_PUBLIC_COMMENT_AREA, null, $project) !!}
    </div>
</article>

