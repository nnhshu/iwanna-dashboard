@extends('layouts.app')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/table/datatable/custom_dt_custom.css') }}">
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h4>{{ __('Danh sách bài viết') }}</h4>
                            <a href="{{ route('article.create') }}" class="btn btn-success btn-sm d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> 
                                Thêm mới bài viết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                    @if( !empty($msg) )
                        <div class="alert alert-success mb-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                            <strong>{{ $msg }}</button>
                        </div>
                    @endif
                <div class="table-responsive mb-4">
                    <table id="style-3" class="table style-3  table-hover">
                        <thead>
                            <tr>
                                <th class="checkbox-column text-center"> Id</th>
                                <th class="text-center">Ảnh</th>
                                <th>Tên</th>
                                <th>Danh mục</th>
                                <th>Ngày update</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $articles  as $article )
                                <tr>
                                    <td class="checkbox-column text-center"> {{ $article->id }} </td>
                                    <td class="text-center">
                                        <span><img src="{{ $article->avatar }}" class="profile-img" alt="avatar"></span>
                                    </td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->category['title'] }}</td>
                                    <td>{{ date("d-m-Y", strtotime($article->updated_at)) }}</td>
                                    <td class="text-center">
                                        @if( $article->status == 1 )
                                            <span class="shadow-none badge badge-primary">Công khai</span>
                                        @else
                                            <span class="shadow-none badge badge-danger">Bản nháp</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li>
                                                <a href="{{ route( 'article.edit', ['article' => $article->id] ) }}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                </a>
                                            </li>
                                            <li><a href="javascript:void(0);" data-id="{{ $article->id }}" class="bs-tooltip btn-removePosts" data-toggle="modal" data-target="#removePost" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="mess-data"
    data-url-delete="{{ route('article.destroy', 'ID_REPLY_IN_URL') }}"
>
</div>

<div class="modal fade" id="removePost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" >Bạn có muốn xoá bài viết này không?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
           
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                <form id="removePostForm" method="POST" onsubmit="">
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
            "stripeClasses": [],
            "lengthMenu": [20, 50],
            "pageLength": 20
        });

        if( $('.alert-success') ){
            setTimeout(function(){ 
                $('.alert-success').remove(); 
            }, 3000);
        };


        $('.btn-removePosts').on('click', function(event){
            event.preventDefault();
            console.log($(this).data('id'));
            let urlDelete = $('.mess-data').data('url-delete');
            let action = urlDelete.replace('ID_REPLY_IN_URL', $(this).data('id'));
            $('#removePostForm').attr('action', action);
        });

    </script>
@endsection
