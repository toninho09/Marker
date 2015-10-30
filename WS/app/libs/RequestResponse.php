<?php

class RequestResponse{
	private $status;
	private $message;
	private $code;
	private $response;

	public function __construct($response = null,$status = StatusConst::OK,$code = ErroCodeConst::ALLFINE,$message = null){
		$this->status = $status;
		$this->message = $message;
		$this->code = $code;
		$this->response = $response;
	}

	public function setStatus(int $status){
		$this->status = $status;
	}

	public function setMessage(String $msg){
		$this->message = $msg;
	}

	public function setCode(int $code){
		$this->code = $code;
	}

	public function setResponse($response){
		$this->response = $response;
	}

	public function setValidationError($message){
		$this->status = StatusConst::ERRO;
		$this->code = ErroCodeConst::VALIDATION;
		$this->message = $message;
		return $this;
	}

	public function setExceptionError($message){
		$this->status = StatusConst::ERRO;
		$this->code = ErroCodeConst::EXCEPTION;
		$this->message = $message;
		return $this;
	}

	public function __toString(){
		return $this->toJson();
	}

	public function toJson(){
		$this->validation();
		return json_encode([
			'status'=>$this->status,
			'message'=>$this->message,
			'code'=>$this->code,
			'response'=>$this->response
			]);
	}

	private function validation(){
		if($this->code != ErroCodeConst::ALLFINE && $this->status == StatusConst::OK ){
			$this->status == StatusConst::ERRO;
		}

		if($this->status == StatusConst::ERRO &&	$this->message == null){
			$this->message = "Ops...";
		}
	}
	
}