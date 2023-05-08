<?php

namespace GhostSushi\Trash\Listener;

use GhostSushi\Trash\Main;
use muqsit\invmenu\InvMenu;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;

class Interact implements Listener{

    public function onUse(PlayerItemUseEvent $event){
        if (Main::getInstance()->getConfig()->get("item-status") === true){
            $id = Main::getInstance()->getConfig()->get("item-id");
            $meta = Main::getInstance()->getConfig()->get("item-meta");
            if ($event->getItem()->getId() === $id & $event->getItem()->getMeta() === $meta ){
               if (Main::getInstance()->getConfig()->get("simple-chest") === true){
                   $menu = InvMenu::create(InvMenu::TYPE_CHEST);
                   $menu->setName(Main::getInstance()->getConfig()->get("titre-coffre"));
                   $menu->send($event->getPlayer());
               }elseif(Main::getInstance()->getConfig()->get("double-chest") === true){
                   $menu = InvMenu::create(InvMenu::TYPE_DOUBLE_CHEST);
                   $menu->setName(Main::getInstance()->getConfig()->get("titre-coffre"));
                   $menu->send($event->getPlayer());
               }elseif(Main::getInstance()->getConfig()->get("hopper") === true){
                   $menu = InvMenu::create(InvMenu::TYPE_HOPPER);
                   $menu->setName(Main::getInstance()->getConfig()->get("titre-coffre"));
                   $menu->send($event->getPlayer());
               }
            }
        }
    }



}