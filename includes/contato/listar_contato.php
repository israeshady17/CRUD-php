<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Lista de contatos</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Lista de contatos</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="card-tools">
              <div class="float-right">
                <a href="/?url=novo-contato" class="btn btn-success">Novo contato</a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Telefone</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $listaContatos = $pdo->prepare("SELECT * FROM contato");
                  $listaContatos->execute();
              
                  $contatos = [];
                  if ($listaContatos->rowCount() > 0) {
                    $contatos = $listaContatos->fetchAll(PDO::FETCH_ASSOC);
                  }

                  foreach($contatos as $contato) {
                ?>
                  <tr>
                    <td><?php echo $contato['id']?>.</td>
                    <td><?php echo $contato['nome']?></td>
                    <td><?php echo $contato['email']?></td>
                    <td><?php echo $contato['telefone']?></td>
                    <td>
                      <a href="/?url=editar-contato&id=<?php echo $contato['id']?>" class="btn btn-primary">Editar</a>
                      <a href="/?url=deletar-contato&id=<?php echo $contato['id']?>" class="btn btn-danger deletar-item" data-toggle="modal" data-target="#modalDelete">Deletar</a>
                    </td>
                  </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDeleteLabel">Atenção</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Você realmente deseja deletar esse item?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
        <button type="button" class="btn btn-success">Sim, eu quero!</button>
      </div>
    </div>
  </div>
</div>