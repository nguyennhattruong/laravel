<div class="form-group">
    @if ($showLabel && $options['label'] !== false && $options['label_show'])
        <label>{{ $options['label'] }}</label><br>
    @endif
    <div class="input-group date" id="{{ $name }}">
        <input name="{{ $name }}" class="form-control" value="{{ @$options['value'] }}">
        <div class="input-group-append">
            <span class="input-group-text input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>
</div>
