<li class="dropdown dropdown-extended dropdown-inbox">
    <a href="javascript:;" class="dropdown-toggle dropdown-header-name" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="icon-envelope-open"></i>
        <span class="badge badge-default"> {{ $comments->total() }} </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right">
        <li class="external">
            <h3>{!! BaseHelper::clean(trans('plugins/contact::contact.new_msg_notice', ['count' => $comments->total()])) !!}</h3>
            <a href="{{ route('contacts.index') }}">{{ trans('plugins/contact::contact.view_all') }}</a>
        </li>
        <li>
            <ul class="dropdown-menu-list scroller" style="height: {{ $comments->total() * 70 }}px;" data-handle-color="#637283">
                @foreach($comments as $comment)
                    <li>
                        <a href="{{ route('contacts.edit', $comment->id) }}">
                            <span class="photo">
                                <img src="{{ $comment->avatar_url }}" class="rounded-circle" alt="{{ $comment->name }}">
                            </span>
                            <span class="subject"><span class="from"> {{ $comment->name }} </span><span class="time">{{ $comment->created_at->toDateTimeString() }} </span></span>
                            <span class="message"> {{ $comment->phone }} - {{ $comment->email }} </span>
                        </a>
                    </li>
                @endforeach

                @if ($comments->total() > 10)
                    <li class="text-center"><a href="{{ route('contacts.index') }}">{{ trans('plugins/contact::contact.view_all') }}</a></li>
                @endif
            </ul>
        </li>
    </ul>
</li>
