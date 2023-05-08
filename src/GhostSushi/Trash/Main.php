<?php

namespace GhostSushi\Trash;
use GhostSushi\Trash\Command\TrashCommand;
use GhostSushi\Trash\Listener\Interact;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\SingletonTrait;

class Main extends PluginBase{

    private static Main $main;
    public static Config $config;

    use SingletonTrait;

    protected function onLoad(): void {
        self::setInstance($this);
    }


    public function onEnable(): void
    {

        if (!InvMenuHandler::isRegistered())
            InvMenuHandler::register($this);
        self::$main = $this;
        $this->getResource("config.yml");
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents(new Interact(), $this);
        $this->getServer()->getCommandMap()->register("", new TrashCommand());
       $this->getServer()->getLogger()->notice("La plugin Trash de ghost est enable");
    }

    public static function getConfigValue(string $path): mixed
    {
        return self::$main->getConfig()->get($path);
    }

    public function onDisable(): void
    {
        $this->getServer()->getLogger()->notice("La plugin Trash de ghost est disable");
    }
}