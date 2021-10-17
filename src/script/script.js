const target = document.getElementById('target')
let array = ['self', 'bouffe', 'nourriture', 'merguez', 'arraignées dans les salades !']
let wordIndex = 0 
let letterIndex = 0

const createLetter = () => {
    const letter = document.createElement('span')
    target.appendChild(letter)

    letter.classList.add('letter')
    letter.style.opacity = '0'
    letter.style.animation = 'anim 5s ease forwards'
    letter.textContent = array[wordIndex][letterIndex]

    setTimeout(()=>{
        letter.remove()
        }, 2000
    )
}

const loop = () => {
    setTimeout(() => {
        if (wordIndex >= array.length){
            wordIndex = 0
            letterIndex = 0
            loop()
        }
        else if (letterIndex < array[wordIndex].length){
            createLetter()
            letterIndex++
            loop()
        }
        else {
            letterIndex = 0
            wordIndex++
            setTimeout(() => {
            loop()
            }, 2000)
        }
    }, 80)
}

loop()

document.getElementById('btn5').addEventListener('mousemove', (e) => {

    const x = e.pageX - e.target.offsetLeft
    const y = e.pageY - e.target.offsetTop

    e.target.style.setProperty('--x', `${ x }px`);
    e.target.style.setProperty('--y', `${ y }px`);
    
})