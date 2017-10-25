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
	<input type="text" class="criarLinha"><button type="button" class="btn btn-info btn-addlinha">Criar Linha</button>
	<div class="div"></div>

</div>

<input type="hidden" class="camposoculto" value='{"numeroLinha":0,"linhas":[]}'>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Criar Campo</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<label>Label do campo</label>
        	<input type="text" class="form-control" id="labelCampo">
        </div>
        <div class="form-group">
        	<label>Tipo</label>
        	<select class="form-control" id="tipo">
        		<option value="">--Selecione uma opção--</option>
        		<option value="text">Text</option>
        		<option value="textarea">Text Area</option>
        		<option value="select">Select</option>
        		<option value="radio">Radio</option>
        		<option value="checkbox">Checkbox</option>
        		<option value="file">Arquivo</option>
        	</select>
        </div>
        <div class="form-group">
        	<label>Obrigatório</label>
        	<select class="form-control" id="obrigatorio">
        		<option value="n">Não</option>
        		<option value="s">Sim</option>
        	</select>
        </div>
        <h3>Opções</h3>
        <div class="form-inline">
	        <div class="form-group">
	        	<label>Nome do Campo</label>
	        	<input type="text" class="form-control" id="valorcampo">
	        </div>
	        <div class="checkbox">
			    <label>
			      <input type="radio" id="valorpadrao" name="valorpadrao"> Valor padrão
			    </label>
			 </div>
		</div>
		<div class='divop'></div>
		<button type="button" class="btn btn-info btnAddOp">Adicionar Valores</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary addInput">Adicionar</button>
        <input type="hidden" id="numerolinha">
        <input type="hidden" id="numerocoluna">
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(function(){

	$('.addInput').click(function(){
		html = ''
		html = '<div class="form-group">';
		html += '<label>'+$('#labelCampo').val()+"</label>";
		opcoes = '';
		if($("#tipo").val() == 'text'){			
			html += "<input type='text' class='form-control' placeholder='"+$('#labelCampo').val()+"'";			
		}else if($("#tipo").val() == 'textarea'){
			html += "<textarea class='form-control'></textarea>";
		}else if($('#tipo').val() == 'file'){
			html += '<input type="file">'
		}else if($('#tipo').val() == 'select'){
			html += '<select class="form-control">';
			html += '<option></option>';
			$("div.form-inline").each( function(index, value) {
				
				if($(this).find('#valorpadrao').prop( "checked" ))
					html += '<option selected>'+$(this).find('#valorcampo').val()+'</option>';
				else
					html += '<option>'+$(this).find('#valorcampo').val()+'</option>';
				opcoes += '{"nome":"'+$(this).find('#valorcampo').val()+'","selecionado": "'+$(this).find('#valorpadrao').prop( "checked" )+'"}';
				if($(this).next().html() !== undefined){
					opcoes += ',';
				}

			});

		}else if($('#tipo').val() == 'radio'){
			$("div.form-inline").each( function(index, value) {
				html += ' <div class="checkbox"><label>'+$(this).find('#valorcampo').val();
				if($(this).find('#valorpadrao').prop( "checked" ))
					html += '<input type="radio" checked>';
				else
					html += '<input type="radio">';
				html += '</label></div>';
				opcoes += '{"nome":"'+$(this).find('#valorcampo').val()+'","selecionado": "'+$(this).find('#valorpadrao').prop( "checked" )+'"}';
				if($(this).next().html() !== undefined){
					opcoes += ',';
				}
			});
			    
		}else if($('#tipo').val() == 'checkbox'){
			$("div.form-inline").each( function(index, value) {
				html += ' <div class="checkbox"><label>'+$(this).find('#valorcampo').val();
				if($(this).find('#valorpadrao').prop( "checked" ))
					html += '<input type="checkbox" checked>';
				else
					html += '<input type="checkbox">';
				html += '</label></div>';
				opcoes += '{"nome":"'+$(this).find('#valorcampo').val()+'","selecionado": "'+$(this).find('#valorpadrao').prop( "checked" )+'"}';
				if($(this).next().html() !== undefined){
					opcoes += ',';
				}
			});
		}
		html += "</div>";
		arr = '[{"nome":"'+$('#labelCampo').val()+'","tipo":"'+$('#tipo').val()+'","obrigatorio":"'+$('#obrigatorio').val()+'","opcoes": ['+opcoes+']}]';
		arr = JSON.parse(arr);
		json = JSON.parse($('.camposoculto').val());
		json.linhas[$("#numerolinha").val()-1][$("#numerocoluna").val()]['campos'].push(arr);
		$('.camposoculto').val(JSON.stringify	(json));
		console.log(json);
		$('.col'+$("#numerolinha").val()+""+$("#numerocoluna").val()+' .add').append(html);
		return false;

	})

	$('.btnAddOp').click(function(){
		html = '<div class="form-inline"> <div class="form-group"> <label>Nome do Campo</label> <input type="text" class="form-control" id="valorcampo"> </div><div class="checkbox"> <label> <input type="radio" id="valorpadrao"  name="valorpadrao"> Valor padrão </label> </div></div>';
		$('.divop').append(html);
		return false;
	})

	$('.btn-addlinha').click(function(){
		campo = $('.criarlinha').val();
		coluna = campo.split(" ");
		json = JSON.parse($('.camposoculto').val());
		numerolinha = json.numeroLinha;
		novalinha = parseInt(numerolinha) + 1;
		json.numeroLinha = novalinha;
		html = "<div class='row'>";
		arr = '[';
		for(x in coluna){
			html += "<div class='col-md-"+coluna[x]+" col"+novalinha+""+x+" borda' idLinha='"+novalinha+"' id='"+x+"'><div class='add'></div><button class='btn btn-success btnAbrir'  idLinha='"+novalinha+"' id='"+x+"'>Adicionar Elemento</button></div>";
			arr += '{"campos": [],"idLinha":"'+x+'","tamanho":"'+coluna[x]+'"}';
			if(x != coluna.length - 1)
				arr += ',';
		}
		arr += "]";
		arr = JSON.parse(arr);
		json.linhas.push(arr);
		html += "</div>";
		$('.div').append(html);
		$('.camposoculto').val(JSON.stringify	(json));
		$('.btnAbrir').click(function(){
			$('#numerolinha').val($(this).attr('idLinha'));
			$('#numerocoluna').val($(this).attr('id'));
			$('#myModal').modal('show');
		})
		return false;
	})
})

</script>
</body>
</html>