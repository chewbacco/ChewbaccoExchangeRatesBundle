<?php
namespace Chewbacca\ExchangeRatesBundle\Services;
use Doctrine\ORM\EntityManager;

class CurrencyConverter{

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function convert($from, $to, $amount){
    	$from_currency = $this->entityManager->getRepository('ChewbaccaExchangeRatesBundle:Currency')->findOneBy(array('mnemo' => $from));
    	$to_currency = $this->entityManager->getRepository('ChewbaccaExchangeRatesBundle:Currency')->findOneBy(array('mnemo' => $to));
    	return $from_currency->getRate() / $to_currency->getRate() * $amount;
    }
}