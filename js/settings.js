const imageButton=document.querySelector('.image-button');
console.log(imageButton);
imageButton.addEventListener('click',(e)=>{
e.preventDefault();
e.stopPropagation();
const imageInput=document.querySelector('.image-input');
imageInput.click();
imageInput.addEventListener('change',()=>{
        const imageField=document.querySelector('.image-field');
        imageField.src=URL.createObjectURL(imageInput.files[0]);     
    })
})


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
