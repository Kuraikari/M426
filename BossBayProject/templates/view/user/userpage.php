
<?php
use services\QueryBuilder;



if (\services\Sessionmanagement::get('user'))
{
    $user = unserialize(\services\Sessionmanagement::get('user'))['username'];
    $query = new QueryBuilder();

    $myQuery = $query
        ->select("*")
        ->from("user")
        ->where("username","'$user'")
        ->execute();

    $row = $myQuery->fetch(PDO::FETCH_ASSOC);

}


?>

<div class="profilePage">

    <div>
        <h1 class="profileTitle" style="font-size:32px">Your Profile:</h1>
    </div>
        <img class="profileImg" src="<?php
        if($row["image"] != null)
        {
            echo '/BossBayProject/assets/userimages/' . $row["image"];
        }else {
            echo '/BossBayProject/assets/userimages/defaultUser.png';
        }
        ?>" alt="">
        <div class="profile">

            <div class="profileDiv">
                <label  for="">Username:</label>
                <div class="profileValue">
                    <label for=""> <?php echo $row["username"]; ?></label>
                </div>
            </div class="profileEditDiv">

            <div class="profileDiv">
                <label  for="">Firstname:</label>
                <div class="profileValue">
                    <label  for=""> <?php echo $row["firstname"]; ?></label>
                </div>
            </div>

            <div class="profileDiv">
                <label  for="">Lastname:</label>
                <div class="profileValue">
                    <label  for=""> <?php echo $row["lastname"]; ?></label>
                </div>
            </div>

            <div class="profileDiv">
                <label  for="">Email:</label>
                <div class="profileValue">
                    <label for="">   <?php echo $row["email"]; ?></label>
                </div>
            </div>

            <div>
                <a  href="/user/useredit" id="toUserEditBtn" class="btn btn-sm animated-button thar-three">Edit your Profile</a>
            </div>

            <div>
                <a  href="/user/addProduct" id="userAddProductBtn" class="btn btn-sm animated-button thar-three">Add Product</a>
            </div>

            <div>
                <a  href="/user/article-edit" id="articleEditBtn" class="btn btn-sm animated-button thar-three">See Products</a>
            </div>

            <?php
            if($row['roleFk'] == 1) {
                ?>
                <div>
                    <a href="/user/adminpage" id="toAdminpageBtn" class="btn btn-sm animated-button thar-three">Adminpage</a>
                </div>
                <?php
            }
            ?>
            <div>
                <a  href="/user/logout" id="userLogiutBtn" class="btn btn-sm animated-button thar-three">Logout</a>
            </div>

        </div>
</div>
