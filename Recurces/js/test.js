showDataTest();
var formNewTest=document.getElementById('formNewTest');
var list=document.getElementById('lsitTest');
formNewTest.addEventListener('submit',function (e) {
    e.preventDefault();
    new Send('Test',formNewTest,'create',null);
    rederTest();
});
function rederTest() {
    setTimeout(function(){
        mesage.innerHTML='listo';
        showDataTest()
    } ,1700);
}
function deteleTest(){
    var fomrDelete=document.querySelectorAll('#deleteTest');
    for (let index = 0; index < fomrDelete.length; index++) {
        fomrDelete[index].addEventListener('submit',function(e) {
            e.preventDefault();
            new Send('Test',fomrDelete[index],'deleteTest',null);
            rederTest();
            
        })
    }
}
function editTests(){
    var formEditTest=document.querySelectorAll('#formeditTest');
    console.log(formEditTest);
    for (let index = 0; index < formEditTest.length; index++) {
        // fomrDelete[index].addEventListener('submit',function(e) {
        //     e.preventDefault();
        //     new Send('Test',fomrDelete[index],'deleteTest',null);
        //     rederTest();
            
        // })
        editTest(formEditTest[index]);
    }
}
function editTest(formEditTest){
    // var formEditTest=document.getElementById('formeditTest');
    formEditTest.addEventListener('submit',function (e) {
        e.preventDefault();
        form=new FormData(formEditTest);
        var id= form.get('idTest');
        fetch('/Op-Art/Test/showDataEdit/',
        {
            method:'POST',
            body:form
        }
        ).
        then(data=>data.json()).
        then(
            res=>{
                console.log(res[0].type_learning);
                html=`<form id="editTest">
                    <input type="text" name="type_learning" value='${res[0].type_learning}' >
                    <textarea name="description"  cols="30" rows="10">${res[0].description_t_l}</textarea>        
                    <input type="submit" value="listo">
                </form>`;  
                var container=document.getElementById('containerEditTest');
                container.innerHTML=html;
                var editTest=document.getElementById('editTest');
                editTest.addEventListener('submit',function (e) {
                    e.preventDefault();
                    // console.log(id);
                    new Send('Test',editTest,'updateTest',id);
                    container.innerHTML='';
                    rederTest();


                })
        
            }
        )
    })  
}
function showDataTest() {
    fetch('/Op-Art/Test/showTest/')
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
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>`;
                for (let index = 0; index<res.length; index++) {
                    // console.log(res[index].type_learning);
                    html+=`
                    <tr>
                        <td>${res[index].type_learning}</td>
                        <td>${res[index].description_t_l}</td> 
                        <td>
                            <form id='deleteTest'>
                                <input type='hidden' name='idTest' value='${res[index].id_test}'>
                                <input type='submit' value='elinimar'>
                            </form>
                        </td>
                        <td>
                            <form id='formeditTest'>
                            <input type='hidden' name='idTest' value='${res[index].id_test}'>
                            <input type='submit' value='Editar' >
                            </form>
                        </td>
                    </tr>`;            
                } 
                html+=` 
                </tbody>
                </table>`;
            }
            list.innerHTML=html;
            deteleTest();
            editTests();
        }
    ).catch(
        ()=>{
            list.innerHTML=`Algo salio mal.`;
        }
    )
}
