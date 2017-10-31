<style type="text/css">
p {
    margin: 0;
    text-align: justify;
}
hr {
    border-top: 1px dashed #dedbdb !important;
    margin-bottom: 23px;
    margin-top: 8px;
}
.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12{padding-left:6px!important;}
 .col-sm-12, .col-md-12, .col-lg-12{margin-bottom:15px;}
</style>
<?php
foreach($cardiaccare as $catname)         
	{
		$catgename=$catname['catgname'];
	}
?>
    <section class="post-wrapper-top jt-shadow clearfix">
		<div class="container">
			<div class="col-lg-12">
				<h2><?php echo $catgename;?></h2>
                <ul class="breadcrumb pull-right">
                    <li><a href="home" class="breadcrumb-color">Home</a></li>
                    <li>Products</li>
                </ul>
			</div>
		</div>
	</section><!-- end post-wrapper-top -->

    <?php
     include 'dbfile.php';
	foreach($cardiaccare as $row)         
	{
		$productid=$row['id'];
	?>
	
	 <section class="white-wrapper">
    	<div class="container">
        	<div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 single-portfolio">
                	<div class="col-sm-3">
			<?php 
			if(!empty($row['product_image']))
			{ 
			?>
                        <div class="portfolio_item">
                            <div class="entry">			    
                                <img class="img-responsive" alt="" height="250" width="250" src="<?php echo base_url(); ?>productimages/<?php echo $row['product_image'];?>">
                              
                            </div><!-- entry -->
                        </div><!-- end portfolio_item -->
			<?php			
			}
			?>
                    </div><!-- end col-sm-6 -->
                	<div class="col-sm-6">
                    	<div class="title">
                        	<h2><?php echo $row['product_name']; ?></h2>
                        </div><!-- end title -->	
			<p><?php  echo $row['description']; ?></p>                        
                        <div class="product_details">
						 <div class="doc">
                            	<?php  //echo $row['avilable_strength']; 
				if(!empty($row['avilable_strength']))
				{
					$arrrnw=(explode(',', $row['avilable_strength'], -1));					
				}
				?>
                                <div id="countdown">
                                    <div class="stat f-container">
                                    <div class="f-element col-xs-12" align="left">
                                    <div class="highlight">Strengths:
				    <span style="font-color:#f0f0f0 !important"><?php echo $row['avilable_strength'] ;?></span>  
				    </div>				    
                                    </div>
                                      
                                    </div><!-- stat -->
                                </div><!-- end countdown -->
                            </div>                
                        </div><!-- end product_details -->
                    </div><!-- end col-sm-6 -->
                    <div class="col-sm-3">
				<div class="widget">
		<?php	
		//}
		
		$prdidshow=$row['prdid'];		
                 $pdo = Database::connect();
		 $sql = 'SELECT *  FROM products  LEFT JOIN subdetailsproduct ON subdetailsproduct.productid = products.id  WHERE products.id ='.$prdidshow;
                 foreach ($pdo->query($sql) as $row) {
		 if(!empty($row['brand']))
		 {
		?>			
		<div id="accordion-second" class="clearfix">
                        <div class="accordion" id="accordion2">
                          <div class="accordion-group">
                            <div class="accordion-heading active">
                              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#<?php echo $row['brand'];?>">
                                <em class="fa fa-caret-right icon-fixed-width"></em><?php echo $row['brand']; ?>
                              </a>
                            </div>
                            <div id="<?php echo $row['brand'];?>" class="accordion-body collapse">
                              <div class="accordion-inner">
                              <ul class="accord">
                                <li><div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 border"> <div class="col-sm-4"><span class="accord-heading">Company</span></div> <div class="col-sm-8"><?php  echo $row['company_name']; ?></div></div></li>                              
  							    <li><div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 border"> <div class="col-sm-4"><span class="accord-heading">Packing</span></div><div class="col-sm-8"><?php echo $row['packing']; ?></div></div></li>
  								<li><div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 border"> <div class="col-sm-4"><span class="accord-heading">Origin</span></div><div class="col-sm-8"><?php echo $row['origin']; ?></div></div></li>
							 </ul>
                              </div>
                            </div>
                          </div>
			  <?php
			  }
			  }
			 Database::disconnect();
			?>
                        
                        </div><!-- end accordion -->
                    </div><!-- end accordion first -->
                </div><!-- end widget -->
				</div>
                   
                </div><!-- end col-lg-12 -->
                
            </div><!-- end row -->    
		</div><!-- end container -->
		
		
    </section>
	
	<?php
	
	}
	?>
        <div class="clearfix"></div>