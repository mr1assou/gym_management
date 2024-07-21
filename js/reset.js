


function reset(){
    const reset=document.querySelector('.reset');
    reset.addEventListener('click',(e)=>{
        e.preventDefault();
        const popUp=document.querySelector('.pop-up');
        popUp.classList.remove('hidden');
        popUp.classList.add('block');
        const userId=document.querySelector('.user_id').textContent;
        const input=document.querySelector('.input');
        input.value=userId;
        console.log(input.value);
    })
}
reset();

const no=document.querySelector('.no');
no.addEventListener('click',()=>{
    popUp.classList.add('hidden');
    popUp.classList.remove('block');
})