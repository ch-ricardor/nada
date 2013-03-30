<style>
/*grid/table listing format*/
table.survey-info{width:550px;float:left;}

.grid-table tr td{padding:5px;border-bottom:1px solid #C1DAD7;}
.grid-table .alternate{background-color:#FBFBFB}
.grid-table a{color:#00679C;text-decoration:none;}
.grid-table a:hover{color:maroon;}
.table-heading-row{}
.table-heading-cell{font-weight:bold;font-size:12px;border-bottom:2px solid #CFD9FE;}
.table-row{}
.table-row-alternate{background:#F7F7F7}
.table-cell,.table-cell-alternate{padding:5px;border-bottom:1px solid #F7F7F7;}
.table a{text-decoration:none;color:#003366}
.table a:hover{text-decoration:underline;color:black}
.links img ,.content-container img {vertical-align:bottom;}
.link-col {float:left;display:block;margin-right:10px;}
.link-col-2{float:left;display:block;}
.es td{background-color:#EAEAEA}
.grid-table td {vertical-align:top;}


/*survey resources summary*/
.resources h3{font-weight:bold;padding-top:10px;font-size:12px;}
.abstract{display:none;margin-bottom:10px;background-color:none;}
.resources .alternate, .resources .resource{border-bottom:1px solid #C1DAD7;padding:5px;width:98%;}
.resources .alternate{background-color:#FBFBFB;}
.resources .alternate:hover, .resources .resource:hover{background-color:#EAEAEA}
.resources fieldset {border:0px;border-top:4px solid gainsboro;margin:0px;padding:0px;margin-top:20px;margin-bottom:10px;padding-top:5px;color:#333333;font-size:12px;}
.resources fieldset legend{font-weight:bold;;padding:5px;text-transform:capitalize;margin-left:10px;}	
.resource-info{cursor:pointer;}
.resource-right-col{float:right;font-size:11px;width:15%;}
.resource-left-col{float:left;width:85%;}
.resource-file-size{display:inline-block;width:100px;text-align:left;color:#999999;}
.tbl-resource-info{padding:0px;margin:0px; border-collapse:collapse}
.resource-info{padding-left:20px;background:url('images/blue-add.png') no-repeat left top;}
.active .resource-info{font-weight:bold;margin-bottom:10px;background:url('images/blue-remove.png') no-repeat left top;}
.resources .active{border:1px solid gainsboro;margin-bottom:20px;}
.resource .caption{font-weight:bold;}

/*study info - stats */
.study-statistics-box{
background: white;
height: 200px;
width: 218px;
float: right;
padding: 10px;
color: #666;
font-size: 11px;
border: 3px solid gainsboro;
}

.study-statistics-box .btn-download-ddi{background:url(images/ddi.gif) no-repeat left center; display:block;padding:4px;padding-left:32px;}
.study-statistics-box .btn-download-rdf{background:url(images/rdf.gif) no-repeat left center; display:block;padding:4px;padding-left:32px;}

.btn-container{background:url(themes/wb/btn-bg-sprites.png) 100% 100%; padding:5px 10px;background:#F0F0F0;border:1px solid gainsboro;margin-top:5px;}
.btn-container a{display:block;}
.btn-container a:hover{color:maroon;}
.btn-container:hover{border:1px solid black;}

.grid-table .no-border td{border:none;}
.content-container .collection-thumb-container{margin-top:5px;height:150px;width:100px;float:left;margin-right:20px;overflow:hidden;}

</style>

<div class="content-container" style="overflow:auto;">
	<?php if ($this->input->get("print")) :?>
    <div style="padding-bottom:20px;">
        <h1><?php echo $nation;?> - <?php echo $titl;?></h1>
    </div>
    <?php endif;?>

<?php if ($owner_repo['thumbnail']!=''):?>
<div class="collection-thumb-container">
	<a href="<?php echo site_url('catalog/'.$owner_repo['repositoryid']);?>">
    <img src="<?php echo $owner_repo['thumbnail'];?>" width="100%;" alt="<?php echo $owner_repo['repositoryid'];?>" title="<?php echo $owner_repo['title'];?>"/>
    </a>
</div>
<?php endif;?>

<table class="grid-table survey-info" cellspacing="0">
	<tr>
    	<td><?php echo t('refno');?></td>
        <td><?php echo $refno;?></td>
    </tr>
	<tr>
    	<td style="width:100px;"><?php echo t('year');?></td>
        <td><?php 
				if ($data_coll_start==$data_coll_end)
				{
					echo $data_coll_start;
				}
				else
				{
					if ($data_coll_start!='')
					{
						$dates[]=$data_coll_start;
					}
					if ($data_coll_end!='')
					{
						$dates[]=$data_coll_end;
					}						
					echo implode(" - ", $dates);
				}?>
        </td>
    </tr>
	<?php if ($nation!=''):?>
	<tr>
    	<td><?php echo t('country');?></td>
        <td><?php echo $nation;?></td>
    </tr>
	<?php endif;?>
	<tr valign="top">
    	<td><?php echo t('producers');?></td>
        <td>
        	<?php if (isset($authenty)):?>
				<?php $authenty_arr=json_decode($authenty);?>
                <?php if (is_array($authenty_arr)):?>
                    <?php echo implode("<BR>",$authenty_arr);?>
                <?php else:?>
                    <?php echo $authenty;?>
                <?php endif;?>
            <?php endif;?>    
        </td>
    </tr>
    <?php if (strlen($sponsor)>5):?>
	<tr valign="top">
    	<td><?php echo t('sponsors');?></td>
        <td><?php echo $sponsor;?></td>
    </tr>
    <?php endif;?>

	<?php if (isset($repositories) && is_array($repositories)):?>
	<tr valign="top">
    	<td><?php echo t('collections');?></td>
        <td>
		<?php foreach($repositories as $repository):?>
			<div><?php echo anchor('catalog/'.$repository['repositoryid'],$repository['title']);?></div>
		<?php endforeach;?>
        </td>
    </tr>
	<?php endif;?>

	<?php $report_file=unix_path($this->survey_folder.'/ddi-documentation-'.$this->config->item("language").'-'.$id.'.pdf');?>
    <?php if (file_exists($report_file)):?>    
    <tr>
    	<td><?php echo t('metadata');?></td>
        <td class="links">                                
            <span class="link-col">
                <a href="<?php echo site_url()."/ddibrowser/$id/export/?format=pdf&generate=yes";?>" title="<?php echo t('pdf');?>" rel="nofollow">
                <img border="0" title="<?php echo t('link_pdf');?>" alt="PDF" src="images/pdf.gif" /> <?php echo t('Documentation in PDF');?>
                </a>
            </span>    
        </td>
    </tr>
	<?php endif;?>
    
    <tr>
    	<td><?php echo t('data');?></td>
        <td>
            <!--access policy -->
            <span class="link-col">
            <a id="ap-<?php echo $id;?>" class="accesspolicy"  title="<?php echo t('link_access_policy_hover');?>" href="<?php echo site_url().'/catalog/'.$id.'/accesspolicy/';?>">
                <span><img src="images/page_white_key.png" /> <?php echo t('link_access_policy');?></span>
            </a>
            </span>
            			
                <!--data access -->
                <?php if ($model!=''):?>
                <span class="link-col-2">
                <?php if($model=='direct'): ?>
                    <a href="<?php echo site_url().'/access_direct/'.$id;?>" class="accessform" title="<?php echo t('link_data_direct_hover');?>">
                    <span><img src="images/form_direct.gif" /> <?php echo t('link_data_direct_hover');?></span>
                    </a>                    
                <?php elseif($model=='public'): ?>                    
                    <a href="<?php echo site_url().'/access_public/'.$id;?>" class="accessform"  title="<?php echo t('link_data_public_hover');?>">
                    <span><img src="images/form_public.gif" /> <?php echo t('link_data_public_hover');?></span>
                    </a>                    
                <?php elseif($model=='licensed'): ?>
                    <a href="<?php echo site_url().'/access_licensed/'.$id;?>" class="accessform"  title="<?php echo t('link_data_licensed_hover');?>">
                    <span><img src="images/form_licensed.gif" /> <?php echo t('link_data_licensed_hover');?></span>
                    </a>                    
                <?php elseif($model=='data_enclave'): ?>
                    <a href="<?php echo site_url().'/access_enclave/'.$id;?>" class="accessform"  title="<?php echo t('link_data_enclave_hover');?>">
                    <span><img src="images/form_enclave.gif" /> <?php echo t('link_data_enclave_hover');?></span>
                    </a>                    
                <?php elseif($model=='remote'): ?>
                    <?php if (isset($link_da) && strlen($link_da)>1):?>
                        <a target="_blank" href="<?php echo $link_da;?>"  title="<?php echo t('link_data_remote_hover');?>">
                        <span><img src="images/form_remote.gif" /> <?php echo t('link_data_remote_hover');?></span>
                        </a>                    
                    <?php endif; ?>
                <?php endif; ?>
                </span>
                <?php endif;?>
                 
		</td>	            
	</tr>
    
    <?php if($link_indicator!='' || $link_study!=''): ?>
    <tr>
    <td></td>
    <td>
			<!-- indicators -->
            <span class="link-col">
			 <?php if($link_indicator!=''): ?>
                <a target="_blank"  href="<?php echo site_url().'/catalog/download/'.$id.'/'.base64_encode($link_indicator);?>" title="<?php echo t('link_indicators_hover');?>">
                    <img border="0" alt="<?php echo t('link_indicators');?>" src="images/page_white_database.png" /> <?php echo t('link_indicators_hover');?>
                </a>
            <?php endif; ?>
	        </span>
            
            <span class="link-col">
            <?php if($link_study!=''): ?>
                    <a  target="_blank" href="<?php echo site_url().'/catalog/download/'.$id.'/'.base64_encode($link_study);?>" title="<?php echo t('link_study_website_hover');?>">
                        <img border="0" title="<?php echo t('link_study_website_hover');?>" alt="<?php echo t('link_study_website');?>" src="images/page_white_world.png" /> <?php echo t('link_study_website');?>
                    </a>
            <?php endif; ?>
        	</span>
        </td>
    </tr>
    <?php endif;?>
    
   
    
</table>

<div class="study-statistics-box">
<table class="grid-table">
 <tr>
    <td>Created On</td>
    <td><?php echo date("M d, Y",$created);?></td>
    </tr>
    <tr>
    <td>Last Modified</td>
    <td><?php echo date("M d, Y",$changed);?></td>
    </tr>
<tr>
	<td>Page Views</td>
    <td><?php echo $total_views;?></td>
</tr>
<tr>
	<td>Downloads</td>
    <td><?php echo $total_downloads;?></td>
</tr>
<tr class="no-border">
	<td colspan="2">
    <div style="margin-top:5px;"/>
<div class="btn-container"><span class="btn btn-download-ddi"><a href="<?php echo site_url('catalog/ddi').'/'.$id;?>">Download DDI</a></span></div>
<div class="btn-container"><span class="btn btn-download-rdf"><a href="<?php echo site_url('catalog/rdf').'/'.$id;?>">Download RDF</a></span></div>
    </td>
</tr>
</table>


</div>


</div>