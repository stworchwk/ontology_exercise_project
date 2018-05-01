<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword"
          content="Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,Angular 2,Angular4,Angular 4,jQuery,CSS,HTML,RWD,Dashboard,React,React.js,Vue,Vue.js">
    <title>Exercise Project - Ontology</title>

    <!-- Icons -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    <!-- Main styles for this application -->
    <link href="css/style.min.css" rel="stylesheet">
    <!-- Styles required by this views -->

</head>

<body class="app">
<div class="app-body">
    <!-- Main content -->
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row mt-5">
                    <div class="col-md-6 offset-md-3 text-center">
                        <h1>ระบบ Ontology วิเคราะห์การลดน้ำหนัก</h1>
                        <h3>ด้วยการออกกำลังกายด้วยรูปแบบ <strong>Cardio</strong></h3>
                        <div class="card card-accent-danger mt-5">
                            <div class="card-body">
                                <div class="partOne">
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="gender">เพศ</label>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="male">ชาย</option>
                                                <option value="female">หญิง</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="age">อายุ</label>
                                            <select class="form-control" name="age" id="age">
                                                <?php for ($i = 1; $i < 100; $i++) {
                                                    echo "<option value='" . $i . "' " . ($i == 20 ? 'selected' : '') . ">" . $i . "</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="weight">น้ำหนัก</label>
                                            <select class="form-control" name="weight" id="weight">
                                                <?php for ($i = 30; $i < 150; $i++) {
                                                    echo "<option value='" . $i . "' " . ($i == 170 ? 'selected' : '') . ">" . $i . "</option>";
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="height">ส่วนสูง</label>
                                            <select class="form-control" name="height" id="height">
                                                <?php for ($i = 50; $i < 220; $i++) {
                                                    echo "<option value='" . $i . "' " . ($i == 170 ? 'selected' : '') . ">" . $i . "</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-10 offset-md-1">
                                            <a class="btn btn-primary btn-block text-white calculateBMR">ถัดไป <i
                                                        class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="partTwo" style="display: none;">
                                    <h4>BMR ของคุณคือ <strong id="bmrValue"></strong></h4>
                                    <div class="row mt-3">
                                        <div class="form-group col-sm-6">
                                            <label for="height">โรคประจำตัว (ถ้ามี)</label>
                                            <select class="form-control" name="height" id="height">
                                                <option value="" selected>ไม่มีโรคประจำตัว</option>
                                                <option value="">โรคหัวใจ</option>
                                                <option value="">โรคหอบหืด</option>
                                                <option value="">โรคความดันโลหิตสูง</option>
                                                <option value="">โรคอ้วน</option>
                                                <option value="">โรคข้อเข่าเสื่อม</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="height">ระดับกิจกรรมในชีวิตประจำวัน</label>
                                            <select class="form-control" name="height" id="height">
                                                <option value="">ทำงานอยู่กับที่ เคลื่อนไหวน้อย</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="weightGoal">น้ำหนักที่ต้องการลด</label>
                                            <select class="form-control" name="weightGoal" id="weightGoal">
                                                <?php for ($i = 1; $i < 100; $i++) {
                                                    echo "<option value='" . $i . "' " . ($i == 5 ? 'selected' : '') . ">" . $i . "</option>";
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="dateGoal">ระยะเวลาในการลดน้ำหนัก / วัน</label>
                                            <select class="form-control" name="dateGoal" id="dateGoal">
                                                <?php for ($i = 1; $i < 90; $i++) {
                                                    echo "<option value='" . $i . "' " . ($i == 5 ? 'selected' : '') . ">" . $i . "</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.conainer-fluid -->
    </main>
</div>

<!-- Bootstrap and necessary plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- CoreUI main scripts -->

<script src="js/app.js"></script>

<script>
    $(document).off('click', '.calculateBMR').on('click', '.calculateBMR', e => {
        let gender = $("select[name='gender']").val();
        let age = $("select[name='age']").val();
        let weight = $("select[name='weight']").val();
        let height = $("select[name='height']").val();
        let bmr = null;

        if (gender === 'male') {
            //สูตรของ Mifflin – St Jeor
            bmr = (10 * weight) + (6.25 * height) - (5 * (age + 5));
            $('#bmrValue').html(bmr);
            $('.partOne').hide(200);
            $('.partTwo').show(200);
        } else {
            //สูตรของ Mifflin – St Jeor
            bmr = (10 * weight) + (6.25 * height) - (5 * (age - 161));
            $('#bmrValue').html(bmr);
            $('.partOne').hide(200);
            $('.partTwo').show(200);
        }
    });
</script>

</body>
</html>