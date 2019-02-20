<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private 'App\Activities\Activity\Application\Create\CreateActivityHandler' shared autowired service.

return $this->privates['App\Activities\Activity\Application\Create\CreateActivityHandler'] = new \App\Activities\Activity\Application\Create\CreateActivityHandler(new \App\Activities\Activity\Infrastructure\Persistence\Doctrine\Repository\ActivityRepositoryMySql(($this->services['doctrine.orm.default_entity_manager'] ?? $this->load('getDoctrine_Orm_DefaultEntityManagerService.php'))), new \App\Activities\Infrastructure\Bus\SimpleEventBus(($this->services['event_bus'] ?? $this->load('getEventBusService.php'))));
