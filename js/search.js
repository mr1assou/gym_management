import {} from './dashboard.js';


function checkSearchField(){
    const parent=document.querySelector('.parent');
    if(parent===null){
        const content=document.querySelector('.content');
        content.innerHTML=`<div class="text-1xl text-center text-grey font-bold">There is no client with this name</div>`;
    }
}
checkSearchField();