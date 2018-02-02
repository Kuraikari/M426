<?php
use services\QueryBuilder;

$query = new QueryBuilder();

?>

<div class="profilePage">

    <div>
        <h1 class="profileTitle" style="font-size:32px">Adminpage</h1>
        <h3 class="profileTitle" style="font-size:18px">Add new Article</h3>
    </div>
    <form id="submitFormArticle" action="/admin/addArticle" method="POST" enctype="multipart/form-data">

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
                    <input class="profileInput" type="text" name="Title" >
                </div>
            </div>

            <div class="profileDiv">
                <label  for="">Title description:</label>
                <div class="profileValue">
                    <input class="profileInput" type="text" name="TitleDescription" >
                </div>
            </div>

            <div class="profileDiv">
                <label  for="">Date (Y-M-D):</label>
                <div class="profileValue">
                    <input class="profileInput" type="text" name="Date" >
                </div>
            </div>

            <div class="profileDiv">
                <label  for="">Article text</label>
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