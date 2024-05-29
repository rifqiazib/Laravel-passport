@extends('layouts.app')

@section('content')
<div class="flex-1 p-6 h-screen">
    <div class="flex space-x-4 items-center mb-4">
        <h1 class="text-2xl font-bold">VEHICLE DATA</h1>
        <a href="" class="bg-blue-300 rounded p-2 hover:bg-blue-500 ">Tambah Data</a>
    </div>
    <div class="overflow-x-auto w-full border rounded-[24px]">
        <table class="w-full overflow-hidden leading-normal text-center">
            <thead class="bg-neutral">
                <tr class="">
                    <th class="px-4 py-2 border">NO</th>
                    <th class="px-4 py-2 border">License Number</th>
                    <th class="px-4 py-2 border">Type</th>
                </tr>
            </thead>
            <tbody class="bg-slate-100">
            @foreach($vehicles as $index => $vehicle)
                <tr>
                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border">{{ $vehicle->license_number }}</td>
                    <td class="px-4 py-2 border">{{ $vehicle->type }}</td>
                    <td class="px-4 py-2 border space-x-4 flex justify-center w-full">
                        <a href="" class="bg-yellow-200 hover:bg-yellow-400 text-black px-4 py-2 rounded">EDIT</a>
                        <a href="" class="bg-red-400 hover:bg-red-600 px-4 py-2 text-black rounded">DELETE</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('extra-js')
<script>

</script>
@endsection