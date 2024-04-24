<div class="flex justify-center gap-x-20">
    @php
        use \DantSu\PHPImageEditor\Image
    @endphp
    <form class="max-w-md" wire:submit="generate">
        <div class="mb-5">
            <label class="label" for="file_input">Upload file</label>
            <input class="file-input" wire:model="file" id="file_input" type="file">
            @error('file')
             <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
            @enderror
            @if(isset($form_errors['file']))
                <p class="text-sm text-red-600 font-medium">{{ $form_errors['file'] }}</p>
            @endif
        </div>
       <div class="flex gap-x-5 mb-5 w-full">
           <div class="flex-1">
               <label class="label" for="preview_name">Preview Name</label>
               <input class="number" wire:model="preview_name" id="image" type="text">
               @error('preview_name')
               <p class="text-sm text-red-600 font-medium">{{ $message }}</p>
               @enderror
           </div>
           <div class="flex-1">
               <label for="position_x" class="label !flex items-center gap-x-2">Font</label>
               <select id="position_x" class="select" wire:model="font">
                   <option value="font.ttf">Default</option>
                   @foreach($fonts as $ftp => $ft)
                       <option value="{{$ftp}}">{{$ft}}</option>
                   @endforeach
               </select>
           </div>
       </div>
        <div class="flex gap-x-5 mb-5 w-full">
            <div class="flex-1">
                <label for="font-size" class="label">Font Size</label>
                <input type="number" id="font-size" wire:model="font_size" min="0" value="0"  class="number" placeholder="00.00" required />
            </div>
            <div class="flex-1">
                <label for="font_color" class="label">Font color</label>
                <input type="color" id="font_color" wire:model="font_color" />
            </div>
           <div class="flex-1">
               <label for="type" class="label !flex items-center gap-x-2">File Type</label>
               <select id="type" class="select" wire:model="type">
                   <option value="png">PNG</option>
                   <option value="jpg">JPG</option>
               </select>
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
                    <select id="position_x" class="select" wire:model="position_x_s">
                        <option value="{{Image::ALIGN_LEFT}}">Left</option>
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
                    <input type="number" id="position_y" wire:model="position_y" class="number" placeholder="00.00" />
                @else
                    <select id="position_y" class="select" wire:model="position_y_s">
                        <option selected value="{{Image::ALIGN_TOP}}">Top</option>
                        <option value="{{Image::ALIGN_MIDDLE}}">Middle</option>
                        <option value="{{Image::ALIGN_BOTTOM}}">Bottom</option>
                    </select>
                @endif
            </div>
        </div>
        <div class="flex gap-x-5 mb-5 w-full">
            <div class="flex-1">
                <label for="anchor_x" class="label !flex items-center gap-x-2">
                    Anchor X
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" wire:model.live="is_customs.anchor_x" class="sr-only peer">
                        <div class="relative w-7 h-4 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all  peer-checked:bg-blue-600"></div>
                    </label>
                </label>
                @if($is_customs['anchor_x'])
                    <input type="number" id="anchor_x" wire:model="anchor_x" class="number" placeholder="00.00" />
                @else
                    <select id="anchor_x" class="select" wire:model="anchor_x_s">
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
                    <select id="anchor_y" class="select" wire:model="anchor_y_s">
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
                <input type="number" id="letterSpacing" wire:model="letterSpacing" step="0.01" class="number" placeholder="00.00" />
            </div>
        </div>
       <div class="flex gap-x-4">
           <button wire:loading.attr="disabled" type="submit" class="bg-green-600 text-white py-2 px-5 rounded">
               Generate
               <svg wire:loading wire:target="generate" aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                   <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
               </svg>
           </button>
           <button wire:loading.attr="disabled" type="button" class="bg-blue-600 text-white py-2 px-5 rounded" wire:click="preview">
               Preview
               <svg wire:loading wire:target="preview" aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                   <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
               </svg>
           </button>
           <button wire:loading.attr="disabled" type="button" class="bg-zinc-600 text-white py-2 px-5 rounded" wire:click="download">
               Download
               <svg wire:loading wire:target="download" aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                   <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                   <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
               </svg>
           </button>
       </div>
    </form>
   @if(!empty($preview_img))
        <img width="700" src="{{$preview_img}}" alt="">
   @endif

</div>
