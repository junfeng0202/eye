@if ($paginator->hasPages())
    <div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-1">
        @if ($paginator->onFirstPage())
            <a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="0">上一页</a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="layui-laypage-prev">上一页</a>
        @endif

        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>{{ $element }}</em></span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>{{ $page }}</em></span>
                    @else
                        <a href="{{ $url }}" data-page="{{ $page }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="layui-laypage-next">下一页</a>
        @else
            <a href="javascript:;" class="layui-laypage-next layui-disabled">下一页</a>
        @endif
    </div>
@endif
