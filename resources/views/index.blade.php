@extends('templates.template')

@section('content')

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row" style="margin-left: 0px;">
                        <div class="col-sm-6">
                            <h2>CRUD</h2>
                        </div>
                        <div class="col-sm-6" style="display: flex; justify-content: end;">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal" style="margin-right: 15px; margin-top: 25px;"><span>Adicionar nova pessoa</span></a>
                        </div>
                    </div>
                </div>
                <form  method="GET">
                    <input type="text" name="search" style="margin-left: 15px;" value="{{!empty($_GET['search']) ? $_GET['search'] : ''}}"/>
                    <button type="submit">Pesquisar</button>
                </form>
                @csrf
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Sexo</th>
                            <th>Data de nascimento</th>
                            <th>Email</th>
                            <th>Fone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pessoa as $pessoas)
                        <tr>
                            <th>{{$pessoas->nome}}</th>
                            <th>{{$pessoas->cpf}}</th>
                            <th>{{$pessoas->sexo}}</th>
                            <th>{{date('d/m/Y', strtotime($pessoas->data_nascimento))}}</th>
                            <th>{{$pessoas->email}}</th>
                            <th>{{$pessoas->fone}}</th>
                            <td>
                                <a href="#editEmployeeModal-{{$pessoas->id}}" class="btn btn-success" data-toggle="modal" style="margin-right: 15px"><span>Editar</span></a>
                                <a class="btn btn-danger" data-toggle="modal" js-deletar="{{$pessoas->id}}"><span>Excluir</span></a>
                            </td>
                        </tr>
                        <div id="editEmployeeModal-{{$pessoas->id}}" js-editar="{{$pessoas->id}}" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" action="{{url('pessoa-update') . '/' . $pessoas->id}}">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-header">
                                            <h4 class="modal-title">Editar</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nome</label>
                                                <input type="text" name="nome" class="form-control" required value="{{$pessoas->nome}}">
                                            </div>
                                            <div class="form-group">
                                                <label>CPF <span>* apenas números</span></label>
                                                <input type="tel" name="cpf" maxlength="11" class="form-control" required value="{{$pessoas->cpf}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Sexo</label>
                                                <select name="sexo" class="form-control" required value="{{$pessoas->sexo}}">
                                                    <option value="">Selecione</option>
                                                    <option value="Homem" {{ ($pessoas->sexo == 'Homem') ? 'selected' : '' }}>Homem</option>
                                                    <option value="Mulher" {{ ($pessoas->sexo == 'Mulher') ? 'selected' : '' }}>Mulher</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Data de nascimento</label>
                                                <input type="date" name="data_nascimento" class="form-control" required value="{{$pessoas->data_nascimento}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" required value="{{$pessoas->email}}">
                                            </div>
                                            <div class="form-group">
                                                <label>Fone <span>* apenas números</span></label>
                                                <input type="text" name="fone" class="form-control" required value="{{$pessoas->fone}}">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                                            <input type="submit" class="btn btn-info" value="Salvar">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{url('pessoas-form')}}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Cadastro de nova pessoa</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>CPF <span>* apenas números</span></label>
                            <input type="tel" name="cpf" maxlength="11" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Sexo</label>
                            <select name="sexo" class="form-control" required>
                                <option value="Homem">Homem</option>
                                <option value="Mulher">Mulher</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data de nascimento</label>
                            <input type="date" name="data_nascimento" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Fone <span>* apenas números</span></label>
                            <input type="text" name="fone" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                        <input type="submit" class="btn btn-success" id="criar" value="Criar">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
@endsection