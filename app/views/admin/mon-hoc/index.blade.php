@extends('layouts.main')
@section('title', 'Danh sách môn học')
@section('content')
<table class="table table-hover">
    <thead>
        <th>Mã môn</th>
        <th>Tên môn</th>
        <th>
            <a href="<?= BASE_URL . 'mon-hoc/tao-moi'?>">Tạo mới</a>
        </th>
    </thead>
    <tbody>
        @foreach ($subjects as $sub)
            <tr>
                <td>{{$sub->id}}</td>
                <td>
                    <a href="{{ BASE_URL . 'quiz?subjectId=' . $sub->id }}"><?= $sub->name ?></a>
                </td>
                <td>
                    <a class="btn btn-sm btn-primary" href="{{ BASE_URL . 'mon-hoc/cap-nhat?id=' . $sub->id }}">Sửa</a>
                    <a class="btn btn-sm btn-danger btn-remove" href="{{ BASE_URL . 'mon-hoc/xoa?id=' . $sub->id }}">Xóa</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
@section('page-script')
<script>
    $('.btn-remove').click(function(){
        console.log(1);
    });
</script>
@endsection