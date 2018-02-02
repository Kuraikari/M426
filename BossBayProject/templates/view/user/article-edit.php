<?php
	use services\QueryBuilder;

	$query = new QueryBuilder();

	if (\services\Sessionmanagement::get('user'))
	{
	    $id = unserialize(\services\Sessionmanagement::get('user'))['id'];

			$myQuery = $query
				->select("*")
				->from("product")
				->where("userFK","'".$id."'")
				->execute();


	}




?>
		<div class="articles">
			<div class="row">
				<?php while ($row = $myQuery->fetch(PDO::FETCH_ASSOC)) {?>
					<figure class="article">
						<div>
							<img src="<?php echo '/BossBayProject/assets/articleImages/'.$row["image"]; ?>" width="130px" height="130px"><br>

							<p><?php echo $row['name'] ?></p><br>
							<p><?php echo $row['price'] ?></p><br>
							<input type="submit" name="edit" value="✍">
							<input type="submit" name="delete" value="X">
						</div>
					</figure>
				<?php } ?>
			</div>
		</div>
		<style type="text/css">
			.articles{
				position: absolute;
				top: 250px;
				left: 50px;
			}

			.article {
				float: left;
			}

			.article div input[name=edit], .article div input[name=delete]{
				position: absolute;
				width: 25px;
				height: 25px;
				border: solid 1px rgb(80, 80, 40);
				border-radius: 4px;
				background: none;
			}

			.article div p {
				position: absolute;
				width: 200px;
				left: 0;
				margin: 5px 15px;
				text-align: center;
			}

			.article div input[name=delete]{
				background-color: rgba(200, 130, 130, 1);
				color: white;
				top: 16px;
				left: 185px;
			}

			.article div input[name=edit]{
				background-color: rgba(150, 150, 250, 1);
				color: white;
				font-size: 18px;
				top: 48px;
				left: 185px;
			}

			.article div input[name=edit][value]{

			}
		</style>
