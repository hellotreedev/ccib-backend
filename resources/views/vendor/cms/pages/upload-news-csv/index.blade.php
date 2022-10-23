@extends('cms::layouts/dashboard')

@section('breadcrumb')
    <ul class="breadcrumbs list-inline font-weight-bold text-uppercase m-0">
        <li>Upload News CSV</li>
    </ul>
@endsection

@section('dashboard-content')
    <div class="card py-4 mx-2 mx-lg-5">
        <div class="row no-gutters">
            <div class="col-md">
                <div class="server-showing-number-wrapper" style="padding-right: 30px">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p class="m-0" style="font-size: 16px">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <form method="post"
                        action="{{ url(config('hellotree.cms_route_prefix') . '/upload-news-csv' . '/upload-news') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label>CSV</label>
                            <input type="file" class="form-control" name="csv_file">
                        </div>
                        <div class="form-group mb-3">
                            <label>images</label>
                            <input type="file" class="form-control" name="images">
                        </div>
                        <div class="form-group mb-3">
                            <label>pdfs</label>
                            <input type="file" class="form-control" name="pdfs">
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
