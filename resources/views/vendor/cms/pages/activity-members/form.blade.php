
@extends('cms::layouts/dashboard')


@section('breadcrumb')
    <ul class="breadcrumbs list-inline font-weight-bold text-uppercase m-0">
        <li><a
                href="{{ url(config('hellotree.cms_route_prefix') . '/' . $page['route'] . '') }}">{{ $page['display_name_plural'] }}</a>
        </li>
        @if (isset($row))
            <li>{{ $row['id'] }}</li>
            <li>Edit</li>
        @else
            <li>Create</li>
        @endif
    </ul>
@endsection

@section('dashboard-content')

    <form method="post" enctype="multipart/form-data"
        action="{{ isset($row) ? url(config('hellotree.cms_route_prefix') . '/' . $page['route'] . '/' . $row['id'] . $appends_to_query) : url(config('hellotree.cms_route_prefix') . '/' . $page['route'] . '') }}"
        ajax>

        <?php
        $socials[0] = [
            'icon' => '',
            'url' => '',
        ];
        ?>
        <div class="card p-4 mx-2 mx-sm-5">
            <p class="font-weight-bold text-uppercase mb-4">
                {{ isset($row) ? 'Edit ' . $page['display_name'] . ' #' . $row['id'] : 'Add ' . $page['display_name'] }}</p>

            @if (isset($row))
                @method('put')
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p class="m-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @foreach ($page_fields as $field)
                @if ($field['form_field'] &&
                    ((!isset($row) && (!isset($field['hide_create']) || !$field['hide_create'])) ||
                        (isset($row) && (!isset($field['hide_edit']) || !$field['hide_edit']))))
                    @include('cms::pages/cms-page/form-fields', ['locale' => null])
                @endif
            @endforeach

            @if (isset($row))
                @if ($row->socials->count() > 0)
                    @foreach ($row->socials as $i => $single)
                        <?php
                        $socials[$i] = [
                            'icon' => $single->icon,
                            'url' => $single->url,
                            'prev_id' => $single->id,
                        ];
                        ?>
                    @endforeach
                @endif
            @endif

            <div class="container-fluid">
                <div class="row justify-content-end">
                    <div class="social-container w-100">
                        <label>Social Media</label>
                        <div class="col-12">
                            <div class="row">
                                <a style="width:150px" class="btn btn-sm btn-secondary mb-3 cursor-pointer add-social">Add
                                    Social Link</a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <ul class="sortable list-inline m-0 ui-sortable">
                                    @if (isset($row))
                                        @if ($row->socials->count() > 0)
                                            @foreach ($socials as $i => $single)
                                                <li
                                                    class="sortable-row d-block bg-white border px-3 py-2 mb-2 ui-sortable-handle">
                                                    <input type="hidden" value="{{ $single['prev_id'] }}"
                                                        name="socials[{{ $i }}][prev_id]" />
                                                    <div class="col-12 pb-4">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                @include('cms::/components/form-fields/image',
                                                                    [
                                                                        'label' => 'Icon',
                                                                        'name' => 'socials[' . $i . '][icon]',
                                                                        'value' => $single['icon'],
                                                                        'required' => false,
                                                                        'description' => null,
                                                                        'locale' => null,
                                                                    ])
                                                            </div>
                                                            <div class="col-12">
                                                                @include('cms::/components/form-fields/input',
                                                                    [
                                                                        'label' => 'url',
                                                                        'name' => 'socials[' . $i . '][url]',
                                                                        'type' => 'text',
                                                                        'value' => $single['url'],
                                                                        'required' => false,
                                                                        'description' => null,
                                                                        'locale' => null,
                                                                    ])
                                                            </div>
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger ml-3 delete-social align-items-center">Delete</button>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (count($page_translatable_fields))
                @foreach (\Hellotreedigital\Cms\Models\Language::get() as $language)
                    <div class="form-group">
                        <label>{{ $language->title }}</label>
                        <div class="pl-3">
                            @foreach ($page_translatable_fields as $field)
                                @include('cms::pages/cms-page/form-fields', ['locale' => $language->slug])
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif

            @csrf

            <div class="form-buttons-wrapper text-right">
                <input type="hidden" name="ht_preview_mode" value="0">
                @if ($page['preview_path'])
                    <button type="button" class="btn btn-sm btn-secondary ht-preview-mode">Preview</button>
                @endif
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </div>
        </div>

    </form>

@endsection

@section('scripts')
    <script>
        $(window).on("load", function() {
            const date = new Date();
            datetext = date.toTimeString();
            var today = date.getFullYear() + '-' + (Number(date.getMonth() + 1) < 10 ? '0' + Number(date
                .getMonth() + 1) : Number(date.getMonth() + 1)) + '-' +
                (date.getDate() < 10 ? '0' + date.getDate() : date.getDate());
            var x = "<?php echo request()->get('admin')['name']; ?>";
            if (window.location.href.includes('create')) {
                $('[name="created_on"]').parent().css('display', 'none');
                $('[name="created_by"]').parent().parent().css('display', 'none');
                $('[name="created_on"]').prop('value', today);
                $('[name="created_by"]').prop('value', x);
            }
            if (window.location.href.includes('edit')) {
                $('[name="created_on"]').parent().css('display', 'none');
                $('[name="created_by"]').parent().parent().css('display', 'none');
            }
        });

        $(document).on('click', '.add-social', function() {
            var x = parseInt(event.timeStamp);
            // var data_unique = $(this).closest('.social-container').attr('data-unique');
            // // var label='Answer '+counter;
            $(".social-container .sortable").append(
                `<li class="sortable-row d-block bg-white border px-3 py-2 mb-2 ui-sortable-handle">
                    <div class="col-12 pb-4">
                        <div class="row">
                            <div class="col-12">
                                @include('cms::/components/form-fields/image', [
                                    'label' => 'Icon',
                                    'name' => 'socials[${x}][icon]',
                                    'value' => null,
                                    'required' => false,
                                    'description' => null,
                                    'locale' => null,
                                ])
                            </div>
                            <div class="col-12">
                                @include('cms::/components/form-fields/input', [
                                    'label' => 'url',
                                    'name' => 'socials[${x}][url]',
                                    'type' => 'text',
                                    'value' => null,
                                    'required' => false,
                                    'description' => null,
                                    'locale' => null,
                                ])
                            </div>
                            <button type="button" class="btn btn-sm btn-danger ml-3 delete-social align-items-center">Delete</button>
                        </div>
                    </div>
                </li>`
            );
        });

        $(document).on('click', '.delete-social', function() {
            $(this).parent().parent().parent().remove();
        });
    </script>
@endsection
