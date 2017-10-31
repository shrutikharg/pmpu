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
          <a href="#">New</a>
        </li>
      </ul>
      
      <div class="page-header">
        <h2>
          Adding <?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
 
      <?php
      //flash messages
      if(isset($flash_message)){
        if($flash_message == TRUE)
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> new product created with success.';
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
      
      echo form_open_multipart('admin/products/add', $attributes);
      ?>
        <fieldset>
	<div class="control-group">
            <label for="inputError" class="control-label">Product Name</label>
            <div class="controls">
              <input type="text" id="" name="product_name" value="<?php echo set_value('product_name'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
	    <textarea id="" name="description"><?php echo set_value('description'); ?></textarea>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
	 <div class="control-group">
            <label for="inputError" class="control-label">Generic Name</label>
            <div class="controls">
              <input type="text" id="" name="generic_name" value="<?php echo set_value('generic_name'); ?>" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
          </div>
	  
	    <div class="control-group">
            <label for="inputError" class="control-label">Product Image</label>
            <div class="controls">
		<input type="file" name="userfile" id="userfile" />
               <!--<input type="text" id="" name="product_image" value="<?php echo set_value('product_image'); ?>">-->
              <!--<span class="help-inline">Cost Price</span>-->
            </div>
          </div> 
	  
	  <div class="control-group">
            <label for="inputError" class="control-label">Available Strength</label>
            <div class="controls">
              <input type="text" id="" name="avilable_strength" value="<?php echo set_value('avilable_strength'); ?>">
            
            </div>
          </div>  
	  
	  
	<!--  <div class="control-group">
            <label for="inputError" class="control-label">Brand</label>
            <div class="controls">
              <input type="text" id="" name="brand" value="<?php echo set_value('brand'); ?>">
             
            </div>
          </div> 

	<div class="control-group">
            <label for="inputError" class="control-label">Packing</label>
            <div class="controls">
              <input type="text" id="" name="packing" value="<?php echo set_value('packing'); ?>">
             
            </div>
          </div>	
	  
	  
	  <div class="control-group">
            <label for="inputError" class="control-label">Company Name</label>
            <div class="controls">
              <input type="text" id="" name="company_name" value="<?php echo set_value('company_name'); ?>">
            
            </div>
          </div>  
	  
	  
	  <div class="control-group">
            <label for="inputError" class="control-label">Origin</label>
            <div class="controls">
              <input type="text" id="" name="origin" value="<?php echo set_value('origin'); ?>">
             
            </div>
          </div> ----> 
	  
	  
	  <div class="control-group">
            <label for="inputError" class="control-label">Minimum order quanitity</label>
            <div class="controls">
              <input type="text" id="" name="min_order_qty" value="<?php echo set_value('min_order_qty'); ?>">
              <!--<span class="help-inline">Cost Price</span>-->
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
	
	
	  <div class="control-group">
            <label for="inputError" class="control-label">Click here<INPUT type="button" value="Add Row" onclick="addRow('dataTable')" />
 
    <INPUT type="button" value="Delete Row" onclick="deleteRow('dataTable')" /></label>
            <div class="controls">
             <TABLE id="dataTable" width="50%" border="1">	
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
	  
	 
 
    
	
	
 
	  
	  <!--
          <div class="control-group">
            <label for="inputError" class="control-label">Stock</label>
            <div class="controls">
              <input type="text" id="" name="stock" value="<?php echo set_value('stock'); ?>">
            </div>
          </div>          
          <div class="control-group">
            <label for="inputError" class="control-label">Cost Price</label>
            <div class="controls">
              <input type="text" id="" name="cost_price" value="<?php echo set_value('cost_price'); ?>">

            </div>
          </div>
          <div class="control-group">
            <label for="inputError" class="control-label">Sell Price</label>
            <div class="controls">
              <input type="text" name="sell_price" value="<?php echo set_value('sell_price'); ?>">
            </div>
          </div>--->
          <?php
          echo '<div class="control-group">';
            echo '<label for="category_id" class="control-label">Category</label>';
            echo '<div class="controls">';
              //echo form_dropdown('category_id', $options_category, '', 'class="span2"');
              
              echo form_dropdown('category_id', $options_category, set_value('category_id'), 'class="span2"');

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
     