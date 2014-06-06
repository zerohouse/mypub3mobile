<?php
// 검색결과를 호출하고/파싱할 수 있는 파일은 Include 한다. 
class ApiManager {
        
        private $key = "4e91a82a85f0e174272b2d3ef39e9448"; // 사용자가 발급받은 오픈API 키 
        private $searchUrl = "http://openapi.naver.com/search"; // 오픈API 호출URL
        private $target = "shop";

        /**
         * API 결과를 받아오기 위하여 오픈API 서버에 Request 를 하고 결과를 XML Object 로 반환하는 메소드
         * @return object
         */
        private function query($query)
        {
                $url = sprintf("%s?query=%s&target=%s&key=%s&display=4", $this->searchUrl, $query, $this->target, $this->key);
                $data =file_get_contents($url);
                $xml = simplexml_load_string($data);
                
                return $xml;
        }

        /**
         * API의 결과를 Array 형태로 반환하는 사용자 커스터마이징 메소드
         * XML을 직접 parsing 하여 Array형태로 변환한다  
         */
        public function getData($query)
        {
                $xml = $this->query($query);

                $result = array();
                $shop = array();
                
                foreach($xml->channel->item as $data){

                        $result['title'] = (string)$data->title;
                        $result['link'] = (string)$data->link;
                        $result['image'] = (string)$data->image;
                        $result['lprice'] = (string)$data->subtitle;
                        $result['hprice'] = (string)$data->director;
                        $result['mallName'] = (string)$data->actor;
                        $shop[] = $result;
                }
                
                return $shop;
        }
}

// 호출을 위한 ShopApiManager 객체를 초기화 한다. 
$movie = new ApiManager();

// 검색어가 입력된 경우 호출 객체로 전달하여 결과를 가져 온다. 
        $result = $movie->getData($_POST['query']);

?>

<?php
 // 결과를 반복문(foreach)를 사용하여 페이지에 표현한다. 
 $id=0;
 foreach ($result as $data){
 $id++;
 $ida = "id".$id;
?>


      <div class=moviewrap id=<?echo $ida?> onclick="moveToWrite('<?echo $ida?>')">
	  	  <div class=removethis onclick=removeID('<?echo $ida?>')></div>
		
      <?php if($data['image']!=null){ echo "<img class=poster src='{$data['image']}'/>";}?>
		<div class=moviewords>
		<a class=movielink href="<?php echo $data['link'];?>" target="_blank"><?php echo $data['title'];?></a>
				<? if ($data['lprice']!=0||$data['hprice']!=0){?>
		<?php if ($data['lprice']!=0){ echo $data['lprice'];}else{echo "?";}?>
		 ~ <?php if ($data['hprice']!=0){ echo $data['hprice'];}else{echo "?";}?>
		
		) <?php echo $data['mallName'];?><?}?>
		</div>
      </div>
                        <?php } ?>sdf
						