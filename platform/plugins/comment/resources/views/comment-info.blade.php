@if ($comment)
    <p>{{ trans('plugins/comment::comment.tables.blog') }}: <a target="_blank" href="{{ @$comment->post->url }}">{{ @$comment->post->name }}</a>
    </p>
    <p>{{ trans('plugins/comment::comment.tables.time') }}: <i>{{ $comment->created_at }}</i></p>
    <p>{{ trans('plugins/comment::comment.tables.name') }}: <i>{{ $comment->name }}</i></p>
    <p>{{ trans('plugins/comment::comment.tables.email') }}: <i><a href="mailto:{{ $comment->email }}">{{ $comment->email }}</a></i></p>
    <p>{{ trans('plugins/comment::comment.tables.content') }}:</p>
    <pre class="message-content">{{ $comment->content ?: '...' }}</pre>
@endif
