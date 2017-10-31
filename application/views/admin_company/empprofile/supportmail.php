    <div id="content">
	<div class="container">
      
      <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("admin_company"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li>
          <a href="<?php echo site_url("admin_company").'/'.$this->uri->segment(2); ?>">
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
         Support<?php echo ucfirst($this->uri->segment(2));?>
        </h2>
      </div>
     
	   <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'send')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Your message send properly .';
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
		//form validation
		echo validation_errors();	  
		echo form_open_multipart('admin_company/supportmail', $attributes);     
      ?>
	  
        <fieldset>         

		<div class="control-group">
            <label for="inputError" class="control-label"> Subject </label>
            <div class="controls">
              <input type="text" id="" name="subname" >
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		
		
		<div class="control-group">
            <label for="inputError" class="control-label">Description</label>
            <div class="controls">
	    <textarea id="" name="description"> </textarea>
              <!--<span class="help-inline">Woohoo!</span>-->
            </div>
        </div>
		  
          <div class="form-actions">
            <button class="btn btn-primary" type="submit">Send Mail</button>
          </div>
        </fieldset>

      <?php echo form_close(); ?>

       </div>
    </div> 