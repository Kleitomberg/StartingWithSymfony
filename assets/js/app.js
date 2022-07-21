
var btn = document.querySelector('#datakike')

btn.onclick = function(){
    addLike();
};

function addLike(){  
   

    $.ajax({
                url:"http://127.0.0.1:8000/messages/12/like/like",
                method: 'POST',

    }).then(function(response){
       
        document.getElementById('likescontador').innerHTML = response.likes
    })
    

}

