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

    <style>
        .slidecontainer {
            width: 100%;
        }

        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 25px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .slider:hover {
            opacity: 1;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            background: #4CAF50;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            background: #4CAF50;
            cursor: pointer;
        }
    </style>

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
                                        <div class="col-md-3">
                                            อาหารเช้า :
                                        </div>
                                        <div class="col-md-6">
                                            <input type="range" min="0" max="100" value="0" step="5" class="slider"
                                                   id="breakfastRange">
                                        </div>
                                        <div class="col-md-3 breakfastRangePercent">
                                            0%
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            อาหารกลางวัน :
                                        </div>
                                        <div class="col-md-6">
                                            <input type="range" min="0" max="100" value="0" step="5" class="slider"
                                                   id="lunchRange">
                                        </div>
                                        <div class="col-md-3 lunchRangePercent">
                                            0%
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            อาหารเย็น :
                                        </div>
                                        <div class="col-md-6">
                                            <input type="range" min="0" max="100" value="0" step="5" class="slider"
                                                   id="dinnerRange">
                                        </div>
                                        <div class="col-md-3 dinnerRangePercent">
                                            0%
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            อาหารว่าง :
                                        </div>
                                        <div class="col-md-6">
                                            <input type="range" min="0" max="100" value="0" step="5" class="slider"
                                                   id="snackRange">
                                        </div>
                                        <div class="col-md-3 snackRangePercent">
                                            0%
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            สิ่งที่ไม่รับประทาน :
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control"
                                                   placeholder="เช่น หมู เนื้อ บร็อคโคลี่ เป็นต้น" id="ingredientFood">
                                        </div>
                                        <div class="col-md-3 allRangePercent text-danger">
                                            0%
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 offset-md-1 text-danger foodPercentAlert"
                                             style="display: none">
                                            โปรดเลือกเปอร์เซ็นต์ของแต่ละมื้ออาหาร ให้ครบ 100 เปอร์เซ็นต์ด้วย
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
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody class="tableBody">
                                                <tr>
                                                    <td colspan="4">ยังไม่มีการค้นหา</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 foodResult" style="display: none">
                    <div class="col-md-10 offset-md-1">
                        <div class="card card-accent-primary">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <h4>อาหารเช้า</h4>
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th>ชื่ออาหาร</th>
                                                <th>แคลลอรี่</th>
                                            </tr>
                                            </thead>
                                            <tbody class="breakfastTable">
                                            <tr>
                                                <td colspan="2">ไม่มีข้อมูล</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <h4>อาหารกลางวัน</h4>
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th>ชื่ออาหาร</th>
                                                <th>แคลลอรี่</th>
                                            </tr>
                                            </thead>
                                            <tbody class="lunchTable">
                                            <tr>
                                                <td colspan="2">ไม่มีข้อมูล</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <h4>อาหารเย็น</h4>
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th>ชื่ออาหาร</th>
                                                <th>แคลลอรี่</th>
                                            </tr>
                                            </thead>
                                            <tbody class="dinnerTable">
                                            <tr>
                                                <td colspan="2">ไม่มีข้อมูล</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <h4>อาหารว่าง</h4>
                                        <table class="table table-sm">
                                            <thead>
                                            <tr>
                                                <th>ชื่ออาหาร</th>
                                                <th>แคลลอรี่</th>
                                            </tr>
                                            </thead>
                                            <tbody class="snackTable">
                                            <tr>
                                                <td colspan="2">ไม่มีข้อมูล</td>
                                            </tr>
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
        <!-- /.conainer-fluid -->
    </main>
</div>

<!-- Bootstrap and necessary plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- CoreUI main scripts -->

<script src="js/app.js"></script>

<script>
    let gender = null, age = null, weight = null, height = null, activity_factor = null, disease = null, bmr = null,
        tdee = null, goal = null, weightGoal = null, dateGoal = null, timePerDay = null;
    let breakfastRange = 0, lunchRange = 0, dinnerRange = 0, snackRange = 0;
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
                    tableContent += '<tr><td>' + (index + 1) + '</td><td>' + e.exercise_name + '</td><td><i class="fa fa-arrow-up text-success"></i> ' + kcal_exercise.toFixed(2) + '</td><td><i class="fa fa-arrow-down text-danger"></i> ' + kcal_eat.toFixed(2) + '</td><td><a class="btn btn-sm btn-primary selectExercise text-white" data-kcal-eat="' + kcal_eat.toFixed(2) + '">เลือก</a></td></tr>';
                });
                $('.tableBody').html(tableContent);
            });
        }
    });

    $(document).off('change', '#breakfastRange').on('change', '#breakfastRange', e => {
        let maxRange = getMaxRange(0);
        if ($(e.currentTarget).val() <= maxRange) {
            breakfastRange = Number($(e.currentTarget).val());
            $('.breakfastRangePercent').html(breakfastRange + '%');
        } else {
            breakfastRange = maxRange;
            $('.breakfastRangePercent').html(breakfastRange + '%');
            $(e.currentTarget).val(breakfastRange);
        }
        if (getAllRange() < 100) {
            $('.allRangePercent').html(getAllRange() + '%').removeClass('text-success').addClass('text-danger');
            $('.foodPercentAlert').show(300);
        } else {
            $('.allRangePercent').html(getAllRange() + '%').removeClass('text-danger').addClass('text-success');
            $('.foodPercentAlert').hide(300);
        }
    });

    $(document).off('change', '#lunchRange').on('change', '#lunchRange', e => {
        let maxRange = getMaxRange(1);
        if ($(e.currentTarget).val() <= maxRange) {
            lunchRange = Number($(e.currentTarget).val());
            $('.lunchRangePercent').html(lunchRange + '%');
        } else {
            lunchRange = maxRange;
            $('.lunchRangePercent').html(lunchRange + '%');
            $(e.currentTarget).val(lunchRange);
        }
        if (getAllRange() < 100) {
            $('.allRangePercent').html(getAllRange() + '%').removeClass('text-success').addClass('text-danger');
            $('.foodPercentAlert').show(300);
        } else {
            $('.allRangePercent').html(getAllRange() + '%').removeClass('text-danger').addClass('text-success');
            $('.foodPercentAlert').hide(300);
        }
    });

    $(document).off('change', '#dinnerRange').on('change', '#dinnerRange', e => {
        let maxRange = getMaxRange(2);
        if ($(e.currentTarget).val() <= maxRange) {
            dinnerRange = Number($(e.currentTarget).val());
            $('.dinnerRangePercent').html(dinnerRange + '%');
        } else {
            dinnerRange = maxRange;
            $('.dinnerRangePercent').html(dinnerRange + '%');
            $(e.currentTarget).val(dinnerRange);
        }
        if (getAllRange() < 100) {
            $('.allRangePercent').html(getAllRange() + '%').removeClass('text-success').addClass('text-danger');
            $('.foodPercentAlert').show(300);
        } else {
            $('.allRangePercent').html(getAllRange() + '%').removeClass('text-danger').addClass('text-success');
            $('.foodPercentAlert').hide(300);
        }
    });

    $(document).off('change', '#snackRange').on('change', '#snackRange', e => {
        let maxRange = getMaxRange(3);
        if ($(e.currentTarget).val() <= maxRange) {
            snackRange = Number($(e.currentTarget).val());
            $('.snackRangePercent').html(snackRange + '%');
        } else {
            snackRange = maxRange;
            $('.snackRangePercent').html(snackRange + '%');
            $(e.currentTarget).val(snackRange);
        }
        if (getAllRange() < 100) {
            $('.allRangePercent').html(getAllRange() + '%').removeClass('text-success').addClass('text-danger');
            $('.foodPercentAlert').show(300);
        } else {
            $('.allRangePercent').html(getAllRange() + '%').removeClass('text-danger').addClass('text-success');
            $('.foodPercentAlert').hide(300);
        }
    });

    function getMaxRange(type) {
        switch (type) {
            case 0:
                return (100 - (lunchRange + dinnerRange + snackRange));
            case 1:
                return (100 - (breakfastRange + dinnerRange + snackRange));
            case 2:
                return (100 - (breakfastRange + lunchRange + snackRange));
            case 3:
                return (100 - (breakfastRange + lunchRange + dinnerRange));
        }
    }

    function getAllRange() {
        return (breakfastRange + lunchRange + dinnerRange + snackRange);
    }

    $(document).off('click', '.selectExercise').on('click', '.selectExercise', e => {
        if ((breakfastRange + lunchRange + dinnerRange + snackRange) !== 100) {
            $('.allRangePercent').removeClass('text-success').addClass('text-danger').focus();
            $('.foodPercentAlert').show(300);
        } else {
            let allKcalEat = e.target.attributes.getNamedItem('data-kcal-eat').value;
            let breakfastRangeValue = (breakfastRange * allKcalEat) / 100;
            let lunchRangeValue = (lunchRange * allKcalEat) / 100;
            let dinnerRangeValue = (dinnerRange * allKcalEat) / 100;
            let snackRangeValue = (snackRange * allKcalEat) / 100;
            let ingredient = $('#ingredientFood').val();

            let breakfastRangeContent = null, lunchRangeContent = null, dinnerRangeContent = null, snackRangeContent = null;

            $.ajax({
                url: "api.php?function=getFood&kcal=" + breakfastRangeValue.toFixed(2) + "&time=b&$ingredient=" + ingredient
            }).done(function (data) {
                if (data.length > 0) {
                    data.forEach(function (e, index) {
                        breakfastRangeContent += '<tr><td>' + e.food_name + '</td><td>' + e.food_kcal_give + ' / ' + e.food_unit + '</td></tr>';
                    });
                }else{
                    breakfastRangeContent = '<tr><td colspan="2">ไม่มีข้อมูล</td></tr>';
                }
                $('.breakfastTable').html(breakfastRangeContent);
            });

            $.ajax({
                url: "api.php?function=getFood&kcal=" + lunchRangeValue.toFixed(2) + "&time=l&$ingredient=" + ingredient
            }).done(function (data) {
                if (data.length > 0) {
                    data.forEach(function (e, index) {
                        lunchRangeContent += '<tr><td>' + e.food_name + '</td><td>' + e.food_kcal_give + ' / ' + e.food_unit + '</td></tr>';
                    });
                }else{
                    lunchRangeContent = '<tr><td colspan="2">ไม่มีข้อมูล</td></tr>';
                }
                $('.lunchTable').html(lunchRangeContent);
            });

            $.ajax({
                url: "api.php?function=getFood&kcal=" + dinnerRangeValue.toFixed(2) + "&time=d&$ingredient=" + ingredient
            }).done(function (data) {
                if (data.length > 0) {
                    data.forEach(function (e, index) {
                        dinnerRangeContent += '<tr><td>' + e.food_name + '</td><td>' + e.food_kcal_give + ' / ' + e.food_unit + '</td></tr>';
                    });
                }else{
                    dinnerRangeContent = '<tr><td colspan="2">ไม่มีข้อมูล</td></tr>';
                }
                $('.dinnerTable').html(dinnerRangeContent);
            });

            $.ajax({
                url: "api.php?function=getFood&kcal=" + snackRangeValue.toFixed(2) + "&time=s&$ingredient=" + ingredient
            }).done(function (data) {
                if (data.length > 0) {
                    data.forEach(function (e, index) {
                        snackRangeContent += '<tr><td>' + e.food_name + '</td><td>' + e.food_kcal_give + ' / ' + e.food_unit + '</td></tr>';
                    });
                }else{
                    snackRangeContent = '<tr><td colspan="2">ไม่มีข้อมูล</td></tr>';
                }
                $('.snackTable').html(snackRangeContent);
            });

            $('.foodResult').show(300);
            $('html, body').animate({scrollTop:$(document).height()}, 'slow');
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