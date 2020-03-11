<?php

namespace xfdb;

error_reporting( E_ALL&~E_NOTICE );

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\Event;
use pocketmine\utils\Utils;
use pocketmine\command\CommandSender;
use pocketmine\item\Item;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerChatEvent;
use Love\love;
use xfdb\CallbackTask;
use onebone\economyapi\EconomyAPI;
use CKylinMC\CkVIP;
use CKlinMC\UserManager;
use FragMent\FragMent;

class xfdb extends PluginBase implements Listener{

 public function onEnable(){

	  $this->getServer()->getPluginManager()->registerEvents($this, $this);
	 
     $this->getScheduler()->scheduleRepeatingTask(new CallbackTask([$this,"senddb"]),20);

	

			$this->getLogger()->info("§e底部插件作者:Magic雪飞  >>  来自Fancy团队");

   $this->v=CkVIP::$API;

   $this->SimpleMarry=$this->getServer()->getPluginManager()->getPlugin("Love");

     $this->frag=FragMent::getInstance();

 }

	public function onLoad(){
  $this->getLogger()->info("\n      §b=给小学生的一封信=\n§c      底部插件完全免费,倒卖必究\n         §c极致插件 来自§bFancy§c团队\n         §b=========");
	}

   
  	public function senddb(){


        $usermgr=$this->v->getUserMgr();


   	$zaixian = count($this->getServer()->getOnlinePlayers());

   	date_default_timezone_set("Asia/Shanghai");

		foreach($this->getServer()->getOnlinePlayers() as $player){

			 	if($player->isOnline()){

	$m = EconomyAPI::getInstance()->myMoney($player->getName());//金钱
	
    $world = $player->getLevel()->getName();//地图名字

    $xue = $player->getHealth();//获取血

    $x = $player->getX();

        $y = $player->getY();

        $z = $player->getZ();

        $sy = intval($y);//约数Y

        $sz = intval($z);//约数Z

        $sx = intval($x);//约数X

        $gm = $player->getgamemode();//模式

        $pn = $player->getName();//玩家名字

    $beibao=$player->getInventory();

$item=$beibao->getItemInHand();

$idt=$item->getID();

//id

$ids=$item->getDamage();//特殊值，也是耐久

                    //ip

$ip=$player->getAddress();

                    $server = 'ping 192.168.3.1 -n 1';
                    $last= exec($server);
                    $ping = (explode("Average = ",$last))[1];

                    $user=$player->getName();

                    $id=strtolower($user);

/*
	$toolmeta[270]=60;
				$toolmeta[274]=132;
				$toolmeta[257]=251;
				$toolmeta[285]=33;
				$toolmeta[278]=1562;
				$toolmeta[359]=238;
				$toolmeta[271]=60;
				$toolmeta[275]=132;
				$toolmeta[258]=251;
				$toolmeta[286]=33;
				$toolmeta[279]=1562;
				$toolmeta[269]=60;
				$toolmeta[273]=132;
				$toolmeta[256]=251;
				$toolmeta[284]=33;
				$toolmeta[277]=1562;
				$toolmeta[268]=60;
				$toolmeta[272]=132;
				$toolmeta[267]=251;
				$toolmeta[283]=33;
				$toolmeta[276]=1562;
				$toolmeta[346]=65;	
				$toolmeta[276]=1562;
			
*/

//状态部分

    if ($gm==0){
$ms="生存模式";
}
if ($gm==1){
$ms="创造模式";
}
if($gm==2){
$ms="冒险模式";
}
if($gm==3){
$ms=="观察者模式";
}





//会员部分

if($usermgr->isUserVIP($user))
{
$hy="繁星至尊会员";

$ts=$usermgr->getUserExpireStamp($user);

//会员时间差

    $vipday =  date('Y-m-d',$ts);
    $end =  date("Y-m-d");
    $newvipday = date_create($vipday);
    $newend = date_create($end);
    $days = date_diff($newvipday, $newend)->days;
}
else
{
$hy="非会员用户";
$days="无";
 
}

//等级
$dj=$usermgr->getUserAvailableVIPLevel($user);




//点卷
$coin=$usermgr->getUserCoins($user);



//管理部分

if($player->isOp())
{
$gg="〖OP〗高层管理员";
}
else
{
$gg="帅帅哒的玩家";
}

//金币部分

if($m>10000)
{
$zb="【土豪认证✔】";
}
else
{
$zb="【未认证为土豪✘】";
}

//碎片部分
                    //合成状态
     $hc=$this->frag->getStatus($user);
                   //合成ID
     if($this->frag->getFragID()==0)
     {
         //合成物品名字
         $fragname ="无";


     }
     else
     {
         $fragname = $this->frag->getFragName();

     }




                   $player->sendTip("  §d❀§b会员:§e".$hy."§a 剩余天数:§6".$days." §d等级§b:".$dj." §f点卷:".$coin." §e合成物品:§b".$fragname." §a合成状态:§6".$hc."§d❀\n       §b♦§b手里ID:§6".$idt.":".$ids." §e当前坐标X-Y-Z >>§b".$sx."-".$sy."-".$sz."§d §3所在星球:§a".$world."§2卐§b 权限:§e".$gg."§b♦\n       §d❀§e繁星币:".$m." §b".$zb." §a当前模式:§6".$ms." §b在线星民:§e".$zaixian." §e当前时间:§e".date("h").":".date("i").":".date("s")."§d❀\n\n\n");



                }
    
}
         
		 
		 } 



}


















