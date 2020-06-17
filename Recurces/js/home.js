class Article{
    constructor(method, nameContainer,finalObj=false){
        this.url=`/Op-Art/Article/${method}/`;
        this.container=document.getElementById(nameContainer);
        this.getData()
        this.final=finalObj;
        this.objComment =new Comment;
        
    }
    getData(){
        fetch(`${this.url}`).
        then(data=>data.json()).
        then(
            res=>{
                // console.log(res);    
                for (let index = 0; index < res.length; index++) {
                    res[index].title=this.checkData(res[index].title);
                    res[index].contenido=this.checkData(res[index].contenido);
                    res[index].autor=this.checkData(res[index].autor);
                    if(typeof res[index].genero!=='undefined'){
                        res[index].genero=this.checkData(res[index].genero);
                        var element=`Genero:${res[index].genero}`;
                    }else{
                        res[index].num_c=this.checkData(res[index].num_c);
                        if (res[index].num_c==1) {
                            var element=`Hay un comentario sobre este articulo.`;
                            
                        }else{
                            var element=`Hay ${res[index].num_c} comentarios sobre este articulo.`;
                        }
                    }
                    this.container.innerHTML+=`
                    <article>
                        <h3>${res[index].title}</h3>
                        <p>${res[index].contenido}</p>
                        <footer>
                            <p>Autor: ${res[index].autor}</p>
                            <p>${element}</p>
                                <div id="">
                                    <form  class="showArtid">
                                        <input type='hidden' name='idArt' value='${res[index].id}'>
                                        <input type="submit" value="ver mas">
                                    </form>
                                </div>
                        </footer>
                    </article>`;                     
                }                
            }
        ).then(
            ()=>{
                if (this.final==true) {      
                    this.ShowArtFull();
                }
                if (this.final==false) {
                }
            }
        ).
        catch(()=>{
            console.log('Error');
        })
    }
    ShowArtFull(){
        var fromShowArt=document.querySelectorAll('.showArtid');
        for (let index = 0; index < fromShowArt.length; index++) {
            fromShowArt[index].addEventListener('submit',function(e){
                e.preventDefault();
                var from = new FormData(fromShowArt[index]); 
                var containerArt=document.getElementById('articleSelec');
                fetch('/Op-Art/Article/showOneArt/',
                {
                    method:'POST',
                    body:from
                }
                ).then(
                    data=>data.json()
                ).then(data=>{
                    console.log(data);
                    if (typeof data==='string') {
                        containerArt.innerHTML=data;
                    }else{
                        containerArt.innerHTML=
                        `<article>
                            <h3>${data.title!=null?data.title:'desconocido' }</h3>
                            <p>${data.content!=null?data.content:'desconocido'}</p>
                            <footer>
                                <p>Autor: ${data.autor!=null?data.autor:'desconocido'}</p>
                                <p>Genero:${data.genero!=null?data.genero:'desconocido'}</p>
                                <p>Fecha de publicacion:${data.fecha!=null?data.fecha:'desconocido'}</p>
                                <div id="">
                                    <div id='litsComent'>
                                    </div>
                                    <form  id="addComent">
                                        <input type='hidden' name='idArt' value='${data.id}'>
                                        <textarea name="contentComent"  cols="30" rows="10"></textarea>
                                        <input type="submit" value="Comentar">
                                    </form>
                                </div>
                            </footer>
                        </article>
                        `;
                    }
                    return data.id;
                }).then(
                    res=>{
                        var objComment =new Comment(res);
                        objComment.show();
                        objComment.add();
                        // objComment.delete();

                    }
                ).
                catch(
                    ()=>{
                        containerArt.innerHTML=`No se pudo seleccionar el articulo inteneta otra vez`;
                    }
                )
            });
        }
    }
    checkData(param){
        if (param==null) {
            param="Desconocido.";
        }
        return param;
    }     
    
}
setTimeout(() => {
    new Article('showDesc','artOutstanding');
    setTimeout(() => {
        new Article('showRecent','artrecent', true);
    }, 100);
}, 100);

