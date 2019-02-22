<?php

use \Symfony\Component\Console\Application;
use \Imponeer\Commands\MakeCommand;

$version = \PackageVersions\Versions::getVersion("imponeer/installer-maker");
$console = new Application("Installer Maker", $version );
$console->add($make_command = new MakeCommand());
$console->setDefaultCommand($make_command->getName(), true);
$console->run();