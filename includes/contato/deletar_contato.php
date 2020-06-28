<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Novo contato</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Novo contato</li>
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
                <a href="/?url=listar-contatos" class="btn btn-primary">Voltar para pesquisa</a>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <?php
              $id = (isset($_GET['id'])) ? $_GET['id'] : null;
              if (!isset($id) || empty($id)) {
                header('Location: /?url=listar-contatos');
              }

              $buscaContato = $pdo->prepare("SELECT * FROM contato WHERE id = :id");
              $buscaContato->bindValue(":id", $id);
              $buscaContato->execute();

              if($buscaContato->rowCount() <= 0) {
                header('Location: /?url=listar-contatos');
              }
              
              $deletaContato = $pdo->prepare("DELETE FROM contato WHERE id = ?");
              $deletaContato->bindValue(1, $id);

              if($deletaContato->execute()) {
                header( "refresh:1;url=/?url=listar-contatos" );
                echo '<br/> <div class="container-fluid"><div class="alert alert-success" role="alert">Contato deletado com sucesso!</div></div>';
              } else {
                echo '<br/> <div class="container-fluid"><div class="alert alert-error" role="alert">Ocorreu um erro ao deletar o contato, contate o administrador!</div></div>';
              }
            ?>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->