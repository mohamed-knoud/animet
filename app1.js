const arrows = document.querySelectorAll(".arrow");

const movieLists = document.querySelectorAll(".movie-list");
arrows.forEach((arrow, i) => {
  // const itemNumber = movieLists[i].querySelectorAll("img").length;
  // console.log(itemNumber)
  let clickCounter = 0;
  arrow.addEventListener("click", () => {
    const ratio = Math.floor(window.innerWidth / 270);
    clickCounter++;
    if (20 - (4 + clickCounter) + (4 - ratio) >= 0) {
      movieLists[i].style.transform = `translateX(${
        movieLists[i].computedStyleMap().get("transform")[0].x.value - 300
      }px)`;
    } else {
      movieLists[i].style.transform = "translateX(0)";
      clickCounter = 0;
    }
  });

  console.log(Math.floor(window.innerWidth / 270));
});
let x = Math.ceil(Math.random() * 10);
// alert(x)
fetch(`https://api.enime.moe/popular`)
        .then(response => {
            if (response.ok) {
            return response.json(); 
            } else {
                
                alert("Error loading data from server!")
            throw new Error('Request failed with status ' + response.status);
            }
        })
        .then(data => {
            let button = document.getElementsByClassName('featured-button')['0']
            button.parentElement.setAttribute('href',`watch.php?animeid=${data.data[x].id}&title=${data.data[x].title.english}`)
            button.parentElement.style.cursor = 'pointer'
          document.getElementsByClassName('featured-desc')[0].textContent = data.data[x].description.substring(0,400)+"..."
          document.getElementsByClassName('featured-title')[0].textContent = data.data[x].title.english
          document.getElementsByClassName('featured-content')[0].style.background = `linear-gradient(to bottom, rgba(0,0,0,0), #151515),url(${data.data[x].bannerImage}) no-repeat`
            data.data.forEach((item)=>{

                    fetch(`https://api.enime.moe/anime/${item.id}`)
                        .then((response) => {
                            if (response.ok) {
                            return response.json();
                            } else {
                            throw new Error("Request failed");
                            }
                        })
                        .then((data) => {

                            let a = document.createElement('a');
                            fetch(`https://api.enime.moe/anime/${data.id}`)
                                .then(response => response.json())
                                .then(data => { 
                                    a.setAttribute('href',`watch.php?animeid=${item.id}&title=${data.title.english}`)
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                            let div = document.createElement('div')
                            div.setAttribute('class','movie-list-item')

                            let img = document.createElement('img')
                            img.setAttribute('class','movie-list-item-img')
                            let span =document.createElement('span')
                            span.setAttribute('class','movie-list-item-title')
                            let p = document.createElement('p')
                            p.setAttribute('class','movie-list-item-desc')
                            let btn = document.createElement('button')
                            btn.setAttribute('class','movie-list-item-button')
                            btn.textContent = 'Watch'
                            a.appendChild(btn)
                            img.src = item.coverImage
                            img.alt = item.title.english
                            span.textContent = item.title.english || item.title.native || item.title.romaji
                            p.textContent = item.description.substring(0,100)+"..."
                            div.appendChild(img)
                            div.appendChild(span)
                            div.appendChild(p)
                            div.appendChild(a)
                            let ml = document.getElementsByClassName("movie-list")[0]
                            
                            ml.appendChild(div)
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                    
                    
                })
        
        }).catch(error => {
                console.error('Error:', error);
            });
        
        
