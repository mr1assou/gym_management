
function clickLinksSideBar(){
    const links=document.querySelectorAll('.link-page');
    console.log(links);
    links.forEach((link)=>{
    link.addEventListener('click',(e)=>{
            const sibling=e.currentTarget.children[1];
            sibling.click();
        })
    })
}
clickLinksSideBar();