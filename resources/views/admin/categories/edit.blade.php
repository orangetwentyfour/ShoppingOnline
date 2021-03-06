@extends('layout_admin.master')
@section('content')
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">{{__('Categories')}}</a>
        </li>
        <li class="breadcrumb-item active">{{__('Edit')}}</li>
    </ol>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div><br />
    @endif
    @if($message = Session::get('error'))
        <div class="row pt-2 px-3">
            <div class="alert alert-danger col-12">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{$message}}
            </div>
        </div>
    @endif

    <div class="d-flex mb-3">
        <form action="{{route('categories.update', $category->id)}}" method="post" class="w-100">
            @csrf
            <input type="hidden" value="put" name="_method">
            <div class="form-group">
                <label for="">{{_('Tên danh mục')}}</label>
                <input required type="text" value="{{old('name') == null ? $category->name : old('name')}}" class="form-control" name="name">
            </div>
            @if($parentCategories->count() > 0 && $category->parent_id != null)
                <div class="form-group">
                    <label for="">{{__('Lựa chọn danh mục cha')}}</label>
                    <select required name="parent_id" class="form-control">
                        @foreach($parentCategories as $parent)
                            <option value="{{$parent->id}}"
                                @if($category->parent_id == $parent->id)
                                    selected
                                @endif
                            >{{$parent->name}}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="form-group">
                <label class="custom-checkbox">
                    <input type="checkbox" value="true" name="top"
                        @if($category->top)
                            checked
                        @endif
                    >
                    <div class="checkbox-box"></div>
                </label>
                <label class="ml-4">{{__('Hiển thị top')}}</label>
            </div>
            <div class="form-group">
                <a href="{{route('categories.index')}}" class="btn btn-default bg-light mr-2">
                    {{__('Trở lại')}}
                </a>
                <input value="{{__('Lưu')}}" type="submit" class="btn btn-primary">
            </div>
        </form>
    </div>

@endsection

@section('js')
@endsection
