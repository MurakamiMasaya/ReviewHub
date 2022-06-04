document.addEventListener("DOMContentLoaded", function(){

    adjustTopMargin()

    window.addEventListener('resize', function(){
        adjustTopMargin()
    })
})

function adjustTopMargin(){
    const nav = document.querySelector("#nav")
        const main = document.querySelector("#main")
    
        navHight = nav.offsetHeight;

        main.style.marginTop = navHight + 'px'
}