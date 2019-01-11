
    <table class='table table-condensed table-hover table-striped tablesorter table-fixed' id='storyList'>
      <thead>
      <tr>
        <th class='w-id'>  <?php common::printOrderLink('id',         $orderBy, $vars, $lang->idAB);?></th>
        <th class='w-pri'> <?php common::printOrderLink('cid',        $orderBy, $vars, "CID");?></th>
        <th class='w-80px text-left'> <?php common::printOrderLink('name',      $orderBy, $vars, "Name");?></th>
        <?php 
		foreach($fields as $key => $value): ?>
       <?php 
	   if($key == "part_number") 
	   {
		   $width = "w-100px";
		}
		else
		{
			$width = "w-50px";
		}
	   
	   ?>
        <th class="text-left {sorter:false} <?php echo $width;?>">         <?php common::printOrderLink($key,       $orderBy, $vars, $value->fieldname);?></th>
        <?php endforeach ?>
        
<!--        <th class="w-120px text-left">< ?php common::printOrderLink('dstitle',   $orderBy, $vars, "Datasheet");?></th>
        <th class="w-120px text-left">               < ?php common::printOrderLink('notetsitle',     $orderBy, $vars, "Notes");?></th>
        <th class="w-120px text-left">               < ?php common::printOrderLink('manualtitle',      $orderBy, $vars, "Manual");?></th>-->
        <th class="w-120px text-left">               <?php common::printOrderLink('access',      $orderBy, $vars, "Access");?></th>
        <th class='w-60px {sorter:false}'><?php echo $lang->actions;?></th>
      </tr>
      </thead>
      <?php if($stories):?>
      <tbody>
      <?php foreach($stories as $key => $story):?>
      <?php
      $viewLink = $this->createLink('story', 'view', "storyID=$story->id");
      $canView  = common::hasPriv('story', 'view');
      ?>
      <tr class='text-center'>
        <td class='text-left'>
          <!--<input type='checkbox' name='storyIDList[< ?php echo $story->id;?>]' value='< ?php echo $story->id;?>' />--> 
          
          &nbsp;&nbsp;<?php echo $canView ? html::a($viewLink, sprintf('%04d', $story->id)): sprintf('%04d', $story->id);?>
        </td>
        <td><?php echo $story->cid;?></td>
        <td class='text-left' title="<?php echo $story->name?>"><nobr>
        <?php if(!empty($story->name))  {echo html::a($viewLink, $story->name, null, "style='color: $story->color'") ;}?>
        </nobr></td>
        <?php foreach($fields as $key => $value): ?>
        <td class="text-left"><?php echo $story->cusinfo->$key;?></td>
        <?php endforeach ?>
        
<!--        <td class="text-left"><a href="" title="< ?php echo $story->dstitle;?>">< ?php echo $story->datasheet;?></a></td>
        <td class="text-left"><a href="" title="< ?php echo $story->notestitle;?>">< ?php echo $story->notes;?></a></td>
        <td class="text-left">
         <a href="" title="< ?php echo $story->manualtitle;?>"> < ?php echo $story->manual;?></a>
        </td>-->
        <td class="text-left"><?php echo $story->access;?></td>
        <td class='text-right'>
          <?php 
          $vars = "story={$story->id}";
          common::printIcon('story', 'edit',       $vars, $story, 'list', 'pencil');
          
          ?>
        </td>
      </tr>
      <?php endforeach;?>
      </tbody>
      <?php endif;?>
