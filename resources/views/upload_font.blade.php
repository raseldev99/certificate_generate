<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Upload font') }}
            </h2>
            <a href="{{url()->previous()}}" class="text-sm inline-block py-2 px-4 rounded font-medium text-white bg-gray-600">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <p class="text-sm font-medium text-center mx-auto text-gray-500 mb-5">{{ __('Font file must be .ttf format.') }}</p>
        <form class="w-[800px] mx-auto mb-5" action="{{route('upload_font')}}" method="POST" enctype="multipart/form-data">
            @csrf
           <div class="flex gap-x-2 items-center">
               <div class="flex-1">
                   <input type="text" name="font_name" value="{{old('font_name')}}" class="number" placeholder="Font name...">
                  <div class="h-5">
                      @error('font_name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                      @enderror
                  </div>
               </div>
               <div class="flex-1">
                  <div class="flex items-center gap-x-2">
                      <input type="file" name="font_file" accept=".ttf" class="file-input">
                      <button type="submit" class="text-white bg-gray-700 py-2 px-4 rounded text-sm">Upload</button>
                  </div>
                  <div class="h-5">
                      @error('font_file')
                         <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                      @enderror
                  </div>
               </div>
           </div>
        </form>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[800px] mx-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Font name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($fonts as $font)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{$font}}
                    </td>
                    <th  scope="row" class="px-6 py-4 whitespace-nowrap">
                        <div class="flex gap-x-2">
                            <a href="{{route('delete_font',$font)}}" class="py-2 px-4 rounded bg-red-600 text-white">Delete</a>
                        </div>
                    </th>
                </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            <p class="text-lg text-gray-800 py-2">Not Found</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>