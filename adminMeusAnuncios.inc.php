<?php
/////// ARVORE DE FORM BASEADO EM ARRAY -> NOVO ANUNCIO

$puxaBD = new Crud();
$puxaBD->conn();

$loopTipoImovel[] = '';
$query = $puxaBD->selectArrayPostWhere('*','types','WHERE id!=0 ORDER BY name ASC');
	//$loopTipoImovel[] = array(NULL,'');
	while($queryLP = $query->fetch_assoc()){ $loopTipoImovel[] = array($queryLP['id'],utf8_encode($queryLP['name'])); }
	unset($query);

$query = $puxaBD->selectArrayPostWhere('*','categories','WHERE id!=0 ORDER BY id ASC');
	while($queryLP = $query->fetch_assoc()){ $loopEstagioImovel[] = array($queryLP['id'],utf8_encode($queryLP['name'])); }
	unset($query);

$query = $puxaBD->selectArrayPostWhere('title,item','area_details_itens','ORDER BY title ASC');
	while($queryLP = $query->fetch_assoc()){ $area_details_itens[] = array($queryLP['item'],utf8_encode($queryLP['title'])); }
	unset($query);

$query = $puxaBD->selectArrayPostWhere('title,item','building_details_itens','ORDER BY title ASC');
	while($queryLP = $query->fetch_assoc()){ $building_details_itens[] = array($queryLP['item'],utf8_encode($queryLP['title'])); }
	unset($query);

$tree5 = array(
	 array('Estágio da obra (Lançamento)','estagio','select' => $loopEstagioImovel,'validate[required] form-control'),
	 array('Tipo de imóvel','tipoimovel','select' => $loopTipoImovel,'validate[required] form-control')
);

$tree6 = array(	 
	 array('Área privativa','area','double','validate[required] form-control',2,'m²'),
	 array('Área total','totArea','double','form-control',2,'m²'),
	 array('Dormitórios','rooms','double','validate[required] form-control',2,'un'),
	 array('Suítes','suites','double','validate[required] form-control',2,'un'),
	 array('Vagas','slots','double','validate[required] form-control',2,'un')
);

$tree12 = array(
	 array('Valor (R$)','price','text','validate[required] form-control')
);

$tree15 = array(
	 array('Nome/título do lançamento','lcNome','text','validate[required] form-control'),
	 array('Área total do terreno','area_terreno','double','validate[required] form-control',2,'m²'),
	 array('Previsão da entrega (mês/ano)','prev_entrega','data','form-control')
);

$tree8 = array(
     array('divider','<div class="clear h30"></div><div class="alert alert-info"><i class="fa fa-check-square-o"></i>Defina como o valor do imóvel será exibido na hora da busca. Caso a opção \'Solicitar valores ao corretor/proprietário\' for selecionada, um e-mail de contato será necessário para o envio do email de solicitação.<div class="clear h5"></div><i class="fa fa-lightbulb-o"></i>Você pode ocultar a exibição dos valores nos resultados de busca, mas seu preenchimento é obrigatório.</div><div class="clear"></div>'),
	 array('Exibição do valor','exibValor','select' => array(array('0','Mostrar os valores'), array('1','Não mostrar o valor (Sob consulta)'), array('2','Solicitar valores ao anunciante')),'validate[required] form-control'),
	 array('Contato do anunciante (e-mail)','contatoCorretor','text','validate[required] form-control'),
	 array('Permuta','permuta','checkbox','form-control',1,'Aceita permuta')
);

$tree8_2 = array(
     array('divider','<div class="clear h30"></div><div class="alert alert-info"><i class="fa fa-check-square-o"></i>Identificação dos autores, empresas e estilo de arquitetura</div><div class="clear"></div>'),
	 array('Arquitetura','archtect','text','form-control'),
	 array('Interiores','decorator','text','form-control'),
	 array('Paisagismo','paisagist','text','form-control'),
	 array('Incorporadora/Construtora','incorporator','text','form-control'),
	 array('Condomínio','condominio','text','form-control'),
	 array('Estilo de arquitetura','style','text','form-control')
);

$tree2 = array(	 
	 array('Descrição completa do imóvel','fullDesc','obs','validate[required] form-control')
);

$tree3 = array(
	 array('CEP','zipCode','cep','validate[required] form-control'),
	 array('Estado','province','text','validate[required] form-control', '', 2),
	 array('Cidade','city','text','validate[required] form-control'),
	 array('Bairro','district','text','validate[required] form-control'),
	 array('Logradouro','address', 'text' ,'validate[required] form-control'),
	 array('Número','number', 'text' ,'validate[required] form-control'),
	 array('Complemento','adjunct', 'text' ,'form-control')
);

$tree7 = array(
	 array('Área do terreno','area_terreno','text','validate[required] form-control'),
	 array('Metragem frente','frente_terreno','text','validate[required] form-control', '', 2),
	 array('Metragem fundo','fundo_terreno','text','validate[required] form-control'),
	 array('Formato do terreno','formato_terreno','radiogroup' => array(array('1','Regular'), array('2','Irregular')),'validate[required] form-control'),
	 array('Topografia do terreno','nivel_terreno', 'radiogroup' => array(array('1','Plano'), array('2','Aclive'), array('3','Declive')) ,'validate[required] form-control')
);

$tree4 = array(
	 array('Visualização do endereço','mostrarEndereco','select' => array(array('0','Mostrar endereço completo'), array('1','Não mostrar endereço do imóvel'), array('2','Não mostrar o número do imóvel')),'validate[required] form-control'),
	 array('Código de referência','codigoRef', 'text','form-control')
);

$tree9 = array(array('Características do Imóvel','building_details','checkboxlist' => $building_details_itens,' form-control'));
	 
$tree11 = array(array('Características da Área Comum','area_details','checkboxlist' => $area_details_itens,' form-control'));

$tree10 = array(
);
?>

<div class="span12">

	<?php 
	
    if(!isset($_GET['novo']) && !isset($_GET['editar'])){
		if(isset($_SESSION['SYSBYLN__haveNoPays'])) {
			echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a><i class="fa fa-exclamation-circle"></i>
			Torne seus anúncios visíveis publicamente já! <a href="admin.php?minhaConta&transacoes">Clique aqui</a> para efetuar o pagamento dos planos adicionados.</div>'; }
		
		if(isset($_SESSION['SYSBYLN__haveNoFinished'])) {
			echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#">&times;</a><i class="fa fa-exclamation-circle"></i>
			Você possui anúncios incompletos. <a href="admin.php?meusAnuncios&view&onlyview=3">Clique aqui</a> para terminar de criar seus anúncios.</div>'; }
	}
	
	if(isset($_GET['msg'])){ ?>
                <?php if(isset($_GET['anunError'])) { ?>
                <div class="alert alert-danger hidetime"><i class="fa fa-exclamation-circle"></i>Ops! Houveram erros ao criar seu anuncio. Por favor, contate o suporte.</div>
                <? } elseif(isset($_GET['anunOk'])) { ?>
                <div class="alert alert-success hidetime"><i class="fa fa-check-square-o"></i>Seu anúncio está concluído.</div>
                <? } elseif(isset($_GET['editOk'])) { ?>
                <div class="alert alert-success hidetime"><i class="fa fa-check-square-o"></i>Seu anúncio foi editado.</div>
                <? } elseif(isset($_GET['renOk'])) { ?>
                <div class="alert alert-success hidetime"><i class="fa fa-check-square-o"></i>Seu anúncio foi renovado.</div>
                <? } elseif(isset($_GET['deleteOk'])) { ?>
                <div class="alert alert-success hidetime"><i class="fa fa-check-square-o"></i>Anúncio excluído.</div>
                <? } elseif(isset($_GET['deleteErro'])) { ?>
                <div class="alert alert-danger hidetime"><i class="fa fa-exclamation-circle"></i>Erro ao excluir o anúncio: Você não tem permissão.</div>
                <? } elseif(isset($_GET['notAllowed'])) { ?>
                <div class="alert alert-danger hidetime"><i class="fa fa-exclamation-circle"></i>Você não pode criar anúncios sem possuir créditos.</div>
                <? } elseif(isset($_GET['alreadyCreated'])) { ?>
                <div class="alert alert-danger hidetime"><i class="fa fa-exclamation-circle"></i>Você já criou um anúncio no plano selecionado, ele está disponível para continuação abaixo.</div>
                <? } elseif(isset($_GET['forbidden'])) { ?>
                <div class="alert alert-danger hidetime"><i class="fa fa-exclamation-circle"></i>Você não tem permissão para executar esta ação.</div>
                <? } elseif(isset($_GET['stchngOk'])) { ?>
                <div class="alert alert-success hidetime"><i class="fa fa-exclamation-circle"></i>O status de exibição do anúncio foi alterado.</div>
                <? } elseif(isset($_GET['stchngErro'])) { ?>
                <div class="alert alert-danger hidetime"><i class="fa fa-exclamation-circle"></i>Erro ao modificar o anúncio: Você não tem permissão.</div>
                <? } elseif(isset($_GET['expiredLogin'])) { ?>
                <div class="alert alert-danger hidetime"><i class="fa fa-exclamation-circle"></i>Seu login expirou! Entre com seu email e senha novamente para efetuar um novo login.</div>
                <? } elseif(isset($_GET['differentType'])) { ?>
                <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>Seu perfil de usuário não permite a criação de Publicidade, apenas Anúncios.</div>
                <? } elseif(isset($_GET['needBuy'])) { ?>
                <div class="alert alert-success" style="margin-bottom:5px;"><i class="fa fa-check-square-o"></i>Seu anúncio foi criado.</div><div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i>Você criou um novo anúncio, mas ele só estará visível publicamente após o pagamento do plano contratado.<br />Para efetuar o pagamento agora, <a href="admin.php?minhaConta&transacoes">clique aqui</a>.</div>
                <? } ?>
    <? } ?>

	<div class="row-fluid">
    
		<div class="span3 fullRow985">
        	<legend><i class="fa fa-bullhorn"></i> Meus anúncios</legend>
			<ul class="nav nav-list">
                <li><a href="admin.php?meusAnuncios&novo"><i class="fa fa-plus-square"></i> Criar anúncio</a></li>
                <li><a href="index.php?anunciar"><i class="fa fa-sign-in"></i> Adicionar planos</a></li>
                <li><a href="admin.php?meusAnuncios&view"><i class="fa fa-check-square"></i> Anúncios cadastrados</a></li>
			</ul>
		</div>

		<div class="span9 fullRow985">
        
	<?php if(isset($_GET['novo'])){ 
                
				if(isset($_GET['concluir']) && isset($_POST['autosaveKey'])){ 
					
					$anunID = secURLdecode($_POST['autosaveKey']);
					
					$query = $newCrud->update("finished=?", 'buildings', 'id=?');
					$query->bind_param('ii', $s=1, $anunID);
					$query->execute();
					
					if($_POST['edit_mode']==0){
						$query2 = $newCrud->selectCustomQuery('SELECT `transactions`.`status` as sts_pagto, `campaigns`.`id` as cid, `campaigns`.`period` as tempo FROM `campaigns` INNER JOIN `transactions` ON `transactions`.`id` = `campaigns`.`transaction_id` WHERE `campaigns`.`building_id` = '.$anunID);
						$queryLP = $query2->fetch_assoc();
						
						if($queryLP['sts_pagto']==3 || $queryLP['sts_pagto']==4){
							
							$periodoStart = date("Y-m-d");
							$periodoVar = $queryLP['tempo'];
							$periodoExp = explode("-", $periodoStart);
							$periodoEnd = date("Y-m-d", mktime(0, 0, 0, $periodoExp[1] + $periodoVar, $periodoExp[2], $periodoExp[0]));
							
							$query3 = $newCrud->update("start=?, end=?, status=?, pause=?", 'campaigns', 'id=?');
							$query3->bind_param('ssiii', $periodoStart, $periodoEnd, $s=1, $p=0, $queryLP['cid']);
							$query3->execute();
						}
					}
					
					if($_SESSION['SYSBYLN__user_root_level']==1 && isset($_GET['root'])){
						header('Location: root.php?anuncios&imoveis&msg&editOk');
					}

					header('Location: admin.php?meusAnuncios&view&msg&anunOk');
				
					
				} elseif(isset($_GET['cadastrar']) || isset($_GET['editar'])){ 
				
					if(isset($_GET['editar'])){
						$id = secURLdecode($_GET['token']);
						$autosaveKey = $id;
						$editar=1;
						if($_SESSION['SYSBYLN__user_root_level']==1 && isset($_GET['root'])){
							$checkDataSql = '';
						} else {
							$checkDataSql = 'AND `buildings`.`profile_id` = '.$_SESSION['SYSBYLN__user_id'].' AND `campaigns`.`end` > "'.$PRE_hoje.'"';
						}
						
						$query = $newCrud->selectArrayPostWhere('`buildings`.* , `campaigns`.`end` as fim','`buildings` INNER JOIN `campaigns` ON `buildings`.`id` = `campaigns`.`building_id`','WHERE `buildings`.`id` = '.$id.' '.$checkDataSql);
						
						$queryLP = $query->fetch_assoc();
						$queryNumRows = $query->num_rows;
							if(!$queryNumRows){ header('Location: admin.php?meusAnuncios&view&msg&forbidden'); }
						
						$latitude = $queryLP['latitude'] ? $queryLP['latitude'] : '-14.235004';
						$longitude = $queryLP['longitude'] ? $queryLP['longitude'] : '-51.92527999999999';
												
						$initLatLng = $latitude.', '.$longitude;
						$initZoom = 16;
												
						$tipoPlan = $queryLP['statusimovel'];
						$pagTitle = 'Editar anúncio';
						
						$tipoUsoSelected = $queryLP['tipouso'];
						
						$buildingID = $queryLP['id'];
						
					} else {
						$initLatLng = '-14.235004, -51.92527999999999';
						$initZoom = 3;
						$editar=0;
						$queryLP='';
	
						$selectedPlan = secURLdecode($_GET['planSelect']);
						$keyExp = explode(",", $selectedPlan);
						$PRE_key = $keyExp[1];
						$PRE_id = $keyExp[0];
						$num_credit = $PRE_planos[$PRE_key]['credit'];
						$num_dstq = $PRE_planos[$PRE_key]['destaque'];
						$num_sdstq = $PRE_planos[$PRE_key]['superdestaque'];
						
						if(array_search_multi($PRE_id,$PRE_planos)==false || (isset($_GET['typeSelect']) && $num_credit == 0) || (($_GET['typeSelect'] == 0 || $_GET['typeSelect'] == 1) && $num_credit == 0) || ($_GET['typeSelect'] == 1 && $num_dstq==0) || ($_GET['typeSelect'] == 2 && $num_sdstq==0) || (isset($_GET['cadastrar']) && !isset($_GET['planSelect'])) || (isset($_GET['cadastrar']) && !isset($_GET['typeSelect'])) || (isset($_GET['cadastrar']) && !isset($PRE_planos)) || (isset($_GET['cadastrar']) && sizeof($PRE_planos)==0) || ($_GET['typeSelect'] != 4 && $PRE_planos[$PRE_key]['plan_credit']==1)){
							header('Location: admin.php?meusAnuncios&view&msg&notAllowed');
							exit;
						}
						
						if(!isset($_SESSION['SYSBYLN__newVerify'])){
							header('Location: admin.php?meusAnuncios&view&msg&alreadyCreated');
							exit;
						}
						
						unset($_SESSION['SYSBYLN__newVerify']);
						
						$tempIDquery = $newCrud->insert('`profile_id`, `finished`', 'buildings', '?,?');
						$tempIDquery->bind_param('ii', $_SESSION['SYSBYLN__user_id'], $f=0);
						$tempIDquery->execute();
						$autosaveKey = $tempIDquery->insert_id;
						
						
						$tipoPlan = $PRE_planos[$PRE_key]['tipo_plan'];
						
						$pagTitle = 'Novo anúncio';
						
						if($PRE_planos[$PRE_key]['plan_credit']==1 && $_GET['typeSelect']==4){
							  $dest_val = $num_dstq;
							  $sdest_val = $num_sdstq;
						} else {
							  switch($_GET['typeSelect']){
								  case 0:
									  $dest_val = 1;
									  $sdest_val = 0;
									  break;
								  case 1:
									  $dest_val = 0;
									  $sdest_val = 1;
									  break;
							  }
						}
						  
						$periodoStart = date("Y-m-d");
						$periodoVar = $PRE_planos[$PRE_key]['period'];
						$periodoExp = explode("-", $periodoStart);
						$periodoEnd = date("Y-m-d", mktime(0, 0, 0, $periodoExp[1] + $periodoVar, $periodoExp[2], $periodoExp[0]));
						
						$query3 = $newCrud->fastInsert('user_id, transaction_id, building_id, period, destaque, superdestaque, start, end, status, pause', 'campaigns', $_SESSION['SYSBYLN__user_id'].','.$PRE_planos[$PRE_key]['id'].','.$autosaveKey.','.$PRE_planos[$PRE_key]['period'].','.$dest_val.','.$sdest_val.',"'.$periodoStart.'","'.$periodoEnd.'", 0, 1');
						
					}
										
					$newTempID = '<input type="hidden" id="autosaveKey" name="autosaveKey" value="'.secURLencode($autosaveKey).'">';
					
					if($tipoPlan == 0){
						$varTree1 = array('Status do imóvel','statusimovel','select' => array(array('0','Lançamento')),'validate[required] form-control');
						$varTree2 = array(array('Finalidade','finalidade','select' => array(array('Comprar','Vender')),'validate[required] form-control'),
		 							array('Tipo de uso','tipouso','select' => array(array('1','Residencial'), array('2','Comercial'), array('3','Lazer')),'validate[required] form-control'));
					} else {
						$varTree1 = array('Status do imóvel','statusimovel','select' => array(array('1','Pronto')),'validate[required] form-control');
						$varTree2 = array(array('Finalidade','finalidade','select' => array(array('Comprar','Vender'), array('Alugar','Alugar'), array('Temporada','Temporada')),'validate[required] form-control'),
		 							array('Tipo de uso','tipouso','select' => array(array('1','Residencial'), array('2','Comercial'), array('3','Lazer')),'validate[required] form-control'));
					}

					if(isset($_GET['editar']) && ($_SESSION['SYSBYLN__user_level'] == 1 || $_SESSION['SYSBYLN__user_root_level']==1)){
						$varTree1 = array('Status do imóvel','statusimovel','select' => array(array('0','Lançamento'),array('1','Pronto')),'validate[required] form-control');
						$varTree2 = array(array('Finalidade','finalidade','select' => array(array('Comprar','Vender'), array('Alugar','Alugar'), array('Temporada','Temporada')),'validate[required] form-control'),
		 							array('Tipo de uso','tipouso','select' => array(array('1','Residencial'), array('2','Comercial'), array('3','Lazer')),'validate[required] form-control'));
					}
					
					$tree5[] = $varTree1;
					$tree5 = array_reverse($tree5);
					
					echo '<legend>'.$pagTitle.'</legend>';
					?>
			
            <form action="admin.php?meusAnuncios&novo&concluir<?=($_SESSION['SYSBYLN__user_root_level']==1 && isset($_GET['root'])) ? '&root' : '';?>" id="addForm" method="post" class="validate novoimovel exitVerify" accept-charset="utf-8" name="addForm">
                <fieldset>
                	<?=$newTempID;?>
                    
					<div class="alert alert-success">
                    	<i class="fa fa-lightbulb-o"></i>Os campos abaixo possuem auto-formatação. Digite apenas letras e números. Pontos e traços serão adicionados automaticamente. Campos em branco serão ignorados nos resultados de buscas.
					</div>
					<div class="clear"></div>
					<div class="alert alert-info"><i class="fa fa-check-square-o"></i>Qual será a finalidade e tipo de uso do imóvel?</div>
					<div class="clear"></div>
					
					<?=formBuilder($varTree2,'span4 large_rowfluid700',$editar,$queryLP);?>
					
					<div id="statusimovelToggle">
                        <div class="clear h30"></div>
                        <div class="alert alert-info"><i class="fa fa-check-square-o"></i>Defina se o empreendimento é um lançamento ou já está pronto. Opções complementares serão exibidas conforme a escolha do Status.</div><div class="clear"></div>
                        <?=formBuilder($tree5,'span4 large_rowfluid700',$editar,$queryLP);?>
					</div>
					
					<div id="dadosTerreno">
                        <div class="clear h30"></div><div class="alert alert-info"><i class="fa fa-check-square-o"></i>Dados do terreno.</div><div class="clear"></div>
                        <?=formBuilder($tree7,'span4 large_rowfluid700',$editar,$queryLP);?>
					</div>
                    
					<div id="dadosComum">
                        <div class="clear h30"></div><div class="alert alert-info"><i class="fa fa-check-square-o"></i>Dados do empreendimento.</div><div class="clear"></div>
                        <?=formBuilder($tree6,'span4 large_rowfluid700',$editar,$queryLP);?>
					</div>
                    
					<?=formBuilder($tree8,'span4 large_rowfluid700',$editar,$queryLP);?>
					
					<div id="dadosAptoLc">
                        <div class="clear h30"></div><div class="alert alert-info"><i class="fa fa-check-square-o"></i>Agora, defina o nome/título do lançamento e os tipos de apartamentos que ele terá. Você pode adicionar vários tipos diferentes de aptos clicando no botão 'Adicionar linha de tipo' abaixo.</div><div class="clear"></div>
                            <?=formBuilder($tree15,'span4 large_rowfluid700',$editar,$queryLP);?>
                            <div class="clear h20"></div>
                            <table class="table table-bordered table-condensed mobileTable" style="margin-bottom:10px;">
                                <thead>
                                    <tr>
                                        <th width="45%">Tipo</th>
                                        <th width="20%" class="chngOpt">Área privativa</th>
                                        <th width="5%" class="hideOpt">Dorms.</th>
                                        <th width="5%" class="hideOpt">Suítes</th>
                                        <th width="5%" class="hideOpt">Vagas</th>
                                        <th width="17%">Valor</th>
                                        <th width="3%">Rem.</th>
                                    </tr>
                                </thead>
                                <tbody id="tipoCampos">
                                
                                	<?php
										if($editar == 1 && $tipoPlan == 0){
											$query5 = $newCrud->selectArrayPostWhere('*','buildings_type','WHERE building_id='.$queryLP['id']);
											while($lcItensLP = $query5->fetch_assoc()){ 
												
												echo '<tr class="dadosAptoLinha">
                                                <td>
													<select name="tipoAptoLc[]" class="validate[required] form-control chosen-select tipoAptoLc" data-placeholder="Selecione" style="width:90%;"><option></option>';
															$query6 = $puxaBD->selectArrayPostWhere('id,name,types','types','WHERE apto=1 AND id!=0 ORDER BY name ASC');
															  while($queryILC = $query6->fetch_assoc()){ 
																  echo "<option value='".$queryILC['id']."'";
																  		if($queryILC['id'] == $lcItensLP['tipoAptoLc']){ echo ' selected="selected"'; }
																  		if($queryILC['types'] != $tipoUsoSelected){ echo ' style="display:none"'; }
																  echo ">".utf8_encode($queryILC['name'])."</option>";
															  }
															unset($query6);
												echo '</select>
												</td>
												<td style="text-align:center;">
													<div class="input-append"><input type="text" name="areaAptoLc[]" class="areaAptoLc validate[required] form-control" style="width:60px;" value="'.moneyDecode($lcItensLP['areaAptoLc']).'" /><span class="add-on">m²</span></div>
												</td>
												<td style="text-align:center;" class="hideOpt">
													<input type="text" name="dormsAptoLc[]" class="validate[required] form-control" style="width:20px;" value="'.$lcItensLP['dormsAptoLc'].'" />
												</td>
												<td style="text-align:center;"  class="hideOpt">
													<input type="text" name="suitesAptoLc[]" class="validate[required] form-control" style="width:20px;" value="'.$lcItensLP['suitesAptoLc'].'" />
												</td>
												<td style="text-align:center;"  class="hideOpt">
													<input type="text" name="vagasAptoLc[]" class="validate[required] form-control" style="width:20px;" value="'.$lcItensLP['vagasAptoLc'].'" />
												</td>
												<td style="text-align:center;">
													<div class="input-prepend"><span class="add-on">R$</span><input type="text" name="vlrAptoLc[]" class="vlrAptoLc form-control validate[required]" style="width:100px;" value="'.moneyDecode($lcItensLP['vlrAptoLc']).'" /></div>
												</td>
												<td style="text-align:center;">
													<button class="btn btn-small btn-danger remLinha" type="button"><i class="fa fa-times" style="margin:0;"></i></button>
												</td>
												</tr>';
											
                                            }
										}
											?>
                                
                                </tbody>
                            </table>
                            <button class="btn btn-success novaLinha" type="button"><i class="fa fa-plus"></i>Adicionar linha de tipo</button>
					</div>
                    
                    <div id="dadosValor">
                        <div class="clear h30"></div>
                        <div class="alert alert-info"><i class="fa fa-check-square-o"></i>Defina abaixo o valor do imóvel.</div>
                        <div class="clear"></div>
                        <?=formBuilder($tree12,'span4 large_rowfluid700',$editar,$queryLP);?>
                    </div>
					
					<?=formBuilder($tree8_2,'span4 large_rowfluid700',$editar,$queryLP);?>
					
     				<div class="clear h30"></div>
						<div class="alert alert-info"><i class="fa fa-check-square-o"></i>Ótimo. Agora precisamos de uma descrição completa do imóvel. Este texto estará visível na página de detalhes do imóvel e quanto mais detalhado ele for, maiores são as chances do anúncio ser encontrado em mecanismos de busca externos (Google, Bing, Yahoo). <br />
                        <i class="fa fa-check-square-o"></i>Abaixo do campo de texto, você pode inserir conteúdos externos como vídeos, imagens, tour virtual, links para sites e hotsites, etc...</div>
					<div class="clear"></div>
					
					<?=formBuilder($tree2,'span12',$editar,$queryLP);?>
                    
                    <div class="clear h20"></div>
                    
                    <? $query435 = $newCrud->selectArrayPostWhere('type,link','buildings_external_links','WHERE building_id='.$buildingID);
					   $exibeDivExt = ($query435->num_rows > 0) ? 'block' : 'none';
					?>
                    <div id="extContentHolder" style="display:<?=$exibeDivExt;?>;">
                        <table class="table table-bordered table-condensed mobileTable">
                          <thead>
                              <tr>
                                  <th width="30%">Tipo de conteúdo</th>
                                  <th width="67%">Link para o conteúdo</th>
                                  <th width="3%">Rem.</th>
                              </tr>
                          </thead>
                          <tbody id="extContentHtmlHolder">
						  <?
                              if($query435->num_rows > 0){
                                  while($extCnctItens = $query435->fetch_assoc()){
                                      echo '
                                          <tr>
                                              <td>
                                                  <select name="extContentType[]" class="validate[required] form-control chosen-select" data-placeholder="Selecione" style="width:90%;">
                                                      <option></option>';
                                                      foreach($extContentTypes as $key=>$value){
                                                          echo "<option value='".$key."'";
                                                              if($key == $extCnctItens['type']){ echo ' selected="selected"'; }
                                                          echo ">".$value."</option>";
                                                      }
                                                  echo '
                                                  </select>
                                              </td>
                                              <td>
                                                  <input type="text" name="extContentLink[]" class="form-control validate[required]" style="width:96%;" value="'.utf8_encode($extCnctItens['link']).'" placeholder="Insira o link para o conteúdo aqui" />
                                              </td>
                                              <td style="text-align:center;">
                                                  <button class="btn btn-small btn-danger extContentLineDel" type="button"><i class="fa fa-times" style="margin:0;"></i></button>
                                              </td>
                                          </tr>
                                      ';
                                  }
                              }
                          ?>
                          </tbody>
                        </table>
                    </div>
                    <button class="btn btn-success addExtContent" type="button"><i class="fa fa-plus"></i>Adicionar conteúdo externo</button>
                    
					
					<div id="minidesc_holder" style="display:none;">
						<div class="clear h30"></div>
						<div class="alert alert-info"><i class="fa fa-check-square-o"></i>Utilize a caixa de texto abaixo para especificar em poucas linhas os principais diferenciais do lançamento. O que você vê na caixa é exatamente o que será exibido na lista de resultados. Todo texto que ultrapassar o limite do box será excluído.</div>
						<div class="clear"></div>

						<div id="htmlTXT_panel" style="width: 100%;"></div>
						<div class="clear"></div>
						
						<div class="span12 lancDescBox">
							<div id="lancTitlePreview" style="display:block; margin:0; padding:0; font-size:13px; color:#468847; line-height:30px; height:30px;"></div>
							<div class="clear h20"></div>
							<textarea class="previewTextInput" name="miniDesc" id="htmlTXT_txtbox" style="display:block; width:314px; height:130px;" placeholder="Digite aqui a descrição curta" maxlength="140"><?php echo $editar==1 ? utf8_encode($queryLP['miniDesc']) : ''; ?></textarea>
							<div class="clear h10"></div>
							<div class="clear"></div>
						</div>
						<div class="clear"></div>
					</div>
					
					
                    <div class="clear h30"></div>
                    <div class="alert alert-info"><i class="fa fa-check-square-o"></i>Utilize os ckeckboxes abaixo para marcar as características do imóvel. (Mínimo de 1 opção obrigatório)</div>
                    <div class="clear"></div>

					<?=checkboxBuilder($tree9,'span4 nominheight large_rowfluid700',$editar,$queryLP);?>
					<div class="apCaracs">
                    <div class="clear h30"></div>
                    <div class="alert alert-info"><i class="fa fa-check-square-o"></i>Agora, utilize os ckeckboxes abaixo para marcar as características da área comum do empreendimento. (Mínimo de 1 opção obrigatório)</div>
                    <div class="clear"></div>
					<?=checkboxBuilder($tree11,'span4 nominheight large_rowfluid700',$editar,$queryLP);?>
					</div>
					
                    <div class="clear"></div>
                    
					<div class="clear h30"></div>
                    <div class="alert alert-info"><i class="fa fa-check-square-o"></i>Agora, precisamos da localização do imóvel. Caso você não queira divulgar o endereço do imóvel, você pode ocultá-lo em um dos passos mais abaixo, mas seu preenchimento é obrigatório.
                    <div class="clear h5"></div>
                    <i class="fa fa-lightbulb-o"></i>Preencha o CEP e clique no botão <i class="fa fa-search"></i>para buscar seu endereço e preencher os campos automaticamente. Caso o marcador vermelho no mapa não aponte o local exato do imóvel, mova-o manualmente até o ponto correto.</div>
                    <div class="clear"></div>
                    
                    <?=formBuilder($tree3,'span4 large_rowfluid700',$editar,$queryLP);?>
					
                    <div class="clear h20"></div>
                    
                    <div class="span12" style="margin:0;">
                        	<input type="text" id="txtEndereco" name="txtEndereco" style="width:98%" placeholder="Entre com qualquer parte do endereço..." readonly="readonly" 
								<?php if($editar){echo 'value="'.utf8_encode($queryLP['enderecoCompleto']).'"';}?> />
                        	
                        <div class="mapa" id="mapa">
                        </div>
                    </div>
                    
                    
                    
					<?php 
						if($editar){
							$token_img = ($queryLP['images_id']) ? $queryLP['images_id'] : md5(uniqid(rand(), true));
							$token_vid = ($queryLP['videos_id']) ? $queryLP['videos_id'] : 0;
							$token_pln = ($queryLP['plantas_id']) ? $queryLP['plantas_id'] : md5(uniqid(rand(), true));
						} else {
							$token_img = md5(uniqid(rand(), true));
							$token_vid = 0;
							$token_pln = md5(uniqid(rand(), true));
						}
					?>
                    
                    <input type="hidden" name="latitude" id="txtLatitude" value="<?php if($editar){echo $queryLP['latitude'];}?>" />
                    <input type="hidden" name="longitude" value="<?php if($editar){echo $queryLP['longitude'];}?>" id="txtLongitude" />
                    <input type="hidden" name="enderecoCompleto" value="<?php if($editar){echo utf8_encode($queryLP['enderecoCompleto']);}?>" id="enderecoCompleto" />
                    <input type="hidden" id="images_id" name="images_id" value="<?php echo $token_img; ?>">
                    <input type="hidden" id="videos_id" name="videos_id" value="<?php echo $token_vid; ?>">
                    <input type="hidden" id="plantas_id" name="plantas_id" value="<?php echo $token_pln; ?>">
                    <input type="hidden" id="user_id" name="media_token" value="<?php echo $token_img; ?>">
                    <input type="hidden" id="type_id" name="media_type" value="1">
                    <input type="hidden" id="edit_mode" name="edit_mode" value="<?php echo $editar; ?>">
                    <input type="hidden" id="edit_control1" value="<?php echo $editar; ?>">
                    <input type="hidden" id="autosave_sts" name="autosave_sts" value="0">
					
                    <div class="clear h30"></div>
                    <div class="alert alert-info"><i class="fa fa-check-square-o"></i>Opções complementares.</div>
                    <div class="clear"></div>
					
					<?php echo formBuilder($tree4,'span4 large_rowfluid700',$editar,$queryLP); ?>
                    
                    <script src="<?=ROOTPATH?>js/AJAXupload/uploader/assets/js/fileupload.js"></script>
                    <script src="<?=ROOTPATH?>js/AJAXupload/uploader/assets/js/script.js"></script>
                    
					<script id="template-upload" type="text/x-tmpl">
                    {% for (var i=0, file; file=o.files[i]; i++) { var nameID=file.name; nameID=nameID.split('.'); %}
                        <li class="template-upload fade" id="{%=nameID[0]%}">
                            <span class="preview"></span>
                            {% if (file.error) { %}
                               <span class="label label-danger filetypenotallowed">Não permitido</span>
                            {% } %}
                            {% if (!o.files.error) { %}
                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                </div>
                            {% } %}
                        </li>
                    {% } %}
                    </script>
                    <script id="template-download" type="text/x-tmpl">
                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <li class="template-download fade {% if (file.image) { %}image{% } else if (file.url) { %}video{% } %}" id="sort_{%=file.id%}" data-file="{%=file.name%}">
                            {% if (file.error) { %}
                                <span class="label label-danger filetypenotallowed">Não permitido</span>
                            {% } %}
                            {% if (!file.error) { %}
								<span class="preview" title="{%=file.title%}">
									{% if (file.image) { %}
									   <img src="{%=file.thumbnailUrl%}" width="120" height="90" />
									{% } %}
								</span>
                                <div class="actions delete-file" style="color:#FFF; cursor:pointer;">
                                    <i class="fa fa-trash-o"></i>Excluir
                                </div>
                            {% } %}
                        </li>
                    {% } %}
                    </script>
                    <script id="template-download-planta" type="text/x-tmpl">
                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                        <li class="template-download fade {% if (file.image) { %}image{% } else if (file.url) { %}video{% } %}" id="sort_{%=file.id%}" data-file="{%=file.name%}">
                            {% if (file.error) { %}
                                <span class="label label-danger filetypenotallowed">Não permitido</span>
                            {% } %}
                            {% if (!file.error) { %}
								<span class="preview">
									{% if (file.image) { %}
									   <img src="{%=file.thumbnailUrl%}" width="120" height="90" />
									{% } %}
								</span>
                                <div class="actions delete-file" style="color:#FFF; cursor:pointer;">
                                    <i class="fa fa-trash-o"></i>Excluir
                                </div>
								<div class="planta-legenda">
									<label>Legenda da planta (opcional)</label>
									<input type="text" name="planta-legenda" class="planta-legenda-input" data-planta_id="{%=file.id%}" value="{%=file.title%}" />
								</div>
                            {% } %}
                        </li>
						<div class="clear h10"></div>
                    {% } %}
                    </script>
                    
                    
                    <div class="clear h30"></div>
                    <hr />
                    <div class="clear"></div>
                    
                    <div class="alert alert-info"><i class="fa fa-check-square-o"></i>Vamos criar o conteúdo multimídia para seu anúncio. Você pode enviar 1 vídeo, até 30 fotos e até 15 plantas. O vídeo e todas as fotos estarão restritas apenas ao site, sem propagação/divulgação externa.
                    </div><div class="clear"></div>
                    
                    <div class="alert alert-info"><i class="fa fa-check-square-o"></i>Utilize o botão 'Escolher fotos' para enviar imagens, envie um mínimo de 6 e um máximo de 30 fotos (.jpg .jpeg .gif .png - máx. 5MB cada). Dê preferência a imagens 'quadradas' (formado 4:3) e sem bordas de cor sólida, isso valoriza o visual de seu anúncio!</div>
                    <div class="clear"></div>
                    
                    <div class="span12" style="margin:0; color:">
                    	<label>Fotos - Arraste as fotos para reorganizá-las. A primeira foto será a capa do anúncio.</label>
                         <div id="fileupload">   
                            <ul class="files images"></ul>
                            <div class="clear"></div>
                            <ul class="files attachments"></ul>
                            <div class="clear"></div>
                            <div class="loading-files"></div>
                            <div class="clear"></div>
                            <div class="fileupload-buttonbar">
                                <span class="btn btn-sm btn-success fileinput-button"><i class="fa fa-upload"></i><span>Escolher fotos</span><input type="file" name="files[]" multiple></span>
                                <span class="btn btn-sm btn-warning maxlimit" style="display:none;"><i class="fa fa-exclamation-circle"></i><span>Limite máximo alcançado</span></span>
                                <span class="btn btn-sm btn-warning minlimit" style="display:none;"><i class="fa fa-exclamation-circle"></i><span>Mínimo de 6 fotos não alcançado</span></span>
                            </div>
                        </div>
                    </div>

                    <div class="clear h30"></div>
                    
                    <div class="alert alert-info"><i class="fa fa-check-square-o"></i>Deseja enviar as plantas do imóvel? Utilize o botão 'Escolher plantas' para enviar imagens, envie um máximo de 15 imagens (.jpg .jpeg .gif .png - máx. 5MB cada). O envio das plantas é opcional.</div>
                    <div class="clear"></div>
                    
                    <div class="span12" style="margin:0;">
                    	<label>Plantas do imóvel</label>
                         <div id="plantaupload">   
                            <ul class="files planta"></ul>
                            <div class="clear"></div>
                            <div class="loading-files"></div>
                            <div class="clear"></div>
                            <div class="plantaupload-buttonbar">
                                <span class="btn btn-sm btn-success plantaupload-button"><i class="fa fa-upload"></i><span>Escolher plantas</span><input type="file" name="files[]" multiple></span>
                                <span class="btn btn-sm btn-warning plantaupload-maxlimit" style="display:none;"><i class="fa fa-exclamation-circle"></i><span>Limite máximo alcançado</span></span>
                            </div>
                        </div>
                    </div>
                    
                </fieldset>
            </form>
            
            <?php  
				$vidUpTkn = get_video_upload_info('Vídeo do imóvel - '.$autosaveKey);
				if($vidUpTkn){
			?>
            <form method="post" action="<?=$vidUpTkn['post_url'];?>?nexturl=http://allbodyscan3d.com.br/ajaxQuery.php?videoUploadSts" enctype="multipart/form-data" target="uploadVideo" id="vidUploadForm" class="novoimovel">

                <div class="clear h10"></div>
                
                <div class="alert alert-info"><i class="fa fa-lightbulb-o"></i>Utilize o botão 'Escolher vídeo' para enviar o arquivo de vídeo. Formatos suportados: .mp4 .m4v .mpeg4 .mov .avi .wmv .webm .mpegps .flv .3gpp (qualquer resolução - máx 30mb). O envio do vídeo é opcional.<br />
                <i class="fa fa-lightbulb-o"></i>O envio do vídeo pode demorar alguns minutos dependendo da qualidade e do tamanho do arquivo. Aguarde o aviso de 'Vídeo enviado' antes de finalizar seu anúncio.</div><div class="clear"></div>
                
                <div class="span12" style="margin:0;">
                    <label>Vídeo (máximo de 1 vídeo)</label>
                     <div id="videoupload"> 
                     
                          <?php 
						  	  $haveVideo = '';
							  if($editar && $token_vid){
								  
								  echo '<div class="haveVideo_box">
								  			<iframe width="350" height="250" style="max-width:100% !important;" src="//www.youtube.com/embed/'.$token_vid.'" frameborder="0" allowfullscreen></iframe>
								  			<div class="clear h10"></div>
											<button type="button" id="vidUploadRemove" data-vid="'.$token_vid.'" class="btn btn-danger"><i class="fa fa-times"></i>Remover vídeo</button>
								  		</div>';
								  
							  	$haveVideo = ' style="display:none;"';
							  }
						  ?>
                       
                        <div class="videoupload-buttonbar haveVideo_box" <?=$haveVideo;?>>
                          <input name="token" type="hidden" value="<?=$vidUpTkn['upload_token'];?>" />   
                          <span class="btn btn-sm btn-success vidUploadTggl fileinput-button"><i class="fa fa-upload"></i><span>Escolher vídeo</span><input type="file" id="videofile" name="file" accept="video/*" /></span>
                          <span class="btn btn-sm btn-primary vidUploadTggl" style="display:none;"><i class="fa fa-refresh fa-spin"></i><span>Enviando o vídeo, aguarde.</span></span>
                        </div>
                    </div>
                </div>
                    
            <div class="clear"></div>
            </form>
            <iframe id="uploadVideo" style="display:none !important;" name="uploadVideo"></iframe>
            
			<? } else { ?>
                <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i>O serviço de envio de vídeos está indisponível no momento. Por favor, tente enviar seu vídeo mais tarde através do botão 'Gerenciar' > 'Editar' dentro do anúncio a ser criado.</div>
            
            <? } ?>
                    
            <div class="clear h30"></div>
            
            <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i>Certifique-se de que todos os campos acima foram preenchidos corretamente.<br />Todos os dados são fundamentais para uma busca rápida e precisa.<br /><b>Se tudo estiver correto, clique em 'Verificar e salvar' abaixo.</b><br /><i class="fa fa-exclamation-circle"></i>Seu anúncio só estará <b>completo</b> após clicar no botão 'Verificar e salvar'</div>
            <div class="clear"></div>

            <button class="btn btn-success btn-large" type="button" style="display:none;" id="btnSbmtCad">Verificar e salvar</button>
            <button type="button" class="btn btn-large btn-primary disabled" disabled="disabled" id="btnCadWait">Fotos insuficientes</button>
            <button class="btn btn-danger btn-large" type="button" onclick="history.go(-1);">Cancelar</button>
            <div class="clear h30"></div>
            
            <table style="height:0px; overflow:hidden; opacity:0; display:none;">
            	<tbody id="typeTmpl">
                <tr class="dadosAptoLinha"><td><select name="tipoAptoLc[]" id="lcMultiSel" class="validate[required] form-control tipoAptoLc" data-placeholder="Selecione" style="width:90%;"><option></option>
				<?php
                    $query = $puxaBD->selectArrayPostWhere('*','types','WHERE apto=1 AND id!=0 ORDER BY name ASC');
                      while($queryLP = $query->fetch_assoc()){ 
                          echo "<option value=\"".$queryLP['id']."\">".utf8_encode($queryLP['name'])."</option>";
                      }
                    unset($query);
                ?>
				</select></td><td style="text-align:center;"><div class="input-append"><input type="text" name="areaAptoLc[]" class="areaAptoLc validate[required] form-control" style="width:60px;" /><span class="add-on">m²</span></div></td><td style="text-align:center;" class="hideOpt"><input type="text" name="dormsAptoLc[]" class="validate[required] form-control" style="width:20px;" /></td><td style="text-align:center;"  class="hideOpt"><input type="text" name="suitesAptoLc[]" class="validate[required] form-control" style="width:20px;" /></td><td style="text-align:center;"  class="hideOpt"><input type="text" name="vagasAptoLc[]" class="validate[required] form-control" style="width:20px;" /></td><td style="text-align:center;"><div class="input-prepend"><span class="add-on">R$</span><input type="text" name="vlrAptoLc[]" class="vlrAptoLc form-control validate[required]" style="width:100px;" /></div></td><td style="text-align:center;"><button class="btn btn-small btn-danger remLinha" type="button"><i class="fa fa-times" style="margin:0;"></i></button></td></tr>
            	</tbody>
                
            	<tbody id="extContentTmpl">
                    <tr>
                        <td>
                            <select name="extContentType[]" class="validate[required] form-control" data-placeholder="Selecione" style="width:90%;" id="extCnctChosen">
                                <option></option>
                                <?
                                    foreach($extContentTypes as $key=>$value){
                                        echo "<option value='".$key."'>".$value."</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <input type="text" name="extContentLink[]" class="form-control validate[required]" style="width:96%;" value="" placeholder="Insira o link para o conteúdo aqui" />
                        </td>
                        <td style="text-align:center;">
                            <button class="btn btn-small btn-danger extContentLineDel" type="button"><i class="fa fa-times" style="margin:0;"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
                    <script type="text/javascript">
						var geocoder;
						var map;
						var marker;
						function initialize() {
							var latlng = new google.maps.LatLng(<?=$initLatLng;?>);
							var options = {
								zoom: <?=$initZoom;?>,
								center: latlng,
								mapTypeId: google.maps.MapTypeId.ROADMAP
							};
							map = new google.maps.Map(document.getElementById("mapa"), options);
							geocoder = new google.maps.Geocoder();
							marker = new google.maps.Marker({
								map: map,
								draggable: true,
							});
							marker.setPosition(latlng);
						}
						$(document).ready(function () {
							
							initialize();
							function carregarNoMapa(endereco) {
									geocoder.geocode({ 'address': endereco + ', Brasil', 'region': 'BR' }, function (results, status) {
										if (status == google.maps.GeocoderStatus.OK) {
											if (results[0]) {
												var latitude = results[0].geometry.location.lat();
												var longitude = results[0].geometry.location.lng();
												$('#txtEndereco').val(results[0].formatted_address);
												$('#enderecoCompleto').val(results[0].formatted_address);
												$('#txtLatitude').val(latitude);
												$('#txtLongitude').val(longitude);
												var location = new google.maps.LatLng(latitude, longitude);
												marker.setPosition(location);
												map.setCenter(location);
												map.setZoom(16);
											}
										}
									});
							}
							$("#txtEndereco").blur(function() {
								if($(this).val() != "")
									carregarNoMapa($(this).val());
							})	
							
							google.maps.event.addListener(marker, 'dragend', function () {
									geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
										if (status == google.maps.GeocoderStatus.OK) {
												if (results[0]) { 
												$('#txtEndereco').val(results[0].formatted_address);
												$('#enderecoCompleto').val(results[0].formatted_address);
												$('#txtLatitude').val(marker.getPosition().lat());
												$('#txtLongitude').val(marker.getPosition().lng());
											}
										}
									});
							});	
							$("#txtEndereco").autocomplete({
									source: function (request, response) {
										geocoder.geocode({ 'address': request.term + ', Brasil', 'region': 'BR' }, function (results, status) {
											response($.map(results, function (item) {
												return {
													label: item.formatted_address,
													value: item.formatted_address,
													latitude: item.geometry.location.lat(),
													longitude: item.geometry.location.lng()
												}
											}));
										})
									},
									select: function (event, ui) {
										$("#txtLatitude").val(ui.item.latitude);
										$("#txtLongitude").val(ui.item.longitude);
										var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
										marker.setPosition(location);
										map.setCenter(location);
										map.setZoom(16);
									}
							});		
							
							var linecount = 0;
							$('.novaLinha').click(function(e) {
								var dadosAptoHTML = $('#typeTmpl').html();
								dadosAptoHTML = dadosAptoHTML.replace("lcMultiSel", "lcMultiSel_"+linecount);
								$('tbody#tipoCampos').append(dadosAptoHTML);
								$("#lcMultiSel_"+linecount).chosen({
									no_results_text: "Nenhum resultado encontrado"
								});
								$('.areaAptoLc, .vlrAptoLc').maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
								$('.areaAptoLc, .vlrAptoLc').maskMoney('mask');
								//$("#tipouso").change();
								linecount++;
                            });
							if($('#tipoCampos tr').length == 0){$('.novaLinha').click();}
													
						});	
						
						$(document).on("click", ".remLinha", function() {
							if($('#tipoCampos tr').length > 1){
								$(this).parent().parent().remove();
							}
						});
						
						$(document).on("click", ".extContentLineDel", function() {
							$(this).parent().parent().remove();
							if($('#extContentHtmlHolder tr').length < 1){
								$('#extContentHolder').hide();
							}
						});
						
						$(document).on("change", "#lcMultiSel_0", function() {
							if($(this).val() == 18 || $(this).val() == 19){
								$('.hideOpt').fadeOut('fast');
								$('.chngOpt').html('Área do terreno');
							} else {
								$('.hideOpt').fadeIn('fast');
								$('.chngOpt').html('Área privativa');
							}
						});
						
				</script>
				<?php 
					$footerScriptADD[] = '
						$(".chosen-select").change().trigger("chosen:updated");
						$("#finalidade").change().trigger("chosen:updated");
					';
					
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// FIM DO ISSET>GET CADASTRAR
				
				} else {  
					$_SESSION['SYSBYLN__newVerify'] = 1;
				?>
                    <form method="get" class="validate">
                    <input type="hidden" name="meusAnuncios"/>
                    <input type="hidden" name="novo"/>
                    <input type="hidden" name="cadastrar"/>
                    <legend>Criar um novo anúncio (siga os passos abaixo)</legend>
                    <label>1. Selecione o plano a ser usado</label>
                    <?php 
					include 'inc/exibirPlanosDisponiveis.inc.php';
					
					if($count==0) { 
					
					header('Location: index.php?anunciar');
					
					} else { ?>
                    <div class="clear h10"></div>
                    <label>2. Selecione o tipo de anúncio a ser criado</label>
                    <div class="supericons" id="comboSelect">
                        
                        <label>
                            <div class="thumbnail listStyleFA selectAnunType" id="anunType1">
                            <input type="radio" name="typeSelect" class="validate[required]" value="0"/>
                                    <span class="fa-stack fa-lg">
                                      <i class="fa fa-square-o fa-stack-2x" style="color:#00a2ff;"></i>
                                      <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                <h3>Anúncio destaque (comum)</h3>                    	
                        		<div class="clear"></div>
                            </div>
                        	<div class="clear"></div>
                        </label>
                        
                        <div class="clear"></div>
                        
                        <label>
                            <div class="thumbnail listStyleFA selectAnunType" id="anunType2">
                            <input type="radio" name="typeSelect" class="validate[required]" value="1"/>
                                    <span class="fa-stack fa-lg">
                                      <i class="fa fa-square-o fa-stack-2x" style="color:#00a2ff;"></i>
                                      <i class="fa fa-star fa-stack-1x"></i>
                                      <i class="fa fa-plus fa-stack-0-5x fa-inverse"></i>
                                    </span>
                                <h3>Anúncio superdestaque (destaque exclusivo)</h3> 
                                <div class="clear"></div>                   	
                            </div>
                            <div class="clear"></div>
                        </label>
                        
                    </div>
                    
                    <div id="singleSelect">
                        <label class="radio">
                          <input type="radio" name="typeSelect" id="singleSelectOpt" value="4"/>Anúncio padrão <span id="singleSelectTXT"></span>
                        </label>  
                    </div>
                    
                    <div class="clear h30"></div>
                    
                    <label>3. Hora de criar o anúncio!</label>
                    <button type="submit" class="btn btn-success">Continuar <i class="fa fa-arrow-right"></i></button>
                    </form>
                    <div class="clear h20"></div>

				<?php } } ?>
	





			
	<?php } elseif(isset($_GET['excluir'])){ 
		$id = secURLdecode($_GET['token']);
		$checkUser = $newCrud->selectArrayPostWhere("profile_id", "buildings", "WHERE id = ".secURLdecode($_GET['token']));
		$chkUser = $checkUser->fetch_assoc();
			if($chkUser['profile_id'] == $_SESSION['SYSBYLN__user_id']){
				$delete1 = $newCrud->delete("buildings", "id = ".$id);
				$delete2 = $newCrud->delete("buildings_type", "building_id = ".$id);
				$delete3 = $newCrud->delete("building_details", "building_id = ".$id);
				$delete4 = $newCrud->delete("area_details", "building_id = ".$id);
				$delete5 = $newCrud->delete("recentes", "building_id = ".$id);
				$delete6 = $newCrud->delete("favorites", "building_id = ".$id);
				$update = $newCrud->update("building_id=?,start=?,end=?,status=?,expirado=?","campaigns", "building_id = ?");
				$update->bind_param('issiii',$b,$st0,$en0,$s=0,$e=1,$id);
				$update->execute();
				header('Location: admin.php?meusAnuncios&view&msg&deleteOk');
			} else {
				header('Location: admin.php?meusAnuncios&view&msg&deleteErro');
			}
	
	?>







			
	<?php } elseif(isset($_GET['desativar']) || isset($_GET['ativar'])){ 
		
		if(isset($_GET['desativar'])){ $act=0; $pause=1; } else { $act=1; $pause=0; }
		$checkUser = $newCrud->selectArrayPostWhere("user_id, transaction_id", "campaigns", "WHERE id = ".secURLdecode($_GET['token']));
		$chkUser = $checkUser->fetch_assoc();
		
		$checkTrns = $newCrud->selectArrayPostWhere("status", "transactions", "WHERE id = ".$chkUser['transaction_id']);
		$checkTrQR = $checkTrns->fetch_assoc();

			if(($chkUser['user_id'] == $_SESSION['SYSBYLN__user_id'] && ($checkTrQR['status']==3 || $checkTrQR['status']==4)) || ($_SESSION['SYSBYLN__user_root_level']==1 && isset($_GET['root']))){
				$update = $newCrud->update("status=? , pause=?","campaigns", "id = ?");
				$update->bind_param('iii',$act,$pause,secURLdecode($_GET['token']));
				$update->execute();
				
				if($_SESSION['SYSBYLN__user_root_level']==1 && isset($_GET['root'])){header('Location: root.php?anuncios&imoveis&msg&toggleOk');}else{header('Location: admin.php?meusAnuncios&view&msg&stchngOk');}
				
			} else {
				header('Location: admin.php?meusAnuncios&view&msg&stchngErro');
			}
	
	?>








			
	<?php } elseif(isset($_GET['view'])){ 
			
			$actBtns = array(0=>'Todos',1=>'Ativos',2=>'Desativados',4=>'Expirados/Vencimento próximo',3=>'Não terminados');
			
			echo '<legend>Anúncios cadastrados
			
				  <div class="btn-group menu900 pull-left">
					  <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">
						Filtrar exibição 
						<span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">';
						  foreach($actBtns as $key => $value){
							  if($_GET['onlyview']==$key) { $slctd = 'btn-info active'; $fntClr = '#FFF';} else { $slctd = ''; $fntClr = '#444';}
							  echo '<li><a class="'.$slctd.'" href="admin.php?meusAnuncios&view&onlyview='.$key.'" style="color:'.$fntClr.'">'.$value.'</a></li>';
						  }
						  echo '
					  </ul>
				  </div>
			  
				  <div class="buttons900">
					  <div class="btn-group pull-right">';
						  foreach($actBtns as $key => $value){
							  if($_GET['onlyview']==$key) { $slctd = 'btn-info active'; $fntClr = '#FFF';} else { $slctd = ''; $fntClr = '#444';}
							  echo '<a class="btn btn-small '.$slctd.'" href="admin.php?meusAnuncios&view&onlyview='.$key.'" style="color:'.$fntClr.'">'.$value.'</a>';
						  }
					  echo '</div>
				  </div>
				  </legend>
			<div class="row-fluid">';
			
			$nextExpExp = explode("-", $PRE_hoje);
			$nextExp = date("Y-m-d", mktime(0, 0, 0, $nextExpExp[1], $nextExpExp[2]+7, $nextExpExp[0]));
			
			if(isset($_GET['onlyview'])){
				if($_GET['onlyview']==1){$limit = 'AND `campaigns`.`status` = 1';}
				elseif($_GET['onlyview']==2){$limit = 'AND `campaigns`.`status` = 0 AND `buildings`.`finished` = 1 AND `campaigns`.`end` > "'.$PRE_hoje.'"';}
				elseif($_GET['onlyview']==3){$limit = 'AND `buildings`.`finished` = 0';}
				elseif($_GET['onlyview']==4){$limit = 'AND `campaigns`.`end` <= "'.$nextExp.'"';}
			} else {
				$limit = '';
			}

			$customSQL = "
				SELECT `buildings`.*, `multi_uploads`.`file` as imagem, `campaigns`.`start` as inicio, `campaigns`.`end` as fim , `campaigns`.`id` as actID, 
					   `campaigns`.`renovado` as renovado, `campaigns`.`expirado` as expirado, `campaigns`.`modified` as camp_modified,  
					   `campaigns`.`destaque` as destaque, `campaigns`.`superdestaque` as superdestaque, `campaigns`.`status` as anun_sts, `campaigns`.`pause` as pause, 
					   `transactions`.`status` as status_pagto  , `categories`.`name` as estagioObra
				FROM `buildings` 
				LEFT JOIN `multi_uploads` ON `buildings`.`images_id` = `multi_uploads`.`object_id` AND display_order=0
				INNER JOIN `campaigns` ON `buildings`.`id` = `campaigns`.`building_id` 
				INNER JOIN `transactions` ON `campaigns`.`transaction_id` = `transactions`.`id` 
				LEFT JOIN `categories` ON `buildings`.`estagio` = `categories`.`id` 
				WHERE `profile_id` = ".$_SESSION['SYSBYLN__user_id']." ".$limit." AND `campaigns`.`expirado` = 0 ORDER BY id DESC
			";
			
			$loop=0;
			$query = $newCrud->selectCustomQuery($customSQL);
			if($query->num_rows>0){
				while($queryLP = $query->fetch_assoc()){
						
						$secID=secURLencode($queryLP['actID']);
						$secBID=secURLencode($queryLP['id']);
	
						$dstq_txt = ($queryLP['superdestaque'] == 1) ? 'Superdestaque' : 'Destaque';
						$sts_txt = ($queryLP['anun_sts'] == 1) ? 'alert-success"><i class="fa fa-check"></i>Ativo' : 'alert-danger"><i class="fa fa-times"></i>Desativado';
						$expLink = '<div class="pull-right"><a href="admin.php?meusAnuncios&renovar&token='.$secID.'&type='.$queryLP['statusimovel'].'"><i class="fa fa-refresh"></i>Renovar</a></div>';
						
						if(strtotime($queryLP['fim']) <= strtotime($nextExp)){
							$remainDays = (strtotime($queryLP['fim']))-(strtotime($PRE_hoje));
							$remainDays = (int)floor( $remainDays / (60 * 60 * 24));
							$remainDays = ($remainDays==0) ? 'Hoje' : 'em '.$remainDays.' dias';
							$sts_txt = 'alert-warning"><i class="fa fa-clock-o"></i>Expira '.$remainDays.$expLink;
						}
						
						$sts_txt = (strtotime($PRE_hoje) > strtotime($queryLP['fim'])) ? 'alert-warning"><i class="fa fa-clock-o"></i>Expirado '.$expLink : $sts_txt;
						
						$imTitle = '';
						if($queryLP['statusimovel'] == 0){
							$imTitle = utf8_encode($queryLP['lcNome']);
							$status_imovel = utf8_encode($queryLP['estagioObra']);
						} else {
							$checkType = $newCrud->selectArrayPostWhere("name", "types", "WHERE id = ".$queryLP['tipoimovel']);
							if($checkType->num_rows > 0){
								$checkTypeQR = $checkType->fetch_assoc();
								$imTitle = utf8_encode($checkTypeQR['name']);
							}
							$status_imovel = utf8_encode($queryLP['finalidade']);
							$status_imovel = ($status_imovel=='Comprar') ? 'Venda' : $status_imovel;
						}
						
						if($queryLP['price'] && $queryLP['area']){
							@$rsm2 = (($queryLP['price'])&&($queryLP['area'])) ? (($queryLP['price'])/($queryLP['area'])) : '';
							$rsm2 = '<span class="label label-info">R$ '.moneyDecode($rsm2).'/m²</span>';
						} else {
							$rsm2 = '';
						}
						
						$payed = ($queryLP['status_pagto']==3 || $queryLP['status_pagto']==4) ? 1 : 0;
						
						$num_quartos = ($queryLP['rooms_2'] == 0) ? $queryLP['rooms'] : $queryLP['rooms'].' a '.$queryLP['rooms_2'];
						$num_suites = ($queryLP['suites_2'] == 0) ? $queryLP['suites'] : $queryLP['suites'].' a '.$queryLP['suites_2'];
						$num_vagas = ($queryLP['slots_2'] == 0) ? $queryLP['slots'] : $queryLP['slots'].' a '.$queryLP['slots_2'];
						$area_util = ($queryLP['area_2'] == 0) ? $queryLP['area'] : $queryLP['area'].' a '.$queryLP['area_2'];
						$area_total = ($queryLP['totArea'] == 0) ? '' : ' / '.$queryLP['totArea'];
						$valor = (substr($queryLP['price_2'], 0) == 0) ? 'R$ '.moneyDecode($queryLP['price']) : 'R$ '.moneyDecode($queryLP['price']).' a R$ '.moneyDecode($queryLP['price_2']);
						$expData = explode(" ",$queryLP['created']);
						
						if($queryLP['finished']==0){
							$statusData = '<span class="label label-warning">Anúncio incompleto</span>';
						} elseif($queryLP['finished']==1 && $payed==0){
							$statusData = '<span class="label label-warning">Aguardando pagamento do plano</span>';
						} else {
							$statusData = '<span class="label ';
							$statusData .= isset($queryLP['renovado']) ? 'label-success">Renovado em ' : 'label-info">Criado em ';
							$statusData .= dataDecode($queryLP['inicio']);
							$statusData .= '</span><span class="label label-important">Vencimento: '.dataDecode($queryLP['fim']).'</span>';
						}
						
						  if($loop>2){
							  echo '</div><div class="clear h20"></div><div class="row-fluid">';
							  $loop=1;
						  } else {
							  $loop++;						
						  }
						  
						  $incompleto = ($queryLP['finished']==0) ? '<div class="alert alert-danger center" style="padding:10px 15px; cursor:pointer;" onclick="window.location=\'admin.php?meusAnuncios&novo&editar&token='.$secBID.'\'">Anúncio incompleto!<br>Clique para continuar <i class="fa fa-arrow-right"></i></div>' : '';
						  
						  echo '
						  <div class="span4 large_rowfluid700">
							<div class="favthumb">
							
							<div style="margin-bottom: -3px; padding: 7px 10px;" class="alert '.$sts_txt.'</div>	
							
							  <div class="thumb" style="background-image:url(js/AJAXupload/files/thumbnail/'.$queryLP['imagem'].');">'.$incompleto.'</div>
								<h3>'.$status_imovel.' - '.$imTitle.' (Ref. '.$queryLP['codigoRef'].')</h3>
								<div class="clear"></div>
								<span class="label label-success">Código: '.codigoAnuncio($queryLP['id']).'</span>
								<div class="clear"></div>
								<div class="info" style="min-height: 160px;">
									<span class="label label-info">Dorms: '.$num_quartos.'</span>
									<span class="label label-info">Suítes: '.$num_suites.'</span>
									<span class="label label-info">Vagas: '.$num_vagas.'</span>
									<span class="label label-info">Área: '.$area_util.$area_total.'m²</span>
									<span class="label label-info">'.$valor.'</span>
									'.$rsm2.'
									
									<span class="label label-info" style="margin-top:1px; white-space: normal;">'.utf8_encode($queryLP['address']).', '.$queryLP['number'].', '.utf8_encode($queryLP['district']).', '.utf8_encode($queryLP['city_name']).' ('.utf8_encode($queryLP['adjunct']).')</span>
									
									'.$statusData.'
	
								</div>
								
								<div class="clear h10"></div>';
								 
									if(isset($dstq_txt)){ echo '<span class="label label-info pull-left">'.$dstq_txt.'</span>'; }
								
								if($queryLP['finished']==1){
									echo '
									<div class="btn-group dropup pull-right">
									  <button class="btn dropdown-toggle pull-right" data-toggle="dropdown">Gerenciar <span class="caret"></span></button>
									  <ul class="dropdown-menu">
											<li><a href="index.php?searchResultDetails&token='.$secBID.'" target="_blank"><i class="fa fa-eye"></i>Visualizar</a></li>';
										if(strtotime($PRE_hoje) < strtotime($queryLP['fim'])){
											echo '<li><a href="admin.php?meusAnuncios&novo&editar&token='.$secBID.'"><i class="fa fa-edit"></i>Editar</a></li>';
										}
										if($queryLP['anun_sts']==1){ echo '
											<li><a href="admin.php?meusAnuncios&desativar&token='.$secID.'"><i class="fa fa-power-off"></i>Desativar</a></li>
											';
										} else { 
											if(strtotime($PRE_hoje) > strtotime($queryLP['fim'])){
												echo '<li><a href="admin.php?meusAnuncios&renovar&token='.$secID.'&type='.$queryLP['statusimovel'].'"><i class="fa fa-refresh"></i>Renovar</a></li>';
												echo '<li><a href="admin.php?meusAnuncios&excluir&token='.$secID.'"><i class="fa fa-times"></i>Excluir</a></li>';
											} elseif($payed==1) {
												echo '<li><a href="admin.php?meusAnuncios&ativar&token='.$secID.'"><i class="fa fa-power-off"></i>Ativar</a></li>';
											}
										}
										echo '
										<li><a href="admin.php?estatisticas&only='.$secID.'"><i class="fa fa-bar-chart-o"></i>Estatísticas</a></li>
									  </ul>
									</div>';
								} else {
									echo '<div class="clear h10"></div>';
								}
							echo '	
							<div class="clear"></div>
						  </div>
						  </div>
						  ';	
				} 
			}
			else { echo '<div class="alert alert-info">Ops! Não há nada aqui.</div>'; }
			echo '</div>';
			unset($query);
	
	
	
	
	
	
	
	
	





	} elseif(isset($_GET['renovar'])){ 
		$checkUser = $newCrud->selectArrayPostWhere("*", "campaigns", "WHERE id = ".secURLdecode($_GET['token']));
		$chkUser = $checkUser->fetch_assoc();
		
		if(isset($_GET['renACT'])){ 
				
				if(!isset($_POST['planSelect'])){header('Location: admin.php?meusAnuncios&view');}
				
				switch($_POST['renOpt']){
					case 1:
						$dest_val = $chkUser['destaque']; $sdest_val = $chkUser['superdestaque'];
						break;
					case 2:
						$dest_val = 1; $sdest_val = 0;
						break;
					case 3:
						$dest_val = 0; $sdest_val = 1;
						break;
				}
				
				$selectedPlan = secURLdecode($_POST['planSelect']);
				$keyExp = explode(",", $selectedPlan);
				$PRE_key = $keyExp[1];
				$PRE_id = $keyExp[0];
				$num_credit = $PRE_planos[$PRE_key]['credit'];
				$num_dstq = $PRE_planos[$PRE_key]['destaque'];
				$num_sdstq = $PRE_planos[$PRE_key]['superdestaque'];
				$tid = $PRE_planos[$PRE_key]['id'];
								
				if(array_search_multi($PRE_id,$PRE_planos)==false || $num_credit == 0 || ($_POST['renOpt'] == 1 && $num_dstq==0 && $num_sdstq==0) || ($_POST['renOpt'] == 2 && $num_dstq==0) || ($_POST['renOpt'] == 3 && $num_sdstq==0) || (isset($_GET['renovar']) && !isset($_POST['planSelect'])) || (isset($_GET['renovar']) && !isset($_POST['renOpt'])) || (isset($_GET['renovar']) && !isset($PRE_planos)) || (isset($_GET['renovar']) && sizeof($PRE_planos)==0)){
					header('Location: admin.php?meusAnuncios&view&msg&notAllowed');
					exit;
				}
	
			    $periodoStart = date("Y-m-d");
			    $periodoVar = $PRE_planos[$PRE_key]['period'];
				$remainDays = 0;
				if((strtotime($periodoStart) < strtotime($chkUser['end']))){  
					$remainDays = (strtotime($chkUser['end']))-(strtotime($periodoStart));
					$remainDays = (int)floor( $remainDays / (60 * 60 * 24));
				}
			    $periodoExp = explode("-", $periodoStart);
			    $periodoEnd = date("Y-m-d", mktime(0, 0, 0, $periodoExp[1] + $periodoVar, $periodoExp[2] + $remainDays, $periodoExp[0]));
								
				$checkTrans = $newCrud->selectArrayPostWhere("status", "transactions", "WHERE id = ".$tid);
				$checkTransQR = $checkTrans->fetch_assoc();
				
				if($checkTransQR['status']==3 || $checkTransQR['status']==4){
					$sts_pagto = 1; $pause = 0;
				} else {
					$sts_pagto = 0; $pause = 1;
				}
			   
			    $newCampaign = $newCrud->fastInsert('user_id, transaction_id, building_id, period, destaque, superdestaque, start, end, status, pause, renovado', 'campaigns', $_SESSION['SYSBYLN__user_id'].','.$tid.','.$chkUser['building_id'].','.$periodoVar.','.$dest_val.','.$sdest_val.',"'.$periodoStart.'","'.$periodoEnd.'",'.$sts_pagto.','.$pause.',"'.$periodoStart.'"');
				
				$oldCID = secURLdecode($_GET['token']);
				
				$update = $newCrud->update("building_id=?,start=?,end=?,status=?,expirado=?","campaigns", "id = ?");
				$update->bind_param('issiii',$b,$st0,$en0,$s=0,$e=1,$oldCID);
				$update->execute();
				
				if(!isset($erro)){
					header('Location: admin.php?meusAnuncios&view&msg&renOk');
				} else {
					header('Location: admin.php?meusAnuncios&view&msg&anunError');
				}

		} else {
			
			if($chkUser['superdestaque'] == 1){ $configAnun='anúncio com superdestaque'; $class='renOpt2'; } else { $configAnun='anúncio com destaque'; $class='renOpt1'; $sugerirSD=1; }
			
	?>
			<legend>Renovar anúncio expirado (siga os passos abaixo)</legend>
                    <form action="admin.php?meusAnuncios&renovar&renACT&token=<?=$_GET['token'];?>" method="post" class="validate">
                    
                    <label>1. Selecione o plano a ser usado</label>
                    
					<?php 
					$checkAnunType = $_GET['type'];
					include 'inc/exibirPlanosDisponiveis.inc.php';
					if($count==0) { 
					
					$redir = isset($sugerirSD) ? '&sugSD' : '';
					header('Location: index.php?anunciar&renovar='.$_GET['token'].'&tipo='.$checkAnunType.$redir);
					
					} else { ?>
                    
                    <label>2. Selecione uma opção de renovação</label>
                    
                        <label class="radio">
                          <input type="radio" name="renOpt" value="1" class="<?=$class;?>">Manter a configuração original do anúncio (<?=$configAnun;?>).
                        </label>  
                        <label class="radio">
                          <input type="radio" name="renOpt" value="2" class="renOpt1">Renovar com destaque.
                        </label>  
                        <label class="radio">
                          <input type="radio" name="renOpt" value="3" class="renOpt2">Renovar com superdestaque.
                        </label>  
                        
                    <div class="clear h20"></div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i>Renovar anúncio</button>
                    </form>
            <div class="clear h20"></div>










			
	<?php } } } else { 
	
		header('Location: admin.php?meusAnuncios&view');
	
	} ?>
		</div>
	</div>
<div class="loadingDiv"><div><i class="fa fa-refresh fa-spin"></i></div></div>
</div>