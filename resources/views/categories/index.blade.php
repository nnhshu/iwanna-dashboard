@extends('layouts.app')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/custom_dt_custom.css') }}">
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{ __('Thêm mới danh mục bài viết') }}</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="title">{{ __('Tên danh mục') }}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" id="title" name="title">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="description">{{ __('Mô tả') }}</label>
                        <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">{{ __('Xác nhận') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                @if( session('msg') )
                    <div class="alert alert-success alert_message mb-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                        <strong>{{session('msg') }} </strong></button>
                    </div>
                @endif
                    @if( session('msg_error') )
                        <div class="alert alert-danger alert_message mb-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                            <strong>{{session('msg_error') }} </strong></button>
                        </div>
                    @endif
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>{{ __('Danh mục bài viết') }}</h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <div class="table-responsive mb-4">
                    <table id="style-3" class="table style-3  table-hover">
                        <thead>
                            <tr>
                                <th class="checkbox-column text-center">Id</th>
                                <th class="text-center">Tên</th>
                                <th>Mô tả</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if( $categories )
                        @foreach ( $categories as $categorie )
                            <tr>
                                <td class="checkbox-column text-center">{{ $categorie->id }}</td>
                                <td>{{ $categorie->title }}</td>
                                <td>{{ $categorie->description }}</td>
                                <td class="text-center">
                                    <ul class="table-controls">
                                        <li><a href="{{ route('categories.edit', ['category' => $categorie->id]) }}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                        <li><a href="javascript:void(0);" data-id="{{ $categorie->id }}" class="bs-tooltip btn-removeCate" data-toggle="modal" data-target="#removeCategory" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mess-data"
    data-url-delete="{{ route('categories.destroy', 'ID_REPLY_IN_URL') }}"
>
</div>

<div class="modal fade" id="removeCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" >Bạn có muốn xoá danh mục này không?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <form id="removeCategoryForm" method="POST" onsubmit="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('assets/plugins/table/datatable/datatables.js') }}"></script>
    <script>

        c3 = $('#style-3').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "columnDefs": [{
                    'targets': 0,
                    'class': "text-center align-middle"
                },
                {
                    'targets': 1,
                    'class': "text-center align-middle"
                },
                {
                    'targets': 2,
                    'class': "text-center align-middle"
                },
                {
                    'targets': 3,
                    'class': "text-center align-middle"
                }
            ],
            "stripeClasses": [],
            "lengthMenu": [5, 10, 20, 50],
            "pageLength": 5
        });

        if( $('.alert_message') ){
            setTimeout(function(){
                $('.alert_message').remove();
            }, 3000);
        };

        $('.btn-removeCate').on('click', function(event){
            event.preventDefault();
            let urlDelete = $('.mess-data').data('url-delete');
            let action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
            $('#removeCategoryForm').attr('action', action);
        });


    </script>
@endsection
