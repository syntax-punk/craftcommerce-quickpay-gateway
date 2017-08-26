<?php

namespace Omnipay\Quickpay;

use Craft\Craft;
use Omnipay\Common\AbstractGateway;
use Omnipay\Quickpay\Message\Notification;

/**
 * Quickpay EcommerceGateway
 */
class EcommerceGateway extends AbstractGateway
{
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'Quickpay';
	}

	/**
	 * @return array
	 */
	public function getDefaultParameters()
	{
		parent::getDefaultParameters();

		return array(
			'type'                         => '',
			'merchant'                     => '',
			'agreement'                    => '',
			'apikey'                       => '',
			'privatekey'                   => '',
			'language'                     => '',
            'default_callback_url'         => '',
            'default_redirect_url'         => '',
			'google_analytics_tracking_id' => '',
			'google_analytics_client_id'   => '',
			'description'                  => '',
			'order_id'                     => '',
			'synchronized'                 => false,
			'payment_methods'              => array()
		);
	}

	/**
	 * @return array
	 */
	public function getPaymentMethods()
	{
		return $this->getParameter('payment_methods');
	}

	/**
	 * @param array $value
	 * @return mixed
	 */
	public function setPaymentMethods($value = array())
	{
		return $this->setParameter('payment_methods', $value);
	}

	/**
	 * @return int
	 */
	public function getMerchant()
	{
		return $this->getParameter('merchant');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setMerchant($value)
	{
		return $this->setParameter('merchant', $value);
	}

	/**
	 * @return int
	 */
	public function getAgreement()
	{
		return $this->getParameter('agreement');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setAgreement($value)
	{
		return $this->setParameter('agreement', $value);
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setApikey($value)
	{
		return $this->setParameter('apikey', $value);
	}

	/**
	 * @return string
	 */
	public function getApikey()
	{
		return $this->getParameter('apikey');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setPrivatekey($value)
	{
		return $this->setParameter('privatekey', $value);
	}

	/**
	 * @return string
	 */
	public function getPrivatekey()
	{
		return $this->getParameter('privatekey');
	}

	/**
	 * @return string
	 */
	public function getLanguage()
	{
		return $this->getParameter('language');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setLanguage($value)
	{
		return $this->setParameter('language', $value);
	}

	/**
	 * @return string
	 */
	public function getGoogleAnalyticsTrackingID()
	{
		return $this->getParameter('google_analytics_tracking_id');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setGoogleAnalyticsTrackingID($value)
	{
		return $this->setParameter('google_analytics_tracking_id', $value);
	}

	/**
	 * @return string
	 */
	public function getGoogleAnalyticsClientID()
	{
		return $this->getParameter('google_analytics_client_id');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setGoogleAnalyticsClientID($value)
	{
		return $this->setParameter('google_analytics_client_id', $value);
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->getParameter('type');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setType($value)
	{
		return $this->setParameter('type', $value);
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->getParameter('description');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setDescription($value)
	{
		return $this->setParameter('description', $value);
	}

	/**
	 * @return string
	 */
	public function getOrderID()
	{
		return $this->getParameter('order_id');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setOrderID($value)
	{
		return $this->setParameter('order_id', $value);
	}

	/**
	 * @param $value
	 * @return self
	 */
	public function setSynchronized($value)
	{
		return $this->setParameter('synchronized', $value);
	}

	/**
	 * @return boolean
	 */
	public function getSynchronized()
	{
		return boolval($this->getParameter('synchronized'));
	}

	public function getDefaultCallbackUrl()
    {
        return $this->getParameter('default_callback_url');
    }

    public function setDefaultCallbackUrl($value)
    {
        return $this->setParameter('default_callback_url', $value);
    }

    public function getDefaultRedirectUrl()
    {
        return $this->getParameter('default_redirect_url');
    }

    public function setDefaultRedirectUrl($value)
    {
        return $this->setParameter('default_redirect_url', $value);
    }


	/**
	 * Start an authorize request
	 *
	 * @param array $parameters array of options
	 * @return \Omnipay\Quickpay\Message\AuthorizeRequest
	 */
	public function authorize(array $parameters = array())
	{
	    if(!empty($this->getDefaultRedirectUrl())) {
            $parameters['returnUrl'] = \Craft\craft()->getSiteUrl() . $this->getDefaultRedirectUrl() . '?order=' . $parameters['order']['number'];
        }
//        if(!empty($this->getDefaultCallbackUrl())) {
//            $parameters['notifyUrl'] = \Craft\craft()->getSiteUrl() . $this->getDefaultCallbackUrl();
//        }

		return $this->createRequest('\Omnipay\Quickpay\Message\AuthorizeRequest', $parameters);
	}

	/**
	 * Start a purchase request
	 *
	 * @param array $parameters array of options
	 * @return \Omnipay\Quickpay\Message\PurchaseRequest
	 */
	public function purchase(array $parameters = array())
	{
        if(!empty($this->getDefaultRedirectUrl())) {
            $parameters['returnUrl'] = \Craft\craft()->getSiteUrl() . $this->getDefaultRedirectUrl() . '?order=' . $parameters['order']['number'];
        } else {
            $parameters['returnUrl'] = $parameters['order']['returnUrl'];
        }

		return $this->createRequest('\Omnipay\Quickpay\Message\PurchaseRequest', $parameters);
	}

	/**
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CaptureRequest
	 */
	public function capture(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\CaptureRequest', $parameters);
	}

	/**
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\VoidRequest
	 */
	public function void(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\VoidRequest', $parameters);
	}

	/**
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\RefundRequest
	 */
	public function refund(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\RefundRequest', $parameters);
	}

	/**
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\RefundRequest
	 */
	public function recurring(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\RecurringRequest', $parameters);
	}

	/**
	 * Is used for callbacks coming in to the system
	 * notify will verify these callbacks and eventually return the body of the callback to the app
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\NotifyRequest
	 */
	public function notify(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\NotifyRequest', $parameters);
	}

	/**
	 * Complete a purchase
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completePurchase(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * Complete an authorization
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeAuthorize(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * A complete request
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeRequest(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\CompleteRequest', $parameters);
	}

	/**
	 * Complete capture
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeCapture(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * Complete cancel
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeVoid(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * Complete refund
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeRefund(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * Complete recurring
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeRecurring(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * @return Notification
	 */
	public function acceptNotification()
	{
		return new Notification($this->httpRequest, $this->getPrivatekey());
	}

	public function link(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\LinkRequest', $parameters);
	}

    /**
     * @param $amount
     * @param $currency
     * @param $transactionId
     * @param $apiKey
     * @param $agreement
     * @param $fullId
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function startLinkSession($amount, $currency, $transactionId, $apiKey, $agreement, $fullId) {

        $params = [
            'apikey' => $apiKey,
            'transactionId' => $transactionId,
            'agreement' => $agreement,
            'amount' => $amount,
            'currency' => $currency
            ];

        $linkRequest = $this->link($params);
        $linkRequest->setNotifyUrl($this->getDefaultCallbackUrl());
        $linkRequest->setReturnUrl($this->getDefaultRedirectUrl());
        $linkResponse = $linkRequest->send();
        return $linkResponse;
    }

	//  HTTP SESSION MANIPULATIONS
    public function sessionSet($key, $value)
    {
        \Craft\craft()->httpSession->add($key, $value);
    }

    public function sessionGet($key)
    {
        $result = \Craft\craft()->httpSession->get($key);
        return $result;
    }

    public function sessionDump($key) {
        $result = \Craft\craft()->httpSession->remove($key);
        return $result;
    }
}
