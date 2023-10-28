<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazord - Teste</title>
    <style>
        *{
            margin: 0;
            border: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header{
            width: 100%;
            padding-top: 20px;
            padding-bottom: 20px;
            position: sticky;
            top: 0;
            width: 100%;
            background: rgba(255,255,255,0.75);
            backdrop-filter: saturate(180%) blur(20px);
            margin: 0;
            border-bottom: 1px solid #e1e1e1;
            z-index: 20;
            -moz-box-shadow: rgba(0,0,0,0.2) 0 0 50px 1px;
            -webkit-box-shadow: rgba(0,0,0,0.2) 0 0 50px 1px;
            box-shadow: rgba(0,0,0,0.2) 0 0 50px 1px;
        }

        .header-body{
            display: flex;
        }

        .header-body img {
            margin-left: 20px;
        }

        .actions{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            margin-right: 50px;
        }

        a{
            text-decoration: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: .2s;
        }

        button{
            border: 0;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: .2s;
        }

        .primary{
            background: #0587FF;
            color: white;
        }

        .primary:hover{
            background: #0660b4;
            transition: .2s;
        }

        .danger{
            background: red;
            color: white;
        }

        .danger:hover{
            background: rgb(145, 12, 12);
            transition: .2s;
        }

        .warning{
            background: orange;
            color: white;
        }

        .warning:hover{
            background: rgb(138, 90, 2);
            transition: .2s;
        }

        .container{
            margin: 0 auto;
            width: 70%;
        }

        .card{
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            -moz-box-shadow: rgba(0,0,0,0.2) 0 0 50px 1px;
            -webkit-box-shadow: rgba(0,0,0,0.2) 0 0 50px 1px;
            box-shadow: rgba(0,0,0,0.2) 0 0 50px 1px;
            margin-bottom: 20px;
        }

        .card-title{
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: solid 1px #f5f5f5;
            padding-bottom: 20px;
        }

        .card-body{}

        .card-footer{}

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #ffff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .search{
            background-color: #f5f5f5;
            padding: 10px;
            width: 300px;
            border-radius: 8px;
        }

        .input{
            background-color: #f5f5f5;
            padding: 10px;
            outline: none;
            width: 95%;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        select{
            background-color: #f5f5f5;
            padding: 10px;
            outline: none;
            width: 100%;
            border-radius: 8px;
            margin-bottom: 5px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js" integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <header class="header">
        <div class="header-body">
            <img src="https://www.magazord.com.br/wp-content/themes/magazord/image/logo-magazord.svg">
            <div class="actions"></div>
        </div>
    </header>
    <br><br>
    <div class="container">
        <div class="card">
            <div class="card-title">
                <b>Lista de Pessoas (<span class="pessoas-count">0</span>)</b>
                <input type="search" class="search search-pessoa" placeholder="Pesquisar pessoa... (nome)">
                <a href="javascript:void(0)" class="primary add-person">+adicionar pessoa</a>
            </div>
            <div class="card-body">
                <table class="table-pessoas"></table>
            </div>
            <div class="card-footer">
            </div>
        </div>

        <div class="card">
            <div class="card-title">
                <b>Lista de Contatos (<span class="contatos-count">0</span>)</b>
                <input type="search" class="search search-contato" placeholder="Pesquisar contato... (descrição)">
                <a href="javascript:void(0)" class="primary add-contato">+adicionar contato</a>
            </div>
            <div class="card-body">
                <table class="table-contatos"></table>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</body>
</html>

<!--MAIN-->
<script>
    class Api {

        static fetchPessoas ({search, callback}) {
            $.ajax({
                type: "POST",
                url: "pessoa/find",
                data: {
                    search: search
                },
                success: function(response) {
                    if(callback){
                        callback(response);
                    }
                }
            });
        }

        static fetchContatos ({search, callback}) {
            $.ajax({
                type: "POST",
                url: "contato/find",
                data: {
                    search: search
                },
                success: function(response) {
                    if(callback){
                        callback(response);
                    }
                }
            });
        }

        static deletePessoa ({id, callback}) {
            $.ajax({
                type: "POST",
                url: "pessoa/delete",
                data: {
                    id: id
                },
                success: function(response) {
                    if(callback){
                        callback(response);
                    }
                }
            });
        }

        static deleteContato ({id, callback}) {
            $.ajax({
                type: "POST",
                url: "contato/delete",
                data: {
                    id: id
                },
                success: function(response) {
                    if(callback){
                        callback(response);
                    }
                }
            });
        }

        static salvarPessoa ({pessoa, callback}) {
            $.ajax({
                type: "POST",
                url: "pessoa/save",
                data: pessoa,
                success: function(response) {
                    if(callback){
                        callback(response);
                    }
                }
            });
        }

        static salvarContato ({contato, callback}) {
            $.ajax({
                type: "POST",
                url: "contato/save",
                data: contato,
                success: function(response) {
                    if(callback){
                        callback(response);
                    }
                }
            });
        }

    }
</script>

<!--MAIN-->
<script>
    var fnRenderPessoas = null;
    var fnRenderContatos = null;

    var pessoas_list = [];
    var contatos_list = [];

    $(document).ready(function () {

        const renderPessoas = (search) => {

            Api.fetchPessoas({
                search: search,
                callback: (response) => {
                    $(".pessoas-count").html(response?.data?.length);
                    $(".table-pessoas").html("");

                    if(response?.data?.length <= 0){
                        $(".table-pessoas").html("<div style='background: #fff6d8; color: orange; padding: 10px; border-radius: 8px; border: solid 1px orange;'>Não há dados.</div>")
                    }else{

                        pessoas_list = response?.data;

                        $(".table-pessoas").html(`
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Ações</th>
                            </tr>
                        `)

                        response?.data?.map(pessoa => {
                            $(".table-pessoas").append(`
                                <tr>
                                    <td>${pessoa?.id}</td>
                                    <td>${pessoa?.nome}</td>
                                    <td>${pessoa?.cpf}</td>
                                    <td style="display: flex; align-items: center;">
                                        <a href="javascript:void(0)" id="view-person" data-id='${pessoa?.id}' class="primary">ver</a>&nbsp;
                                        <a href="javascript:void(0)" id="edit-person" data-id='${pessoa?.id}' class="warning">editar</a>&nbsp;
                                        <a href="javascript:void(0)" id="delete-person" data-id='${pessoa?.id}' class="danger">excluir</a>
                                    </td>
                                </tr>
                            `)
                        })
                    }
                }
            })

        }

        const renderContatos = (search) => {

            Api.fetchContatos({
                search: search,
                callback: (response) => {
                    $(".contatos-count").html(response?.data?.length);
                    $(".table-contatos").html("");

                    if(response?.data?.length <= 0){
                        $(".table-contatos").html("<div style='background: #fff6d8; color: orange; padding: 10px; border-radius: 8px; border: solid 1px orange;'>Não há dados.</div>")
                    }else{

                        contatos_list = response?.data;

                        $(".table-contatos").html(`
                            <tr>
                                <th>Id</th>
                                <th>Tipo</th>
                                <th>Descrição</th>
                                <th>Vinculo</th>
                                <th>Ações</th>
                            </tr>
                        `)

                        response?.data?.map(contato => {
                            $(".table-contatos").append(`
                                <tr>
                                    <td>${contato?.id}</td>
                                    <td>${contato?.tipo == 0 ? `(telefone)` : `(email)`}</td>
                                    <td>${contato?.descricao}</td>
                                    <td>${pessoas_list.filter(p => {return p.id == contato?.idPessoa})[0]?.nome}</td>
                                    <td style="display: flex; align-items: center;">
                                        <a href="javascript:void(0)" id="view-contact" data-id='${contato?.id}' class="primary">ver</a>&nbsp;
                                        <a href="javascript:void(0)" id="edit-contact" data-id='${contato?.id}' class="warning">editar</a>&nbsp;
                                        <a href="javascript:void(0)" id="delete-contact" data-id='${contato?.id}' class="danger">excluir</a>
                                    </td>
                                </tr>
                            `)
                        })
                    }
                }
            })

        }

        fnRenderPessoas = search => renderPessoas(search);
        fnRenderContatos = search => renderContatos(search);

        fnRenderPessoas("");

        fnRenderContatos("");

    })
    .on('keyup', '.search-pessoa', function () {
        fnRenderPessoas($(this).val());
    })
    .on('keyup', '.search-contato', function () {
        fnRenderContatos($(this).val());
    })
    .on('click', '.add-person', function () {
        modalPessoa({edit_mode: false, pessoa: null});
    })
    .on('click', '.add-contato', function () {
        modalContato({edit_mode: false, contato: null});
    })
    .on('click', '#delete-person', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: 'Deseja excluir a pessoa?',
            text: "Ao excluir a pessoa, seus contatos serão apagados.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                Api.deletePessoa({
                    id: id,
                    callback: (data) => {
                        Swal.fire(
                            (data.data) ? 'Excluido!' : 'Erro',
                            data?.message,
                            (data.data) ? 'success' : 'error'
                        )
                        if(data?.data){
                            fnRenderPessoas($(".search-pessoa").val());
                            fnRenderContatos($(".search-contato").val());
                        }
                    }
                })
            }
        })

    }).on('click', '#edit-person', function () {
        let id = $(this).attr('data-id');
        let pessoa_selected = pessoas_list.filter(p => {return p.id == id})[0];
        modalPessoa({edit_mode: true, pessoa: pessoa_selected});
    }).on('click', '#delete-contact', function () {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: 'Deseja excluir o contato?',
            text: "Confirmar exclusão de contato.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                Api.deleteContato({
                    id: id,
                    callback: (data) => {
                        Swal.fire(
                            (data.data) ? 'Excluido!' : 'Erro',
                            data?.message,
                            (data.data) ? 'success' : 'error'
                        )
                        if(data?.data){
                            fnRenderContatos($(".search-contato").val());
                        }
                    }
                })
            }
        })

    }).on('click', '#edit-contact', function () {
        let id = $(this).attr('data-id');
        let contato_selected = contatos_list.filter(c => { return c.id == id })[0];
        modalContato({edit_mode: true, contato: contato_selected});
    }).on('click', ".fire-dismiss", function () {
        Swal.close();
    }).on('click', '#view-person', function () {
        let id = $(this).attr('data-id');
        let pessoa_selected = pessoas_list.filter(p => {return p.id == id})[0];
        Swal.fire({
            title: "Pessoa",
            html: `
                <div>
                    <label>Id:</label>&nbsp;<b>${pessoa_selected.id}</b><br>
                    <label>Nome:</label>&nbsp;<b>${pessoa_selected.nome}</b><br>
                    <label>CPF:</label>&nbsp;<b>${pessoa_selected.cpf}</b>
                </div>
            `
        })
    }).on('click', '#view-contact', function () {
        let id = $(this).attr('data-id');
        let contato_selected = contatos_list.filter(c => { return c.id == id })[0];
        Swal.fire({
            title: "Contato",
            html: `
                <div>
                    <label>Id:</label>&nbsp;<b>${contato_selected.id}</b><br>
                    <label>Tipo:</label>&nbsp;<b>${contato_selected.tipo == 0 ? `Telefone` : `Email`}</b><br>
                    <label>Descrição:</label>&nbsp;<b>${contato_selected.descricao}</b><br>
                    <label>Vínculo:</label>&nbsp;<b>${ pessoas_list.filter(p => { return p.id == contato_selected.idPessoa})[0]?.nome }</b>
                </div>
            `
        })
    })

    function modalPessoa ({edit_mode, pessoa}) {
        Swal.fire({
            title: (edit_mode) ? `Editar Pessoa` : `Adicionar Pessoa`,
            showCancelButton: false,
            showConfirmButton: false,
            html: `
                <div>
                    <div class='alert-pessoa'></div>
                    <div>
                        <div style="text-align: left;"><b style="font-size: 10pt;">Nome (*)</b></div>
                        <input type='text' class='input pessoa-nome' ${edit_mode ? `value='${pessoa.nome}'` : ``} placeholder="Digite o nome">
                    </div>
                    <div>
                        <div style="text-align: left;"><b style="font-size: 10pt;">CPF (*)</b></div>
                        <input type='text' class='input pessoa-cpf' ${edit_mode ? `value='${pessoa.cpf}'` : ``} placeholder="Digite o CPF">
                    </div>
                    <div style="margin-top: 20px; display: flex; align-items: center; justify-content: flex-end;">
                        <button class='danger fire-dismiss'>Cancelar</button>&nbsp;
                        <button class='primary add-pessoa-ok'>Salvar</button>
                    </div>
                </div>
            `,
        })
        $(".pessoa-cpf").mask("000.000.000-00");
        $(".add-pessoa-ok").unbind();
        $(".add-pessoa-ok").click(function () {
            let nome = $(".pessoa-nome").val();
            let cpf = $(".pessoa-cpf").val();

            if(nome.trim().length <= 0){
                setError({
                    target: $(".alert-pessoa"),
                    message: "Digite o nome."
                })
                return;
            }

            if(cpf.trim().length <= 0){
                setError({
                    target: $(".alert-pessoa"),
                    message: "Digite o CPF."
                })
                return;
            }

            Api.salvarPessoa({
                pessoa: {
                    id: (edit_mode) ? pessoa?.id : null,
                    nome: nome,
                    cpf: cpf,
                },
                callback: (data) => {
                    if(data?.data){
                        Swal.close();
                        Swal.fire(
                            'Salvo!',
                            data?.message,
                            'success'
                        );
                        fnRenderPessoas("");
                    }
                }
            })

        })
    }

    function modalContato ({edit_mode, contato}) {
        Swal.fire({
            title: (edit_mode) ? `Editar Contato` : `Adicionar Contato`,
            showCancelButton: false,
            showConfirmButton: false,
            html: `
                <div>
                    <div class='alert-contato'></div>
                    <div>
                        <div style="text-align: left;"><b style="font-size: 10pt;">Tipo (*)</b></div>
                        <select class='contato-tipo'>
                            <option value="">Selecione...</option>
                            <option value="0">Telefone</option>
                            <option value="1">Email</option>
                        </select>
                    </div>
                    <div>
                        <div style="text-align: left;"><b style="font-size: 10pt;">Descrição (*)</b></div>
                        <input type='text' class='input contato-descricao' ${edit_mode ? `value='${contato.descricao}'` : ``} placeholder="Digite a descricao">
                    </div>
                    <div>
                        <div style="text-align: left;"><b style="font-size: 10pt;">Vincular á (*)</b></div>
                        <select class='contato-vinculo'></select>
                    </div>
                    <div style="margin-top: 20px; display: flex; align-items: center; justify-content: flex-end;">
                        <button class='danger fire-dismiss'>Cancelar</button>&nbsp;
                        <button class='primary add-contato-ok'>Salvar</button>
                    </div>
                </div>
            `,
        })
        
        if(edit_mode){
            $(".contato-tipo").val(contato.tipo);
        }

        const renderSelect = () => {
            $(".contato-vinculo").html("");
            Api.fetchPessoas({
                search: "",
                callback: (data) => {
                    $(".contato-vinculo").append(`<option value="">Selecione...</option>`)
                    data?.data?.map(item => {
                        $(".contato-vinculo").append(`<option value="${item.id}">${item.nome}</option>`)
                    })
                    if(edit_mode){
                        $(".contato-vinculo").val(contato.idPessoa);
                    }
                }
            })
        }

        renderSelect();

        $(".add-contato-ok").unbind();
        $(".add-contato-ok").click(function () {

            let tipo = $(".contato-tipo").val();
            let descricao = $(".contato-descricao").val();
            let vinculo = $(".contato-vinculo").val();

            if(tipo.trim().length <= 0){
                setError({
                    target: $(".alert-contato"),
                    message: "Selecione o tipo."
                })
                return;
            } 

            if(descricao.trim().length <= 0){
                setError({
                    target: $(".alert-contato"),
                    message: "Digite a descrição."
                })
                return;
            }

            if(vinculo.trim().length <= 0){
                setError({
                    target: $(".alert-contato"),
                    message: "Selecione o vínculo."
                })
                return;
            } 

            Api.salvarContato({
                contato: {
                    id: (edit_mode) ? contato?.id : null,
                    tipo: tipo,
                    descricao: descricao,
                    vinculo: vinculo,
                },
                callback: (data) => {
                    if(data?.data){
                        Swal.close();
                        Swal.fire(
                            'Salvo!',
                            data?.message,
                            'success'
                        );
                        fnRenderContatos("");
                    }
                }
            })

        })
    }

    function setError ({target, message}) {
        target.slideDown('fast');
        target.html(`
            <div style='background: #f5e6e6; color: red; padding: 10px; border-radius: 8px; border: solid 1px red; text-align: left; font-size: 10pt;'><b>*${message}</b></div>
        `);
        let timeout = setTimeout(function () {
            target.slideUp('fast');
            clearTimeout(timeout)
        }, 1500)
    }
</script>
