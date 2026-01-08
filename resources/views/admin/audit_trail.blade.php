@extends('material/temp_admin')

@section('content')

<div id="content-pengguna" class="tab-content">
    <div class="bg-white shadow rounded-xl overflow-hidden">

        {{-- Header --}}
        <div class="px-6 py-4 border-b flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-700">
                Audit Trail
            </h2>
            <span class="text-sm text-gray-500">
                Riwayat aktivitas sistem
            </span>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">
                            Waktu
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">
                            Model
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">
                            ID
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($auditTrail as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-3 text-gray-600 whitespace-nowrap">
                                {{ $item['waktu']->format('d M Y • H:i') }}
                            </td>

                            <td class="px-6 py-3 text-gray-700 font-medium">
                                {{ $item['model'] }}
                            </td>

                            <td class="px-6 py-3 text-gray-500">
                                #{{ $item['id'] }}
                            </td>

                            <td class="px-6 py-3">
                                @if ($item['aksi'] === 'created')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        bg-green-100 text-green-700">
                                        <i class="bi bi-plus-circle mr-1"></i>
                                        CREATED
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        bg-yellow-100 text-yellow-700">
                                        <i class="bi bi-pencil-square mr-1"></i>
                                        UPDATED
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                Tidak ada data audit trail
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
