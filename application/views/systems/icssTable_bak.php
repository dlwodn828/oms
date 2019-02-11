<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="javascript:;">Home</a></li>
        <li><a href="javascript:;">시스템 관리</a></li>
        <li class="active">I-CSS / IPT / NICE</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">I-CSS 평점/한도 관리 <small>List</small></h1>
    <!-- end page-header -->

    <div class="profile-container">

        <div class="table-responsive">

            <table class="table table-bordered table-hover table-td-valign-middle">
                <thead>
                    <tr>
                        <th width="15%" class="text-center">구분</th>
                        <th class="text-center">세부</th>
                        <th width="10%" class="text-center">값</th>
                        <th width="10%" class="text-center">가중치</th>
                        <th width="20%" class="text-center">결과값</th>
                        <th width="10%" class="text-center">SN 변환값</th>
                        <th width="10%" class="text-center">SN 검증</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" id="nice-grade-val" value="0.000" />
                    <input type="hidden" id="nice-money-val" value="0.000" />
                    <input type="hidden" id="icss-opr-val" value="0.000" />
                    <input type="hidden" id="icss-sn-val" value="0.000" />
                    <input type="hidden" id="icss-sn1-val" value="0.000" />
                    <input type="hidden" id="icss-sn2-val" value="0.000" />
                    <input type="hidden" id="icss-cla-val" value="0.000" />
                    <input type="hidden" id="icss-pou-val" value="0.000" />
                    <input type="hidden" id="icss-pou1-val" value="0.000" />
                    <input type="hidden" id="icss-pou2-val" value="0.000" />
                    <input type="hidden" id="icss-sne-val" value="0.0138" />
                    <input type="hidden" id="icss-ar-val" value="0.000" />
                    <input type="hidden" id="icss-ds1-val" value="0.000" />
                    <input type="hidden" id="icss-ds2-val" value="0.000" />
                    <input type="hidden" id="icss-total-val" value="0.000" />
                    <input type="hidden" id="icss-grade" />
                    <tr>
                       <td class="text-center">NICE 신용등급</td>
                       <td></td>
                       <td><input type="number" id="nice-grade" min="1" max="6" value=""/></td>
                       <td class="text-center" id="nice-grade-ratio" data-value="40">40%</td>
                       <td class="text-center text-danger f-s-14 f-w-700" id="nice-grade-result">0.000%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td class="text-center">신용대출금액</td>
                       <td></td>
                       <td><input type="number" id="nice-money" value="0" min="1000000" /></td>
                       <td class="text-center" id="nice-money-ratio" data-value="10">10%</td>
                       <td class="text-center text-danger f-s-14 f-w-700" id="nice-money-result">0.000 %</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td class="text-center" rowspan="2">OPR</td>
                       <td>누적 납입 횟수</td>
                       <td><input type="number" id="icss-opr-1" class="icss-opr" min="0" max="330" value="0"/></td>
                       <td class="text-center" id="icss-opr-ratio" data-value="20" rowspan="2">20%</td>
                       <td class="text-center text-danger f-s-14 f-w-700" id="icss-opr-result" rowspan="2">0.000%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td>연체 누적 횟수</td>
                       <td><input type="number" id="icss-opr-2" class="icss-opr" min="0" max="10" /></td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td class="text-center" rowspan="5">SN</td>
                       <td>인원수</td>
                       <td>
                           <select id="icss-sn-1" class="" class="icss-sn1 form-control width-150" >
                               <option value="13" selected="">13명</option>
                               <option value="9">9명</option>
                               <option value="7">7명</option>
                               <option value="5">5명</option>
                           </select>
                       </td>
                       <td class="text-center" id="icss-sn-ratio" data-value="10" rowspan="5">10%</td>
                       <td class="text-center" id="icss-sn-result1" rowspan="2">0.000%</td>
                       <td class="text-center" rowspan="2" id="icss-sn-trnas-result1"></td>
                       <td class="text-center text-danger f-s-14 f-w-700" id="icss-sn-check" rowspan="4">FAIL</td>
                    </tr>
                    <tr>
                       <td>선택번호</td>
                       <td><input type="number" id="icss-sn-2" class="icss-sn1" min="1" max="13" /></td>
                    </tr>
                    <tr>
                        <td>인원수</td>
                        <td>
                            <select id="icss-sn-3" class="" class="icss-sn2 form-control width-150" >
                                <option value="13" selected="">13명</option>
                                <option value="9">9명</option>
                                <option value="7">7명</option>
                                <option value="5">5명</option>
                            </select>
                        </td>
                        <td class="text-center" id="icss-sn-result2" rowspan="2">0.000%</td>
                        <td class="text-center" rowspan="2" id="icss-sn-trnas-result2"></td>
                    </tr>
                    <tr>
                       <td>선택번호</td>
                       <td><input type="number" id="icss-sn-4" class="icss-sn2" min="1" max="13" /></td>
                    </tr>
                    <tr>
                       <td class="text-center" colspan="2">SN 소계</td>
                       <td id="icss-sn-result" class="text-center text-danger f-s-14 f-w-700">0.000%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td class="text-center" rowspan="2">CLA</td>
                       <td>스테이지 가입 수</td>
                       <td><input type="number" id="icss-cla-1" class="icss-cla" min="1" max="10" /></td>
                       <td class="text-center" id="icss-cla-ratio" data-value="10" rowspan="2">10%</td>
                       <td class="text-center text-danger f-s-14 f-w-700" id="icss-cla-result" rowspan="2">0.000%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td>약정 대출금액</td>
                       <td><input type="number" id="icss-cla-2" class="icss-cla" min="0" max="12000000" /></td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td class="text-center" rowspan="3">POU</td>
                       <td>누적완료기간</td>
                       <td><input type="number" id="icss-pou-1" min="4" max="2000" step="2" /></td>
                       <td class="text-center" rowspan="3">5%</td>
                       <td class="text-center" id="icss-pou-result1">0.000%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td>누적완료 스테이지</td>
                       <td><input type="number" id="icss-pou-2" min="0" max="1000" /></td>
                       <td class="text-center" id="icss-pou-result2">0.000%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td class="text-center" colspan="2">POU 소계</td>
                       <td id="icss-pou-result" class="text-center text-danger f-s-14 f-w-700">0.000%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td class="text-center" rowspan="2">SNE</td>
                       <td>재매칭 횟수</td>
                       <td><input type="number" id="icss-sne-1" class="icss-sne" min="0" max="30" /></td>
                       <td class="text-center" id="icss-sne-ratio" data-value="2" rowspan="2">2%</td>
                       <td class="text-center text-danger f-s-14 f-w-700" id="icss-sne-result" rowspan="2">0.014%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td>신규 스테이지내 친구수</td>
                       <td><input type="number" id="icss-sne-2" class="icss-sne" min="0" max="10" /></td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td class="text-center">AR(출생년년도)</td>
                       <td></td>
                       <td><input type="number" id="icss-ar" min="1950" max="2010" /></td>
                       <td class="text-center" id="icss-ar-ratio">2%</td>
                       <td class="text-center text-danger f-s-14 f-w-700" id="icss-ar-result">0.000%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td class="text-center" rowspan="2">DS</td>
                       <td>소득세 구간</td>
                       <td><input type="number" id="icss-ds-1" class="icss-sne" min="0" /></td>
                       <td class="text-center" rowspan="2">1%</td>
                       <td class="text-center text-danger f-s-14 f-w-700" id="icss-ds-result1">0.000%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td>재산세 구간</td>
                       <td><input type="number" id="icss-ds-2" class="icss-sne" min="0" /></td>
                       <td class="text-center text-danger f-s-14 f-w-700" id="icss-ds-result2">0.000%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td class="text-center">RISK합산</td>
                       <td colspan="2"></td>
                       <td class="text-center">100%</td>
                       <td class="text-center text-primary f-s-15 f-w-700" id="icss-total-result">0.000%</td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td colspan="4" class="text-center">스코어링</td>
                       <td class="text-center text-primary f-s-15 f-w-700" id="icss-score-result">000.0 </td>
                       <td></td>
                       <td></td>
                    </tr>
                    <tr>
                       <td colspan="4" class="text-center">I-CSS 등급</td>
                       <td class="text-center text-primary f-s-15 f-w-700" id="icss-grade-result"></td>
                       <td></td>
                       <td></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <!-- end #table-responsive -->

    </div>
    <!-- end #profile-container -->
</div>
<!-- end #content -->

<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->
</div>
<!-- end page container -->

<script>
$(document).ready(function() {
App.init();
FormDatePickerPlugins.init();

// NICE 신용등급에 따른 리스크(I-CSS에 40% 적옹됨)
$("#nice-grade").change(function() {
    var selNiceGrade = $(this).val();
    var selNiceGradeRatio = 0.4;
    //console.log(selNiceGrade+" : "+ selNiceGradeRatio);

    $.ajax({
        type: "get",
        dataType: "json",
        url: "/assets/json/icss-nice-grade.json",
        success: function(data) {
            for(var idx=0; idx<data.length; idx++) {
                if (data[idx][0] == selNiceGrade) {
                    var returnVal = data[idx][1];
                     break;
                }
             }

             // 결과값을 뿌려줌
             var returnLastVal = returnVal * selNiceGradeRatio;

             $("#nice-grade-result").html(parseFloat(returnLastVal).toFixed(3)+"%");
             $("#nice-grade-val").val(returnLastVal);

             console.log("nice-grade: "+ returnLastVal);

        },

        error: function(xhr, option, error) {
            console.log(xhr.status);
        }
    });

    var selNiceMoney = parseInt($("#nice-money").val());
    var selNiceMoneyRatio = 10;

    $.ajax({
        type: "get",
        dataType: "json",
        url: "/assets/json/icss-nice-money.json",
        success: function(data) {
            for(var idx=0; idx<data.length; idx++) {
                if (parseInt(data[idx][0]) >= selNiceMoney) {
                    var returnVal = data[idx][selNiceGrade];
                    //console.log("T");
                } else {
                    //console.log("F");
                    break;
                }
             }

             // 결과값을 뿌려줌
             var returnLastVal = returnVal * selNiceMoneyRatio;

             $("#nice-money-result").html(parseFloat(returnLastVal).toFixed(3)+"%");
             $("#nice-money-val").val(returnLastVal);

             console.log("nice-money: "+ returnLastVal);

             // RISK합산
             calculateIcss();
        },

        error: function(xhr, option, error) {
            console.log(xhr.status);
        }
    });

});

// NICE 신용대출금액에 따른 리스크(I-CSS에 10% 적옹됨)
$("#nice-money").change(function() {
    var selNiceGrade = parseInt($("#nice-grade").val());
    var selNiceMoney = parseInt($(this).val());
    var selNiceMoneyRatio = 10;
    //console.log(selNiceGrade+" : "+ selNiceGradeRatio);

    $.ajax({
        type: "get",
        dataType: "json",
        url: "/assets/json/icss-nice-money.json",
        success: function(data) {
            for(var idx=0; idx<data.length; idx++) {
                if (parseInt(data[idx][0]) >= selNiceMoney) {
                    var returnVal = data[idx][selNiceGrade];
                    //console.log("T");
                } else {
                    //console.log("F");
                    break;
                }
             }

             // 결과값을 뿌려줌
             var returnLastVal = returnVal * selNiceMoneyRatio;

             $("#nice-money-result").html(parseFloat(returnLastVal).toFixed(3)+"%");
             $("#nice-money-val").val(returnLastVal);

             console.log("nice-money: "+ returnLastVal);

             // RISK합산
             calculateIcss();
        },

        error: function(xhr, option, error) {
            console.log(xhr.status);
        }
    });
});

// OPR
$(".icss-opr").change(function() {

    var selOpr1 = $("#icss-opr-1").val();
    var selOpr2 = $("#icss-opr-2").val();
    var selOprRatio = 0.2;

    if (selOpr1 > 0 && selOpr2 > 0) {
        console.log(selOpr1 + " : "+ selOpr2);
        $.ajax({
            type: "get",
            dataType: "json",
            url: "/assets/json/icss-opr.json",
            success: function(data) {
                for(var idx=0; idx<data.length; idx++) {
                    if (parseInt(data[idx][0]) == selOpr1) {
                        var returnVal = data[idx][selOpr2];
                        break;
                    } else {
                        var returnVal = 0;
                    }
                 }

                 // 결과값을 뿌려줌
                 var returnLastVal = returnVal * selOprRatio;

                 $("#icss-opr-result").html(parseFloat(returnLastVal).toFixed(3)+"%");
                 $("#icss-opr-val").val(returnLastVal);

                 console.log("icss-opr: "+ returnLastVal);

                 // RISK합산
                 calculateIcss();
            },

            error: function(xhr, option, error) {
                console.log(xhr.status);
            }
        });
    }
});

// SN
// 인원수에 따라 선택번호를 바꿈
$("#icss-sn-1").change(function() {
    $("#icss-sn-2").val("");
    $("#icss-sn-2").attr("max", $(this).val());
});

$(".icss-sn1").change(function() {
    var selSn1 = $("#icss-sn-1").val();
    var selSn2 = $("#icss-sn-2").val();
    var selSn3 = $("#icss-sn-3").val();
    var selSn4 = $("#icss-sn-4").val();
    var selSnRatio = 0.1;
    if (selSn1 > 0 && selSn2 > 0) {
        console.log(selSn1 + " : "+ selSn2);
        $("#icss-sn-3").val("");
        $("#icss-sn-4").val("");

        $.ajax({
            type: "get",
            dataType: "json",
            url: "/assets/json/icss-sn.json",
            success: function(data) {
                for(var idx=0; idx<data.length; idx++) {
                    if (parseInt(data[idx][0]) == selSn1) {
                        var returnVal = data[idx][selSn2];
                        break;
                    } else {
                        var returnVal = 0;
                    }
                 }

                 // 결과값을 뿌려줌
                 returnVal = returnVal * selSnRatio;
                 $("#icss-sn-result1").html(parseFloat(returnVal).toFixed(3)+"%");
                 $("#icss-sn1-val").val(returnVal);

                 var icssSnVal2 = $("#icss-sn2-val").val();
                 var returnLastVal = (parseFloat(returnVal)+ parseFloat(icssSnVal2));

                 $("#icss-sn-result").html(parseFloat(returnLastVal).toFixed(3)+"%");
                 $("#icss-sn-val").val(returnLastVal);

                 console.log("icss-sn1: "+returnVal+" icss-sn2: "+icssSnVal2+" icss-sn: "+returnLastVal);

                 // RISK합산
                 calculateIcss();

                 // SN 변환값
                 // * 1 은 데이타를 숫자로 바꾸기 위함이다.
                 if (parseInt(selSn1) >= 13) {
                     $("#icss-sn-trnas-result1").html((selSn2 * 1).toFixed(1));
                 } else {
                     // (최대 인원수 / 선택한 인원수 * 선택한 번호)
                     var snTransResult1 = (13 / selSn1 * selSn2).toFixed(1);
                     $("#icss-sn-trnas-result1").html(snTransResult1);
                 }

            },

            error: function(xhr, option, error) {
                console.log(xhr.status);
            }
        });
    }
});

// 인원수에 따라 선택번호를 바꿈
$("#icss-sn-3").change(function() {
    $("#icss-sn-4").val("");
    $("#icss-sn-4").attr("max", $(this).val());
});

$(".icss-sn2").change(function() {

    var selSn1 = $("#icss-sn-1").val();
    var selSn2 = $("#icss-sn-2").val();
    var selSn3 = $("#icss-sn-3").val();
    var selSn4 = $("#icss-sn-4").val();

    var selSnRatio = 0.1;

    if (selSn3 > 0 && selSn4 > 0) {
        console.log(selSn1 + " : "+ selSn1);

        if (selSn1 > 0 && selSn2 > 0) {
        } else {
            console.log("위의 인원수 및 선택번호를 먼저 입력해 주셔야 합니다.");
            alert("위의 인원수 및 선택번호를 먼저 입력해 주셔야 합니다.");
            $("#icss-sn-3").val("");
            $("#icss-sn-4").val("");
            return false;
        }

        $.ajax({
            type: "get",
            dataType: "json",
            url: "/assets/json/icss-sn.json",
            success: function(data) {
                for(var idx=0; idx<data.length; idx++) {
                    if (parseInt(data[idx][0]) == selSn3) {
                        var returnVal = data[idx][selSn4];
                        break;
                    } else {
                        var returnVal = 0;
                    }
                 }

                 // 결과값을 뿌려줌
                 returnVal = returnVal * selSnRatio;
                 $("#icss-sn-result2").html(parseFloat(returnVal).toFixed(3)+"%");
                 $("#icss-sn2-val").val(returnVal);

                 var icssSnVal1 = $("#icss-sn1-val").val();
                 var returnLastVal = (parseFloat(returnVal)+ parseFloat(icssSnVal1));

                 $("#icss-sn-result").html(parseFloat(returnLastVal).toFixed(3)+"%");
                 $("#icss-sn-val").val(returnLastVal);

                 console.log("icss-sn1: "+icssSnVal1+" icss-sn2: "+returnVal+" icss-sn: "+returnLastVal);

                 // RISK합산
                 calculateIcss();

                 // SN 변환값
                 // * 1 은 데이타를 숫자로 바꾸기 위함이다.
                 if (parseInt(selSn3) >= 13) {
                     $("#icss-sn-trnas-result2").html((selSn4 * 1).toFixed(1));
                 } else {
                     // (최대 인원수 / 선택한 인원수 * 선택한 번호)
                     var snTransResult2 = (13 / selSn3 * selSn4).toFixed(1);
                     $("#icss-sn-trnas-result2").html(snTransResult2);
                 }

                 // SN 검증
                 var snTransCheck = parseFloat($("#icss-sn-trnas-result1").html()) + parseFloat($("#icss-sn-trnas-result2").html());
                 console.log("snTransCheck: "+ snTransCheck);
                 if (snTransCheck >= 10 ) {
                     $("#icss-sn-check").html("OK");
                 } else {
                     $("#icss-sn-check").html("FAIL");
                 }
            },

            error: function(xhr, option, error) {
                console.log(xhr.status);
            }
        });
    }
});

// CLA
$(".icss-cla").change(function() {

    var selCla1 = $("#icss-cla-1").val();
    var selCla2 = $("#icss-cla-2").val();
    var selClaRatio = 0.1;

    if (selCla1 > 0 && selCla2 > 0) {

        $.ajax({
            type: "get",
            dataType: "json",
            url: "/assets/json/icss-cla.json",
            success: function(data) {
                for(var idx=0; idx<data.length; idx++) {
                    if (parseInt(data[idx][0]) >= selCla2) {
                        var returnVal = data[idx][selCla1];
                        //console.log("T");
                    } else {
                        //console.log("F");
                        break;
                    }
                 }
                 // 결과값을 뿌려줌
                 var returnLastVal = returnVal * 0.1;

                 $("#icss-cla-result").html((returnLastVal).toFixed(3)+"%");
                 $("#icss-cla-val").val(returnLastVal);

                 console.log("icss-cla: "+returnLastVal);

                 // RISK합산
                 calculateIcss();

            },

            error: function(xhr, option, error) {
                console.log(xhr.status);
            }
        });
    }

    if (selCla1 == 0 || selCla2 == 0) {
        $("#icss-cla-result").html('0.000%')
        $("#icss-cla-val").val(0);

        // RISK합산
        calculateIcss();
    }
});

// POU
// 누적완료 기간
$("#icss-pou-1").change(function() {
    var selPou1 = $(this).val();
    var selPouRatio = 0.05;

    // selPou1 가 58일 이상일경우에는 28로 계산
    if (parseInt(selPou1) >= 58) selPou1 = 58;

    $.ajax({
        type: "get",
        dataType: "json",
        url: "/assets/json/icss-pou-1.json",
        success: function(data) {
            for(var idx=0; idx<data.length; idx++) {
                if (data[idx][0] == selPou1) {
                    var returnVal = data[idx][1];
                     break;
                }
             }

             // 결과값을 뿌려줌
             returnVal = returnVal * selPouRatio;
             $("#icss-pou-result1").html(parseFloat(returnVal).toFixed(3)+"%");
             $("#icss-pou1-val").val(returnVal);

             var icssPouVal2 = $("#icss-pou2-val").val();
             var returnLastVal = (parseFloat(returnVal)+ parseFloat(icssPouVal2));

             $("#icss-pou-result").html((returnLastVal).toFixed(3)+"%");
             $("#icss-pou-val").val(returnLastVal);

             console.log("icss-pou1: "+returnVal+" icss-pou2: "+icssPouVal2+" icss-pou: "+returnLastVal);

             // RISK합산
             calculateIcss();
        },

        error: function(xhr, option, error) {
            console.log(xhr.status);
        }
    });
});

// 누적완료 스테이지
$("#icss-pou-2").change(function() {
    var selPou2 = $(this).val();
    var selPouRatio = 0.05;

    // selPou2 가 28일 이상일경우에는 28로 계산
    if (parseInt(selPou2) >= 28) selPou2 = 28;

    $.ajax({
        type: "get",
        dataType: "json",
        url: "/assets/json/icss-pou-2.json",
        success: function(data) {
            for(var idx=0; idx<data.length; idx++) {
                if (data[idx][0] == selPou2) {
                    var returnVal = data[idx][1];
                     break;
                }
             }

             // 결과값을 뿌려줌
             returnVal = returnVal * selPouRatio;
             $("#icss-pou-result2").html(parseFloat(returnVal).toFixed(3)+"%");
             $("#icss-pou2-val").val(returnVal);

             var icssPouVal1 = $("#icss-pou1-val").val();
             var returnLastVal = (parseFloat(returnVal)+ parseFloat(icssPouVal1));

             $("#icss-pou-result").html((returnLastVal).toFixed(3)+"%");
             $("#icss-pou-val").val(returnLastVal);

             console.log("icss-pou1: "+icssPouVal1+" icss-pou2: "+returnVal+" icss-pou: "+returnLastVal);

             // RISK합산
             calculateIcss();
        },

        error: function(xhr, option, error) {
            console.log(xhr.status);
        }
    });
});

// SNE(소설관계망 평가)
$(".icss-sne").change(function() {

    var selSne1 = $("#icss-sne-1").val();
    var selSne2 = $("#icss-sne-2").val();
    var selSneRatio = 0.02;


    if (selSne1 > 0 && selSne2 > 0) {
        console.log(selSne1 + " : "+ selSne2);

        // selSne1 가 30일 이상일경우에는 30으로 계산
        if (parseInt(selSne1) >= 10) selSne1 = 10;
        // selSne2 가 30일 이상일경우에는 10으로 계산
        if (parseInt(selSne2) >= 30) selSne2 = 30;

        $.ajax({
            type: "get",
            dataType: "json",
            url: "/assets/json/icss-sne.json",
            success: function(data) {
                for(var idx=0; idx<data.length; idx++) {
                    if (parseInt(data[idx][0]) == selSne2) {
                        var returnVal = data[idx][selSne1];
                        break;
                    } else {
                        var returnVal = 0;
                    }
                 }

                 // 결과값을 뿌려줌
                 var returnLastVal = returnVal * selSneRatio;

                 $("#icss-sne-result").html(parseFloat(returnLastVal).toFixed(3)+"%");
                 $("#icss-sne-val").val(returnLastVal);

                 console.log("icss-sne: "+returnLastVal);

                 // RISK합산
                 calculateIcss();
            },

            error: function(xhr, option, error) {
                console.log(xhr.status);
            }
        });
    }
});

// AR(출생년도)
$("#icss-ar").change(function() {
    var icssAr = $(this).val();
    var returnVal = 0.000;

    if (icssAr >= 1993) {
        returnVal = 0.282
    }

    $("#icss-ar-result").html((returnVal).toFixed(3)+"%");
    $("#icss-ar-val").val(returnVal);

    // RISK합산
    calculateIcss();
});

// DS
// 소득세
$("#icss-ds-1").change(function() {
    var icssDs1 = $(this).val();
    var returnVal = 0.000;
    var icssDsRatio = 0.01;

    if (icssDs1>=0 && icssDs1 <= 12000000) {
        returnVal = -0.345;
    } else if (icssDs1 >= 12000000 && icssDs1 <= 46000000) {
        returnVal = -0.690;
    } else if (icssDs1 >= 46000001 && icssDs1 <= 88000000) {
        returnVal = -1.380;
    } else if (icssDs1 >= 88000001 && icssDs1 <= 150000000) {
        returnVal = -2.070;
    } else if (icssDs1 >= 150000001) {
        returnVal = -2.760;
    }

    var returnLastVal = returnVal * icssDsRatio;
    $("#icss-ds-result1").html(parseFloat(returnLastVal).toFixed(3)+"%");
    $("#icss-ds1-val").val(returnLastVal);

    // RISK합산
    calculateIcss();
});

 // 재산세
$("#icss-ds-2").change(function() {
    var icssDs2 = $(this).val();
    var returnVal = 0.000;
    var icssDsRatio = 0.01;

    if (icssDs2>=0 && icssDs2 <= 60000000) {
        returnVal = -0.345;
    } else if (icssDs2 >= 60000001 && icssDs2 <= 150000000) {
        returnVal = -0.690;
    } else if (icssDs2 >= 150000001 && icssDs2 <= 300000000) {
        returnVal = -1.380;
    } else if (icssDs2 >= 300000001) {
        returnVal = -2.070;
    }

    var returnLastVal = returnVal * icssDsRatio;
    $("#icss-ds-result2").html(parseFloat(returnLastVal).toFixed(3)+"%");
    $("#icss-ds2-val").val(returnLastVal);

    // RISK합산
     calculateIcss();
});

var calculateIcss = function() {

    var niceGrade = parseFloat($("#nice-grade-val").val());
    var moneyGrade = parseFloat($("#nice-money-val").val());
    var icssOpr = parseFloat($("#icss-opr-val").val());
    var icssSn = parseFloat($("#icss-sn-val").val());
    var icssCla = parseFloat($("#icss-cla-val").val());
    var icssPou = parseFloat($("#icss-pou-val").val());
    var icssSne = parseFloat($("#icss-sne-val").val());
    var icssAr = parseFloat($("#icss-ar-val").val());
    var icssDs1 = parseFloat($("#icss-ds1-val").val());
    var icssDs2 = parseFloat($("#icss-ds2-val").val());

    console.log("nice-grade: "+niceGrade);
    console.log("money-grade: "+moneyGrade);
    console.log("icss-opr: "+icssOpr);
    console.log("icss-sn: "+icssSn);
    console.log("icss-cla: "+icssCla);
    console.log("icss-pou: "+icssPou);
    console.log("icss-sne: "+icssSne);
    console.log("icss-ar: "+icssAr);
    console.log("icss-ds1: "+icssDs1);
    console.log("icss-ds2: "+icssDs2);

    var totalVal = icssTotalScore();

    totalVal = totalVal.toFixed(3);
    var totalScore = 1000 - (totalVal / 100 * 10000);
    $("#icss-total-result").html(totalVal+"%");
    $("#icss-score-result").html(totalScore.toFixed(1));
    $.ajax({
        type: "get",
        dataType: "json",
        url: "/assets/json/icss-score.json",
        success: function(data) {
            for(var idx=0; idx<data.length; idx++) {

                if (totalScore >= parseFloat(data[idx][1]) && totalScore <= parseFloat(data[idx][2])) {
                    var returnVal = data[idx][0];
                    //console.log("T");
                    break;
                } else {
                    //console.log("F");
                }
             }
             $("#icss-grade-result").html("I - "+ returnVal);
             $("#icss-grade").val(returnVal);
        },

        error: function(xhr, option, error) {
            console.log(xhr.status);
        }
    });

    console.log(niceGrade+":"+moneyGrade+":"+icssOpr+":"+icssSn+":"+icssCla+":"+icssPou+":"+icssSne+":"+icssAr+":"+icssDs1+":"+icssDs2+"==>"+totalVal);

};

var icssTotalScore = function() {
    var totalVal = parseFloat($("#nice-grade-val").val())+parseFloat($("#nice-money-val").val())+parseFloat($("#icss-opr-val").val())+parseFloat($("#icss-sn-val").val())+parseFloat($("#icss-cla-val").val())+parseFloat($("#icss-pou-val").val())+parseFloat($("#icss-sne-val").val())+parseFloat($("#icss-ar-val").val())+parseFloat($("#icss-ds1-val").val())+parseFloat($("#icss-ds2-val").val());
    console.log(totalVal);
    return totalVal;
};


});
</script>

</body>
</html>
