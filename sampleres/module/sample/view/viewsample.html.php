<?php  include '../../common/view/header.html.php';?>
<div id='titlebar'>
  <div class='heading'>
    <strong>ID:<?php echo $sample->id;?>&nbsp;#Device:<?php echo $sample->device;?>&nbsp;</strong>
  </div>
  <div class='actions'>
    <?php
    	ob_start();
        echo "<div class='btn-group'>";
        common::printLink('sample', editsample, "id={$sample->id}","<font color='red'><strong><b>编辑</b></strong></font>");
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
        <legend><?php echo "出库记录";?></legend>
        <div class='content' style="height:650px;overflow:scroll;overflow-x:hidden;overflow-y:scroll;">
        <table style="width:100%;" class='table table-condensed table-hover table-striped tablesorter table-fixed' style="text-align:left;">
        <tr class='colhead'><th>ID</th><th>申请人</th><th>RF</th><th>RequestType</th><th>Part</th><th>Lot</th><th>Package</th><th>出库数量</th><th>价格</th><th>金额</th><th>日期</th></tr>
        <?php $sum=0;
        foreach($out as $v)
        {
        ?>
        <tr>
        <td><?php echo $v->id;?></td>
        <td><?php echo $v->person;?></td>
        <td><?php echo $v->rf;?></td>
        <td><?php echo $v->rtype;?></td>
        <td><?php echo $v->partn;?></td>
		<td><?php echo $v->conn;?></td>
        <td><?php echo $v->package;?></td>
        <td><?php echo $v->aqty; $sum+=$v->aqty;?></td>
        <td><?php echo $v->price;?></td>
        <td><?php echo $v->rev;?></td>
        <td><?php echo $v->rdate;?></td>
        </tr>
        <?php 
        }	
        ?>
		<tr><td colspan='11' align='right'><font size=2 color='red'><b>出库总数量:<?php echo $sum; ?></b></font></td></tr>
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
            <td><?php echo $sample->device;?></td>
          </tr>
          <tr>
            <th class="strong"><?php echo "PE";?></th>
            <td style="color:red;"><?php echo $sample->pe;?></td>
          </tr>
          <tr>
            <th class='strong'><?php echo "Status";?></th>
            <td style="color:red;"><?php echo $sample->status;?></td>
          </tr>
          <tr>
            <th class='strong'><?php echo "Wafer_Code";?></th>
            <td><?php echo $sample->wafer_code;?></td>
          </tr>
          <tr> 
            <th class='strong'><?php echo "数量";?></th>
            <td><?php echo $sample->qty;?></td>
          </tr>
          <tr>
            <th class="strong"><?php echo '库存';?></th>
            <td><?php echo $sample->inventry;?></td>
          </tr>
          <tr>
            <th class="strong"><?php echo '核对';?></th>
            <td><?php echo $lang->sample->hedui[$sample->approve];?></td>
          </tr>
        </table>
      </fieldset>
      <fieldset>
        <legend><?php echo "其他信息";?></legend>
        <table class='table table-data table-condensed table-borderless'>
          <tr>
            <th class='w-80px strong'><?php echo "NO";?></th>
            <td><?php echo $sample->no;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "Project";?></th>
            <td><?php echo $sample->project;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "Option";?></th>
            <td><?php echo $sample->options;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "Mark";?></th>
            <td><?php echo $sample->mark;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "Package";?></th>
            <td><?php echo $sample->package;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "Factory";?></th>
            <td><?php echo $sample->factory;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "包装";?></th>
            <td><?php echo $sample->packagetype;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "WaferLot";?></th>
            <td><?php echo $sample->waferlot;?></td>
         </tr>
		  <tr>
            <th class='w-80px strong'><?php echo "片号";?></th>
            <td><?php echo $sample->ids;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "Arrive Date";?></th>
            <td><?php echo $sample->date;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "创建时间";?></th>
            <td><?php echo $sample->createdate;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "Test";?></th>
            <td><?php echo $sample->test;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "Note";?></th>
            <td><?php echo $sample->note;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "Remark";?></th>
            <td><?php echo $sample->remark;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "订单号";?></th>
            <td><?php echo $sample->ordert;?></td>
         </tr>
         <tr>
            <th class='w-80px strong'><?php echo "创建者";?></th>
            <td><?php echo $sample->openby;?></td>
         </tr>
        </table>
      </fieldset>
    </div>
  </div>
</div>
<?php  include '../../common/view/footer.html.php';?>
