<?php
// Get the lot information
$lots = array();
$lots[0]['lot_number'] = '1';	
$lots[0]['image'] = "naval-19-173.jpg";
$lots[0]['name'] = "Naval Officer's Formal Tailcoat, 1840s";
$lots[0]['description'] = 'Black wool broadcloth, double breast front, 
missing 3 of 18 raised round gold buttons w/crossed cannon barrels & 
"Ordnance Corps" text, silver sequin & tinsel embroidered emblem 
on each square cut tail, quilted black silk lining, ';
$lots[0]['price'] = 5700.00;

$lots[1]['lot_number'] = '2';
$lots[1]['image'] = "gents-striped-8-26.jpg";
$lots[1]['name'] = "Striped Cotton Tailcoat, America, 1835-1845";
$lots[1]['description'] = 'Orange and white pin-striped twill cotton, 
double breasted, turn down collar, waist seam, self-fabric buttons, 
inside single button pockets in each tail, (soiled, faded, cuff edges
frayed) good.  ';
$lots[1]['price'] = 20700.00;

$lots[2]['lot_number'] = '3';
$lots[2]['image'] = "gents-black-8-27.jpg";
$lots[2]['name'] = "Black Broadcloth Tailcoat, 1830-1845";
$lots[2]['description'] = 'Fine thin wool broadcloth, double breasted, notched collar, horizontal front and side waist seam,
 slim long sleeves with notched cuffs, curved tails, black silk satin lining quilted in diamond pattern,
padded and quilted chest, black silk covered buttons, (buttons worn) excellent. ';
$lots[2]['price'] = 3450.00;

$i = 0; // untuk menghitung jumlah data / baris data
?>

	
<h1>Product Category: Gents</h1>

	<ul class="ulfancy">
			<?php foreach ($lots as $lot) : ?>
			<li class="row<?php echo $i % 2; ?>">
				<div class="list-photo"><a href="images/<?php echo $lot['image']; ?>">
			<?php // Set up the images
			$image = 'images/'. $lot['image'];

			$image_t = 'images/thumbnails/'. $lot['image'];
			if (!is_file($image_t)) :
				$image_t = 'images/thumbnails/nophoto.jpg';
			endif ;

			if (is_file($image)) :
			?>
				<a href="<?php echo $image; ?>">
				<img src="<?php echo $image_t; ?>" alt=""/></a>
			<?php else : ?>
				<img src="<?php echo $image_t; ?>" alt=""/>
			<?php endif; ?>
			<img src="images/thumbnails/<?php echo $lot['image']; ?>" alt="" /></a>
				</div>
				<div class="list-description">
			<h2><?php echo ucwords($lot['name']); ?></h2>
			<p><?php echo htmlspecialchars($lot['description']); ?></p>
			<p>
			<strong>Lot:</strong> #<?php echo $lot['lot_number']; ?>
			<strong>Price:</strong> $<?php echo number_format($lot['price'],2);?>
			</p>
			</div>
			<div class="clearfl oat"></div>
			</li>
			<?php endforeach; ?>
			</ul>


	
	</div><!-- end content -->

	<div class="clearfloat"></div>

	<div id="footer">
	<p>&copy; 2011 Smithside Auctions</p>
	</div><!-- end footer -->

	</div><!-- end container -->
	</body>

	</html>