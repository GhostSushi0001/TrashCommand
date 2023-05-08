<?php

namespace GhostSushi\Trash\Command;

use GhostSushi\Trash\Main;
use muqsit\invmenu\InvMenu;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;

class TrashCommand extends Command{

    public function __construct()
    {
        $command = explode(":", Main::getConfigValue("trash_cmd"));
        parent::__construct($command[0]);
        if (isset($command[1])) $this->setDescription($command[1]);
        $this->setAliases(Main::getConfigValue("trash_aliases"));
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if ($sender instanceof Player){
            if (Main::getInstance()->getConfig()->get("item-status") === true){
                $id = Main::getInstance()->getConfig()->get("item-id");
                $meta = Main::getInstance()->getConfig()->get("item-meta");
                if (Main::getInstance()->getConfig()->get("simple-chest") === true){
                    $menu = InvMenu::create(InvMenu::TYPE_CHEST);
                    $menu->setName(Main::getInstance()->getConfig()->get("titre-coffre"));
                    $menu->send($sender);
                }elseif(Main::getInstance()->getConfig()->get("double-chest") === true){
                    $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
                    $menu->setName(Main::getInstance()->getConfig()->get("titre-coffre"));
                    $menu->send($sender);
                }elseif(Main::getInstance()->getConfig()->get("hopper") === true){
                    $menu = InvMenu::create(InvMenu::TYPE_HOPPER);
                    $menu->setName(Main::getInstance()->getConfig()->get("titre-coffre"));
                    $menu->send($sender);
                } else{
                    $sender->sendMessage(Main::getInstance()->getConfig()->get("message-close"));
                }
            }
        }
    }

}
