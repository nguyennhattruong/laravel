<div>
    @if ($showLabel && $options['label'] !== false && $options['label_show'])
        <label>{{ $options['label'] }}</label><br>
    @endif
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        @php
            $flag = false;
            $is_active = '';
            $is_checked = '';
            $class = $options['attr']['class'];
        @endphp
        @foreach ($options['elements'] as $element)
            @if($flag == false)
                @if ($element['value'] == $options['value'])
                    @php
                        $is_active = 'active';
                        $is_checked = 'checked';

                        if (isset($element['attr']['class'])) {
                            $class = $element['attr']['class'];
                        }

                        $flag = true;
                    @endphp
                @endif
            @else
                @php
                    $is_active = '';
                    $is_checked = '';
                    $class = $options['attr']['class'];
                @endphp
            @endif
            <label class="{{ $class }} {{ $is_active }}">
                <input type="radio" autocomplete="off" name="{{ $name }}"
                       value="{{ $element['value'] }}" {{ $is_checked }}>
                <i class="{{ @$element['icon'] }}"></i> {{ @$element['label'] }}
            </label>
        @endforeach
    </div>
</div>
