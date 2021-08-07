<?php 
session_start();
include "partials/dbconct.php";
if(isset($_SESSION["loggedin"])){
    if(isset($_SERVER['HTTP_REFERER'])){
        $classcode=$_GET["code"];
        $returnto='classroom.php?code='.$classcode.'';
        $sql="SELECT * FROM `classroom` WHERE c_code='$classcode';";
  
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        if($row){
            if($row){
                if($row["students"]==""){
                    $arr['userid']=$_SESSION['user_id'];
                    $arr['date']=date("Y-m-d H:i:s");
                    $studentsArr[]=$arr;
                    $students=json_encode($studentsArr);
                    $update="UPDATE `classroom` SET `students` = '$students' WHERE `c_code` = '$classcode';";
                    $updateresult=mysqli_query($conn,$update);
                        if($updateresult){
                            echo "done";
                        }
                        else{
                            echo 'failed';
                        }
                }
                else{
                    $studentsArr=json_decode($row['students'],true);
                    $s_id=array_column($studentsArr,'userid');
                    if(!in_array($_SESSION['user_id'],$s_id)){
                        $arr['userid']=$_SESSION['user_id'];
                        $arr['date']=date("Y-m-d H:i:s");
                        $studentsArr[]=$arr;
                        $students=json_encode($studentsArr);
                        $update="UPDATE `classroom` SET `students` = '$students' WHERE `c_code` = '$classcode';";
                        $updateresult=mysqli_query($conn,$update);
                        if($updateresult){
                            echo "done";
                        }
                        else{
                            echo 'failed';
                        }
                    }
                    else{
                        echo "already enrolled";
                    }

                }
            }
        }
        else{
            echo "not going in";
        }
        
    }
    else{
        $returnto="profile.php";
    }
    header("location:$returnto");

}
else{
    header("location:login.php");
}
?>