{{-- <x-admin-layout>
    <div class="container">
        <div class="card p-4">
            <h4 class="card-title">
                <a href="{{ route('permission.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                @lang('crud.permission.edit_title')
            </h4>
            <div class="card-body">
    
                <x-form method="PUT" action="{{ route('permission.update', $permission) }}" class="mt-2">
                    @include('app.permission.form-inputs')
    
                    <div class="mt-4">
                        <a href="{{ route('permission.index') }}" class="btn btn-light">
                            <i class="icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>
    
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="icon ion-md-save"></i>
                            @lang('crud.common.update')
                        </button>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
</x-admin-layout> --}}