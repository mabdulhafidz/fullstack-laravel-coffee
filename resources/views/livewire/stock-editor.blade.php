<div>
    <input type="number" wire:model="stock" wire:change="updateStock" x-data="{ editing: false }" x-on:dblclick="editing = true" x-on:blur="editing = false">
</div>