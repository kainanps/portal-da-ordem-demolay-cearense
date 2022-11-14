﻿<?php

function enviarEmail($nome, $titulo, $arquivo_pConta, $data, $frequencia){
	require 'PHPMailerAutoload.php';
	
	$Mailer = new PHPMailer();

	//Define que será usado SMTP
	$Mailer->IsSMTP();
	
	//Enviar e-mail em HTML
	$Mailer->isHTML(true);
	
	//Aceitar carasteres especiais
	$Mailer->CharSet = "utf8";
	
	//Configurações
	$Mailer->SMTPAuth = true;
	$Mailer->SMTPSecure = 'tls';
	$Mailer->SMTPDebug = 3;
	
	//nome do servidor
	$Mailer->Host = 'br904.hostgator.com.br';
	//Porta de saida de e-mail 
	$Mailer->Port = 465;
	
	//Dados do e-mail de saida - autenticação
	$Mailer->Username = 'financeirogce@demolayce.com.br';
	$Mailer->Password = 'b17j1a2r3d4e5l6b17';
	
	//E-mail remetente (deve ser o mesmo de quem fez a autenticação)
	$Mailer->From = 'financeirogce@demolayce.com.br';
	
	//Nome do Remetente
	$Mailer->FromName = $nome;
	
	//Assunto da mensagem
	$Mailer->Subject = 'Prestação de conta';
	
	//Corpo da Mensagem
	$Mailer->Body = "<h1>$titulo</h1><br>Remetente: $nome.<br>Data: $data.<br>Frequência: $frequencia";
	
	//Corpo da mensagem em texto
	$Mailer->AltBody = "$titulo, Data: $data, por: $nome, frequência: $frequencia.";

	//Anexo do arquivo de prestação de conta
	$Mailer->AddAttachment($arquivo_pConta, $titulo.".pdf");
	
	//Destinatario 
	//$Mailer->AddAddress('tesourariagcece@gmail.com');
	$Mailer->AddAddress('kainanldfq123@gmail.com');
	
	return $Mailer->Send();
}	
?>
