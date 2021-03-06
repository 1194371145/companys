<?php include '../../common/view/header.html.php';?>
<div class='block' id='productbox'>
<div id='querybox' style="margin-top:0px;" class="<?php if($type!='bysearch'){echo "show";}?>"><?php echo $searchForm?></div>
<form method='post' action='<?php echo inLink('batchEdit', "productID=$productID");?>' id='productsForm'>
  <table class='table table-condensed table-hover table-striped tablesorter table-datatable' id='performancetList' style="margin-top:20px;">
    <?php $vars = "CID=$CID&status=$status&param=0&orderBy=%s&recTotal={$pager->recTotal}&recPerPage={$pager->recPerPage}&pageID={$pager->pageID}";?>
    <thead>
      <tr>
        <th class='w-id text-left' ><?php common::printOrderLink('id', $orderBy, $vars, $lang->idAB);?></th>
        <th class='w-90px text-left' text-left><?php common::printOrderLink('staffcode', $orderBy, $vars, $lang->performance->staffcode);?></th>
        <th class="w-60px text-left"><?php common::printOrderLink('circle', $orderBy, $vars, $lang->performance->circle);?></th>
        <th class='w-90px text-left'><?php echo "Name";?></th>
        <th class='w-90px text-left'><?php echo "Position";?></th>
        <th class='w-80px text-left'><?php echo "Supervisor";?></th>
        <th class='w-200px text-left'><?php echo "Employee's Statement";?></th>
        <th class="w-200px text-left"><a title="评估者综合  评估总结,总结主要优点"><?php echo "Employee's strength";?></th>
        <th class="w-200px text-left"><a title="确定改进及发展需求"><?php echo "Improvements and development";?></th>
        <th class='w-90px text-left'>Update Date</th>
        <th class='w-70px text-left'>Score</th>
        <th class='w-60px text-left'>Status</th>
        <th class='w-160px text-left' style="color:#304269">Action</th>
      </tr>
    </thead>
    <tbody class='sortable' id='productTableList'>
      <?php foreach($perlists as $k=>$v){?>
      
      <tr class='text-left' data-id='<?php echo $v->id ?>' data-order='<?php echo $v->id ; ?>'>
        <td>
          <?php echo  $v->id ;?>
        </td>
        <td><?php echo $v->staffcode;?></td>
        <td><?php if($v->zhouqi !=""){ echo substr($v->zhouqi,0,4)." ".substr($v->zhouqi,4,1)."H";}?></td>
        <td><?php echo $v->name;?></td>
        <td class='text-left' title='<?php echo $v->zhiwei?>'>
		<?php
		echo $v->zhiwei;
		?>
        </td>
        <td class='text-left'><a  title="<?php echo $v->zgname;?>"><?php echo $v->zgname;?></a></td>
        <td class='text-left'><a  title="<?php echo $v->statement;?>">
		<?php
		if(strlen($v->statement) < 40)
		{
		   echo $v->statement;
		}
		else
		{
		   echo html::msubstr($v->statement,0,38)."...";
		}
		
		?>
        </a></td>
        <td class='text-left' title="<?php echo $v->review_strength;?>">
        <?php
		if(strlen($v->review_strength) < 40)
		{
		   echo $v->review_strength;
		}
		else
		{
		   echo html::msubstr($v->review_strength,0,38)."...";
		}
		?>
        </td>
        <td class='text-left' title="<?php echo $v->review_improve;?>">
        <?php
		if(strlen($v->review_improve) < 50)
		{
		   echo $v->review_improve;
		}
		else
		{
		   echo html::msubstr($v->review_improve,0,38)."...";
		}
		?>
        </td>
        <td><?php echo $v->adddate;?></td>
        <td><?php echo $v->total;?></td>
        <td class='text-left'><?php 
         echo $v->status;
		?>
        </td>
        <td class='text-left'>
		<?php echo html::a($this->createLink('performance', 'see', "PID=$v->id"), "View" ,"","style='color:#304269' class='see'");?>
        </td>
        
      </tr>
      <?php };?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan='13'>
          <div class='table-actions clearfix'>
          </div>
          <div class='text-right'><?php $pager->show();?></div>
        </td>
      </tr>
    </tfoot>
  </table>
</form>
</div>
<?php include '../../common/view/footer.html.php';?>