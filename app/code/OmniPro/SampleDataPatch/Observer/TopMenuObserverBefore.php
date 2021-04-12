<?php
namespace OmniPro\SampleDataPatch\Observer;

use Magento\Framework\Event\ObserverInterface;

class TopMenuObserverBefore implements ObserverInterface
{
  /**
   * @param \Psr\Log\LoggerInterface
   */
  private $logger;

  public function __construct(
    \Psr\Log\LoggerInterface $logger
  )
  {
    // Observer initialization code...
    // You can use dependency injection to get any class this observer may need.
    $this->logger = $logger;
  }

  public function execute(\Magento\Framework\Event\Observer $observer)
  {
    $menu = $observer->getData('menu');
    $block = $observer->getData('block');
    $request = $observer->getData('request');
    $this->logger->debug("before top menu");
  }
}