

function hideSideBar(){
    const cross=document.querySelector('.cross');
    const sidebar=document.querySelector('.sidebar');
    console.log(cross);
    cross.addEventListener('click',()=>{
        sidebar.classList.remove('translate-x-[0%]');
        sidebar.classList.add('translate-x-[-100%]');
    })
}
hideSideBar();
function displaySideBar(){
    const toggleButton=document.querySelector('.toggleButton');
    const sidebar=document.querySelector('.sidebar');
    toggleButton.addEventListener('click',()=>{
        sidebar.classList.remove('translate-x-[-100%]');
        sidebar.classList.add('translate-x-[0%]');
    })
}
displaySideBar();

export function clickLinksSideBar(){
    const links=document.querySelectorAll('.link-page');
    links.forEach((link)=>{
    link.addEventListener('click',(e)=>{
            const sibling=e.currentTarget.children[1];
            sibling.click();
        })
    })
}
clickLinksSideBar();


let title=document.querySelector('.title');
let add_fees=document.querySelector('.add_fees');
let titleText=title.textContent.replace(/\s/g, "");
let add_feesText=add_fees.textContent.replace(/\s/g, "");
if(add_feesText===titleText){
    add_fees.classList.add('bg-white');
    add_fees.style.color='#74f814';
    add_fees.classList.remove('hover:bg-white');
    add_fees.classList.remove('hover:text-green');
}