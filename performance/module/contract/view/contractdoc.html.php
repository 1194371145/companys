<?php include '../../common/view/header.html.php';?>

<!-- css -->
<style>
  .contract-lib{
    float: left;display: block;width: 80px;padding: 5px;margin: 0px 3px;
    text-align: center;color: #333;overflow: hidden;text-overflow: ellipsis;
    width:45%;
  }
  .contract-lib:hover{border-color: #2e6dad;background-color: #EBF2F9;color: #2e6dad;}
  .contract-group{
    border: 1px solid #ddd;
    border-top: 0px;
    margin-bottom: 20px;overflow: hidden;   
}
.col-md-3{border: 0px solid #ddd;height:140px;}
.contract-group {
    padding: 10px;
    height: 84px}
.contract-heading{    
  border: 1px solid #ddd;
  overflow: hidden;padding:8px;color: #808080}
</style>

<!-- html -->
<div class='row' style='height:150px;'>
  <!-- 杭州 -->
    <div class='col-md-3'>
      <div class='contract-heading'>
        <?php
        echo html::a(inlink('contractdoclist','type=normal&area=THZ'),'杭州公司合约归档','','style="color:green;"'); 
        ?>
      </div>
      <div class='contract-group'>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=THZ&over=5'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>会审中</p>
          </div>
        </a>
        <a href="<?php echo $this->inLink('contractdoclist','type=mormal&area=THZ&over=1'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>已完成(归档)</p>
          </div>
        </a>
      </div>
    </div>
<!-- 西安 -->
  <div class='col-md-3'>
    <div class='contract-heading'>
      <?php
      echo html::a(inlink('contractdoclist','type=normal&area=TXA'),'西安公司合约归档','','style="color:green;"'); 
      ?>
    </div>
    <div class='contract-group'>
      <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TXA&over=5'); ?>" class='contract-lib'>
        <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
        <div class='contract-name'>
          <p>会审中</p>
        </div>
      </a>
      <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TXA&over=1'); ?>" class='contract-lib'>
        <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
        <div class='contract-name'>
          <p>已完成(归档)</p>
        </div>
      </a>
    </div>
  </div>
<!-- 成都 -->
<div class='col-md-3'>
    <div class='contract-heading'>
      <?php
      echo html::a(inlink('contractdoclist','type=normal&area=TCD'),'成都公司合约归档','','style="color:green;"'); 
      ?>
    </div>
    <div class='contract-group'>
      <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TCD&over=5'); ?>" class='contract-lib'>
        <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
        <div class='contract-name'>
          <p>会审中</p>
        </div>
      </a>
      <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TCD&over=1'); ?>" class='contract-lib'>
        <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
        <div class='contract-name'>
          <p>已完成(归档)</p>
        </div>
      </a>
    </div>
</div>
<!-- 上海 -->
<div class='col-md-3'>
    <div class='contract-heading'>
        <?php
        echo html::a(inlink('contractdoclist','type=normal&area=TSH'),'上海公司合约归档','','style="color:green;"');
        ?>
    </div>
    <div class='contract-group'>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TSH&over=5'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>会审中</p>
          </div>
        </a>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TSH&over=1'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>已完成(归档)</p>
          </div>
        </a>
    </div>
</div>

<!-- SilergyCorp -->
<div class='col-md-3'>
    <div class='contract-heading'>
        <?php
        echo html::a(inlink('contractdoclist','type=normal&area=TCP'),'SilergyCorp合约归档','','style="color:blue;"');
        ?>
    </div>
    <div class='contract-group'>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TCP&over=5'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>会审中</p>
          </div>
        </a>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TCP&over=1'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>已完成(归档)</p>
          </div>
        </a>
    </div>
</div>

<!-- 萨摩亚台湾分公司 -->
<div class='col-md-3'>
    <div class='contract-heading'>
        <?php
        echo html::a(inlink('contractdoclist','type=normal&area=TSM'),'萨摩亚台湾分公司合约归档','','style="color:blue;"');
        ?>
    </div>
    <div class='contract-group'>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TSM&over=5'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>会审中</p>
          </div>
        </a>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TSM&over=1'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>已完成(归档)</p>
          </div>
        </a>
    </div>
</div>

<!-- 南京 -->
<div class='col-md-3'>
    <div class='contract-heading'>
        <?php
        echo html::a(inlink('contractdoclist','type=normal&area=TNJ'),'南京公司合约归档','','style="color:blue;"');
        ?>
    </div>
    <div class='contract-group'>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TNJ&over=5'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>会审中</p>
          </div>
        </a>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TNJ&over=1'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>已完成(归档)</p>
          </div>
        </a>
    </div>
</div>

<!-- 工程合同 -->
<div class='col-md-3'>
    <div class='contract-heading'>
        <?php
        echo html::a(inlink('contractdoclist','type=normal&area=TGC'),'工程合同归档','','style="color:blue;"');
        ?>
    </div>
    <div class='contract-group'>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TGC&over=5'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>会审中</p>
          </div>
        </a>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TGC&over=1'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>已完成(归档)</p>
          </div>
        </a>
    </div>
</div>

<!-- USA -->
<div class='col-md-3'>
    <div class='contract-heading'>
        <?php
        echo html::a(inlink('contractdoclist','type=normal&area=TUS'),'美国分公司合约归档','','style="color:red;"');
        ?>
    </div>
    <div class='contract-group'>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TUS&over=5'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>会审中</p>
          </div>
        </a>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TUS&over=1'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>已完成(归档)</p>
          </div>
        </a>
    </div>
</div>


<!-- 台湾 -->
<div class='col-md-3'>
    <div class='contract-heading'>
        <?php
        echo html::a(inlink('contractdoclist','type=normal&area=TTW'),'台湾分公司合约归档','','style="color:red;"');
        ?>
    </div>
    <div class='contract-group'>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TTW&over=5'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>会审中</p>
          </div>
        </a>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TTW&over=1'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>已完成(归档)</p>
          </div>
        </a>
    </div>
</div>

<!-- 韩国 -->
<div class='col-md-3'>
    <div class='contract-heading'>
        <?php
        echo html::a(inlink('contractdoclist','type=normal&area=TKR'),'韩国分公司合约归档','','style="color:red;"');
        ?>
    </div>
    <div class='contract-group'>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TKR&over=5'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>会审中</p>
          </div>
        </a>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TKR&over=1'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>已完成(归档)</p>
          </div>
        </a>
    </div>
</div>

<!-- 杭州英沃 -->
<div class='col-md-3'>
    <div class='contract-heading'>
        <?php
        echo html::a(inlink('contractdoclist','type=normal&area=TYW'),'杭州英沃公司合约归档','','style="color:red;"');
        ?>
    </div>
    <div class='contract-group'>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TYW&over=5'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>会审中</p>
          </div>
        </a>
        <a href="<?php echo $this->inLink('contractdoclist','type=normal&area=TYW&over=1'); ?>" class='contract-lib'>
          <img src="<?php echo $config->webRoot . 'theme/default/images/main/doc-lib.png'?>" class='file-icon' />
          <div class='contract-name'>
            <p>已完成(归档)</p>
          </div>
        </a>
    </div>
</div>

</div>
<!-- js -->
<script>

</script>
<?php include '../../common/view/footer.html.php';?>
