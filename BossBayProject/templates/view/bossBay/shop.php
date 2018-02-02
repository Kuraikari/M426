<?php


use services\QueryBuilder;

$query = new QueryBuilder();

$myQuery = $query
    ->select("*")
    ->from("product")
    ->execute();

?>

<div class="parallax3" >
    <div class="hero-text">
        <h1 style="font-size:50px">BossBay</h1>
        <p>Shopping • Sell • Look and more...</p>
    </div>
</div>

<?php
while ($row = $myQuery->fetch(PDO::FETCH_ASSOC))
{
  $catK = $query
  ->select("categorieFk")
  ->from("product_categorie")
  ->where("productFk","".$row["id"]."")
  ->execute()->fetch();

  $cat = $query
    ->select("name")
    ->from("categorie")
    ->where("id",$catK[0])
    ->execute()->fetch();
?>
<figure class="snip1477">
  <img src="<?php echo '/BossBayProject/assets/articleImages/'.$row["image"]; ?>" alt="sample38" />
  <div class="title">
    <div>
      <h2><?php echo $row["name"]; ?></h2>
      <h4><?php echo $cat[0]; ?></h4>
    </div>
  </div>
  <figcaption>
    <p>Click on the image to get more information about the product</p>
  </figcaption>

  <a href="/bossBay/article?id=<?php echo $row["id"]?>"></a>
</figure>
<?php
 }
 ?>
