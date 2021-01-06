<div class="form-group">
    @if ($showLabel && $options['label'] !== false && $options['label_show'])
        <label>{{ $options['label'] }}</label><br>
    @endif
    <div>
        @php
            $flag = false;
            $is_active = '';
            $is_checked = '';
            $class = '';
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
                    $class = '';
                @endphp
            @endif
            <label class="label-radio">
                <input class="{{ $class }}" type="radio" name="{{ $name }}" value="{{ $element['value'] }}" {{ $is_checked }}>
                <span></span>
                {{ @$element['label'] }}
            </label>
        @endforeach
    </div>
</div>
