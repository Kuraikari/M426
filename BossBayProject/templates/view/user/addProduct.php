<?php
use services\QueryBuilder;

$query = new QueryBuilder();

$myQuery = $query
    ->select("*")
    ->from("categorie")
    ->execute();


?>

<div class="profilePage">

    <div>
        <h1 class="profileTitle" style="font-size:32px">Add Page</h1>
        <h3 class="profileTitle" style="font-size:18px">Add new Article</h3>
    </div>
    <form id="submitFormArticle" action="/user/addArticle" method="POST" enctype="multipart/form-data">

        <div class="profile">
            <div class="profileDiv">
                <label  for="">Article Image:</label>
                <div class="profileValue">
                    <input type="file" name="Image" id="Image" accept="image/*">
                </div>
            </div>

            <div class="profileDiv">
                <label  for="">Articletitle:</label>
                <div class="profileValue">
                    <input class="profileInput" type="text" name="title" >
                </div>
            </div>

            <div class="profileDiv">
                <label  for="">Article price:</label>
                <div class="profileValue">
                    <input class="profileInput" type="text" name="price" >
                </div>
            </div>

            <div class="profileDiv">
                <label  for="">Quantity:</label>
                <div class="profileValue">
                    <input class="profileInput" type="text" name="quantity" >
                </div>
            </div>

            <div class="profileDiv">
                <label  for="">Categories:</label>
                <div class="profileValue">
                  <select name="Categories">
                    <?php
                    while ($row = $myQuery->fetch(PDO::FETCH_ASSOC))
                    {
                    ?>
                    <option value="<?php echo $row["name"]; ?>"><?php echo $row["name"]; ?></option>
                    <?php
                    }
                     ?>
                  </select>
                </div>
            </div>

            <div class="profileDiv">
                <label  for="">Article description:</label>
                <div class="profileValue">
                    <textarea class="profileText" type="text" name="text"></textarea>
                </div>
            </div>

            <div>
                <a href="#" id="submitArticleBtn" class="btn btn-sm animated-button thar-three ">Save</a>
            </div>

        </div>
    </form>
</div>


<script type="text/javascript">
    //Set a Button to Submitbutton
    document.getElementById("submitArticleBtn").onclick = function()
    {
        document.getElementById("submitFormArticle").submit();
    }
</script>
