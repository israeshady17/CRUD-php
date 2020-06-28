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

              $contato = $buscaContato->fetch(PDO::FETCH_ASSOC);

              if(!empty($_POST)) {
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $telefone = $_POST['telefone'];

                if(!empty($nome) && !empty($email) && !empty($telefone)) {
                  $editarContato = $pdo->prepare("UPDATE contato SET nome = ?, email = ?, telefone = ? WHERE id = ?");
                  
                  if($editarContato->execute([$nome, $email, $telefone, $id])) {
                    header( "refresh:1;url=/?url=editar-contato&id={$id}" );
                    echo '<br/> <div class="container-fluid"><div class="alert alert-success" role="alert">Contato cadastrado com sucesso!</div></div>';
                  } else {
                    echo '<br/> <div class="container-fluid"><div class="alert alert-error" role="alert">Ocorreu um erro ao salvar o contato, contate o administrador!</div></div>';
                  }
                } else {
                  echo '<br/> <div class="container-fluid"><div class="alert alert-warning" role="alert">Preencha todos os campos!</div></div>';
                }
              }
            ?>
            <form action="" class="fome" method="post">
               <div class="container-fluid ">
                <div class="row ">
                  <div class="col-md-4">
                    <!-- phone mask -->
                      <div class="form-group">
                        <label>Nome:</label>

                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>
                          <input type="text" class="form-control" name="nome" value="<?php echo $contato['nome']?>">
                        </div>
                        <!-- /.input group -->
                      </div>
                  </div>
                  <div class="col-md-4">
                    <!-- phone mask -->
                      <div class="form-group">
                        <label>Email:</label>

                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                          </div>
                          <input type="email" class="form-control" name="email" value="<?php echo $contato['email']?>"">
                        </div>
                        <!-- /.input group -->
                      </div>
                  </div>
                  <div class="col-md-4">
                    <!-- phone mask -->
                      <div class="form-group">
                        <label>Telefone:</label>

                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                          </div>
                          <input type="text" class="form-control" name="telefone"  value="<?php echo $contato['telefone']?>"" data-inputmask='"mask": "(99) 99999-9999"' data-mask>
                        </div>
                        <!-- /.input group -->
                      </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group float-right">
                      <button type="submit" class="btn btn-success">Cadastrar</button>
                    </div>
                  </div>
                </div>
               </div>
            </form>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->