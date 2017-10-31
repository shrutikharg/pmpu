    <div class="container top">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin").'/'.$this->uri->segment(2); ?>">
            <?php echo ucfirst($this->uri->segment(2));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <a href="#">Update</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Updating <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>

 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> product updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-error">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
      ?>
      
       <?php
      //form data
      $attributes = array('class' => 'form-horizontal', 'id' => '');
      $options_category = array('' => "Select");
      foreach ($category as $row)
      {
		$options_category[$row['id']] = $row['name'];
      }

      //form validation
      echo validation_errors();

      echo form_open_multipart('admin/products/update/'.$this->uri->segment(4).'', $attributes);
      ?>
        <fieldset>
	<div class="control-group">
            <label for="inputError" class="control-label">Product Name</label>
            <div class="controls">
              <input type="text" id="" name="product_name" value="<?php echo $product[0]['product_name']; ?>">
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
	    <textarea id="" name="description"><?php echo $product[0]['description']; ?></textarea>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
	 <div class="control-group">
            <label for="inputError" class="control-label">Generic Name</label>
            <div class="controls">
              <input type="text" id="" name="generic_name" value="<?php echo $product[0]['generic_name']; ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
	  
	    <div class="control-group">
            <label for="inputError" class="control-label">Product Image</label>
            <div class="controls">
		<input type="file" name="userfile" id="userfile" />
               <!--<input type="text" id="" name="product_image" value="<?php echo set_value('product_image'); ?>">-->
              <!--<span class="help-inline">Cost Price</span>-->
	      <img src="<?php echo base_url(); ?>productimages/<?php echo $product[0]['product_image']; ?>" height="50" width="50" />
	      <input type="hidden" id="" name="prdimg" value="<?php echo $product[0]['product_image']; ?>" >
            </div>
          </div> 
	  
	  <div class="control-group">
            <label for="inputError" class="control-label">Available Strength</label>
            <div class="controls">
              <input type="text" id="" name="avilable_strength" value="<?php echo $product[0]['avilable_strength']; ?>">
            
            </div>
          </div>  
  
	  
	  <div class="control-group">
            <label for="inputError" class="control-label">Minimum order quanitity</label>
            <div class="controls">
              <input type="text" id="" name="min_order_qty" value="<?php echo $product[0]['min_order_qty']; ?>">
            </div>
          </div>  

    <SCRIPT language="javascript">
        function addRow(tableID) {
 
            var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
 
            var colCount = table.rows[0].cells.length;
 
            for(var i=0; i<colCount; i++) {
 
                var newcell = row.insertCell(i);
 
                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;                    
                }
            }
        }
 
        function deleteRow(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
 
 
            }
            }catch(e) {
                alert(e);
            }
        }
 
    </SCRIPT>
	
	
	IF you want more Brands and details then<a onclick="document.getElementById('div_name2').style.display='';return false;" 
href="" style="text-decoration:none;border-bottom:1px dotted blue;">
 Click here...</a>
<br />
<div id="div_name2" style="display:none;margin:15px 15px 0px 15px;padding:5px;border:1px solid #aaa;">
<div class="control-group">
            <label for="inputError" class="control-label">Click here<INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />
 
    <INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" /></label>
            <div class="controls">
             <TABLE id="dataTable" width="20%" border="0">	
		<TR>
		<TD><INPUT type="checkbox" name="chk"/></TD>
		<TD><label>BRAND</label><INPUT type="text" name="txtbrand[]"/></TD>
		<TD><label>PACKING</label><INPUT type="text" name="txtpacking[]"/></TD>
		<TD><label>COMPANY</label><INPUT type="text" name="txtcompany[]"/></TD>
		<TD><label>ORIGIN</label><INPUT type="text" name="txtorigin[]"/></TD> 
		</TR>
	      </TABLE>
            </div>
          </div>
<a onclick="document.getElementById('div_name2').style.display='none';return false;" href="" 
style="text-decoration:none;border-bottom:1px dotted blue;">hide</a>
</div>

	<div class="control-group">
	<table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
	        
                <th class="green header">BRAND</th>
                <th class="red header">PACKING</th>
                <th class="red header">COMPANY</th>
                <th class="red header">ORIGIN</th>			
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($subproduct as $row)
              {
                echo '<tr>';		
                echo '<td>'.$row['brand'].'</td>';
                echo '<td>'.$row['packing'].'</td>';
                echo '<td>'.$row['company_name'].'</td>';
                echo '<td>'.$row['origin'].'</td>';
		//echo '<a href="'.site_url("admin").'/products/deletesub/'.$row['subid'].'" class="btn btn-danger">delete</a>';		
		echo '</tr>';
              }
              ?>      
            </tbody>
          </table>
	</div>	  
	  
          <?php
          echo '<div class="control-group">';
            echo '<label for="category_id" class="control-label">Category</label>';
            echo '<div class="controls">';
              
                 echo form_dropdown('category_id', $options_category, $product[0]['category_id'], 'class="span2"');

            echo '</div>';
          echo '</div">';
          ?>

	 
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Save changes</button>
            <button class="btn" type="reset">Cancel</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

    </div>
     