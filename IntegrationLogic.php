<?php 
	class IntegrationLogic
	{
		private $message ="";
		private $identificationKey ="";
		private $encryptionKey ="";
		private $urlWebService = "";
		function __construct($identification_key, $encryption_Key, $url_WebService){

			$this->identificationKey = $identification_key;
			$this->encryptionKey = $encryption_Key;
			$this->urlWebService = $url_WebService;
		}
		public function wsClient($method){
			try {
				$tripleDes = new CTripleDes();
				$tripleDes->setMessage($this->message);
				$tripleDes->setPrivateKey($this->encryptionKey);
				$encryptionMessage = $tripleDes->encrypt();
				$client = new nusoap_client($this->urlWebService,'wsdl');
				$err = $client->getError();
				$parameters = array('key' => $this->identificationKey, 'parametros' => $encryptionMessage);
				$result = $client->call($method, $parameters);
				$encryptado = implode($result);
				//Desencriptacion
				$tripleDes2 = new CTripleDes();
				$tripleDes2->setMessage_to_decrypt($encryptado);
				$tripleDes2->setPrivateKey($this->encryptionKey);
				$respuesta = $tripleDes2->decrypt();
				return $respuesta;
				}
				catch(Exception $e){	
				  return $e;	
				}			
		}
	 	public function tmPaymentSyncWithoutBill(
	 								 $pv_orderId, 
	 								 $pv_monto, 
	 								 $pv_linea,
	 								 $pv_confirmacion = "",
	 								 $pv_notificacion = ""){
	 			$this->message = "pv_nroDocumento=;pv_linea=SNCELS;pv_monto=SmontoS;pv_orderId=SNIDES;pv_confirmacion= SconfirmationS;pv_notificacion= ScodnotiS";
				$this->message = str_replace("SNIDES",$pv_orderId,$this->message);
				$this->message = str_replace("SmontoS",$pv_monto,$this->message);
				$this->message = str_replace("SNCELS",$pv_linea,$this->message);
				$this->message = str_replace("SconfirmationS",$pv_confirmacion,$this->message);
				$this->message = str_replace("ScodnotiS",$pv_notificacion,$this->message);
				return $this->wsClient("solicitarPago");
		}
		public function tmPaymentAsyncWithoutBill(
	 								 $pv_orderId, 
	 								 $pv_monto, 
	 								 $pv_linea,
	 								 $pv_confirmacion = "",
	 								 $pv_notificacion = ""){
	 			$this->message = "pv_nroDocumento=;pv_linea=SNCELS;pv_monto=SmontoS;pv_orderId=SNIDES;pv_confirmacion= SconfirmationS;pv_notificacion= ScodnotiS";
				$this->message = str_replace("SNIDES",$pv_orderId,$this->message);
				$this->message = str_replace("SmontoS",$pv_monto,$this->message);
				$this->message = str_replace("SNCELS",$pv_linea,$this->message);
				$this->message = str_replace("SconfirmationS",$pv_confirmacion,$this->message);
				$this->message = str_replace("ScodnotiS",$pv_notificacion,$this->message);
				return $this->wsClient("solicitarPagoAsincrono");
		}
		public function tmPaymentSyncWithtBill(
	 								 $pv_orderId, 
	 								 $pv_monto, 
	 								 $pv_linea, 
	 								 $pv_confirmacion = "",
	 								 $pv_notificacion = "",
	 								 $pv_items = "",
	 								 $pv_razonSocial = "",
	 								 $pv_nit = ""){
		$this->message = "pv_nroDocumento=;pv_linea=SNCELS;pv_monto=SmontoS;pv_orderId=SNIDES;pv_confirmacion= SconfirmationS;pv_notificacion= ScodnotiS;pv_items=SitemsS;pv_razonSocial=SrazonsolicialS;pv_nit=SnitS";
				$this->message = str_replace("SNIDES",$pv_orderId,$this->message);
				$this->message = str_replace("SmontoS",$pv_monto,$this->message);
				$this->message = str_replace("SNCELS",$pv_linea,$this->message);
				$this->message = str_replace("SconfirmationS",$pv_confirmacion,$this->message);
				$this->message = str_replace("ScodnotiS",$pv_notificacion,$this->message);
				$this->message = str_replace("SitemsS",$pv_items,$this->message);
				$this->message = str_replace("SrazonsolicialS",$pv_razonSocial,$this->message);
				$this->message = str_replace("SnitS",$pv_nit,$this->message);
				return $this->wsClient("solicitarPago");
		}
		public function tmPaymentAsyncWithtBill(
	 								 $pv_orderId, 
	 								 $pv_monto, 
	 								 $pv_linea, 
	 								 $pv_confirmacion = "",
	 								 $pv_notificacion = "",
	 								 $pv_items = "",
	 								 $pv_razonSocial = "",
	 								 $pv_nit = ""){
		$this->message = "pv_nroDocumento=;pv_linea=SNCELS;pv_monto=SmontoS;pv_orderId=SNIDES;pv_confirmacion= SconfirmationS;pv_notificacion= ScodnotiS;pv_items=SitemsS;pv_razonSocial=SrazonsolicialS;pv_nit=SnitS";
				$this->message = str_replace("SNIDES",$pv_orderId,$this->message);
				$this->message = str_replace("SmontoS",$pv_monto,$this->message);
				$this->message = str_replace("SNCELS",$pv_linea,$this->message);
				$this->message = str_replace("SconfirmationS",$pv_confirmacion,$this->message);
				$this->message = str_replace("ScodnotiS",$pv_notificacion,$this->message);
				$this->message = str_replace("SitemsS",$pv_items,$this->message);
				$this->message = str_replace("SrazonsolicialS",$pv_razonSocial,$this->message);
				$this->message = str_replace("SnitS",$pv_nit,$this->message);
				return $this->wsClient("solicitarPagoAsincrono");
		}
		public function checkStatus($pv_orderId){
				$this->message = $pv_orderId;
				return $this->wsClient("consultarEstado");
			}
		public function paymentReversion($pv_orderId){
				$this->message = "pv_orderId=".$pv_orderId;
				return $this->wsClient("revertirPago");
		}
	}
 ?>