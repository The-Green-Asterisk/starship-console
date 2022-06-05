<div class="{{ $system->getHpPercentage() > 25 ? 'hp' : 'hp danger' }}">
    <label>{{ $system->name }}</label><br>
    <progress value="{{ $system->getHpPercentage() }}" max="100" min="0" id="{{ $system->systems == null ? $system->id : 'ship-' . $system->id }}"></progress>
    @if ($detail)
        <div class="detail-wrapper">
            <span><span id="{{ $system->id }}detail">{{ $system->current_hp ?? $system->getCurrentHp() }}</span>/{{ $system->max_hp ?? $system->getMaxHp() }}</span>
            <span id="{{ $system->id }}detail-percent">{{ number_format($system->getHpPercentage(), 0) }}%</span>
        </div>
        @if ($system->description)
            <span class="description">{{ $system->description ?? '' }}</span>
        @endif
    @endif
</div>
