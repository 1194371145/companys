<?php
/**
 * The control file of admin module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2013 青岛易软天创网络科技有限公司 (QingDao Nature Easy Soft Network Technology Co,LTD www.cnezsoft.com)
 * @license     LGPL (http://www.gnu.org/licenses/lgpl.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     admin
 * @version     $Id: control.php 4460 2013-02-26 02:28:02Z chencongzhi520@gmail.com $
 * @link        http://www.zentao.net
 */
class admin extends control
{
    /**
     * Index page.
     * @access public
     * @return void
     */
    public function index()
    {
    	/*$url=$this->createLink('mail','index');
    	$this->locate($url);
        $community = zget($this->config->global, 'community');
        if(!$community or $community == 'na')
        {
            $this->view->bind    = false;
            $this->view->account = false;
            $this->view->ignore  = $community == 'na';
        }
        else
        {
            $this->view->bind    = true;
            $this->view->account = $community;
            $this->view->ignore  = false;
        }
		$this->app->loadLang('misc');
        $this->view->title      = $this->lang->admin->common;
        $this->view->position[] = $this->lang->admin->index;*/
		$this->display();
    }
    
    public function template($id="")
    {
    	if(!empty($id))
    	{
    		if($id==1){$file_name="mpbasic.xls";}
    		if($id==2){$file_name="mpin.xls";}
    		if($id==3){$file_name="mpout.xls";}
    		if($id==4){$file_name="sample.xls";}
    		if($id==5){$file_name="sample.xls";}
    		if($id==6){$file_name="sampleout.xls";}
    		$file_dir = '../../www/data/template/';
			$file = fopen ( $file_dir . $file_name, "r" );
			Header ( "Content-type: application/octet-stream" );
			Header ( "Accept-Ranges: bytes" );
			Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );
			Header ( "Content-Disposition: attachment; filename=" . $file_name);
			echo fread ( $file, filesize ( $file_dir . $file_name ) );
			fclose ( $file );
			exit ();
    	}
    	$this->display();
    }

	/**
	 * Ignore notice of register and bind.
	 * 
	 * @access public
	 * @return void
	 */
	public function ignore()
	{
		$this->loadModel('setting')->setItem('system.common.global.community', 'na');
		die(js::locate(inlink('index'), 'parent'));
	}

	/**
	 * Register zentao.
	 * 
	 * @access public
	 * @return void
	 */
	public function register()
	{
		if($_POST)
		{
			$response = $this->admin->registerByAPI();
			if($response == 'success') 
			{
				$this->loadModel('setting')->setItem('system.common.global.community', $this->post->account);
				echo js::alert($this->lang->admin->register->success);
				die(js::locate(inlink('index'), 'parent'));
			}
			die($response);
		}
        $this->view->title      = $this->lang->admin->register->caption;
        $this->view->position[] = $this->lang->admin->register->caption;
		$this->view->register   = $this->admin->getRegisterInfo();
		$this->view->sn         = $this->config->global->sn;
		$this->display();
	}

	/**
	 * Bind zentao.
	 * 
	 * @access public
	 * @return void
	 */
	public function bind()
	{
		if($_POST)
		{
			$response = $this->admin->bindByAPI();	
			if($response == 'success') 
			{
				$this->loadModel('setting')->setItem('system.common.global.community', $this->post->account);
				echo js::alert($this->lang->admin->bind->success);
				die(js::locate(inlink('index'), 'parent'));
			}
			die($response);
		}
        $this->view->title      = $this->lang->admin->bind->caption;
        $this->view->position[] = $this->lang->admin->bind->caption;
		$this->view->sn         = $this->config->global->sn;
		$this->display();
	}

    /**
     * Check all tables.
     * 
     * @access public
     * @return void
     */
    public function checkDB()
    {
        $tables = $this->dbh->query('SHOW TABLES')->fetchAll();
        foreach($tables as $table)
        {
            $tableName = current((array)$table);
            $result = $this->dbh->query("REPAIR TABLE $tableName")->fetch();
            echo "Repairing TABLE: " . $result->Table . "\t" . $result->Msg_type . ":" . $result->Msg_text . "\n";
        }
    }

    /**
     *申请记录同步产线
     * 实现功能如下:本地zt_out表中proline为空的数据需要从另一个数据库表zt_wgcprorelease中根据partnumber字段来进行查找数据并匹配到zt_out表中
     * 本接口实现的是原生sql执行批量更新操作
     */
    public function sqjltbcx()
    {
        //查询所以空的数据zt_out
        $array=$this->dao->select('partn')->from('zt_out')->where('proline')->eq('')
			//->andWhere('id')->in(array(13,10,4,9))
		    ->andWhere('close')->eq('wait')
			->fetchPairs('partn','partn');
        // 需要同步的数据partn类型字符串
        $dbms='mysql'; //数据库类型
        $host=$this->config->db->host16; //数据库主机名
        $dbName=$this->config->db->name16inside;; //使用的数据库
        $user=$this->config->db->user16; //数据库连接用户名
        $pass=$this->config->db->password16;  //对应的密码
        $dsn="$dbms:host=$host;dbname=$dbName";
        try {
            $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
        } catch (PDOException $e) {
             die ("Error!: " . $e->getMessage() . "<br/>");
        }
        $rows=[];
        $rewms=[];
        foreach ($array as $value){
            $val=$value[partn];
            $val_arr=["partn"=>$val];
            $sql="select proline from zt_wgcprorelease where partnumber ='$val' ";
            $res=$dbh->query($sql);
            $rewms= $res->fetch(PDO::FETCH_ASSOC);
            $rewms_merge=array_merge($rewms,$val_arr);
            $rows[]=$rewms_merge;//$row_count = $stmt->rowCount(); //记录数，2
        }
        $arrayresq= $this->admin->batchUpdate($rows, 'partn');//高效批量修改方案
//        print($arrayresq);die;//print_r($rows);die;
        $result=$this->dao->query($arrayresq)->exec();
        $rows = null;$pdo = null;//释放查询结果并关闭连接



        $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
		foreach ($array as $v)
		{
			$sql="select newproline from zt_wgcprorelease where partnumber like'%$v%' ";
			$res=$dbh->query($sql);
			$rewms= $res->fetch(PDO::FETCH_ASSOC);
			if($rewms)$this->dao->update('zt_out')->set('proline')->eq($rewms['newproline'])->where('partn')->eq($v)->exec();
		}
		echo "<script type='text/javascript'>alert('Success!!');</script>";
    }

    /**
     * 同步zt_mp表格（device匹配partnumber）
     * 实现功能如下:本地zt_out表中proline，ae为空的数据需要从另一个数据库表zt_wgcprorelease中根据partnumber字段来进行查找数据并匹配到zt_out表中
     * 其中如果本地proline,ae字段有一个不为空时，则更新另一个为空的值
     * 本接口实现的是原生sql执行批量更新操作
     */
    public function sqjmp()
    {
        //查询所有空的数据zt_mp-----后期将查询条件id去掉
        $array=$this->dao->select('id,device,proline,ae')->from('zt_mp')->where('proline')->eq('')->orwhere('ae')->eq('')->fetchAll();
        //$arrayR=$this->dao->printSQL();
        $array= $this->admin->object2Array($array);
        // 需要同步的数据partn类型字符串
        $dbms='mysql'; //数据库类型
        $host='localhost'; //数据库主机名
        $dbName='proindpur'; //使用的数据库
        $user='root'; //数据库连接用户名
        $pass='123456';  //对应的密码
        $dsn="$dbms:host=$host;dbname=$dbName";
        try {
            $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
        } catch (PDOException $e) {
             die ("Error!: " . $e->getMessage() . "<br/>");
        }
        $rows=[];
        $rewms=[];
        $warm=0;//初始化可能存在的当前编号partnumber在zt_wgcprorelease中找不到的数据
        foreach ($array as $value){
            $val=$value[device];
            $vproline=$value[proline];//proline
            $vae=$value[ae];//需要修改的俩个条件
            $val_arr=["device"=>$val];
            $sql="select proline,ae from zt_wgcprorelease where partnumber ='$val' ";
            $res=$dbh->query($sql);
            $rewms= $res->fetch(PDO::FETCH_ASSOC);
            if(!$rewms){//如果外链中未查到则不做任何修改操作
                $warm++;
            }else{
                if(empty($vproline) and !empty($vae)){//proline为空时
                    $rewms['ae']=$vae;
                }elseif(empty($vae) and !empty($vproline)){//ae为空时
                    $rewms['proline']=$vproline;
                }elseif (empty($vproline) and empty($vae)){//俩个值都为空时
                    //不进行任何操作
                }else{
                    echo js::alert('未知错误 ');
                }
                $rewms_merge=array_merge($rewms,$val_arr);
                $rows[]=$rewms_merge;//$row_count = $stmt->rowCount(); //记录数，2
            }
        }
//        echo '<br>';print_r($rows);die;
        $arrayresq= $this->admin->mpUpdate($rows, 'device');//高效批量修改方案
//       print($arrayresq);die;//print_r($rows);die;
//        var_dump(333);die;
        $result=$this->dao->exec($arrayresq);
        $rows = null;$pdo = null;//释放查询结果并关闭连接
//        var_dump($this->dao->get());die;
        if($result){
            echo js::alert("导入成功，其中有{$warm}条数据不能导入");
        }else{
            echo js::alert("失误导入");
        }



    }
    /**
     * 同步zt_sqjmpi表格
     * 原理同上
     */
    public function sqjmpi()
    {
        //查询所以空的数据zt_out-----后期将查询条件id去掉
        $array=$this->dao->select('id,device,proline,ae')->from('zt_mpi')->where('proline')->eq('')->orwhere('ae')->eq('')->fetchAll();
        //$arrayR=$this->dao->printSQL();
        $array= $this->admin->object2Array($array);
        $dbms='mysql'; //数据库类型
        $host='localhost'; //数据库主机名
        $dbName='proindpur'; //使用的数据库
        $user='root'; //数据库连接用户名
        $pass='123456';  //对应的密码
        $dsn="$dbms:host=$host;dbname=$dbName";
        try {
            $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
        } catch (PDOException $e) {
             die ("Error!: " . $e->getMessage() . "<br/>");
        }
        $rows=[];
        $rewms=[];
        $warm=0;//初始化未能运输的数据量
        foreach ($array as $value){
            $val=$value[device];
            $vproline=$value[proline];//proline
            $vae=$value[ae];//需要修改的俩个条件
            $val_arr=["device"=>$val];
            $sql="select proline,ae from zt_wgcprorelease where partnumber ='$val' ";
            $res=$dbh->query($sql);
            $rewms= $res->fetch(PDO::FETCH_ASSOC);
            if(!$rewms){//如果外链中未查到则不做任何修改操作
                $warm++;
            }else{
                if(empty($vproline) and !empty($vae)){//proline为空时
                    $rewms['ae']=$vae;
                }elseif(empty($vae) and !empty($vproline)){//ae为空时
                    $rewms['proline']=$vproline;
                }elseif (empty($vproline) and empty($vae)){//俩个值都为空时
                    //不进行任何操作
                }else{
                    echo js::alert('未知错误 ');
                }
                $rewms_merge=array_merge($rewms,$val_arr);
                $rows[]=$rewms_merge;//$row_count = $stmt->rowCount(); //记录数，2
            }
        }
        $arrayresq= $this->admin->mpiUpdate($rows, 'device');//高效批量修改方案
        $result=$this->dao->exec($arrayresq);
        $rows = null;$pdo = null;//释放查询结果并关闭连接
        if($result){
            echo js::alert("导入成功，其中有{$warm}条数据不能导入");
        }else{
            echo js::alert("失误导入");
        }



    }
    /**
     * 同步zt_sample表格
     * 原理同上
     */
    public function sample()
    {
        //查询所以空的数据zt_out-----后期将查询条件id去掉
        $array=$this->dao->select('id,device,proline,ae')->from('zt_sample')->where('proline')->eq('')->orwhere('ae')->eq('')->fetchAll();
        $array= $this->admin->object2Array($array);
        $dbms='mysql'; //数据库类型
        $host='localhost'; //数据库主机名
        $dbName='proindpur'; //使用的数据库
        $user='root'; //数据库连接用户名
        $pass='123456';  //对应的密码
        $dsn="$dbms:host=$host;dbname=$dbName";
        try {
            $dbh = new PDO($dsn, $user, $pass); //初始化一个PDO对象
        } catch (PDOException $e) {
             die ("Error!: " . $e->getMessage() . "<br/>");
        }
        $rows=[];
        $rewms=[];
        $warm=0;//初始化未能运输的数据量
        foreach ($array as $value){
            $val=$value[device];
            $vproline=$value[proline];//proline
            $vae=$value[ae];//需要修改的俩个条件
            $val_arr=["device"=>$val];
            $sql="select proline,ae from zt_wgcprorelease where partnumber ='$val' ";
            $res=$dbh->query($sql);
            $rewms= $res->fetch(PDO::FETCH_ASSOC);
            if(!$rewms){//如果外链中未查到则不做任何修改操作
                $warm++;
            }else{
                if(empty($vproline) and !empty($vae)){//proline为空时
                    $rewms['ae']=$vae;
                }elseif(empty($vae) and !empty($vproline)){//ae为空时
                    $rewms['proline']=$vproline;
                }elseif (empty($vproline) and empty($vae)){//俩个值都为空时
                    //不进行任何操作
                }else{
                    echo js::alert('未知错误 ');
                }
                $rewms_merge=array_merge($rewms,$val_arr);
                $rows[]=$rewms_merge;//$row_count = $stmt->rowCount(); //记录数，2
            }
        }
        $arrayresq= $this->admin->sampleUpdate($rows, 'device');//高效批量修改方案
        $result=$this->dao->exec($arrayresq);
        $rows = null;$pdo = null;//释放查询结果并关闭连接
        if($result){
            echo js::alert("导入成功，其中有{$warm}条数据不能导入");
        }else{
            echo js::alert("失误导入");
        }



    }
}
