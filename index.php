<?php
/* ARC2 static class inclusion */
include_once('vendor/semsol/arc2/ARC2.php');

$dbpconfig = array(
    "remote_store_endpoint" => "http://localhost:3030/diet_project/query",
);

$store = ARC2::getRemoteStore($dbpconfig);

if ($errs = $store->getErrors()) {
    echo "<h1>getRemoteStore error<h1>";
}
?>
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
                                        <div class="form-group col-sm-8 offset-sm-2">
                                            <label for="gender">เพศ</label>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="male">ชาย</option>
                                                <option value="female">หญิง</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-8 offset-sm-2">
                                            <label for="age">อายุ</label>
                                            <select class="form-control" name="age" id="age">
                                                <?php for ($i = 1; $i < 100; $i++) {
                                                    echo "<option value='" . $i . "' " . ($i == 30 ? 'selected' : '') . ">" . $i . " ปี</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-8 offset-sm-2">
                                            <label for="weight">น้ำหนัก</label>
                                            <select class="form-control" name="weight" id="weight">
                                                <?php for ($i = 30; $i < 150; $i++) {
                                                    echo "<option value='" . $i . "' " . ($i == 55 ? 'selected' : '') . ">" . $i . " กิโลกรัม</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-8 offset-sm-2">
                                            <label for="height">ส่วนสูง</label>
                                            <select class="form-control" name="height" id="height">
                                                <?php for ($i = 50; $i < 220; $i++) {
                                                    echo "<option value='" . $i . "' " . ($i == 170 ? 'selected' : '') . ">" . $i . " เซนติเมตร</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-8 offset-sm-2">
                                            <label for="disease">โรคประจำตัว (ถ้ามี)</label>
                                            <select class="form-control" name="disease" id="disease">
                                                <option disabled selected>ไม่มีโรคประจำตัว</option>
                                                <?php
                                                $activity_factors = '
                                            PREFIX ex: <http://www.semanticweb.org/diet_project#>

                                              SELECT ?disease_name
                                            WHERE {
                                                ?disease ex:disease_name ?disease_name .
                                            }';
                                                foreach ($store->query($activity_factors, 'rows') as $activity_factor) {
                                                    echo "<option value='" . $activity_factor['disease_name'] . "'>" . $activity_factor['disease_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-8 offset-sm-2">
                                            <label for="activity_factor">ระดับกิจกรรมในชีวิตประจำวัน</label>
                                            <select class="form-control" name="activity_factor" id="activity_factor">
                                                <option value="" disabled selected>โปรดเลือกข้อมูล</option>
                                                <?php
                                                $activity_factors = '
                                            PREFIX ex: <http://www.semanticweb.org/diet_project#>

                                              SELECT ?individual ?activity_factor_name ?activity_factor_description ?activity_factor_value
                                            WHERE {
                                              ?individual ex:activity_factor_name ?activity_factor_name .
                                              ?individual ex:activity_factor_description ?activity_factor_description .
                                              ?individual ex:activity_factor_value ?activity_factor_value .
                                            }';
                                                foreach ($store->query($activity_factors, 'rows') as $activity_factor) {
                                                    echo "<option value='" . $activity_factor['activity_factor_value'] . "' data-description='" . $activity_factor['activity_factor_description'] . "'>" . $activity_factor['activity_factor_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback activityFactorFeedback" style="display: none">
                                                โปรดเลือกข้อมูลระดับกิจกรรมในชีวิตประจำวันด้วย
                                            </div>
                                            <div class="jumbotron pt-4 pb-4" style="display: none"></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-10 offset-md-1">
                                            <a class="btn btn-primary btn-block text-white nextToPartTwo">ถัดไป <i
                                                        class="fa fa-arrow-circle-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="partTwo" style="display: none;">
                                    <h4 id="bmrAndTdeeValue"></h4>
                                    <div class="row mt-5">
                                        <div class="form-group col-sm-6">
                                            <label for="weightGoal">น้ำหนักที่ต้องการลด</label>
                                            <select class="form-control" name="weightGoal" id="weightGoal">
                                                <?php for ($i = 1; $i < 100; $i++) {
                                                    echo "<option value='" . $i . "' " . ($i == 5 ? 'selected' : '') . ">" . $i . " กิโลกรัม</option>";
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="dateGoal">ระยะเวลาที่ต้องการลด (วัน)</label>
                                            <select class="form-control" name="dateGoal" id="dateGoal">
                                                <?php for ($i = 1; $i < 90; $i++) {
                                                    echo "<option value='" . $i . "' " . ($i == 30 ? 'selected' : '') . ">" . $i . " วัน</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="timePerDay">ระยะเวลาการออกกำลังกายต่อวัน (นาที)</label>
                                            <select class="form-control" name="timePerDay" id="timePerDay">
                                                <?php for ($i = 1; $i < 180; $i++) {
                                                    echo "<option value='" . $i . "' " . ($i == 45 ? 'selected' : '') . ">" . $i . " นาที</option>";
                                                } ?>
                                            </select>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-10 offset-md-1">
                                            <a class="btn btn-primary btn-block text-white nextToPartThree">ค้นหา <i
                                                        class="fa fa-search-plus"></i></a>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>วิธีการออกกำลังกาย</th>
                                                    <th>แคลอรี่จากการออกกำลังกาย</th>
                                                    <th>แคลอรี่ที่กินได้ต่อวัน</th>
                                                </tr>
                                                </thead>
                                                <tbody class="tableBody">
                                                </tbody>
                                            </table>
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
    let gender, age, weight, height, activity_factor, disease, bmr, tdee, goal, weightGoal, dateGoal, timePerDay = null;
    $(document).off('click', '.nextToPartTwo').on('click', '.nextToPartTwo', e => {
        gender = $("select[name='gender']").val();
        age = $("select[name='age']").val();
        weight = $("select[name='weight']").val();
        height = $("select[name='height']").val();
        activity_factor = $("select[name='activity_factor']").val();

        if (activity_factor === '' || activity_factor === null) {
            $('.activityFactorFeedback').show();
            $('#activity_factor').addClass('is-invalid');
        } else {
            if (gender === 'male') {
                bmr = (66 + (13.7 * weight) + (5 * height) - (6.8 * age));
                tdee = bmr * activity_factor;
                $('#bmrAndTdeeValue').html("BMR คือ <strong>" + bmr.toFixed(2) + "</strong><br />TDEE คือ <strong>" + tdee.toFixed(2) + "</strong><br /><span class='goal_result' style='disable:none'></span>");
                $('.partOne').hide(200);
                $('.partTwo').show(200);
            } else {
                bmr = (655 + (9.6 * weight) + (1.8 * height) - (4.7 * age));
                tdee = bmr * activity_factor;
                $('#bmrAndTdeeValue').html("BMR คือ <strong>" + bmr.toFixed(2) + "</strong><br />TDEE คือ <strong>" + tdee.toFixed(2) + "</strong><br /><span class='goal_result' style='disable:none'></span>");
                $('.partOne').hide(200);
                $('.partTwo').show(200);
            }
        }
    });

    $(document).off('click', '.nextToPartThree').on('click', '.nextToPartThree', e => {
        weightGoal = $("select[name='weightGoal']").val();
        dateGoal = $("select[name='dateGoal']").val();
        timePerDay = $("select[name='timePerDay']").val();
        disease = $("select[name='disease']").val();
        let tableContent = '';
        goal = tdee - ((weightGoal * 7700) / dateGoal);
        if (goal < bmr) {
            $('.tableBody').html('<tr><td colspan="4" class="text-danger">แคลลอรี่เป้าหมายต่อวัน น้อยกว่าค่า BMR ซึ่งอาจส่งผมต่อสมดุลของระบบเผาผลาญของร่างกายได้</td></tr>');
            $('.goal_result').html("แคลลอรี่เป้าหมาย <strong>" + goal.toFixed(2) + "</strong> / วัน");
        } else {
            $('.goal_result').html("แคลลอรี่เป้าหมาย <strong>" + goal.toFixed(2) + "</strong> / วัน");
            $.ajax({
                url: "api.php?function=getExercise&disease=" + disease + "&age=" + age + "&gender=" + gender + "&timePerDay=" + timePerDay
            }).done(function (data) {
                data.forEach(function (e, index) {
                    let kcal_exercise = (gender === 'male' ? (e.exercise_kcal_burn_per_minute_male * timePerDay) : (e.exercise_kcal_burn_per_minute_female * timePerDay));
                    let kcal_eat = kcal_exercise + goal;
                    tableContent += '<tr><td>' + (index + 1) + '</td><td>' + e.exercise_name + '</td><td><i class="fa fa-arrow-up text-success"></i> ' + kcal_exercise.toFixed(2) + '</td><td><i class="fa fa-arrow-down text-danger"></i> ' + kcal_eat.toFixed(2) + '</td></tr>';
                });
                $('.tableBody').html(tableContent);
            });
        }
    });

    $(document).on('change', '#activity_factor', e => {
        $('.jumbotron').html('<p class="lead">' + $(e.currentTarget).find(':selected').attr('data-description') + '</p>').show();
        $('.activityFactorFeedback').hide();
        $('#activity_factor').removeClass('is-invalid').addClass('is-valid');
    });
</script>

</body>
</html>