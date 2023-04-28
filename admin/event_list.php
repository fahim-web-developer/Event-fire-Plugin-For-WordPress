<?php 
if ( ! defined('ABSPATH')) exit;  // if direct access 

 add_action('admin_menu', 'addAdminPageContent');
 function addAdminPageContent() {
   add_menu_page('Event', 'Event', 'manage_options' ,__FILE__, 'eventAdminPage', 'dashicons-wordpress');
 }
 
  function eventAdminPage() {
       global $wpdb;
       $table_name = $wpdb->prefix . 'event_collection';
   
    if (isset($_GET['del'])) {
      $del_id = $_GET['del'];
      $wpdb->query("DELETE FROM $table_name WHERE id='$del_id'");
      echo "<script>location.replace('admin.php?page=event/admin/event_list.php');</script>";
    }

    if (isset($_POST['uptsubmit'])) {
      $id = $_POST['uptid'];
      $name    =  $_POST["even_name"] ;
      $code    =  $_POST["even_code"] ;
      $date1    =  $_POST["even_date"] ;
      $description    =  $_POST["even_description"] ;
      $address    =  $_POST["even_address"] ;
      $status    =  $_POST["even_status"];
      $wpdb->query("UPDATE $table_name SET name='$name',code='$code',dates ='$date1',description='$description',address='$address',status='$status' WHERE id='$id'");
      echo "<script>location.replace('admin.php?page=event/admin/event_list.php');</script>";
    }
	  
?>
    
<div class="wrap">
  <form action="" method="post">
     <input type="text" id="event_name" name="event_name"></td>
      <input type="submit" name="search_event" value="Search1">
  </form>
</div>
     
<div class="wrap">
  <table class="wp-list-table widefat striped">
    <thead>
        <tr>
          <th>Id</th>
          <th>name</th>
          <th>code</th>
          <th>date</th>
          <th>description</th>
          <th>address</th>
          <th>status</th>
          <th></th>
          <th></th>
        </tr>
    </thead>
     <tbody>
        <?php
        if (isset($_POST['search_event'])) {
          $event_name = $_POST['event_name'];
           $result = $wpdb->get_results("SELECT * FROM $table_name WHERE CONCAT(name, ' ', code, ' ', dates, ' ', status)  LIKE '%".$event_name."%'");
        }else{
          $result = $wpdb->get_results("SELECT * FROM $table_name");
        }
       foreach ($result as $print) { ?>
           <tr>
             <td width='5%'><?= $print->id  ?></td>
             <td><?= $print->name ?></td>
             <td><?= $print->code ?></td>
             <td><?= $print->dates ?></td>
             <td><?= $print->description ?></td>
		         <td><?= $print->address ?></td>
             <td><?= $print->status ?></td>
             <td><a href='admin.php?page=event/admin/event_list.php&upt=<?= $print->id ?>'><button type='button'>UPDATE</button></a> <a href='admin.php?page=event/admin/event_list.php&del=<?= $print->id ?>'><button type='button'>DELETE</button></a></td>
             <tr>
        <?php
       }
     ?>
    </tbody>
  </table>

      <br>
    <br> 
 

    <?php
       if (isset($_GET['upt'])) {
         $upt_id = $_GET['upt'];
         $result = $wpdb->get_results("SELECT * FROM $table_name WHERE id='$upt_id'");
         foreach($result as $print) {
         }
         ?>
          <form action=""  method="post">
              <input type='hidden' id='uptid' name='uptid' value='<?= $print->id ?>'></td>
              <label for="name">Name</label>
              <input type="text" id="name" name="even_name" style="width: 100%;" value="<?= $print->name ?>">
              <br>
              <br>
              <label for="code">Code:</label><br>
               <textarea name="even_code" id="code" rows="10" style="width: 100%;"><?= $print->code ?></textarea>
               <br><br>
                <label for="date">Date:</label><br>
                <input type="date" name="even_date" id="date" style="width: 100%;" value="<?= $print->dates ?>">
                <br><br>
                <label for="description">Description:</label><br>
                <textarea name="even_description" id="description" rows="10" style="width: 100%;"><?= $print->description ?></textarea>
                <br><br>
                <label for="address">Address:</label><br>
                <textarea name="even_address" id="address" rows="10" style="width: 100%;"><?= $print->address ?></textarea>
                <br><br>
                <label for="status">Status:</label><br>
                <input type="text" name="even_status" id="status" style="width: 100%;" value="<?= $print->status ?>">
                 <br><br>
                 <input type="submit" name="uptsubmit" value="Send" style="width: 100%;">
            </form>
           <?php
         }
       
     ?>

</div>  
<?php   
  }
  
