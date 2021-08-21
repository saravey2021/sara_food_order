<!--Header Admin include-->
<?php
  include('../AdminInclude/header.php');
?>

<!--Main Content Section Starts-->
<div class="main-wrapper">
  <div class="maincontainer">
    <h1></h1><br><br>
      <?php
        if (isset($_SESSION['login'])) {
          echo $_SESSION['login'];//Displaying Session Message
          unset($_SESSION['login']);//Removing Session Message
        }
      ?>  <br><br><br><br>
  </div>
</div>
<!--Maun Content Section Ends-->