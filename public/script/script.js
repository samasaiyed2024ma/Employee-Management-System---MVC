
const links = document.querySelectorAll(".nav-link");
const currentpath = window.location.pathname;

links.forEach(link => {
        if(currentpath === link.getAttribute("href") ){
            link.classList.add("active");
        }  
        else{
            link.classList.remove("active");
        }   
});


function displayConfirmBox(eid){
    var box = document.getElementById('confirm-box');
    if(box.style.display === 'none'){
        box.style.display = 'block';
    }
    else{
        box.style.display = "block";
    }

    document.getElementById('eid').value = eid;
    
    document.getElementById('delete').href = "/delete?eid=" +eid;
}



