import {} from './dashboard.js';

function confirm(){
    const confirms=document.querySelectorAll('.confirm');
    confirms.forEach(confirm=>{
        confirm.addEventListener('click',(e)=>{
            let link=e.currentTarget.nextElementSibling.getAttribute('href');
            link=link.split("?");
            link[0]="./confirm.php?";
            const yes=document.querySelector('.yes');
            yes.setAttribute('href',link.join(""));
            const popUP=document.querySelector('.pop-up');
            popUP.classList.remove('hidden');
            popUP.classList.add('block');
        })
    })
}
confirm();
function deletePopUp(){
    const no=document.querySelector('.no');
    no.addEventListener('click',()=>{
        const popUP=document.querySelector('.pop-up');
        popUP.classList.remove('block');
        popUP.classList.add('hidden');              
    })
}
deletePopUp();