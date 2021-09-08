function soumission(id){
    let form = document.getElementById('form'+id);
    form.submit();
}

$("#ajouter").click(function(){
    $(".container-hidden").toggleClass(2);
});
