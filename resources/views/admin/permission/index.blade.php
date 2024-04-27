{{-- permission.blade.php --}}
<x-admin-layout>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="searchbar mt-4 mb-5">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Permission</h4>
                        {{-- @can('create', App\Models\Permission::class) --}}
                            {{-- <a href="{{ route('permission.create') }}" class="btn btn-primary w-24"> --}}
                                {{-- <i class="icon ion-md-add"></i> @lang('crud.common.create') --}}
                            {{-- </a> --}}
                        {{-- @endcan --}}
                    </div>
                </div>
    
                <div class="table-responsive">
                    <table class="table-auto w-full border-collapse border border-gray-300" id="myTable">
                        <thead>
                            <tr>
                                {{-- <th class="text-left px-4 py-2">@lang('crud.permission.inputs.name')</th>
                                <th class="text-center px-4 py-2">@lang('crud.common.actions')</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permission as $p)
                                <tr>
                                    <td class="border px-4 py-2">{{ $p->name ?? '-' }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            {{-- @can('update', $p) --}}
                                                {{-- <a href="{{ route('permission.edit', $p) }}"> --}}
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                {{-- </a> --}}
                                            {{-- @endcan --}}
                                            {{-- @can('delete', $p) --}}
                                                {{-- <form action="{{ route('permission.destroy', $p) }}" method="POST"> --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-light text-danger btn-delete">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                {{-- </form> --}}
                                            {{-- @endcan --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="border px-4 py-2 text-center">No permissions found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</x-admin-layout>
