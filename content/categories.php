 		<?php
		$items = Category::getCategories();
		if (empty($items)) {
			$items = array();
		}
		?>
		<h1>Categories <a class="button" href="index.php?content=categorymaint&cat_id=0">Add</a></h1>

		<ul class="ulfancy">
			
		<?php foreach ($items as $i=>$item) : ?>
			<li class="row<?php echo $i % 2; ?>">
		<?php
		$image = 'images'. $item->getCat_image();
		if (!is_file($image)) {
			$image = 'images/nophoto.jpg';
		}
		$image_t = 'images/thumbnails/'. $item->getCat_image();
		if (!is_file($image_t)) {
			$image_t = 'images/thumbnails/nophoto.jpg';
		}
		?>
    			<div class="list-photo">
    			    <a href="<?php echo $image?>">
					<img alt=""  src="<?php echo $image_t; ?>" />
				</a>
    			</div>
    			<div class="list-description">
    				<h2><a href="index.php?content=lots&cat_id=<?php echo (int) $item->getCat_id(); ?>&sidebar=catnav">
						<?php echo htmlspecialchars (strtolower($item->getCat_name ())); ?>
					</a></h2>	
    				<p><?php echo htmlspecialchars($item->getCat_description()); ?></p>
    				<a class="button display" href="index.php?content=lots&cat_id=<?php echo (int) $item->getCat_id(); ?>&sidebar=catnav">
					Display Lots
				</a>
				<a class="button edit" href="index.php?content=categorymaint&cat_id=<?php echo (int) $item->getCat_id(); ?>">
				Edit
			</a>
			<a class="button edit" href="index.php?content=categorydelete&cat_id=<?php echo $item->getCat_id(); ?>">
				Delete
			</a>
    			</div>
    			<div class="clearfloat"></div>
    		</li>
			<?php endforeach ?>
	
	</div><!-- end content -->

	<div class="clearfloat"></div>
</div><!-- end container -->
</body>