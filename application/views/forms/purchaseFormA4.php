<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>주문서</title>
    <style>
        .form-wrapper {
            width: 595px;
            height: 842px;
            border: 1px solid grey;
        }

        .text-center {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            margin: 5px;
        }
        td{
            min-width: 40px;
        }
        table,
        th,
        td {
            border: 1px solid black;
        }
        .table-basic-info, .table-contact{
            display: inline-table;
        }
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }
        .table-basic-info tr td{
            height: 24px;
        }
        .table-delivery td, .table-item td{
            min-height: 24px;
        }

    </style>
</head>

<body>
    <div class="form-wrapper">
        <div class="heading text-center">
            <h3>주 문 서</h3>
        </div>
        <form class="" action="index.html" method="post">
            <div class="row">
                <table width="230" class="table-basic-info">
                    <tr>
                        <td>일련번호</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>수 신</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>참 조</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>TEL</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>FAX</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>납기일자</td>
                        <td></td>
                    </tr>
                </table>

                <table width="329" height="163" class="table-contact">
                    <tr>
                        <td>사업자등록번호</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>회사명/대표</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>주소</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>담당/연락처</td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <table width="580" class="table-delivery">
                    <tr>
                        <td>화 물</td>
                        <td>방 법</td>
                        <td>업체명</td>
                        <td>주 소</td>
                        <td>연락처</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <table width="580" class="table-item">
                    <tr >
                        <td>품명</td>
                        <td>굵기/길이/피치</td>
                        <td>재질</td>
                        <td>도금</td>
                        <td>수량</td>
                        <td>단가</td>
                        <td>Note</td>
                        <td>납기일</td>
                        <td>Total</td>
                    </tr>
                    <?php foreach ($arrItem as $item): ?>
                        <tr>
                            <!-- <td><?=$item['productname']?></td>
                            <td><?=$item['size1']?> / <?=$item['size2']?> / <?=$item['size3']?></td>
                            <td><?=$item['material']?></td>
                            <td><?=$item['plated']?></td>
                            <td><?=$item['basequantity']?></td> -->
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="row">
                <table width="580" class="table-total">
                    <tr>
                        <td>수량</td>
                        <td> </td>
                        <td>공급가액</td>
                        <td> </td>
                        <td>VAT</td>
                        <td> </td>
                        <td>합계</td>
                        <td> </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</body>

</html>
