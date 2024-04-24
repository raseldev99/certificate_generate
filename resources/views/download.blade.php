<x-app-layout>
    <x-slot name="header">
       <div class="flex justify-between items-center">
           <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               {{ __('Download certificate') }}
           </h2>
           <div class="flex gap-x-5">
               <a href="{{url()->previous()}}" class="text-sm inline-block py-2 px-4 rounded font-medium text-white bg-gray-600">Back</a>
               <a href="/jobs" class="inline-block font-medium text-sm text-white py-1.5 px-4 rounded bg-blue-500">Manage queue</a>
           </div>
       </div>
    </x-slot>

    <div class="py-12">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-[900px] mx-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        File name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($file_names as $file_name)
                <tr class="odd:bg-white even:bg-gray-50 border-b">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{$file_name}}
                    </td>
                    <th  scope="row" class="px-6 py-4 whitespace-nowrap">
                        <div class="flex gap-x-2">
                            <a href="{{route('download_file',$file_name)}}" class="py-2 px-4 rounded bg-green-600 text-white">Download</a>
                            <a href="{{route('delete_file',$file_name)}}" class="py-2 px-4 rounded bg-red-600 text-white">Delete</a>
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