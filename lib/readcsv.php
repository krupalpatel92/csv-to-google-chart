<?php
function csv_to_array($filename='', $delimiter=','){
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();

    if (($handle = fopen($filename, 'r')) !== FALSE){

        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE){
            if(!$header){
                $header = $row;
                $data["header"] = $header;
            }else{
                $data["data"][] = array_combine($header, $row);
            }
        }
        fclose($handle);
    }
    return $data;
}

function BuildDataTable($gdata,$gheader){

    $chart_data = "";
    foreach($gdata as $gcdata){
        $count = 0;
        $p = array();
        foreach($gcdata as $k){
        	if(!is_null($k)){
	            $p[] = ($count==0)? '"'.$k.'"' : $k;            
	            $count++;
        	}
        }
        $chart_data[] = "[".implode(",",$p)."]";
    }

    foreach($gheader as $d){
        $header_data[] = '"'.$d.'"';
    }

    $header_data = "[".implode(",",$header_data)."]";
    $chart_data = implode(",",$chart_data);
    $full_chart_data = "[".$header_data.",".$chart_data."]";
    return $full_chart_data;

}
?>