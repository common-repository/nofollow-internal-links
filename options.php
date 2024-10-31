<div class="wrap">
	    <h2>Nofollow Internal Links Settings</h2>
<ul> 	
    <li>
      <a href="https://www.pandasilk.com/wordpress-nofollow-internal-links-plugin/" target="_blank">Documents and Troubleshooting
      </a>
    </li> 	
    <li>
      <a href="https://wordpress.org/support/plugin/nofollow-internal-links" target="_blank">Support Forum on WordPress.org
      </a>
    </li>
  </ul>   
    <?php screen_icon(); ?>
    
	<form action="options.php" method="post" id="<?php echo $plugin_id; ?>_options_form" name="<?php echo $plugin_id; ?>_options_form">
    
	<?php settings_fields($plugin_id.'_options'); ?>
    <table>
		<tbody>
		   <tr>
			 <td>
<h3>Nofollow The Following Internal Links</h3>		 
<p><label><input type="checkbox" name="NIL1" value="1"<?php checked(1,get_option('NIL1'));?> /> Read More Link</label></p>
<p><label><input type="checkbox" name="NIL2" value="1"<?php checked(1,get_option('NIL2'));?> /> Tag Cloud</label></p>
<p><label><input type="checkbox" name="NIL3" value="1"<?php checked(1,get_option('NIL3'));?> /> Post Tags</label></p>
<p><label><input type="checkbox" name="NIL4" value="1"<?php checked(1,get_option('NIL4'));?> /> Archive Links</label></p>
<p><label><input type="checkbox" name="NIL5" value="1"<?php checked(1,get_option('NIL5'));?> /> Category List</label></p>
<p><label><input type="checkbox" name="NIL6" value="1"<?php checked(1,get_option('NIL6'));?> /> Post Category</label></p>
<p><label><input type="checkbox" name="NIL7" value="1"<?php checked(1,get_option('NIL7'));?> /> Post Author</label></p>
<p><label><input type="checkbox" name="NIL8" value="1"<?php checked(1,get_option('NIL8'));?> /> Comments Popup Link</label></p>
             </td>
		   </tr>
		</tbody>
		

		<tfoot>
		   <tr>
			 <th><input type="submit" name="submit" value="Save Settings" class="button-primary"/></th>
		   </tr>
		</tfoot>
	</table>
    
	</form>
    
</div>