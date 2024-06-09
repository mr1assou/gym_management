import {} from './dashboard.js';


function checkSearchField(){
    const parent=document.querySelector('.parent');
    if(parent===null){
        const table=document.querySelector('.table');
        table.innerHTML=`<div class="text-1xl text-center text-grey font-bold">There is no client with this name</div>`;
    }
}
checkSearchField();