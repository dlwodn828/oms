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
            text-align:center;
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
        /* .right{
            float:right;
        } */
    </style>
</head>

<body>
    <div class="form-wrapper">
        <div class="heading text-center">
            <h3>주 문 서</h3>
        </div>
        <form class="" action="index.html" method="post">
            <div class="row">
                <table width="270" height="163" class="table-contact">
                    <? foreach ($arrItem as $index => $row) { ?>
                        <tr>
                            <td>주문일</td>
                            <td><?=$row['orderdate']?></td>
                        </tr>
                        <tr>
                            <td>H.P</td>
                            <td><?=$row['managertel']?></td>
                        </tr>
                        <tr>
                            <td>TEL</td>
                            <td><?=$row['companytel']?></td>
                        </tr>
                        <tr>
                            <td>FAX</td>
                            <td><?=$row['fax']?></td>
                        </tr>
                        
                    <? break;} ?>
                </table>
                <table width="580" height="163" class="table-contact">
                    <? foreach ($arrItem as $index => $row) { ?>
                        <tr>
                            <td>거래처명</td>
                            <td><?=$row['companyname']?></td>
                        </tr>
                        <tr>
                            <td>대표자명</td>
                            <td><?=$row['managername']?></td>
                        </tr>
                        <tr>
                            <td>주소</td>
                            <td><?=$row['companyaddr']?></td>
                        </tr>
                        <tr>
                            <td>납기일</td>
                            <td><?=$row['duedate']?></td>
                        </tr>
                        <tr>
                            <td>배송지</td>
                            <td><?=$row['destination']?></td>
                        </tr>
                    <? break;} ?>
                </table>
            </div>
            <script>
                var arrSupplyPrice=[];
            </script>
            <div class="row">
                <table width="580" class="table-item">
                    <tr >
                        <td>번호</td>
                        <td>품명</td>
                        <td>규격</td>
                        <td>재질</td>
                        <td>도금</td>
                        <td>수량</td>
                        <td>단가</td>
                        <td>납기일</td>
                        <td>Total</td>
                    </tr>
                    <? foreach ($arrItem as $index => $row) { ?>
                        
                            <tr>
                                <td><?=++$no ?></td>
                                <td><?=$row['productname']?></td>
                                <td><?=$row['size']?></td>
                                <td><?=$row['material']?></td>
                                <td><?=$row['plated']?></td>
                                <td class="orderquantity<?=$row['idx']?>"><?=$row['orderquantity']?></td>
                                <td class="price<?=$row['idx']?>"><?=$row['orderprice']?></td>
                                <td><?=$row['duedate']?></td>
                                <td class="total<?=$row['idx']?>"><?=floor($row['orderprice']*$row['orderquantity']*1.1)?></td>
                            </tr>
                            <script>
                                // var defaultPrice = $(".price<?=$row['idx']?>").html();
                                // var orderquantity = $(".orderquantity<?=$row['idx']?>").html();
                                // var supplyPrice = defaultPrice * orderquantity;
                                // var vat = Math.floor(supplyPrice * 0.1);
                                // var total = supplyPrice + vat;
                                // $('.total<?=$row['idx']?>').html(total);
                                // arrSupplyPrice.push($(".total<?$row['idx']?>").html());
                                var t = $('.total<?=$row['idx']?>').html();
                                $('.totalPrice').html(t);
                            </script>
                    <? } ?>
                </table>
            </div>
            <div class="row right">
                <table width="580" class="right table-total">
                    <?$tt=0;$sp=0;$v=0;?>
                    <tr>
                        <td>총 공급가액</td>
                        <td class="tot_supplyPrice">
                            <? foreach($arrItem as $index=>$row){?>
                            <? $sp+=$row['orderprice']*$row['orderquantity'];?>
                            <? }?> 
                            <?=$sp?>
                        </td>
                        <td>VAT</td>
                        <td class="tot_vat"> 
                            <? foreach($arrItem as $index=>$row){?>
                            <? $v+=floor($row['orderprice']*$row['orderquantity']*0.1);?>
                            <? }?> 
                            <?=$v?>
                        </td>
                        <td>합계</td>
                        <td class="totalPrice">
                            <? foreach($arrItem as $index=>$row){?>
                            <? $tt+=floor($row['orderprice']*$row['orderquantity']*1.1);?>
                            <? }?> 
                            <?=$tt?>
                        </td>
                        <td width="10">원</td>
                    </tr>
                    <!-- <script>
                        var tot_sp;
                        var tot_vat;
                        var total;
                        for(var i in arrSupplyPrice){
                            tot_sp+=arrSupplyPrice[i];
                        }
                        tot_vat=Math.floor(tot_sp * 0.1);
                        total=tot_sp+tot_vat;
                        $('.tot_supplyPrice').html(tot_sp);
                        $('.tot_vat').html(tot_vat);
                        $('.totalPrice').html(total);
                    </script> -->
                </table>
            </div>
        </form>
    </div>
    <script>
    
        
    </script>
</body>

</html>
