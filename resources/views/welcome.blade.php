<x-app-layout>
    <x-slot name="header">
       <div class="flex justify-between items-center">
           <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ __('Generate certificate') }}
           </h2>
           <div class="flex gap-x-5">
               <a href="{{route('download')}}" class="inline-block font-medium text-sm text-white py-1.5 px-4 rounded bg-green-600">Download</a>
               <a href="{{route('select_or_upload')}}" class="inline-block font-medium text-sm text-white py-1.5 px-4 rounded bg-yellow-600">Select or upload template</a>
               <a href="{{route('upload_font')}}" class="inline-block font-medium text-sm text-white py-1.5 px-4 rounded bg-blue-500">Upload font</a>
               <a href="/jobs" class="inline-block font-medium text-sm text-white py-1.5 px-4 rounded bg-blue-500">Manage queue</a>
           </div>
       </div>
    </x-slot>

    <div class="py-12">
        <livewire:generate-from-file template_url="{{ isset($template_url) ? $template_url : ''  }}" />
    </div>
</x-app-layout>