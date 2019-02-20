<?php

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $valueHoldercdb03 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer186c4 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties1bdbc = [
        
    ];

    public function getConnection()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getConnection', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getMetadataFactory', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getExpressionBuilder', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'beginTransaction', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->beginTransaction();
    }

    public function getCache()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getCache', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getCache();
    }

    public function transactional($func)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'transactional', array('func' => $func), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->transactional($func);
    }

    public function commit()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'commit', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->commit();
    }

    public function rollback()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'rollback', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getClassMetadata', array('className' => $className), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'createQuery', array('dql' => $dql), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'createNamedQuery', array('name' => $name), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'createQueryBuilder', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'flush', array('entity' => $entity), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->flush($entity);
    }

    public function find($entityName, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'find', array('entityName' => $entityName, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->find($entityName, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'clear', array('entityName' => $entityName), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->clear($entityName);
    }

    public function close()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'close', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->close();
    }

    public function persist($entity)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'persist', array('entity' => $entity), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'remove', array('entity' => $entity), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'refresh', array('entity' => $entity), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'detach', array('entity' => $entity), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'merge', array('entity' => $entity), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getRepository', array('entityName' => $entityName), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'contains', array('entity' => $entity), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getEventManager', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getConfiguration', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'isOpen', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getUnitOfWork', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getProxyFactory', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'initializeObject', array('obj' => $obj), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'getFilters', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'isFiltersStateClean', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'hasFilters', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return $this->valueHoldercdb03->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? $reflection = new \ReflectionClass(__CLASS__);
        $instance = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializer186c4 = $initializer;

        return $instance;
    }

    protected function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config, \Doctrine\Common\EventManager $eventManager)
    {
        static $reflection;

        if (! $this->valueHoldercdb03) {
            $reflection = $reflection ?: new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHoldercdb03 = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHoldercdb03->__construct($conn, $config, $eventManager);
    }

    public function & __get($name)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, '__get', ['name' => $name], $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        if (isset(self::$publicProperties1bdbc[$name])) {
            return $this->valueHoldercdb03->$name;
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHoldercdb03;

            $backtrace = debug_backtrace(false);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    get_parent_class($this),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
            return;
        }

        $targetObject = $this->valueHoldercdb03;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHoldercdb03;

            return $targetObject->$name = $value;
            return;
        }

        $targetObject = $this->valueHoldercdb03;
        $accessor = function & () use ($targetObject, $name, $value) {
            return $targetObject->$name = $value;
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, '__isset', array('name' => $name), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHoldercdb03;

            return isset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHoldercdb03;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, '__unset', array('name' => $name), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHoldercdb03;

            unset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHoldercdb03;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __clone()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, '__clone', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        $this->valueHoldercdb03 = clone $this->valueHoldercdb03;
    }

    public function __sleep()
    {
        $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, '__sleep', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;

        return array('valueHoldercdb03');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null)
    {
        $this->initializer186c4 = $initializer;
    }

    public function getProxyInitializer()
    {
        return $this->initializer186c4;
    }

    public function initializeProxy() : bool
    {
        return $this->initializer186c4 && ($this->initializer186c4->__invoke($valueHoldercdb03, $this, 'initializeProxy', array(), $this->initializer186c4) || 1) && $this->valueHoldercdb03 = $valueHoldercdb03;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHoldercdb03;
    }

    public function getWrappedValueHolderValue() : ?object
    {
        return $this->valueHoldercdb03;
    }


}
