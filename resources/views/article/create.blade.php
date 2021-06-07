@extends('layouts.app')

@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/file-upload/file-upload-with-preview.min.css') }}">
    <style>
        .custom-file-container__image-preview {
            margin-bottom: 0px;
            margin-top: 0px;
            height: 150px;
        }
    </style>
@endsection

@section('content')
<form action="{{ route('article.store') }}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="row layout-top-spacing">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>{{ __('Thêm mới bài viết') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="form-group mb-4">
                        <label for="title">Tiêu đề bài viết</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" id="title" name="title" placeholder="Tiêu đề bài viết">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="title">Mô tả ngắn bài viết</label>
                        <textarea class="form-control" value="{{old('short_desc')}}" row="6"
                                  name="short_desc" aria-label="With textarea"></textarea>
                        @error('short_desc')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="form-group mb-4">
                        <label for="Content">Nội dung</label>
                        <textarea id="editor"
                                  class="form-control @error('content') is-invalid @enderror"
                                  value="{{old('content')}}" row="6"
                                  name="content" aria-label="With textarea"></textarea>
                        @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">
            <div class="statbox widget box box-shadow mb-3">
                <div class="text-right">
                    <button type="submit" class="btn btn-success">Lưu</button>
                </div>
                <div class="form-group">
                    <label for="title">Trạng thái</label>
                    <select class="form-control categories" name="status">
                        <option value="1">Công khai</option>
                        <option value="0">Bản nháp</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Danh mục</label>
                    <select class="form-control categories" name="categories_id">
                    @foreach( $categories as $category )
                        <option value="{{ $category->id }}">{{$category->title}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="statbox widget box box-shadow mb-3">
                <div class="custom-file-container" data-upload-id="avatarArticle">
                    <label>
                        Ảnh đại diện
                        <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                        </a>
                    </label>
                    <label class="custom-file-container__custom-file" >
                        <input type="file" class="custom-file-container__custom-file__custom-file-input" name="avatar" accept="image/*">
                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                    </label>
                    <div class="custom-file-container__image-preview"></div>
                </div>
            </div>
        </div>

    </div>
</form>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
@section('script_head')
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

@endsection
@section('script')
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>--}}
    <script src="{{ asset('assets/plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
{{--    <script src="https://cdn.tiny.cloud/1/pf1tmwfbpu3loc4f6e8o50ythleb9dqawk5i72d3q8igzkj6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>--}}

{{--    <script>--}}
{{--        tinymce.init({--}}
{{--            selector: 'textarea#editor',--}}
{{--            plugins: 'image a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',--}}
{{--            toolbar: 'image a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',--}}
{{--            toolbar_mode: 'floating',--}}
{{--            tinycomments_mode: 'embedded',--}}
{{--            relative_urls: false,--}}
{{--            remove_script_host: false,--}}
{{--            height : 500,--}}
{{--            file_picker_callback: function (callback, value, meta) {--}}
{{--                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;--}}
{{--                let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;--}}

{{--                let type = 'image' === meta.filetype ? 'Images' : 'Files',--}}
{{--                    url  = '/laravel-filemanager?editor=tinymce5&type=' + type;--}}

{{--                tinymce.activeEditor.windowManager.openUrl({--}}
{{--                    url : url,--}}
{{--                    title : 'Filemanager',--}}
{{--                    width : x * 0.8,--}}

{{--                    onMessage: (api, message) => {--}}
{{--                        callback(message.content);--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
    <!-- <script>
        ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
    </script> -->
    <script>
        //First upload
        var firstUpload = new FileUploadWithPreview('avatarArticle');
        //Second upload
        var secondUpload = new FileUploadWithPreview('coverArticle');
    </script>
@endsection
