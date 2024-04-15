<div class="mt-4 mb-4">
    @foreach ($projects as $project)
        <li>
            <a href="{{ $project->url }}">

                {{ $project->name }}
            </a>
        </li>

    @endforeach
</div>

