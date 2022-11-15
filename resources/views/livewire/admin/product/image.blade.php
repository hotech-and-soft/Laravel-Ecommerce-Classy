<div>
    <x-modal wire:model="imageModal">
        <x-slot name="title">
            {{ __('Image Management') }}
        </x-slot>
        <x-slot name="content">
            {{-- show image and gallery --}}
            <div class="w-full mb-4 px-2">
                @if($product->image)
                <img src="{{ asset('images/products/' . $product->image) }}" class="rounded-md object-cover w-full">
                @endif
            </div>
            <div class="w-full mb-4 px-2">
                <div class="flex flex-wrap">
                    @if($product->gallery)
                    @foreach (json_decode($product->gallery) as $image)
                        <div class="w-1/4 mb-4 px-2">
                            <img src="{{ asset('images/products/' .  $image) }}" alt="" class="w-full">
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <form wire:submit.prevent="saveImage">
                <div class="flex flex-wrap">

                    <div class="w-full px-4 my-4">
                        {{-- import with url --}}
                        <x-label for="image" :value="__('Upload with url')" />
                        <x-input id="image_url" class="block mt-1 w-full" type="text" name="image_url"
                            wire:model="image_url" />

                        <x-label for="image" :value="__('Upload with file')" />
                        <x-fileupload wire:model="image" :file="$image" accept="image/jpg,image/jpeg,image/png" />
                        <x-input-error :messages="$errors->get('image')" for="image" class="mt-2" />
                    </div>

                    <div class="w-full px-4 my-4">
                        <x-label for="gallery" :value="__('Product Gallery')" />
                        <x-fileupload wire:model="gallery" :file="$gallery" accept="image/jpg,image/jpeg,image/png"
                            multiple />
                        <x-input-error :messages="$errors->get('gallery')" for="gallery" class="mt-2" />
                    </div>
                </div>
                <div class="w-full px-4">
                    <x-button primary wire:click="saveImage" wire:loading.attr="disabled">
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>

        </x-slot>
    </x-modal>

</div>
