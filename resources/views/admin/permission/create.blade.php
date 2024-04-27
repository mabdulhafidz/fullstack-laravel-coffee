{{-- <x-admin-layout>
    <div class="container">
        <div class="card p-4">
            <h4 class="card-title">
                <a href="{{ route('permission.index') }}" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                @lang('crud.permission.create_title')
            </h4>
            <div class="card-body">

                <form method="POST" action="{{ route('permission.store') }}" class="mt-2">
                    @csrf

                    @include('app.permission.form-inputs')

                    <div class="mt-4">
                        <a href="{{ route('permission.index') }}" class="btn btn-light">
                            <i class="icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>

                        <button type="submit" class="btn btn-primary float-right">
                            <i class="icon ion-md-save"></i>
                            @lang('crud.common.create')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout> --}}