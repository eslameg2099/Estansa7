@if(method_exists($post, 'trashed') && $post->trashed())
        <a href="{{ route('dashboard.posts.trashed.show', $post->id) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@else
        <a href="{{ route('dashboard.posts.show', $post->id) }}" class="btn btn-outline-dark btn-sm">
            <i class="fas fa fa-fw fa-eye"></i>
        </a>
@endif