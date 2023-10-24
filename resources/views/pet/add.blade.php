@extends("layouts.master") @section('title') ระบบสัตว์เลี้ยง @stop
@section('content')
<h1>เพิ่มข้อมูลสัตว์เลี้ยง</h1>
<ul class="breadcrumb">
    <li><a href="{{ URL::to('pet') }}">หน้าแรก</a></li>
    <li class="active">เพิ่มข้อมูลสัตว์เลี้ยง</li>
</ul>
{!! Form::open(array('action' => 'App\Http\Controllers\PetController@insert','method' => 'post', 'enctype' =>'multipart/form-data')) !!}
@if($errors->any())
    <div class="alert alert-danger">
@foreach ($errors->all() as $error)
    <div>{{ $error }}</div>
@endforeach
    </div>
@endif
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
            <strong>เพิ่มข้อมูลสัตว์เลี้ยง</strong>
        </div>
    </div>
<div class="panel-body">
    <table>
        <tr>
            <td>{{ Form::label('name', 'ชื่อสัตว์เลี้ยง ') }}</td>
            <td>{{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}</td>
        </tr>
            <td>{{ Form::label('type_id', 'ประเภทสัตว์เลี้ยง ') }}</td>
            <td>{{ Form::select('type_id', $types, Request::old('type_id'), ['class' => 'form-control']) }}
        </td>
        <tr>
            <td>{{ Form::label('image','เลือกรูปภาพสัตว์เลี้ยง') }}</td>
            <td>{{ Form::file('image') }}</td>
        </tr>
    </table>
</div>
<div class="panel-footer">

    <button onclick="location.href='{{ URL::to('pet') }}'" type="reset" class="btn btn-danger">ยกเลิก</button>
    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</button>
    </div>
</div>
{!! Form::close() !!}

@endsection