<?php
$accessLevel = Contact::accessLevel();
if ($accessLevel != 'Admin') :
echo 'Sorry, no acces allowed to this page';
else :

// Get the Category the new lot will be in
$cat_id_in = (int) $_GET['cat_id'];
// Get the lot id. If it doesn't exist or is 0, then this is a new lot
$id = (int) $_GET['lot_id'];
// Is this an existing item or a new one?
if ($id) {
	
   
	// Get the existing information for an existing item
	$item = Lot::getLot($id);
	

	// set up the category dropdown
	$cat_dropdown = Category::getCat_DropDown($item->getCat_id());
} else {
	// Set up for a new item
	$item = new Lot;
	// set up the category dropdown
	$cat_dropdown = Category::getCat_DropDown($cat_id_in);
}
?>


<h1>Lot Maintenance</h1>
<form action="index.php?content=lots&cat_id=<?php echo
$cat_id_in;?>&sidebar=catnav" method="post" name="maint" id="maint">
	<fieldset class="maintform">
		<legend><?php echo ($id) ? 'Id: '. $id : 'Add a Lot' ?></legend>
		<ul>
			<li>
				<label for="lot_name" class="required">Lot Name</label><br />
				<input type="text" name="lot_name" id="lot_name" class="required"
				value="<?php echo htmlspecialchars($item->getLot_name()); ?>"/>
			</li>
			<li>
				<label for="lot_description">Lot Description</label><br />
				<textarea rows="5" cols="60"  name="lot_description" 
				id="lot_description"><?php echo htmlspecialchars($item->getLot_description()); ?></textarea>
			</li>
			<li>
				<label for="lot_image">Lot Image File</label><br />
				<input type="text" name="lot_image" id="lot_image" 
				value="<?php echo htmlspecialchars($item->getLot_image()); ?>" />
			</li>
			<li>
				<label for="lot_number">Lot number</label><br />
				<input type="text" name="lot_number" id="lot_number" class="required" value="<?php echo (int)
				$item->getLot_number(); ?>" />
			</li>
			<li>
				<label for="lot_price">Lot Price</label><br />
				<input type="text" name="lot_price" id="lot_price" value="<?php echo (float)
				$item->getLot_price(); ?>" />
			</li>
			<li>
				<?php echo $cat_dropdown; ?>
			</li>
		</ul>
		<?php 
		// create token
		$salt = 'SomeSalt';
		$token = sha1(mt_rand(1,1000000) . $salt);
		$_SESSION['token'] = $token;
		?>
		<input type="hidden" name="cat_id_in" id="cat_id_in" value="<?php echo
		$cat_id_in; ?>" />
		<input type="hidden" name="lot_id" id="lot_id" value="<?php echo $item->getLot_id(); ?>" />
		<input type="hidden" name="task" id="task" value="lot.maint" />
		<input type='hidden' name='token' value='<?php echo $token; ?>' />
		<input type="submit" name="save" value="Save" />
		<a class="cancel" href="index.php?content=lots&cat_id=<?php echo $cat_id_in;?>&sidebar=catnav">
		Cancel
	</a>
	</fieldset>
</form>
<?php endif; ?>