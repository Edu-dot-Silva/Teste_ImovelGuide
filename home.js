function validacao() {
    const cpf = document.getElementById("cpf").value,
    creci = document.getElementById("creci").value,
    nome = document.getElementById("nome").value;

    if (cpf.length !== 11) {
        alert("Somente CPF com 11 caracteres.");
        return false
    }
    if (creci.length < 2) {
        alert("Numero do Creci deve conter 2 caracteres.");
        return false
    }
    if (nome.length < 2) {
        alert("Nome deve conter mais de 2 caracteres.");
        return false
    }

    return true
}

function alerta(msg){
    alert(msg);
}

function deletar(){
    return confirm('Deseja excluir o corretor selecionado?')
}
