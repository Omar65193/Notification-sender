window.addEventListener('load',()=>{

    var oneperson = document.getElementById('sendOne');  
    var all = document.getElementById('sendAll');    
     
    
    oneperson.addEventListener('click',()=>{
        var user = document.getElementById('user').value
        var messageOne = document.getElementById('messageOne').value
        const xhr = new XMLHttpRequest()
        xhr.open('POST', 'notificacionUno.php')
        xhr.setRequestHeader('Content-Type', 'application/json')
        xhr.onload = function() {
            if (xhr.status === 200) {
            console.log(xhr.responseText);
            }
        };
        const datos = {
            tk: user.toString(),
            ms: messageOne.toString()
        };
        xhr.send(JSON.stringify(datos))
        document.getElementById('messageOne').value = '';
        alert('Mensaje enviado')
    })



    all.addEventListener('click',()=>{        
        var messageAll = document.getElementById('messageAll').value
        const xhr = new XMLHttpRequest()
        xhr.open('POST', 'notificacion.php')
        xhr.setRequestHeader('Content-Type', 'application/json')
        xhr.onload = function() {
            if (xhr.status === 200) {
            console.log(xhr.responseText);
            }
        };
        const datos = {            
            ms: messageAll.toString()
        };
        xhr.send(JSON.stringify(datos))
        document.getElementById('messageAll').value = '';
        alert('Mensaje enviado')
    })

})