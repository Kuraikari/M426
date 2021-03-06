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
        <h1 class="profileTitle" style="font-size:32px">Edit Your Profile:</h1>
    </div>

    <form id='submitFormUseredit' action='/user/edit' method='POST' name='submitFormUseredit' enctype="multipart/form-data">
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
            <label  for="">change Image:</label>
            <div class="profileValue">
                <input type="file" name="Image" id="Image" accept="image/*">
            </div>
        </div>

        <div class="profileDiv">
            <label  for="">Username:</label>
            <div class="profileValue">
                <label for="">Username cant be changed!</label>
            </div>
        </div class="profileEditDiv">

        <div class="profileDiv">
            <label  for="">Firstname:</label>
            <div class="profileValue">
                <input class="profileInput" name="Firstname" type="text" id="inputFirstName" value="<?php echo $row["firstname"]; ?>">
            </div>
        </div>

        <div class="profileDiv">
            <label  for="">Lastname:</label>
            <div class="profileValue">
                <input class="profileInput" name="Lastname" type="text" id="inputLastName" value="<?php echo $row["lastname"]; ?>">
            </div>
        </div>

        <div class="profileDiv">
            <label  for="">Email:</label>
            <div class="profileValue">
                <input class="profileInput" name="Email" type="text" id="inputEmail" value="<?php echo $row["email"]; ?>">
            </div>
        </div>

        <div class="profileDiv">
            <label  for="">Telefon:</label>
            <div class="profileValue">
                <input class="profileInput" name="Telefon" type="text" id="inputTelefon" value="<?php echo $row["telefon"]; ?>">
            </div>
        </div>

        <div class="profileDiv">
            <label  for="">Cityname:</label>
            <div class="profileValue">
                <input class="profileInput" name="Cityname" type="text" id="inputCityname" value="<?php echo $row["cityname"]; ?>">
            </div>
        </div>

        <div class="profileDiv">
            <label  for="">Postcode:</label>
            <div class="profileValue">
                <input class="profileInput" name="Postcode" type="text" id="inputPostcode" value="<?php echo $row["postcode"]; ?>">
            </div>
        </div>

        <div class="profileDiv">
            <label  for="">Streetname:</label>
            <div class="profileValue">
                <input class="profileInput" name="Streetname" type="text" id="inputEmail" value="<?php echo $row["streetname"]; ?>">
            </div>
        </div>

        <div class="profileDiv">
            <label  for="">Streetnumber:</label>
            <div class="profileValue">
                <input class="profileInput" name="Streetnumber" type="text" id="inputEmail" value="<?php echo $row["streetnumber"]; ?>">
            </div>
        </div>
        <div>
            <a href="#" id="submitUserEditBtn" class="btn btn-sm animated-button thar-three ">Save</a>
        </div>
    </div>
    </form>

</div>


<script type="text/javascript">
    //Set a Button to Submitbutton
    document.getElementById("submitUserEditBtn").onclick = function()
    {
        document.getElementById("submitFormUseredit").submit();
    }
</script>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
