<?php


namespace Invoices\Service;

class ClientService extends AbstractDoctrineEntityService
{
	/**
	 * (non-PHPdoc)
	 * @see module/Invoices/src/Invoices/Service/Invoices\Service.AbstractDoctrineEntityService::getEntityRepository()
	 */
	public function getEntityRepository()
	{
		if (null === $this->entityRepository) {
            $this->setEntityRepository($this->getEntityManager()->getRepository('Invoices\Entity\Customer'));
        }
        return $this->entityRepository;
	}

	/**
	 * Persist a Client
	 * 
	 * @param object $entity
	 * @throws \Exception
	 */
	public function persist($entity)
	{
		$country = $entity->getCountry();
		if (null !== $country) {
			if (is_string($country)) {
				$country = $this->getEntityManager()->getRepository('Invoices\Entity\Country')->findOneBy(array('iso' => $country));
				if (!empty($country)) {
					$entity->setCountry($country);
				} else {
					throw new \Exception('Invalid country code');
				}
			}
		}
		
		$this->getEntityManager()->persist($entity);
		$this->getEntityManager()->flush($entity);
	}
}