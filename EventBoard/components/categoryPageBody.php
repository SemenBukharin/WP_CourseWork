<div class="bg-white-body br-10 d-flex flex-column w-75 my-4" style="max-width:1024px; min-height: ;">
	<div class="d-flex justify-content-center">
        <div class="my-2 rounded-pill bg-mainGreen text-white minh-50px minw-220px text-center"> <h4 class="mt-2"><?=$_GET["category"]?></h4></div>
    </div>

    <div class="d-flex w-100 justify-content-start flex-wrap">
        		<a  class="no-underline link-white my-2 mx-3" href="./index.php">
					<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:150px; height: 35px">
						<p class="mt-1">
							Главная
						</p>
					</div>
				</a>
				<div class="d-flex my-2 justify-content-center text-dark" style="width:2rem; height: 35px">
					<h4 class="mt-1">-></h4>
				</div>
        		<a  class="no-underline link-white my-2 mx-3" href="<?="categoryPage.php?category=" . $category?>">
					<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:150px; height: 35px">
						<p class="mt-1">
							<?=$_GET["category"]?>
						</p>
					</div>
				</a>
        	</div>

    <?php
		//включаем файл класса pagination
		include_once './vendor/pagination.class.php';
		//включаем файл конфигурации базы данных
		include_once './vendor/dbConnect.php';
		$limit = 8;
		$offset = !empty($_GET['page'])?(($_GET['page']-1)*$limit):0;
		//получаем количество записей
		$queryNum = $dbConnect->query("SELECT COUNT(*) as eventsNum FROM events WHERE `published`=1 AND `category`='$category' ");
		$resultNum = $queryNum->fetch_assoc();
		$rowCount = $resultNum['eventsNum'];
		if 	($_GET['page']>ceil($rowCount/$limit)){
			$offset = ceil($rowCount/$limit-1)*$limit;
		}
		//инициализируем класс pagination
		$pagConfig = array(
		    'baseURL'=>'http://eventboard/categoryPage.php?category=' . $category,
		    'totalRows'=>$rowCount,
		    'perPage'=>$limit
		);
		$pagination =  new Pagination($pagConfig);
		//получаем записи
		$city = $_SESSION["cityId"];
		$user = $_SESSION["userId"];
		$category = $_GET['category'];
		$query = $dbConnect->query("SELECT * FROM `events` JOIN `images` ON events.id=images.event  WHERE `mainImage`=1  AND `published`=1 AND `category`='$category' ORDER BY `editDate` DESC LIMIT	$offset, $limit");

		if($query->num_rows > 0){
			$imgsPath = "../img/";
			?>
		    <div class="d-flex justify-content-around flex-wrap">
		    <?php while($row = $query->fetch_assoc()){
		    	$image = $imgsPath . $row['id'] . "/" . $row['image'];
		    ?>
		        <!-- <div class="list_item"><a href="javascript:void(0);"><?php echo $row["title"];  echo $row["mainImage"];?></a></div> -->
		        <div class="card d-flex my-2 mx-2 flex-column align-items-center justify-content-between bg-lightGreen" style="width: 235px; height: 360px;">
								<div class="mt-2 rounded img-fluid" style="width: 220px; height: 145px; background-image: url('<?php echo $image ?>'); background-position: center; background-repeat: no-repeat;  background-size: cover;"></div>
								<!-- <div class="card-body d-flex justify-content-center flex-column align-items-center"> -->
									<div class="d-flex justify-content-start w-100 px-2">
										<p class="card-text"><?=date("d.m.Y", strtotime($row["date"])) . " " . mb_strcut($row["time"], 0, 5);?></p>

									</div>

									<a class="no-underline link-dark " href="<?="../eventPage.php" . "?event=" . $row["id"]?>"><h5 class=" text-center card-title"><?=$row["title"]?></h5></a>


									<p class="mx-1 my-0 card-text"><?= mb_substr($row["description"], 0, 50) . "..."; ?></p>

									<p class="mx-2 w-80 my-0 card-text"><?=$row["price"]?></p>

									<div class="d-flex justify-content-between w-100 px-2  mb-2">
										<a>
											<div class="d-flex justify-content-center bg-mainGreen text-white rounded-pill" style="width:110px; height: 35px">
												<p class="mt-1">
													<?= $row["category"]; ?>
												</p>
											</div>
										</a>
										<div class=" d-flex justify-content-center text-white bg-mainGreen rounded-pill" style="width:85px; height: 35px"><p class="mt-1"><?php if ($row["maxVisitors"]>0) {
												$event = $row['id'];
												$users_events_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `event`='$event'");
												$users_events_res = $users_events_res->fetch_assoc();
												$users_on_event = $users_events_res["cnt"];
												echo $users_on_event . "/" . $row["maxVisitors"];
											}
														else {
															$event = $row['id'];
															$users_events_res = $dbConnect->query("SELECT COUNT(*) AS `cnt` FROM `users_events` WHERE `event`='$event'");
															$users_events_res = $users_events_res->fetch_assoc();
															$users_on_event = $users_events_res["cnt"];
															echo $users_on_event;
														}?></p></div>
									</div>
								<!-- </div> -->
							</div>
		    <?php } ?>
		    </div>
		    <div class="d-flex justify-content-center mw-100 align-items-center flex-wrap m-2">
			   	<!-- отображаем ссылки на страницы -->
			    <?php echo $pagination->createLinks(); ?>
			</div>
		 <?php }
		 else {
		 	echo "<div class=\"d-flex justify-content-center align-items-center\" style=\"min-height:250px\"><h5 class=\"text-center\">Нет мероприятий для выбранной категории в указанном городе!</h5></div>";
		 }
	?>

</div>