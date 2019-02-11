<HTML> 
<HEAD> 
<TITLE> New Document </TITLE> 
<META NAME="Generator" CONTENT="EditPlus 1.2"> 
<META NAME="Author" CONTENT=""> 
<META NAME="Keywords" CONTENT=""> 
<META NAME="Description" CONTENT=""> 
</HEAD>

<BODY BGCOLOR="#FFFFFF">


    <script language="javascript">


        function hrewarp(menu) { 
            var myindex = doc.options[doc.selectedIndex].value; 
            location.href=myindex; 
        }

        function OpenNoticeWin(url) { 
            window.open(url,"notice_win",'toolbar=no,location=no,directory=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=510,height=400'); 
        } 


        function member_select(){

            var doc = document.teamlist.team_nm; 
            var Member = document.teamlist.member_nm;


        <?php

        //-------------------------------------------------------------------------------- 
        // MySQL DB 접속 
        //--------------------------------------------------------------------------------

        $connect=mysql_connect( "", "mysql", "") or die( "SQL server에 연결할 수 없습니다."); 
        mysql_select_db("test",$connect);


        //-------------------------------------------------------------------------------- 
        // 제일 큰 팀의 인원수를 알아낸다. 
        //--------------------------------------------------------------------------------

        $que1="select team_nm ,count(*) 
                from team  group by team_nm  
                order by 2  Desc 
                limit 1 
                " ;

        $result1 = mysql_query($que1,$connect ) ;

        $row1 = mysql_fetch_array($result1) ;

        $member_max = $row1[1] ;

        // echo $member_max  : 제일 큰 팀의 인원수 

        

        

        //-------------------------------------------------------------------------------- 
        // 팀이름의 목록를 알아낸다 
        //--------------------------------------------------------------------------------

        $que2="select distinct team_nm from team " ; 
        $result2 = mysql_query($que2,$connect ); 
        $team_max = mysql_num_rows($result2) ;

        //  echo  $team_max : 팀의 수

        

        //========== 팀이름을 루프로 돌린다.: [팀의 수만큼] =======

        $row_team = mysql_fetch_array($result2);

        while($row_team) 
        {

            echo(" if (document.teamlist.team_nm.options[document.teamlist.team_nm.selectedIndex].value == '$row_team[0]') "); 
            echo("    {  
            
                ");    
            //-------------------------------- 
            //  $row_team[0] 에 속하는 팀원의 목록 
            //---------------------------------

            $que3="select member_nm from team where team_nm='$row_team[0]'" ; 
            $result3 = mysql_query($que3,$connect ); 
            //======== 팀원을 작은 루프로 돌린다 [제일 큰 팀의 인원수 만큼]======      
            for($i=0 ; $i < $member_max ; $i++) 
                { 
                    $row_member = mysql_fetch_array($result3); 
                        
                    //if($row_member[0]) 
                    @print(" 
                    document.teamlist.member_nm.options[$i].text = '$row_member[0]' ; 
                    document.teamlist.member_nm.options[$i].value= '$row_member[0]' ;    ");

                                }    
            //======== 작은 루프 끝  ============================================ 
            echo("    } ");

            $row_team = mysql_fetch_array($result2);

        } 
        // ========== 큰루프 끝===========


                            


        ?> 
            document.teamlist.member_nm.selectedIndex = 0 ; 
        }


    </SCRIPT>

<form method="post" name=teamlist>

팀선택 <select name="team_nm" onchange="member_select()">


<?php 
//======  팀이름 목록=========

 $que2="select distinct team_nm from team " ; 
 $result2 = mysql_query($que2,$connect ); 
 $row_team = mysql_fetch_array($result2);


 echo("<option value=''>팀선택</option>"); 
  
 while($row_team) 
 {

  echo("<option value='$row_team[0]'>$row_team[0]</option>"); 
  $row_team = mysql_fetch_array($result2);

 }


?>

</select>

팀원선택<select name="member_nm">

<?php 
 for($i=0 ; $i < $member_max ; $i++ ) 
 {

  echo("<option value=''></option>");

 }

?> 
</font> 
</select>

</form>


</BODY> 
</HTML> 