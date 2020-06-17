formArt=document.getElementById('formArt');
listMyArt=document.getElementById('myArticles');
formArt.addEventListener('submit',function (e) {
    e.preventDefault();
    new Send('Article',formArt,'create',null);  
    renderArt();
});
showMyArt();
function renderArt() {
    setTimeout(function(){
        mesage.innerHTML='listo';
        showMyArt()
    } ,1700);
}
function deleteArt(){
    var fomrDelete=document.querySelectorAll('#deleteArt');
    for (let index = 0; index < fomrDelete.length; index++) {
        fomrDelete[index].addEventListener('submit',function(e) {
            e.preventDefault();
            new Send('Article',fomrDelete[index],'deleteArt',null);
            renderArt();
        })
    }
}
function editArts(){
    var formEditArt=document.querySelectorAll('#formEditArt');
    console.log(formEditArt);
    for (let index = 0; index < formEditArt.length; index++) {
        editArt(formEditArt[index]);
    }
}
function editArt(formEArt){
    // var formEditgender=document.getElementById('formEditGender');
    formEArt.addEventListener('submit',function (e) {
        e.preventDefault();
        form=new FormData(formEArt);
        var id= form.get('idArt');
        fetch('/Op-Art/Article/showDataEdit/',
        {
            method:'POST',
            body:form
        }
        ).
        then(data=>data.json()).
        then(
            res=>{
                // console.log(res[0].name_gender);
                html=`<form id="editART">
                    <input type="text" name="titleArt" value='${res[0].title_article}' >
                    <textarea name="contentArt"  cols="30" rows="10">${res[0].content}</textarea>        
                    <input type="submit" value="listo">
                </form>`;  
                var container=document.getElementById('containerEditArt');
                container.innerHTML=html;
                var edit_article=document.getElementById('editART');
                edit_article.addEventListener('submit',function(e) {
                    e.preventDefault();
                    // console.log(id);
                    new Send('Article',edit_article,'updateArt',id);
                    container.innerHTML='';
                    renderArt();
                })
            }
        )
    })  
}
function showMyArt() {
    fetch('/Op-Art/Article/showMyArt/')
    .then(data=>data.json())
    .then(
        res=>{
            // console.log(res);
            var html=``;
            if (typeof res==='string') {
                html=res;
            }else{
                html+=`<table>
                <thead>
                    <tr>
                        <th>Tipo de aprendizaje</th>
                        <th>Descripcion</th>
                        <th>Genero</th>
                        <th></th>
                        <th></th>
                        <th</th>
                    </tr>
                </thead>
                <tbody>`;
                for (let index = 0; index<res.length; index++) {
                    html+=`
                    <tr>
                        <td>${res[index].titulo}</td>
                        <td>${res[index].contenido}</td> 
                        <td>
                            ${res[index].tema}
                        </td>
                        <td>
                            <form id='genderArt'>
                            <input type='hidden' name='idArt' value='${res[index].id}'>
                            <input type='submit' value='+'>
                        </form>
                        </td>
                        <td>
                            <form id='deleteArt'>
                                <input type='hidden' name='idArt' value='${res[index].id}'>
                                <input type='submit' value='elinimar'>
                            </form>
                        </td>
                        <td>
                            <form id='formEditArt'>
                            <input type='hidden' name='idArt' value='${res[index].id}'>
                            <input type='submit' value='Editar' >
                            </form>
                        </td>
                    </tr>`;            
                } 
                html+=` 
                </tbody>
                </table>`;
            }
            listMyArt.innerHTML=html;
            // deteleGender();
            deleteArt();
            
            // editArt();
            // editGenders();
            // editTest();
            // showGendersForm();
            editArts();
            showGendersEdit();
        }
    ).catch(
        ()=>{
            listMyArt.innerHTML=`Algo salio mal.sdf`;
        }
    )
}
function showGendersEdit(){
    var x=document.querySelectorAll('#genderArt');
    console.log(x);
    for (let index = 0; index < x.length; index++) {
        showGendersForm(x[index]);
    }
}
function showGendersForm(form){
    // var botonGender=document.getElementById('');
    form.addEventListener('submit',function (e) {
        e.preventDefault();
        forme=new FormData(form);
        var id= forme.get('idArt');
        var listGender=document.getElementById('genders');
        fetch('/Op-Art/GenderArt/showGendersArt/').
        then(res=>res.json()).
        then(data=>{
            console.log(data);
            var html=``;
            // var name='name';
            if (typeof data==='string') {
                html=``;
            }else{
                html+=`<form id='formGenderArt'>  `;
                for (let index = 0; index < data.length; index++) {
                    var name='name';
                    html+=`
                    <label>
                        ${data[index].name_gender}
                        <input type="radio" name="${name+=index}" value='${data[index].id_gender}'>
                    </label>`;
                    // console.log(name+=index);
                }
    
                html+=`<input type="reset" value="Restaurar">
                <input type="submit" value="Listo">
                </form>`;
            }
            listGender.innerHTML=html;
            create(id);
        }).catch( ()=>{
            listGender.innerHTML=`Algo salio mal`;
        })
    })
}
function create(id){
    formGenderArt=document.getElementById('formGenderArt');
    formGenderArt.addEventListener('submit', function (e) {
        e.preventDefault();
        new Send('GenderArt',formGenderArt,'create',id);
        renderArt();
    })
}