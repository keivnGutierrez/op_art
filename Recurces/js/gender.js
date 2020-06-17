var listGenders=document.getElementById('listeGender');
var formgender=document.getElementById('formGender');
showDataGenders();
formgender.addEventListener('submit',function (e) {
    e.preventDefault();
    new Send('Gender',formgender,'create',null);
    rederGenders();
});

function rederGenders() {
    setTimeout(function(){
        mesage.innerHTML='listo';
        showDataGenders()
    } ,1700);
}
function deteleGender(){
    var fomrDelete=document.querySelectorAll('#deleteGender');
    for (let index = 0; index < fomrDelete.length; index++) {
        fomrDelete[index].addEventListener('submit',function(e) {
            e.preventDefault();
            new Send('Gender',fomrDelete[index],'deleteGender',null);
            rederGenders();
        })
    }
}
function editGenders(){
    var formEditGender=document.querySelectorAll('#formEditGender');
    console.log(formEditGender);
    for (let index = 0; index < formEditGender.length; index++) {
        editGender(formEditGender[index]);
    }
}
function editGender(formEditgender){
    // var formEditgender=document.getElementById('formEditGender');
    formEditgender.addEventListener('submit',function (e) {
        e.preventDefault();
        form=new FormData(formEditgender);
        var id= form.get('idGender');
        fetch('/Op-Art/Gender/showDataEdit/',
        {
            method:'POST',
            body:form
        }
        ).
        then(data=>data.json()).
        then(
            res=>{
                // console.log(res[0].name_gender);
                html=`<form id="feditGender">
                    <input type="text" name="gender" value='${res[0].name_gender}'>
                    <textarea name="descriptionGender"  cols="30" rows="10">${res[0].description_gender}</textarea>        
                    <input type="submit" value="listo">
                </form>`;  
                var container=document.getElementById('containerEditGender');
                container.innerHTML=html;
                var edit_Gender=document.getElementById('feditGender');
                edit_Gender.addEventListener('submit',function(e) {
                    e.preventDefault();
                    // console.log(id);
                    new Send('Gender',edit_Gender,'updateGender',id);
                    container.innerHTML='';
                    rederGenders();
                })
            }
        )
    })  
}
function showDataGenders() {
    fetch('/Op-Art/Gender/showGenders/')
    .then(data=>data.json())
    .then(
        res=>{
            console.log(res);
            var html=``;
            if (typeof res==='string') {
                html=res;
            }else{
                html+=`<table>
                <thead>
                    <tr>
                        <th>Tipo de aprendizaje</th>
                        <th>Descripcion</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>`;
                for (let index = 0; index<res.length; index++) {
                    html+=`
                    <tr>
                        <td>${res[index].name_gender}</td>
                        <td>${res[index].description_gender}</td> 
                        <td>
                            <form id='deleteGender'>
                                <input type='hidden' name='idGender' value='${res[index].id_gender}'>
                                <input type='submit' value='elinimar'>
                            </form>
                        </td>
                        <td>
                            <form id='formEditGender'>
                            <input type='hidden' name='idGender' value='${res[index].id_gender}'>
                            <input type='submit' value='Editar' >
                            </form>
                        </td>
                    </tr>`;            
                } 
                html+=` 
                </tbody>
                </table>`;
            }
            listGenders.innerHTML=html;
            deteleGender();
            editGenders();
            // editTest();
        }
    ).catch(
        ()=>{
            listGenders.innerHTML=`Algo salio mal.sdf`;
        }
    )
}