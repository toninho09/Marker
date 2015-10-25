<?php

class RequestResponse{
	private $status;
	private $message;
	private $code;
	private $response;

	public function __construct($response = null,$status = Status::OK,$code = ErroCode::ALLFINE,$message = null){
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
		$this->status = Status::ERRO;
		$this->code = ErroCode::VALIDATION;
		$this->message = $message;
		return $this;
	}

	public function setExceptionError($message){
		$this->status = Status::ERRO;
		$this->code = ErroCode::EXCEPTION;
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
		if($this->code != ErroCode::ALLFINE && $this->status == Status::OK ){
			$this->status == Status::ERRO;
		}

		if($this->status == Status::ERRO &&	$this->message == null){
			$this->message = "Ops...";
		}
	}
	
}