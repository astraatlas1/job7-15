<?php
  $items = Contact::getContacts();	
  $accessLevel = Contact::accessLevel();
 ?>
<h1>About Us 
  <?php if ($accessLevel == 'Admin') : ?>
  <a class="button" href="index.php?content=contactmaint&id=0">Add</a>
  <?php endif; ?>
</h1>
<p>We are all happy to be a part of this. Please contact anyof us with questions.</p>

<ul class="ulfancy">
  <?php foreach ($items as $i => $item): ?>
    <li class="row<?php echo $i %2 ?> ">
      <h2>
        <?php echo htmlspecialchars($item->name()); ?>	
        <?php if ($accessLevel == 'Admin') : ?>
      <a class="button" href="index.php?content=contactmaint&id=<?php echo $item->getId();  ?>">
      Edit
    </a>
    <a class="button" href="index.php?content=contactdelete&id=<?php echo $item->getId(); ?>">
  Delete
  </a>
  <?php endif; ?>
    </h2>
      <p>Position: <?php echo htmlentities($item->getPosition()) ?><br />
      Email: <?php echo htmlentities($item->getEmail()) ?><br />
      Phone: <?php echo htmlentities($item->getPhone()) ?><br /></p>
    </li>
  <?php endforeach ?>
</ul>

	</div><!-- end content -->
	
	<div class="clearfloat"></div>
	


</div><!-- end container -->
</body>
</html>
