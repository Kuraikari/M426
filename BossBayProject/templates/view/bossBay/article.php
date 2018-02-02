<?php


use services\QueryBuilder;

$query = new QueryBuilder();

$myQuery = $query
    ->select("*")
    ->from("product")
    ->where("id",$_GET['id'])
    ->execute();

$row = $myQuery->fetch(PDO::FETCH_ASSOC);

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

$userK = $query
  ->select("userFk")
  ->from("product")
  ->where("id","".$row["id"]."")
  ->execute()->fetch();

$user = $query
  ->select("username")
  ->from("user")
  ->where("id",$userK[0])
  ->execute()->fetch();

  $amount = $query
    ->select("quantity")
    ->from("product")
    ->where("id","".$row["id"]."")
    ->execute()->fetch();

?>

<div class="articlePage">

  <div class="articleImage">
    <img class="articleImg" src="<?php echo '/BossBayProject/assets/articleImages/'.$row["image"]; ?>" alt="">
  </div>

  <div class="articleContent">
    <div class="articleValue">
      <h1><?php echo $row["name"]; ?></h1>
    </div>
  </div>

  <div class="articleContent">
    <div class="articleValue">
      <h3><?php echo $row["price"]."$"; ?></h3>
    </div>
  </div>

  <div class="articleContent">
    <div class="articleValue">
      <p><?php echo $row["description"]; ?></p>
    </div>
  </div>

  <div class="articleContent">
    <div class="articleValue">
      <p>Categories: <?php echo $cat[0]; ?></p>
    </div>
  </div>

  <div class="articleContent">
    <div class="articleValue"
      <p>From: <a href="/user/review?username=<?php echo $user[0]; ?>"> <?php echo $user[0]; ?> </a></p>
    </div>
  </div>
<?php  ?>
  <form id="addToCartF" action="./" method="POST">

    (aviable <?php echo $amount[0];?>)  <?php if($amount[0] >= 1 && \services\Sessionmanagement::get('user')){?> Amount : <input type="number" id="amount" name="amount"
   min="1" max="<?php echo $cat[0]; ?>" step="1" value="1">

    <input type="hidden" id="hidden_ProductID" name="hidden_ProductID" value="<?php echo $row["id"]; ?>">

    <div>
      <a  href="#" id="addCartBtn" class="btn btn-sm animated-button thar-three">ADD TO CART</a>
    </div>
<?php  }?>
  </form>




  <div class="commentsSection">
    <div class="comments">
      <p>Comments: 10</p>
    </div>

        <div>
            <h5 class="commentTitle">Comments:</h5>
        </div>

        <div class="commentsSectionCommentary">
          <div>
            <h6 class="commentSectionTitle">Bossjer,
            <span>26.01.2018</span></h6>
          </div>
          <div class="commentsSectionText">
            <p>Nice Product</p>
          </div>
        </div>
  </div>

  <div class="writeSection">
    <div class="writeComment">
      <h5 class="commentTitle">Write Comment:</h5>
    </div>

    <div>
        <form id="submitFormCommentary<?php echo $row["id"]; ?>" action="./" method="POST">
          <input type="hidden" name="hidden_ID" value="<?php echo $row["id"]; ?>"/>
          <textarea class="inputCommentary" name="userComment">Write your commentary here...</textarea>
          <div class="group">
            <a href="#" id="submitButtonCommentary<?php echo $row["id"]; ?>" class="submitButtonCommentary">Submit</a>
          </div>
        </form>
    </div>
  </div>
</div>


<!-- <script type="text/javascript">
    //Set a Button to Submitbutton
    document.getElementById("addCartBtn").onclick = function()
    {
        document.getElementById("addToCartF").submit();
    }
</script> -->

<script>
    $(document).ready(function ()
    {
        $("#addCartBtn").click(function ()
        {

            hidden_ProductID = $("#hidden_ProductID").val();
            amount = $("#amount").val();

            $.ajax({

                type: "POST",
                url: "/user/addToCart",
                data: "hidden_ProductID=" + hidden_ProductID + "&amount=" + amount,

                success: function (isValid) {
                    if (JSON.parse(isValid)['isValid'] == true)
                    {

                        //window.location = "/travellBoss/homepage";
                        // swal('Login Successful','You are now Loged In on BossTravell','success');

                   swal({title: 'Added to Cart Successful',
                        text: "Click on Confirm to get back on the Shop page",
                        type: 'success',showCancelButton: true,confirmButtonColor: '#3085d6',cancelButtonColor: '#d33',confirmButtonText: 'Confirm'}).then(function () {
                        window.location.href = "Shop"; });
                    }
                    else
                    {
                        swal('Ups...','Article already added to cart','error');
                    }
                },
            });
            return false;
        });
    });
</script>
