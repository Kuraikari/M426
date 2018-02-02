<?php
/**
 * Created by PhpStorm.
 * User: vmadmin
 * Date: 25.10.2017
 * Time: 11:30
 */

namespace controller;

use helper\FileUploader;
use models\User;
use MongoDB\Driver\Query;
use PDO;
use services\Cookiemanagement;
use services\DBConnection;
use services\QueryBuilder;
use services\Sessionmanagement;


class UserController extends BaseController implements ControllerInterface
{

    public function home()
    {
        include __DIR__ . '/../templates/view/travellBoss/homepage.php';
    }

    public function addComment()
    {
         if ($this->httpHandler->isPost())
         {
             $userId = unserialize(Sessionmanagement::get('user'))['id'];
             $timezone = date_default_timezone_get();
             date_default_timezone_set($timezone);
             $date = date('Y-m-d', time());
             $id = htmlspecialchars($_POST['hidden_ID'], ENT_QUOTES, 'UTF-8');
             $comment = htmlspecialchars($_POST['userComment'], ENT_QUOTES, 'UTF-8');

             $query = new QueryBuilder();

             $query
                 ->insert("review")
                 ->addField("userFk")
                 ->addField("articleFK")
                 ->addField("text")
                 ->addField("date")
                 ->addValue("$userId")
                 ->addValue("$id")
                 ->addValue("$comment")
                 ->addLastValue("$date");

             header("Location:/BossBay/Shop");
         }
    }

    public function login()
    {
        $query = new QueryBuilder();

        $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
        $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');

        $myQuery = $query
            ->select("*")
            ->from("user")
            ->where("username", "'" . $name . "'")
            ->execute();

        if ($this->verifyPassword($name, $pass)) {
            $myQuery->setFetchMode(PDO::FETCH_CLASS, 'User');

            $user = $myQuery->fetch();

            if ($user) {
                Sessionmanagement::set('user', serialize($user));

                if (Sessionmanagement::get('user')) {

                    if ($_POST["remember"] == "on")
                    {
                        Cookiemanagement::set("member_login",$name,30);
                        Cookiemanagement::set("member_password", $pass, 30);

                    } else {
                        if (isset($_COOKIE["member_login"]))
                        {
                            Cookiemanagement::delete("member_login");
                        }
                        if (isset($_COOKIE["member_password"]))
                        {
                            Cookiemanagement::delete("member_password");
                        }
                    }
                    echo json_encode(['isValid' => true]);
                    $this->destruct = false;
                }

            } else {
                echo json_encode(['isValid' => false]);
                $this->destruct = false;
            }
        } else {
            echo json_encode(['isValid' => false]);
            $this->destruct = false;
        }
    }

    public function register()
    {
        $this->destruct = false;
        if ($this->httpHandler->isPost()) {

            $data = $this->httpHandler->getData();

            $user = new User();

            $user->patchEntity($data);



            if ($user->isValid())
            {
                $user->Password1 = $this->returnEncryptedString($user->Password1);
                $user->Password2 = $this->returnEncryptedString($user->Password2);

                $user->save();

                echo json_encode(['isValid' => true]);

            } else {
                echo json_encode(['isValid' => false, 'errors' => $user->getErrors()]);
            }
        }
    }

    public function edit()
    {
        if ($this->httpHandler->isPost()) {
            $data = $this->httpHandler->getData();
            $user = new User();
            $user->patchEntity($data);

            if ($user)
            {

                if($_FILES['Image']['name'])
                {
                    $uploader = new FileUploader(__DIR__ . '/../assets/userimages/');

                    $ext = pathinfo($_FILES['Image']['name'], PATHINFO_EXTENSION);

                    $username = unserialize(Sessionmanagement::get('user'))['username'];

                    $_FILES['Image']['name'] = $username . "." . $ext;

                    $uploader->upload($_FILES['Image'], 'image');

                    $user->Image = $_FILES['Image']['name'];

                    debug("here");
                    debug($user);

                    $user->saveEdit();
                }else {

                    $user->saveEditNoImage();
                }

                header("Location:/user/userpage");

            } else {
                header("Location:/user/userpage");
            }
        }
    }

    public function returnEncryptedString($passwordEnter): String
    {
        return password_hash($passwordEnter, PASSWORD_DEFAULT);
    }

    public function verifyPassword($usernameEnter, $passwordEnter): bool
    {
        $query = new QueryBuilder();

        $query
            ->select('password')
            ->from('user')
            ->where( 'username',"'".$usernameEnter."'");

        $myQuery = $query->execute()->fetch();

        return password_verify($passwordEnter, $myQuery['password']);
    }

    public function logout()
    {
        Sessionmanagement::destroy();
        header("Location:/BossBay/Homepage");
    }

    public function view(int $id)
    {
        // TODO: Implement view() method.
    }

    public function addArticle()
    {

        if ($this->httpHandler->isPost()) {
            $data = $this->httpHandler->getData();
            $timezone = date_default_timezone_get();
            date_default_timezone_set($timezone);
            $date = date('Y-m-d', time());

            if ($data) {
                if ($_FILES['Image']['name'])
                {
                    $uploader = new FileUploader(__DIR__ . '/../assets/articleImages/');

                    $uploader->upload($_FILES['Image'], 'image');

                    $Imagename = $_FILES['Image']['name'];

                    $query = new QueryBuilder();

                    $user = unserialize(\services\Sessionmanagement::get('user'))['id'];


                    $query
                        ->insert("product")
                        ->addField("name")
                        ->addField("price")
                        ->addField("image")
                        ->addField("description")
                        ->addField("date")
                        ->addField("quantity")
                        ->addField("userFk")
                        ->addValue("".$data['title']."")
                        ->addValue("".$data['price']."")
                        ->addValue("".$Imagename."")
                        ->addValue("".$data['text']."")
                        ->addValue("".$date."")
                        ->addValue("".$data['quantity']."")
                        ->addLastValue("".$user."");


                    $last_id = $query
                      ->select("MAX(id)")
                      ->from("product")
                      ->execute()->fetch();

                    $idCat = $query
                      ->select("id")
                      ->from("categorie")
                      ->Where("name","'".$data['Categories']."'")
                      ->execute()->fetch();

                    $query
                      ->insert("product_categorie")
                      ->addField("categorieFk")
                      ->addField("productFk")
                      ->addValue("".$idCat[0]."")
                      ->addLastValue("".$last_id[0]."");


                }
                header("Location:/BossBay/Homepage");
            }
        }
    }

    public function addToCart()
    {
      if(isset($_SESSION['user']))
      {

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
          $item_ID = $_POST["hidden_ProductID"];
          // $item_ID = htmlspecialchars($_POST['hidden_ProductID'], ENT_QUOTES, 'UTF-8');

          $query = new QueryBuilder();

          $id = unserialize(\services\Sessionmanagement::get('user'))['id'];

          $cart = $query
            ->select("userFk")
            ->from("cart")
            ->where("userFK","".$id."")
            ->execute()->fetch();

          if($cart[0] == null)
          {
            $query
            ->insert("cart")
            ->addField("userFk")
            ->addLastValue("".$id."");
          }

          $currentCartID = $query
            ->select("id")
            ->from("cart")
            ->where("userFk","".$id."")
            ->execute()->fetch();

          $count = $query
            ->select("cartFk, productFK")
            ->from("cart_product")
            ->where("cartFk","".$currentCartID[0]."")
            ->and("productFK","".$item_ID."")
            ->execute()->rowCount();

          if($count >= 1)
          {
            echo json_encode(['isValid' => false]);
            $this->destruct = false;
          }else
          {


            $query
              ->insert("cart_product")
              ->addField("cartFk")
              ->addField("amount")
              ->addField("productFk")
              ->addValue("".$currentCartID[0]."")
              ->addValue("".$_POST["amount"]."")
              ->addLastValue("".$item_ID."");

            echo json_encode(['isValid' => true]);
            $this->destruct = false;

          }
        }

      }
    }
}

?>
