<div class="text-center mt-3 ">
    <h3>Dati statistici sulle vendite</h3>
    <ul class="list-group list-group-horizontal my-2 justify-content-center">
        <li class="list-group-item">
            <input type="checkbox" value="1" wire:model="types"/>
            <span>Verdure</span>
        </li>
        <li class="list-group-item">
            <input type="checkbox" value="2" wire:model="types"/>
            <span>Frutta</span>
        </li>
        <li class="list-group-item">
            <input type="checkbox" value="3" wire:model="types"/>
            <span>Seminativo</span>
        </li>
        <li class="list-group-item">
            <input type="checkbox" value="4" wire:model="types"/>
            <span>Officinali</span>
        </li>
        <li class="list-group-item">
            <input type="checkbox" value="5" wire:model="types"/>
            <span>Avvicendamenti</span>
        </li>
        <li class="list-group-item">
            <input type="checkbox" value="6" wire:model="types"/>
            <span>Altro</span>
        </li>
    </ul>
    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
        <div class="shadow rounded p-4 border bg-white flex-1" style="height: 32rem;">
            <livewire:livewire-column-chart
                key="{{ $columnChartModel->reactiveKey() }}"
                :column-chart-model="$columnChartModel"
            />
        </div>
        
    </div>
   
</div>