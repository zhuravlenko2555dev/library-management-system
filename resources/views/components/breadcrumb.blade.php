<div class="col-sm-6">
    <h1 class="m-0 text-dark">@if (isset($title)){{$title}}@endif</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">{{$parent}}</a></li>
        <li class="breadcrumb-item active"><i class="active"></i>{{$active}}</li>
    </ol>
</div>
