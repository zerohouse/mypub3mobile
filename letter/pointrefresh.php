<?
include "../php/connect_db.php";
$data[8] = $_POST['onlyno'];

	$only_no[0] = $data[8];
	$sql = mysql_query("SELECT * from score where `only_no` = '$only_no[0]'"); 
	$score = mysql_fetch_array($sql,MYSQL_NUM);
	

		
		
		
		
        echo "
            <br><br>
            <a class='pointbtnsym' onclick='scorePlus(4, $only_no[0]);'>공감+</a><a class='pointbtnwow' onclick='scorePlus(0, $only_no[0]);'>우와+</a><a class='pointbtnwow' onclick='scorePlus(1, $only_no[0]);'>지식+</a><a class='pointbtnwow' onclick='scorePlus(2, $only_no[0]);'>감동+</a><a class='pointbtnhum' onclick='scorePlus(3, $only_no[0]);'>ㅋㅋ+</a><br>
			<canvas id='radar$data[8]' data-type='Radar' width='250' height='250'></canvas><br>
        <script type='text/javascript'>
            var data$data[8] = {
                labels : ['공감','우와','지식','감동','ㅋㅋ'],
                datasets : [
                    {
                        fillColor : 'rgba(151,187,205,0.5)',
                        strokeColor : 'rgba(151,187,205,1)',
                        pointColor : 'rgba(151,187,205,1)',
                        pointStrokeColor : '#fff',
                        data : [$score[0],$score[1],$score[2],$score[3],$score[4]]
                    }
                ]
            }
        </script>
        <script type='text/javascript'>
            $(document).ready(function(){
                $('#radar$data[8]').each(function(){
                    eval(\"new Chart(this.getContext('2d')).\" + $(this).data('type') + '(data$data[8],options);');
                });
            });
        </script>"; ?>

	