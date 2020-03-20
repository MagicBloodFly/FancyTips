<?php

namespace xfdb;


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
use FragMent\FragMent;
use Scoreboards\Scoreboards;

class xfdb extends PluginBase implements Listener{

 public function onEnable(){

    

	 $this->getServer()->getPluginManager()->registerEvents($this, $this);
	 
	  $this->getScheduler()->scheduleRepeatingTask(new CallbackTask([$this,"senddb"]),20);
	  


			$this->getLogger()->info("§e底部插件作者:Magic雪飞  >>  来自Fancy团队");

            $this->frag=FragMent::getInstance();
	 
	 
//创建计分板	 
$this->api = Scoreboards::getInstance();
  

 }

	public function onLoad(){
  $this->getLogger()->info("\n      §b=====§c给小学生的一封信§b=====\n§c      底部插件完全免费,倒卖必究\n         §c极致插件 来自§bFancy§c团队\n         §b=================");
	}

   
  	public function senddb(){


	


   	$zaixian = count($this->getServer()->getOnlinePlayers());

   	date_default_timezone_set("Asia/Shanghai");

		foreach($this->getServer()->getOnlinePlayers() as $player){

			 	if($player->isOnline()){
					
					
					
					//计分板
				 
       $this->api->new($player, "繁星", "--繁星之梦--");
                 
					
					$n = $player->getName();
					
					

					
					//碎片插件部分
					
					$zt = $this->frag->getFragName();
					$number = $this->frag->getNumber($n);
					
							



$mt = mt_rand(1,10);

/*$scoreboard->setLine(1, "§b繁§a星§6之§d梦§c五§d岁啦");
$scoreboard->setLine(2, "§e开§b放§6的§a合§d成§e物§b品:§6".$zt);
$scoreboard->setLine(3, "§b可§e召§a唤§3碎§b片§6次§b数:§f".$number);
$scoreboard->setLine(4, $mt);
*/


$this->api->setLine($player,1,"§b繁§a星§6之§d梦§c五§d岁啦");
$this->api->setLine($player,2,"§e开§b放§6的§a合§d成§e物§b品:§6".$zt);
$this->api->setLine($player,3,"§b可§e召§a唤§3碎§b片§6次§b数:§f".$number);
$this->api->setLine($player,4,$mt);






$player->sendTip($mt."I Love Fancy>>".$n);

		 
		 } 


		}

}

}
















