@extends('layouts.main')
@section('content')
<div class="row">
    @if ($subject != null)
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{$subject->name}}</h4>
                </div>
                <div class="card-body">
                    Thông tin môn học
                </div>
            </div>
        </div>    
    @endif
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h4>Danh sách quiz</h4>
            </div>
            <div class="card-body">
                <table class="table table-stripped">
                    <thead>
                        <th>#</th>
                        <th>Môn học</th>
                        <th>Tên Quizs</th>
                        <th>Số câu hỏi</th>
                        <th>Điểm trung bình</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($quizs as $q)
                            <tr>
                                <td>{{$loop->iteration+1}}</td>
                                <td>{{$q->subject_id}}</td>
                                <td>{{$q->name}}</td>
                                <td>0</td>
                                <td>điểm trung bình</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-primary">Sửa</a>
                                    <a href="" class="btn btn-sm btn-danger">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>
    
@endsection