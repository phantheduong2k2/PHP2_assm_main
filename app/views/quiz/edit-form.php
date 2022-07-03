<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-10 offset-1 mt-3">
                <form action="<?= BASE_URL . 'quiz/save-add?subjectId=' . $subjectId ?>" method="post">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mt-3">
                                <label for="">Tên quiz</label>
                                <input type="text" name="name" value="<?= $quiz->name ?>" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Thời gian bắt đầu</label>
                                <input type="datetime-local" name="start_time" value="<?= date('Y-m-d\TH:i', strtotime($quiz->start_time)) ?>" class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Thời gian kết thúc </label>
                                <input type="datetime-local" name="end_time" value="<?= date('Y-m-d\TH:i', strtotime($quiz->end_time)) ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-3">
                                <label for="">Thời gian làm bài</label>
                                <input type="number" step="0" name="duration_minutes" value="<?= $quiz->duration_minutes ?>" class="form-control">
                            </div>
                            <div class="form-check mt-5">
                                <input class="form-check-input" name="status" <?php if ($quiz->status == 1) echo "checked" ?> type="checkbox" value="1" id="status">
                                <label class="form-check-label" for="status">
                                    Online
                                </label>
                            </div>
                            <div class="form-check mt-5">
                                <input class="form-check-input" name="is_shuffle" <?php if ($quiz->is_shuffle == 1) echo "checked" ?> type="checkbox" value="1" id="is_shuffle">
                                <label class="form-check-label" for="is_shuffle">
                                    Đảo câu
                                </label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="" class="btn btn-danger">Hủy</a>
                            &nbsp;
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>

            <hr class="mt-3">
            <div class="col-10 offset-1">
                <button type="button" id="openAddQuestionModal" class="btn btn-success">Thêm câu hỏi</button>
                <div class="row mt-3">
                    <?php foreach ($questions as $index => $qu) : ?>
                        <div class="col-6">
                            <ul class="list-group">
                                <li class="list-group-item active" aria-current="true">
                                    Câu hỏi số: <?= $index + 1 ?>: <?= $qu->name ?>
                                </li>
                                <?php foreach ($qu->getAnswers() as $ansIndex => $ans) : ?>
                                    <li class="list-group-item">
                                        Đáp án <?= $ansIndex + 1 ?>: <strong><?= $ans->content ?></strong>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endforeach ?>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tạo câu hỏi mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="">Nội dung câu hỏi?</label>
                                    <textarea name="name" class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                            <br>
                            <h3>Đáp án <button type="button" id="add_answer" class="btn btn-sm btn-success">Thêm đáp án</button></h3>
                            <table>
                                <thead>
                                    <th style="width: 80%;">Nội dung</th>
                                    <th>Đáp án đúng</th>
                                </thead>
                                <tbody id="answer_list">
                                    <tr>
                                        <td style="width: 80%;">
                                            <input type="text" class="form-control" name="answer[]">
                                        </td>
                                        <td>
                                            <input class="form-check-input" onchange="correctAnswerChange(this)" name="" type="checkbox" value="1" id="status">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" value="" id="correct_order">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        let options = {
            backdrop: false,
            keyboard: true
        };
        var addQuestionModel = new bootstrap.Modal(document.getElementById('addQuestionModal'), options)
        $("#openAddQuestionModal").click(function(){
            addQuestionModel.show();
        })

        $('#add_answer').click(function(){
            
            $('tbody#answer_list').append(`
                <tr>
                    <td>
                        <input type="text" class="form-control" name="answer[]">
                    </td>
                    <td>
                        <input onchange="correctAnswerChange(this)" class="form-check-input" name="" type="checkbox">
                    </td>
                </tr>
            `);
        })

        function correctAnswerChange(el){
            $('tbody#answer_list').find('input[type="checkbox"]').prop('checked', false);
            $(el).prop('checked', true);
            // lấy danh sách tất cả các thẻ input:checkbox trong table
            var listCheckbox = $('tbody#answer_list').find('input[type="checkbox"]');
            $(listCheckbox).each(function(index, el){
                if($(el).is(':checked')){
                    $('#correct_order').val(index);
                }
            })
        }
    </script>
</body>

</html>