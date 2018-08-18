<?php

namespace App\Billing;
use App\Billing\PaymentGatewayInterface;

class FakePaymentGateway implements PaymentGatewayInterface
{
	
	private $charges; 

	public function __construct()
	{
		$this->charges = collect();			#collection
	}
	
	public function getValidToken()
	{
		return 'valid-token';
	}

	public function totalCharges()
	{
		return $this->charges->sum();
	}

	public function charge($amount, $token)
	{
		if($token !== $this->getValidToken())
		{
			throw new FailedPaymentException();
		}
		
		$this->charges[] = $amount;
	}
}
