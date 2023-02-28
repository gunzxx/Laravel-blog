let container = document.getElementById('container');
let kirim = document.getElementById('kirim');

if(kirim != null){
    kirim.onclick = ()=>{
        let data = Math.floor(Math.random()*10)
        $.ajax({
            url:'/api/coba',
            method : 'post',
            // dataType:'json',
            data: {
                'nama':'user coba'
            },
            success:(e)=>{
                container.innerHTML = e
                // console.log(e);
            },
            error: (e)=>{
                console.log(e);
            }
        })
    }
}



let clear = document.querySelectorAll(".clearBtn");
if(clear != null){
    clear.forEach(function(clears){
        clears.addEventListener("click", function(){
            inputSearch = document.querySelector(".clearInput");
            inputSearch.value = "";
            inputSearch.focus();
            // console.log("OK");
        });
    });
}

document.onkeydown = function(e){
    if(e.keyCode==191){
        e.preventDefault();
        inputSearch = document.querySelector(".clearInput");
        inputSearch.focus();
    }
}