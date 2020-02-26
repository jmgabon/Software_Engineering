<?php include 'partials/header.php'; ?>
<script type="text/javascript">
    $('#lead').text('Report Card Settings');
    $('#setting').addClass('active');
</script>
<div class="content-main mt-5">
    <style>
        .ul {
            margin: 0;
            padding: 0;
            list-style: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            width:50%;
            float:left;
        }

        .ul li {
            cursor: move;
            margin: 1px;
            padding: 1% 10%;
            font-size: 100%;
            color: white;
            background-color: #800000;
        }

        .ghost {
            opacity: .4;
        }
    </style>
        <div class="float-left">
            <label>Selected Grade Level:
                <select id="selectGradeLevel" onchange="wrapperGradeSorter.selectGradeLevel()">
                    <option selected value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </label>

            <div class="row">
                <ul class="ul mt-4" id="uListSubject"></ul>
            </div>

            <div class = "col mt-4">
                <button id="btnSaveSubj">SAVE Subject Arrangement</button>
            </div>
        </div>

        <div class="float-right mt-4">
            <label>Quarter SAVE Button Enabled:
                <select id="selectQuarter">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </label>

            <div class = "col">
                <button id="btnSaveQuarter">SAVE Enabled Quarter</button>
            </div>
        </div>



    </div>


    <script>let EmployeeNum = <?php echo $_SESSION['id']?></script>
    <?php include 'partials/footer.php'; ?>
    <script src="../js/Grade_Setting.js" type="text/javascript"></script>
    
