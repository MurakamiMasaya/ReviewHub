document.addEventListener("DOMContentLoaded", function(){

    const reviewIcon = document.querySelector("#review-icon")
    const reviewOpen = document.querySelector('#review-open')
    const reviewArea = document.querySelector('#review-area')


    reviewIcon.addEventListener('click', function(){
        if(reviewOpen.className !== 'hidden'){
            reviewOpen.classList.add('hidden')
            reviewArea.classList.remove('hidden')
        } else {
            reviewOpen.classList.remove('hidden')
            reviewArea.classList.add('hidden')
        }
    })
    reviewOpen.addEventListener('click', function(){
        reviewArea.classList.remove('hidden')
        reviewOpen.classList.add('hidden')
    })
})
