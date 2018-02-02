<?php
// use services\DBConnection;
use services\QueryBuilder;

$query = new QueryBuilder();

$myQuery = $query
    ->select("*")
    ->from("user")
    ->where("username", "'" . $_GET['username'] . "'")
    ->execute();

$row = $myQuery->fetch(PDO::FETCH_ASSOC);

?>

<div class="review">
    <div class="left-part">
        <img src="<?php echo '/BossBayProject/assets/userimages/' . $row["image"]; ?>" width="240" height="240"
             class="profilepicture"><br>
        <label class="username"><?php echo $row['username'] ?></label>
        <div class="star-rating">
            <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
        </div>
        <hr width="240">
    </div>
    <div class="right-part">
        <input type="text" name="name" readonly="true" placeholder="Name"><br>
        <input type="text" name="age" readonly="true" placeholder="Age"><br>
        <input type="text" name="article" readonly="true" placeholder="Best rated article"><br>
        <table>
            <tr>
                <td>ARTICLE #1</td>
                <td>ARTICLE #2</td>
                <td>ARTICLE #3</td>
            </tr>
            <tr>
                <td>ARTICLE #4</td>
                <td>ARTICLE #5</td>
                <td>ARTICLE #6</td>
            </tr>
            <tr>
                <td>ARTICLE #7</td>
                <td>ARTICLE #8</td>
                <td>ARTICLE #9</td>
            </tr>
        </table>
    </div>
    <div class="bottom-part">
        <textarea readonly="true"></textarea> <br>
        <form>
            <input type="text" name="comment" placeholder="Your comment">
            <input type="submit" name="">
        </form>
    </div>
</div>
<style type="text/css">
    html {
        margin: 0;
        padding: 0;
    }

    .review {
        position: absolute;
        top: 200px;
        left: 18%;
        padding: 20px;
        margin: 5px;
        text-align: center;
    }

    .left-part {
        position: absolute;
        left: 350px;
    }

    .right-part {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 600px;
        margin: 10px;
    }

    .right-part table {
        position: absolute;
        top: 110px;
    }

    .right-part table tr td {
        width: 60px;
        height: 60px;
        text-align: center;
    }

    .right-part input[name=name] {
        position: absolute;
        margin: 0px 0;
        left: 5px;
        padding: 6px;
        width: 210px;
    }

    .right-part input[name=age] {
        position: absolute;
        left: 5px;
        margin: 15px 0;
        padding: 6px;
        width: 210px;
    }

    .right-part input[name=article] {
        position: absolute;
        margin: 30px 0;
        left: 5px;
        padding: 6px;
        width: 210px;
    }

    .bottom-part {
        position: absolute;
        top: 420px;
        left: 350px;
        width: 100%;
    }

    .bottom-part textarea {
        width: 480px;
        height: 250px;
    }

    .bottom-part input[type=text] {
        padding: 8px;
        margin-top: 5px;
        width: 480px;
    }

    .bottom-part input[type=submit] {
        position: absolute;
        bottom: 16px;
        left: 490px;
        padding: 8px;
    }

    .star-rating {
        unicode-bidi: bidi-override;
        direction: rtl;
    }

    .star-rating > span {
        display: inline-block;
        position: relative;
        width: 1.1em;
    }

    .star-rating > span:hover:before,
    .star-rating > span:hover ~ span:before {
        content: "\2605";
        position: absolute;
    }
</style>
