<div>
    @role('admin')
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @livewire('product-count')
        
        <div class="relative h-full flex-1 rounded-xl border border-neutral-200 dark:border-neutral-700">
           @livewire('add-product')   

           
        </div>
    </div>
  @endrole
</div>