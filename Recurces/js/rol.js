const configAdmin=document.getElementById('admin');
function validateRol() {
    fetch('/Op-Art/User/rol/').
    catch(_=>{
        console.log('ocurrio un error.')
    }).
    then(
        res=>res.json()
    ).then(
        res=>{
            // console.log(res);
            if (res==0) {
                configAdmin.style.display='none';
            }
        }
    )


}
validateRol();