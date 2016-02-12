<?php

namespace xfdb;

use pocketmine\plugin\PluginBase;
use pocketmine\plugin\Plugin;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use xfdb\CallbackTask;
use onebone\economyapi\EconomyAPI;
use pocketmine\event\player\PlayerJoinEvent;
use RVIP\RVIP;
 
class xfdb extends PluginBase{

 public function onEnable(){
     $this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask([$this,"senddb"]), 9);
			$this->getLogger()->info("§e底部插件作者:Magic雪飞>>搭配插件:RVIP or WarnPoint.");
			$this->vip = RVIP::$RVIP;
	
 }
	public function onLoad(){
  $this->getLogger()->info("§b=给小学生的一封信=\n§c         本插件完全免费,倒卖必究\n         §c版权请勿随意乱改\n         §b=========");
	}
	public function onJoin(PlayerJoinEvent $event) {
$player = $event->getPlayer();
$player->sendMessage("§b===欢迎使用XF底部显示===");
 }
  	public function senddb(){
   	$zaixian = count($this->getServer()->getOnlinePlayers());
   	date_default_timezone_set("Asia/Shanghai");
		foreach($this->getServer()->getOnlinePlayers() as $player){
			 	if($player->isOnline()){
	$m = EconomyAPI::getInstance()->myMoney($player->getName());
    $world = $player->getLevel()->getName();
    $xue = $player->getHealth();
    $x = $player->getX();
        $y = $player->getY();
        $z = $player->getZ();
        $sy = intval($y);
        $sz = intval($z);
        $sx = intval($x);
        $gm = $player->getgamemode();
        $pn = $player->getName();
        $beibao = $player->getInventory();
        $item = $beibao->getItemInHand();
        $id = $item->getID();
        if ($gm==0){
$ms="生存"
;
}
if ($gm==1){
$ms="创造"
;
}

$point = $this->vip->Point("get",$player->getName());//点卷
$ts = $this->vip->Day("get",$player->getName());//天数
 $Prefix = $this->vip->Prefix("get",$player->getName());//称号
 $player->sendPopup("|§a繁星玩家:§b".$zaixian." §e所在星域:§6".$world." §3目前血量:§c".$xue."§f|\n|§e玩家名字:§e".$pn." §dX,Y坐标:§e".$sx." ".$sy."§f|");
$player->sendTip("                                                                             >>>>>§a点卷§b:".$point."\n                                                                             >>>>>§e等级§d:".$Prefix."\n                                                                             >>>>>§b金钱§6:".$m."\n                                                                             >>>>>§a模式§e:".$ms."\n                                                                             >>>>>§eVIP天数§a:".$ts."\n                                                                             >>§c购买点卷请联系星炎");

}
    
}
} 
}




















