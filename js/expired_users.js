function confirm(){
    const confirms=document.querySelectorAll('.confirm');
    confirms.forEach(confirm=>{
        confirm.addEventListener('click',(e)=>{
            const parentElement=e.currentTarget.parentElement.parentElement.parentElement;
            console.log(parentElement);
            const fullName=parentElement.querySelector('.full-name');
            const name=document.querySelector('.name');
            name.textContent=fullName.textContent;
            const beginningDate=parentElement.querySelector('.beginning-date');
            const start=document.querySelector('.start');
            start.textContent=beginningDate.textContent;
            const endDate=parentElement.querySelector('.end-date');
            const end=document.querySelector('.end');
            end.textContent=endDate.textContent;
            let link=e.currentTarget.nextElementSibling.getAttribute('href');
            const clientId=link.split("?")[1].split("&")[0].split("=")[1];
            const clientIdField=document.querySelector('.client-id');
            clientIdField.value=clientId;
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