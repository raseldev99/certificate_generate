<div>
    @php
        use \DantSu\PHPImageEditor\Image;
    @endphp;
    <form class="max-w-md mx-auto" wire:submit="generate">
        <div class="mb-5">
            <label class="label" for="file_input">Upload file</label>
            <input class="file-input" wire:model="file" id="file_input" type="file">
        </div>
        <div class="flex gap-x-5 mb-5 w-full">
            <div class="flex-1">
                <label for="font-size" class="label">Font Size</label>
                <input type="number" id="font-size" wire:model="font_size"  class="number" placeholder="00.00" required />
            </div>
            <div class="flex-1">
                <label for="font_color" class="label">Font color</label>
                <input type="color" id="font_color" wire:model="font_color" />
            </div>
        </div>
        <div class="flex gap-x-5 mb-5 w-full">
            <div class="flex-1">
                <label for="position_x" class="label !flex items-center gap-x-2">
                    Position X
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model.live="is_customs.position_x" class="sr-only peer">
                        <div class="relative w-7 h-4 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all  peer-checked:bg-blue-600"></div>
                    </label>
                </label>
                @if($is_customs['position_x'])
                    <input type="number" id="position_x" wire:model="position_x" class="number"  placeholder="00.00" />
                @else
                    <select id="position_x" class="select" wire:model="position_x">
                        <option selected value="{{Image::ALIGN_LEFT}}">Left</option>
                        <option value="{{Image::ALIGN_CENTER}}">Center</option>
                        <option value="{{Image::ALIGN_RIGHT}}">Right</option>
                    </select>
                @endif
            </div>
            <div class="flex-1">
                <label for="position_y" class="label !flex items-center gap-x-2">
                    Position Y
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model.live="is_customs.position_y" class="sr-only peer">
                        <div class="relative w-7 h-4 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all  peer-checked:bg-blue-600"></div>
                    </label>
                </label>
                @if($is_customs['position_y'])
                    <input type="number" id="position_y" wire:model="position_x" class="number" placeholder="00.00" />
                @else
                    <select id="position_y" class="select" wire:model="position_x">
                        <option selected value="{{Image::ALIGN_TOP}}">Top</option>
                        <option value="{{Image::ALIGN_MIDDLE}}">Middle</option>
                        <option value="{{Image::ALIGN_BOTTOM}}">Bottom</option>
                    </select>
                @endif
            </div>
        </div>
        <div class="flex gap-x-5 mb-5 w-full">
            <div class="flex-1">
                <label for="anchor_X" class="label !flex items-center gap-x-2">
                    Anchor X
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model.live="is_customs.anchor_X" class="sr-only peer">
                        <div class="relative w-7 h-4 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all  peer-checked:bg-blue-600"></div>
                    </label>
                </label>
                @if($is_customs['anchor_X'])
                    <input type="number" id="anchor_X" wire:model="anchor_X" class="number" placeholder="00.00" />
                @else
                    <select id="anchor_X" class="select" wire:model="anchor_X">
                        <option selected value="{{Image::ALIGN_LEFT}}">Left</option>
                        <option value="{{Image::ALIGN_CENTER}}">Center</option>
                        <option value="{{Image::ALIGN_RIGHT}}">Right</option>
                    </select>
                @endif
            </div>
            <div class="flex-1">
                <label for="anchor_y" class="label !flex items-center gap-x-2">
                    Anchor Y
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model.live="is_customs.anchor_y" class="sr-only peer">
                        <div class="relative w-7 h-4 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all  peer-checked:bg-blue-600"></div>
                    </label>
                </label>
                @if($is_customs['anchor_y'])
                    <input type="number" id="anchor_y" wire:model="anchor_y" class="number" placeholder="00.00" />
                @else
                    <select id="anchor_y" class="select" wire:model="anchor_y">
                        <option selected value="{{Image::ALIGN_TOP}}">Top</option>
                        <option value="{{Image::ALIGN_MIDDLE}}">Middle</option>
                        <option value="{{Image::ALIGN_BOTTOM}}">Bottom</option>
                    </select>
                @endif
            </div>
        </div>
        <div class="flex gap-x-5 mb-5 w-full">
            <div class="flex-1">
                <label for="rotation" class="label">
                    Rotation
                </label>
                <input type="number" id="rotation" wire:model="rotation" class="number" placeholder="00.00" />
            </div>
            <div class="flex-1">
                <label for="letterSpacing" class="label">
                    Letter Spacing
                </label>
                <input type="number" id="letterSpacing" wire:model="letterSpacing" class="number" placeholder="00.00" />
            </div>
        </div>
        <button type="submit" class="bg-green-600 text-white py-2 px-5 rounded">Generate</button>
    </form>
</div>
