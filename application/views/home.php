<?php
    \Helper\LayoutHelper::setInterna(false);
?>

<?php if(isset($errors)): ?>
	<?php foreach ($errors as $erro): ?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="alert alert-danger alert-dismissible fade in show"><?= $erro ?></div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
<?php endif; ?>
<div class="route-page">
	<div class="container">
		<div class="row">
			<div class="col-12 d-flex justify-content-betwee align-items-center">
				<ul>
					<li><h1>A casa</h1></li>
					<li><h2>fale conosco</h2></li>
				</ul>
				<img src="<?= $this->url('/assets/img/boneco.png') ?>" alt="">
			</div>
		</div>
	</div>
</div>

<section class="section-contact" id="contato">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="box-title-page">
					<h3>Entre em contato conosco através do formulário abaixo.</h3>
					<h4>Escolha o setor e mande a sua mensagem</h4>
				</div>
			</div>
		</div>
		<form action="contato/submit" class="form-site row" method="post">
			<div class="col-12 col-lg-7">
				<div class="row">
					<div class="form-group col-12">
						<label for="">Nome*</label>
						<input type="text" class="form-control" name="name" max="150">
					</div>
					<div class="form-group col-6 col-lg-6">
						<label for="">Email*</label>
						<input type="text" class="form-control" name="email" max="150">
					</div>
					<div class="form-group col-6 col-lg-4">
						<label for="">Telefone</label>
						<input type="text" class="form-control sp-celphones" name="phone" max="15">
					</div>
					<div class="form-group col-2 col-lg-2">
						<label for="">UF</label>
						<input type="text" class="form-control" name="uf" max="2">
					</div>
					<div class="form-group col-6 col-lg-6">
						<label for="">Cidade</label>
						<input type="text" class="form-control" name="city">
					</div>
					<div class="form-group col-6 col-lg-6">
						<label for="">Setor</label>
						<input type="text" class="form-control" name="sector">
					</div>
				</div>
			</div>
			<div class="col-12 col-lg-5">
				<div class="row">
					<div class="form-group col-12">
						<label for="">Mensagem*</label>
						<textarea id="" class="form-control" name="content"></textarea>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="row">
					<div class="form-group col-12 d-flex justify-content-end">
						<button class="btn-form">Enviar mensagem</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="diviser-site"></div>
		</div>
	</div>
</div>
<section class="section-equipe" id="equipe">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul class="list-equipe">
					<li>
						<strong class="name-equipe">Presidente</strong>
						<a class="email-equipe" href="mailto:diretoria@durvalpaiva.org.br">diretoria@durvalpaiva.org.br</a>
					</li>
					<li>
						<strong class="name-equipe">Presidente</strong>
						<a class="email-equipe" href="mailto:diretoria@durvalpaiva.org.br">diretoria@durvalpaiva.org.br</a>
					</li>
					<li>
						<strong class="name-equipe">Presidente</strong>
						<a class="email-equipe" href="mailto:diretoria@durvalpaiva.org.br">diretoria@durvalpaiva.org.br</a>
					</li>
					<li>
						<strong class="name-equipe">Presidente</strong>
						<a class="email-equipe" href="mailto:diretoria@durvalpaiva.org.br">diretoria@durvalpaiva.org.br</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="section-partner" id="parceiros">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="title-partner">
					<h3><span>Nossos</span> parceiros</h3>
				</div>
				<ul class="list-partner">
					<?php for($i=0; $i<8; $i++): ?>
					<li>
						<a class="logo-partner" href="javascript:;">
							<img src="<?= $this->url('/assets/img/98fm.png') ?>" alt="">
						</a>
					</li>
					<?php endfor; ?>
				</ul>
			</div>
		</div>
	</div>
</section>
