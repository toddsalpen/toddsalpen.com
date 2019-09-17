<?php

class OrderController extends ControllerBase
{
    const POST_ASSIGNMENT_REQUEST = "https://api.butlerfly.com/send/assignment";
    const POST_TEST_REQUEST = "https://api.butlerfly.com/send/test";

    public function indexAction(){
        $this->response->redirect('//www.butlerfly.com');
        $this->view->disable();
    }

    public function sendAction($post){

        $request = json_encode($post);
        $response = json_decode(RestApi::PostRequest($this::POST_ASSIGNMENT_REQUEST, $request));
//        $response = json_decode($response);

        if ($response->ServiceRequest == 'OK' && $response->ClientConfirmation == 'OK') {
            $this->dispatcher->forward([
                'controller' => 'service',
                'action' => 'submitted',
                'params' => [$response->Service]
            ]);
        }else{
            $this->dispatcher->forward([
                'controller' => 'service',
                'action' => 'error',
                'params' => [$response->Service]
            ]);
        }

//        echo $request;
    }
}