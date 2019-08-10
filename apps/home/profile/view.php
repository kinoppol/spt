
<?php
load_fun('table');
load_fun('datatable');

$teacherData=array();
$teacher_data=sSelectTb($appDb,'teacher_data','*','1 order by name');
foreach($teacher_data as $row){
$selectLink='<a href="'.site_url("main/report/form/record/tid/".$row['id']).'"
 class="btn btn-primary" title="เลือก">
      <i class="fa fa-user-secret"></i>
      </a>';
    $schoolData[]=array(
            //$row['school_id'],
            $row['name'],
            $row['workplace'],
            $row['position'],
            $selectLink,
        );
    //$linkArr['uri'][]=$row['group_id'];
}	

//print_r($schoolData);
        $data=array("head"=>array(
        //'รหัสสถานศึกษา',
        'ชื่อครู',
        'ที่ทำงาน',
        'ตำแหน่ง',
        'เลือก',
        ),
        'id'=>'school',
        'item'=>$schoolData,
        'pagelength'=>10,
        'order'=>'[[ 0, "asc" ]]'
        );
        print datatable($data);

?>