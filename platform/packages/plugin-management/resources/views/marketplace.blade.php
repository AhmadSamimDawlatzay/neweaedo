@extends(BaseHelper::getAdminMasterLayoutTemplate())

@section('content')
    <div role="alert" class="alert alert-warning">

    </div>

    <plugin-list plugin-list-url="{{ route('plugins.marketplace.ajax.list') }}" plugin-remove-url="{{ route('plugins.remove', '__name__') }}"></plugins-list>
@endsection

@push('footer')
    <x-core::modal
        id="terms-and-policy-modal"
        :title="__('Install plugin from Marketplace')"
        :submit-button-label="__('Accept and install')"
        size="md"
    >
        <div class="text-start">
            <p>
            </p>
            <p></p>
            <p>

            </p>
            <p class="mb-0">

            </p>
        </div>

        <x-slot:footer>
            <div class="w-100">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn w-100" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-info w-100" data-bb-toggle="accept-term-and-policy">
                            {{ __('Accept and install') }}
                        </button>
                    </div>
                </div>
            </div>
        </x-slot:footer>
    </x-core::modal>

    <script>
        window.trans = {{ Js::from([
            'base' => trans('packages/plugin-management::marketplace'),
        ]) }};

        window.marketplace = {
            route: {
                list: "{{ route('plugins.marketplace.ajax.list') }}",
                detail: "{{ route('plugins.marketplace.ajax.detail', [':id']) }}",
                install: "{{ route('plugins.marketplace.ajax.install', [':id']) }}",
                active: "{{ route('plugins.change.status') }}",
            },
            installed: {{ Js::from(get_installed_plugins()) }},
            activated: {{ Js::from(get_active_plugins()) }},
            token: "{{ csrf_token() }}",
            coreVersion: "{{ get_cms_version() }}"
        };
    </script>
@endpush
