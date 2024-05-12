
function clickLinksSideBar(){
    const links=document.querySelectorAll('.link-page');
    links.forEach((link)=>{
    link.addEventListener('click',(e)=>{
            const sibling=e.currentTarget.children[1];
            sibling.click();
        })
    })
}
clickLinksSideBar();

function statusColor(){
    const status=document.querySelectorAll('.status');
    console.log(status);
    status.forEach(item=>{
        if(item.textContent=='trial') item.classList.add('text-blue');
        else if(item.textContent=='access') item.classList.add('text-green-dark');
        else if(item.textContent=='reject') item.classList.add('text-red');
    })
}
statusColor();