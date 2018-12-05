
     #申请记录同步产线
	 其中主要技术难点：
	 功能实现，将本数据库的表转储存到另外一个数据库的表中,实现批量更新数据库
	 
	 
	 ****-------------------*******批量更新数据库-----地址方法演示：中文网教程http://www.php.cn/php-weizijiaocheng-406104.html
	 
	 
	 
	 /**
     *申请记录同步产线
     * 实现功能如下:本地zt_out表中proline为空的数据需要从另一个数据库表zt_wgcprorelease中根据partnumber字段来进行查找数据并匹配到zt_out表中
     * 本接口实现的是原生sql执行批量更新操作
     */
	 public function sqjltbcx(){}
	 /**
     * 同步zt_mp表格（device匹配partnumber）
     * 实现功能如下:本地zt_out表中proline，ae为空的数据需要从另一个数据库表zt_wgcprorelease中根据partnumber字段来进行查找数据并匹配到zt_out表中
     * 其中如果本地proline,ae字段有一个不为空时，则更新另一个为空的值
     * 本接口实现的是原生sql执行批量更新操作
     */
    public function sqjmp(){}