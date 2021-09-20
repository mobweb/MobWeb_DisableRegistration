<?php
/**
 * @author    Louis Bataillard <info@mobweb.ch>
 * @package    MobWeb_DisableRegistration
 * @copyright    Copyright (c) MobWeb GmbH (https://mobweb.ch)
 */

namespace MobWeb\DisableRegistration\Plugin;

use Magento\Framework\App\Response\Http as Response;
use Magento\Framework\UrlInterface;
use Magento\Framework\Message\ManagerInterface as MessageManager;

abstract class AbstractControllerPlugin
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var MessageManager
     */
    private $messageManager;

    /**
     * @var UrlInterface
     */
    private $urlInterface;

    /**
     * @param Response $response
     * @param MessageManager $messageManager
     * @param UrlInterface $urlInterface
     */
    public function __construct(
        Response $response,
        MessageManager $messageManager,
        UrlInterface $urlInterface
    ) {
        $this->response = $response;
        $this->messageManager = $messageManager;
        $this->urlInterface = $urlInterface;
    }

    /**
     * @param mixed $subject
     * @return Subject
     */
    public function beforeExecute($subject)
    {
        $this->redirectToIndex();
    }
    /**
     *
     */
    private function redirectToIndex()
    {
        $this->messageManager->addNotice(__('You are not allowed to create a new account. Please contact us so that we can create an account for you.'));
        $url = $this->urlInterface->getUrl('cms/index');
        $this->response->setRedirect($url);
    }
}