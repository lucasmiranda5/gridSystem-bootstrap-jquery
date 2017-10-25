<?php
$json = '{"numeroLinha":2,"linhas":[[{"campos":[[{"nome":"Nome","tipo":"text","obrigatorio":"s","opcoes":[]}]],"idLinha":"0","tamanho":"3"},{"campos":[[{"nome":"Sexo","tipo":"radio","obrigatorio":"s","opcoes":[{"nome":"Masculino","selecionado":"false"},{"nome":"Feminino","selecionado":"false"}]}]],"idLinha":"1","tamanho":"3"},{"campos":[[{"nome":"Convenio","tipo":"select","obrigatorio":"s","opcoes":[{"nome":"Sim","selecionado":"false"},{"nome":"Não","selecionado":"false"}]}]],"idLinha":"2","tamanho":"3"},{"campos":[[{"nome":"Tipo da consulta","tipo":"checkbox","obrigatorio":"s","opcoes":[{"nome":"Consulta Simples","selecionado":"false"},{"nome":"Exame","selecionado":"false"},{"nome":"Sei la","selecionado":"false"}]}]],"idLinha":"3","tamanho":"3"}],[{"campos":[[{"nome":"Descrição da doença","tipo":"textarea","obrigatorio":"s","opcoes":[]}]],"idLinha":"0","tamanho":"6"},{"campos":[[{"nome":"Arquivo","tipo":"file","obrigatorio":"s","opcoes":[]}]],"idLinha":"1","tamanho":"6"}]]}';
$json = json_decode($json,true);
?>
<html>
<head>
	<title>Ficha de Cadastro</title>
	<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<style>
		.borda{
			border: 1px solid #000;
		}
	</style>
</head>
<body>
	<div class="container">
	<?php
	foreach($json['linhas'] as $valor){
		print "<div class='row'>";
		foreach($valor as $val){
			print "<div class='col-md-".$val['tamanho']."'>";
			foreach($val['campos'] as $campo ){
				print "<div class='form-group'>";
				print "<label>".$campo[0]['nome']."</label>";
				if($campo[0]['tipo'] == 'text')
					print "<input type='text' class='form-control'>";
				elseif($campo[0]['tipo'] == 'textarea')
					print "<textarea class='form-control'></textarea>";
				elseif($campo[0]['tipo'] == 'file')
					print "<input type='file'>";
				elseif($campo[0]['tipo'] == 'select'){
					print "<select class='form-control'>";
					foreach($campo[0]['opcoes'] as $ops){
						if($ops['selecinado'] == 'true')
							print "<option selected>".$ops['nome']."</option>";
						else
							print "<option>".$ops['nome']."</option>";
					}
					print "</select>";
				}
				elseif($campo[0]['tipo'] == 'radio'){
					foreach($campo[0]['opcoes'] as $ops){
						print '<div class="checkbox"><label>'.$ops['nome'];
						if(@$ops['selecinado'] == 'true')
							print "<input type='radio' checked>";
						else
							print "<input type='radio'>";
						print "</label></div>";
					}
					print "</select>";
				}
				elseif($campo[0]['tipo'] == 'checkbox'){
					foreach($campo[0]['opcoes'] as $ops){
						print '<div class="checkbox"><label>'.$ops['nome'];
						if(@$ops['selecinado'] == 'true')
							print "<input type='checkbox' checked>";
						else
							print "<input type='checkbox'>";
						print "</label></div>";
					}
					print "</select>";
				}
				print "</div>";
			}
			print "</div>";
		}
		print "</div>";

	} ?>
</div>