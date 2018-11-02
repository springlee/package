@extends('layouts.app')
@section('title', '包裹新建导入')
@section('content')
<div class="ibox-content">
    <form class="form-horizontal"  method="post"  enctype="multipart/form-data" action="{{route('package.merchandiser.import.save')}}" >
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