<section id="wid-{{ $layout['wid']['id'] }}"
         class="rounded mb-4 {{ @$layout['wid']['options']->session->class }}" {!! @$layout['wid']['options']->session->attr !!}>
    <div class="card border-0">
        @if(isset($layout['wid']['show_title']) && $layout['wid']['show_title'] == 1)
            <header class="card-header bg-white" style="border-bottom: 1px solid rgba(0,0,0,.05)">
                <h2 class="mb-0 {{ @$layout['wid']['options']->header->class }}" {!! @$layout['wid']['options']->header->attr !!}>
                    @if (trim($layout['wid']['link']) != '')
                        <a href="{{ $layout['link'] }}">{{ $layout['wid']['title'] }}</a>
                    @else
                        {{ $layout['wid']['title'] }}
                    @endif
                </h2>
            </header>
        @endif
        <div class="card-body {{ @$layout['wid']['options']->body->class }}" {!! @$layout['wid']['options']->body->attr !!}>
            @yield('wid_content')
        </div>
    </div>
</section>
