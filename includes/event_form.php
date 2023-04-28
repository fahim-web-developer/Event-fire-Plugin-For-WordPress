<?php 
if ( ! defined('ABSPATH')) exit;  // if direct access 

function html_form_code(){ ?>
    <form action="<?php esc_url( $_SERVER['REQUEST_URI'] ) ?>"  method="post">
      <label for="name">Name</label>
      <input type="text" id="name" name="even_name" style="width: 100%;">
      <br>
      <br>
      <label for="code">Code:</label><br>
       <textarea name="even_code" id="code" rows="10" style="width: 100%;"></textarea>
       <br><br>
        <label for="date">Date:</label><br>
        <input type="date" name="even_date" id="date" style="width: 100%;">
        <br><br>
        <label for="description">Description:</label><br>
        <textarea name="even_description" id="description" rows="10" style="width: 100%;"></textarea>
        <br><br>
        <label for="address">Address:</label><br>
        <textarea name="even_address" id="address" rows="10" style="width: 100%;"></textarea>
        <br><br>
        <label for="status">Status:</label><br>
        <input type="text" name="even_status" id="status" style="width: 100%;">
         <br><br>
         <input type="submit" name="submitted" value="Send" style="width: 100%;">
    </form>

<?php
}
function deliver_data() {
    

    if ( isset( $_POST['submitted'] ) ) {
        $name    = sanitize_text_field( $_POST["even_name"] );
        $code    = esc_textarea( $_POST["even_code"] );
        $date    = sanitize_text_field( $_POST["even_date"] );
        $description    = esc_textarea( $_POST["even_description"] );
        $address    = esc_textarea( $_POST["even_address"] );
        $status    = sanitize_text_field( $_POST["even_status"] );
        global $wpdb;
        $table_name = $wpdb->prefix . 'event_collection';
        
        $wpdb->query("INSERT INTO $table_name (name,code,dates,description,address,status) VALUES('$name','$code','$date','$description','$address','$status')");
        echo "<script>location.replace('/');</script>";
    }
}

function cf_shortcode() {
    ob_start();
    deliver_data();
    html_form_code();
    return ob_get_clean();
}

add_shortcode( 'event', 'cf_shortcode' );
