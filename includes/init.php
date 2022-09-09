<?php
session_start();//starts new or resumes existing session
define('MAGIC_QUOTES_ACTIVE', get_magic_quotes_gpc());
define('SITE_KEY',
'd0d48339c3b82db413b3be8fbc5d7ea1c1fd3e2792605d3cbfda1HEM54!!');
require_once 'includes/functions.php';

// Initialize message coming in
$message = '';
if (isset($_SESSION['message'])) {
  $message = htmlentities($_SESSION['message']);
  unset($_SESSION['message']);
}
   // Process based on the task. Default to display
  $task = filter_input(INPUT_POST,'task', FILTER_SANITIZE_STRING);
  switch ($task) {

 case 'contact.maint' :
    // process the maint
    $results = maintContact();
    $message = $results[1];
    // If there is redirect information
    // redirect to that page
    if ($results[0] == 'contactmaint') {
      // pass on new messages
      if ($results[1]) {
        $_SESSION['message'] = $results[1];
      }
      header("Location: index.php?content=contactmaint&id=$results[2]");
      exit;
    }
    break;
  
    case 'category.maint' :
      // process the maint
      $results = maintCategory();
      $message .= $results[1];
      // If there is redirect information
      // redirect to that page
      if ($results[0] == 'categorymaint') {
        // pass on new messages
        if ($results[1]) {
          $_SESSION['message'] = $results[1];
        }
        header("Location: index.php?content=categorymaint&cat_id=$results[2]");
        exit;
      }
      break;  

        case 'contact.delete' :
      // process the delete
      $results = deleteContact();
      $message .= $results[1];
      // If there is redirect information
      // redirect to that page
      if ($results[0] == 'contactdelete') {
        // pass on new messages
        if ($results[1]) {
          $_SESSION['message'] = $results[1];
        }
        header("Location: index.php?content=contactdelete&id=$results[2]");
        exit;
      }
      break;

  case 'category.delete' :
    // Proses the delete 
    $results = deleteCategory();
    $message .= $results[1];
    // If there is redirect inforamtion
    // Redirect to that page
    if ($results[0]== 'categorydelete'){
      // Pass an new message
      if ($results[1]){
        $_SESSION['message'] = $results[1];
      }
      header("Location: index.php?content=categorydelete&cat_id=$results[2]");
      exit;
    }
    break;

    case 'lot.maint' :
      // process the maint
      $results = maintLot();
      $message .= $results[1];
      // If there is redirect information
      // redirect to that page
      if ($results[0] == 'lotmaint') {
        // pass on new messages
        if ($results[1]) {
          $_SESSION['message'] = $results[1];
        }
        $cat_id_in = (int) $_GET['cat_id'];
        header("Location: index.php?content=lotmaint&cat_id=$cat_id_in&lot_id=$results[2]");
        exit;
      }
      break;      
      
      case 'lot.delete' :
        // process the delete
        $results = deleteLot();
        $message .= $results[1];
        // If there is redirect information
        // redirect to that page
        if ($results[0] == 'lotdelete') {
          // pass on new messages
          if ($results[1]) {
            $_SESSION['message'] = $results[1];
          }
          $cat_id_in = (int) $_GET['cat_id'];
          header("Location: index.php?content=lotdelete&cat_id=$cat_id_in&lot_id=$results[2]");
          exit;
        }
        break;        
      
        case'login' :
          //process the login
          $results = userLogin();
          $message .= $results[1];
          // If there is redirect information
          // redirect to that page
          // pass on new messages
          if ($results[0] == 'login') {
            // pass on new messages
          if ($results[1]) {
            $_SESSION['message'] = $results[1];
          }
          header("Location: index.php?content=login");
          exit;
        }
        break;

        case 'logout' :
          // process the login
          $results = userLogout();
          $message .= $results[1];
          // If there is redirect information
          // redirect to that page
          // pass on new messages
          if ($results[0] == 'logout') {
            // pass on new messages
            if ($results[1]) {
              $_SESSION['message'] = $results[1];
            }
            header("Location: index.php?content=logout]");
            exit;
          }
          break;
          
      }

function __autoload($class_name)
{
    try {
        $class_file = 'includes/classes/'. strtolower($class_name) .'.php';
        if(is_file($class_file)) {
            require_once $class_file;
    } else{
        throw new Exception("Unamble to load class $class_name in file $class_file.");
    }
    } catch (Exception $e){
        echo "Exception caught:".$e->getMessage()."\n";
    }

    }
    

  
?>