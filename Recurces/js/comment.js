class Comment{
    constructor(id){
        this.id=id;
        // this.mesage='hoal';
    }
    add(){
        var formComent=document.getElementById('addComent');
        formComent.addEventListener('submit',(e) =>{
            e.preventDefault();
            new Send('Comment',formComent,'create',null);
            this.render();
        })
    }
    show(){
        var containerComment=document.getElementById('litsComent');
        fetch(`/Op-Art/Comment/showComents/${this.id}/`).
        then(
            res=>res.json()
        ).then(
            res=>{
                console.log(res)
                var html=``;
                if (typeof res==='string') {
                    containerComment.innerHTML=``;    
                }else{
                    for (let index = 0; index < res.length; index++) {                       
                        if (res[index].status==true) {
                            var status=`
                            <form class="deleteComent">
                                <input type="hidden" name="id" value="${this.id}">
                                <input type="hidden" name="id" value="${res[index].id_comment}">
                                <input type="submit" value="Eliminar">
                            </form>
                            `;
                        }else{
                            var status=``;
                        }
                        html+=`
                        <div>
                            <h4>${res[index].name_user}</h4>
                            <p>${res[index].content_comment}</p>
                            ${status}
                        </div>
                        `;
                    }   
                    containerComment.innerHTML=html; 
                    // this.add();
                    this.delete();
                }
            }
        )

    }
    delete(){
        var formComentDelete=document.querySelectorAll('.deleteComent');
        for (let index = 0; index < formComentDelete.length; index++) {
            formComentDelete[index].addEventListener('submit', (e)=> {
                e.preventDefault();
                new Send('Comment',formComentDelete[index],'delete',null);
                this.render();
            })
          
        }
    }
    render() {
        setTimeout(_=>{
            console.log(mesage);
            mesage.innerHTML='listo';
            this.show();   

        },1000)
    }       

}
