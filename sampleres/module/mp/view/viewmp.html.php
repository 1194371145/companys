<?php  include '../../common/view/header.html.php';?>
<div id='titlebar'>
  <div class='heading'>
    <strong>ID:<?php echo $mp->id;?>&nbsp;#Device:<?php echo $mp->device;?>&nbsp;#Conn:<?php echo $mp->wafer_lot;?></strong>
  </div>
  <div class='actions'>
    <?php
    	ob_start();
        echo "<div class='btn-group'>";
        common::printLink('mp', editmp, "id={$mp->id}","<font color='red'><strong><b>编辑</b></strong></font>");
		echo "&nbsp;&nbsp;";
		 echo "<a style='cursor:pointer;' onclick='javascript:history.back();'><font color='red'><strong><b>返回</b></strong></font></a>";
        echo '</div>';
        $actionLinks=ob_get_contents();
    ?>
  </div>
</div>
<div class='row-table'>
  <div class='col-main'>
    <div class='main'>
      <fieldset>
        <legend><?php echo "出入库记录";?></legend>
        <div class='content' style="height:750px;overflow:scroll;overflow-x:hidden;overflow-y:scroll;">
        <table style="width:100%;margin:0px;padding:0px;">
       <tr style="width:100%;margin:0px;padding:0px;">
       		<td style="width:48%;margin:0px;padding:0px;text-align:center;" valign='top'>
       			<h3 style="width:100%;margin:0px;padding:0px;">入库记录</h3>
       			<table  class='table table-condensed table-hover table-striped tablesorter table-fixed' style='text-align:left;'>
       			<tr class="colhead"><th>Device</th><th>Lot</th><th>数量</th><th>时间</th><th>创建</th></tr>
       			<?php
       			$isum=0;
       			foreach($idata as $v)
       			{ 
       			?>
       			<tr>
       			<td><?php echo $v->device;?></td>
       			<td><?php echo $v->wafer_lot;?></td>
       			<td><?php echo $v->qty;$isum+=$v->qty;?></td>
       			<td><?php echo $v->date;?></td>
       			<td><?php echo $v->openby;?></td>
       			</tr>
       			<?php 
       			}
       			?>
       			<tr><td colspan="5" align="right"><font size=2 color=red><b>入库数量:<?php echo $isum;?></b></font></td></tr>
       			</table>
       		</td>
       		<td style="width:48%;margin:0px;padding:0px;text-align:center;" valign='top'>
       			<h3 style="width:100%;margin:0px;padding:0px;">出库记录</h3>
       			<table  class='table table-condensed table-hover table-striped tablesorter table-fixed' style='text-align:left;'>
       			<tr class="colhead"><th>Partn</th><th>申请人</th><th>数量</th><th>Lot</th><th>创建时间</th></tr>
       			<?php
       			$osum=0;
       			foreach($odata as $v)
       			{ 
       			?>
       			<tr>
       			<td><?php echo $v->partn;?></td>
       			<td><?php echo $v->person;?></td>
       			<td><?php echo $v->aqty;$osum+=$v->aqty;?></td>
				<td><?php echo $v->conn;?></td>
       			<td><?php echo $v->rdate; ?></td>
       			</tr>
       			<?php 
       			}
       			?>
       			<tr><td colspan="5" align="right"><font size=2 color=red><b>出库数量:<?php echo $osum;?></b></font></td></tr>
       			</table>
       		</td>
       </tr>
		</table>
        </div>
      </fieldset>
      <?php include '../../common/view/action.html.php';?>
      <div class='actions'> <?php echo $actionLinks;?></div>
    </div>
  </div>
  <div class='col-side'>
    <div class='main main-side'>
      <fieldset>
        <legend><?php echo "基本信息";?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px text-right strong'><?php echo "Device";?></th>
            <td><?php echo $mp->device;?></td>
          </tr>
          <tr>
            <th class='strong'><?php echo "Package";?></th>
            <td><?php echo $mp->package;?></td>
          </tr>
          <tr>
            <th class="strong"><?php echo "Release_code";?></th>
            <td style="color:red;"><?php echo $mp->release_code;?></td>
          </tr>
          <tr>
            <th class='strong'><?php echo "Wafer_code";?></th>
            <td style="color:red;"><?php echo $mp->wafer_code;?></td>
          </tr>
          <tr>
            <th class='strong'><?php echo "Top_mark";?></th>
            <td><?php echo $mp->top_mark;?></td>
          </tr>
          <tr> 
            <th class='strong'><?php echo "Company";?></th>
            <td><?php echo $mp->company;?></td>
          </tr>
          <tr>
            <th class="strong"><?php echo 'Conn';?></th>
            <td><?php echo $mp->wafer_lot;?></td>
          </tr>
          <tr>
            <th class="strong"><?php echo "数量";?></th>
            <td><?php echo $mp->qty;?></td>
          </tr>
          <tr>
            <th class="strong"><?php echo "时间";?></th>
            <td><?php echo $mp->date;?></td>
          </tr>
          <tr>
            <th class="strong"><?php echo "备注";?></th>
            <td><?php echo $mp->remark;?></td>
          </tr>
        </table>
      </fieldset>
      <fieldset>
        <legend><?php echo "其他信息";?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px strong'><?php echo "箱号";?></th>
            <td><?php echo $mp->no;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "状态";?></th>
            <td><?php echo $mp->status;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "创建日期";?></th>
            <td><?php echo $mp->createdate;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "创建者";?></th>
            <td><?php echo $mp->openby;?></td>
         </tr>
        </table>
      </fieldset>
    </div>
  </div>
</div>
<?php  include '../../common/view/footer.html.php';?>