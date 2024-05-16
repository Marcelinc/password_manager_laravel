@props(['mode'])

<div class="modeSelector-container" title={{$mode . ' Mode'}}>
    <input type='checkbox' class='mode-input' <?= $mode === 'Edit' ? 'checked' : ''?> readOnly/>
    <span class='mode-text'><?= $mode === 'Edit' ? 'Manage Mode' : 'Read Mode'?></span>
</div>