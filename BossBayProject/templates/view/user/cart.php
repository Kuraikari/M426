<?php
use services\QueryBuilder;



if (\services\Sessionmanagement::get('user'))
{
    $user = unserialize(\services\Sessionmanagement::get('user'))['username'];
    $query = new QueryBuilder();

    $myQuery = $query
        ->select("product.id, product.Name,Price,quantity")
        ->from("user")
        ->innerJoin("Cart","User.ID","Cart.userFk")
        ->innerJoin("Cart_product","Cart.ID","cart_product.CartFK")
        ->innerJoin("product","cart_product.productFk","product.id")
        ->innerJoin("product_categorie","product.id","product_categorie.productFk")
        ->innerJoin("categorie","product_categorie.categorieFk","categorie.id")
        ->where("username","'$user'")
        ->execute();



}


?>

<div class="parallax4" >
    <div class="hero-text">
        <h1 style="font-size:50px">BossBay</h1>
        <p>Shopping • Sell • Look and more...</p>
    </div>
</div>

<div id="shopping-cart">
<div class="txt-heading">Shopping Cart <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a></div>
<?php
    $item_total = 0;
?>
<table cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;"><strong>Name</strong></th>
<th style="text-align:left;"><strong>Code</strong></th>
<th style="text-align:right;"><strong>Quantity</strong></th>
<th style="text-align:right;"><strong>Price</strong></th>
<th style="text-align:center;"><strong>Action</strong></th>
</tr>
<?php
while ($item = $myQuery->fetch(PDO::FETCH_ASSOC))
{
		?>
				<tr>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["Name"]; ?></strong></td>
				<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["id"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
				<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo "$".$item["Price"]; ?></td>
				<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="user/de?action=remove&code=<?php echo $item["id"]; ?>" class="btnRemoveAction">Remove Item</a></td>
				</tr>
				<?php
        $item_total += ($item["Price"]*$item["quantity"]);
}
		?>

<tr>
<td colspan="5" align=right><strong>Total:</strong> <?php echo "$".$item_total; ?></td>
</tr>
</tbody>
</table>

</div>
