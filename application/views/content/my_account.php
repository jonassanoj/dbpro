	<?php
				if (isset($error))
					echo $error;
 ?>
 <?php $attribute = array("id" => "user_update_form", "name" => "user_update_form", "size" => "20");
	echo form_open_multipart('user/do_upload');
 ?>
        
    <table width="100%" border="0" cellpadding="4" cellspacing="6" class="table">
          <tr>
            <td width="25%"  align="center" valign="top">
            </td>
              <td colspan="2" align="left"><h3>My profile</h3></td>
              <td><input type="hidden" id="hidden_image" name="hidden_image" 
              value="<?php
				if (isset($imagePath))
					echo $imagePath;
 ?>" /></td>
         </tr>
         <tr>
            <td width="25%" rowspan="8" align="right" valign="top" >
            <img src="<?php
				if (isset($imagePath))
					echo base_url().$imagePath;
 ?>" 
            alt="Your image" width="120" height="120" align="bottom" border="1" /> <br />
            </td>
            <td width="12%" align="right">Full Name</td>
            <td width="30%">
            <input type="text" name="fullName" id="fullName" class="input"
            value = "<?php
				if (isset($fullName))
					echo $fullName;
 ?>"/>
            </td>
            <td width="33%">&nbsp;</td>
          </tr>
          <tr>
            <td align="right">Email</td>
            <td>
            <input type="text" name="email" id="email" class="input"
            value = "<?php
				if (isset($email))
					echo $email;
 ?>"/>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">Date of birth</td>
            <td>
            <input type="text" name="dateOfBirth" id="dateOfBirth" class="input"
            value = "<?php
				if (isset($dateOfBirth))
					echo $dateOfBirth;
 ?>"/>
            
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">Organization</td>
            <td>
            <input type="text" name="organization" id="organization" class="input"
            value = "<?php
				if (isset($organization))
					echo $organization;
 ?>"/>
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">Location</td>
            <td>
            <input type="text" name="location" id="location" class="input" class="input"
            value = "<?php
				if (isset($location))
					echo $location;
			?>"/>
            
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>  
            <td align="right">Profile Image</td>
            <td><input type="file" name="userfile" size="20" id="imagePath" /></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">Field of Study </td>
            <td><select name="fieldofstudy" id="fieldofstudy" class="select">
            	<?php 
					
					foreach($fields as $field) {
						if($fieldID == $field -> fieldID){ ?> 
							<option value="<?php echo $field -> fieldID; ?>"  selected='selected' >
							<?php echo $field -> fieldName; ?></option>; 
							<?php }
								else {
						?>
						<option value="<?php echo $field -> fieldID; ?>" ><?php echo $field -> fieldName; ?></option>
                   <?php }

							}
				?>
            </select></td>
            <td>&nbsp;</td>
          </tr>
          </tr>
          <tr>
            <td align="right">Degree</td>
            <td>
            <input type="text" name="degree" id="degree" class="input" class="input"
            value = "<?php
				if (isset($degree))
					echo $degree;
			?>"/>
            
            </td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td valign="top" align="right">
			
			</td>
            <td colspan="2"><input type="submit" name="update" id="update" value="Update Profile" />
            
            </td>
          </tr>
  </table>
</form>
<?php 
echo form_open('user/delete');
echo lang('title_delete_user','delete');
echo form_submit('delete',lang('form_delete'));
echo form_close();
?>