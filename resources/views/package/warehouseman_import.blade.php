@extends('layouts.app')
@section('title', '包裹新建导入')
@section('content')
<div class="ibox-content">
    <div class="alert alert-info">
        如包裹未创建会自动创建一条记录
    </div>
    <form class="form-horizontal"  method="post"  enctype="multipart/form-data" action="{{route('package.warehouseman.import.save')}}" >
        @csrf
        <div class="form-group">
            <label class="col-sm-3 control-label">选择Excel文件(.xlsx)：</label>
            <div class="col-sm-8">
                <input type="file" class="file-pretty" name="xlsx" id="file">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-8">
                <button class="btn btn-sm btn-primary" type="submit">上传</button>
                <button class="btn btn-sm" onclick="javascript:parent.layer.closeAll();">取消</button>
                <a class="btn btn-sm btn-info" href="{{url('/')}}/data/moban1.xlsx">下载模板</a>
            </div>
        </div>
    </form>
</div>
@endsection
@section('js')
    <script>
        $(function () {
            $('.file-pretty').prettyFile();
        })
    </script>
@endsection