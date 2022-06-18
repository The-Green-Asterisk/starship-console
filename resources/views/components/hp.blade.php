<div class="{{ $system ? ($system->getHpPercentage() > 25 ? 'hp' : 'hp danger') : 'hp' }}">
    <label>{{ $system ? $system->name : null }}</label><br>
    <progress value="{{ $system ? $system->getHpPercentage() : '100' }}" max="100" min="0" id="{{ $system ? ($system->systems == null ? $system->id : 'ship-' . $system->id) : null }}"></progress>
    @if ($detail)
        <div class="detail-wrapper">
            <span><span id="{{ $system ? ($system->systems == null ? $system->id : 'ship-' . $system->id) : null }}detail">{{ $system ? ($system->current_hp ?? $system->getCurrentHp()) : null }}</span>/{{ $system ? ($system->max_hp ?? $system->getMaxHp()) : null }}</span>
            <span id="{{ $system ? ($system->systems == null ? $system->id : 'ship-' . $system->id) : null }}detail-percent">{{ $system ? (number_format($system->getHpPercentage(), 0)) : null }}%</span>
        </div>
        @if ($system ? $system->description : null)
            <span class="description">{{ $system->description ?? '' }}</span>
        @endif
    @endif
</div>
