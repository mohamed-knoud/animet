<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Sen:wght@400;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <title>Animet</title>
    <script src="//cdn.jsdelivr.net/npm/hls.js@1"></script>

</head>

<body style="background-color: #151515;">
    <div class="navbar">
        <div class="navbar-container">
            <div class="logo-container">
                <a style="text-decoration:none;" href="index.html"><h1 class="logo">Animet</h1></a>
            </div>
        </div>
    </div>
    

    
    <div id="cont">
        <div id="lis">
            <ul id="epstitle">
                
            </ul>
        </div>
        <div id="tt">
            <video poster="" id="iframe-embed" controls>
            </video>
            <h1 style="color:white;" id="anime"></h1>
            <!-- <h2 style="color:white;" id="title"></h2> -->
          </div>
        
    </div>
    
    
    <script>
        function getTextFromElement(element) {
          let text = "";
          
          for (const node of element.childNodes) {
            if (node.nodeType === Node.TEXT_NODE) {
              text += node.textContent;
            } else if (node.nodeType === Node.ELEMENT_NODE && node.tagName === "IMG") {
              text += " [Image]";
            }
          }
        }
        let listtitles = document.getElementById('epstitle')
        let frame = document.querySelector('#iframe-embed')
        
        // frame.src ="https://gogoanimehd.io/one-piece-episode-1"
const apiUrl = 'https://api.enime.moe/anime/<?php echo $_GET['animeid'];?>/episodes';

fetch(apiUrl)
  .then(response => {
    if (!response.ok) {
      throw new Error(`Network response was not ok, status code: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    console.log(data);
    // document.getElementById('title').textContent = data[0].title
    document.getElementById('anime').textContent = "<?php echo $_GET['title']; ?>";
    frame.poster = data[0].image
    // Replace 'https://api.example.com/data' with the actual API endpoint URL
const apiUrl = `https://api.enime.moe/source/${data[0].sources[0].id}`;
let current = 0
// Perform the API request using the fetch() function
fetch(apiUrl)
  .then(response => {
    if (!response.ok) {
      throw new Error(`Network response was not ok: ${response.status}`);
    }
    return response.json(); // Parse the response body as JSON
  })
  .then(data => {
    // Work with the JSON data
    if (Hls.isSupported()) {
    var hls = new Hls();
    hls.on(Hls.Events.MEDIA_ATTACHED, function () {
      console.log('video and hls.js are now bound together !');
    });
    hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {
      console.log(
        'manifest loaded, found ' + data.levels.length + ' quality level',
      );
    });
    hls.loadSource(data.url);
    // bind them together
    hls.attachMedia(frame);
  }
        

    console.log(data);
  })
  .catch(error => {
    console.error('Fetch error:', error);
  });


    data.forEach((item,index)=>{
        let li = document.createElement('li')
        li.textContent = ((item.title === null) ? "Episode "+ (item.number)  : "Episode "+ (item.number) + " : "  + item.title.substring(0,30) + "...")
        let img = document.createElement('img')
        img.src=item.image
        img.style.width="100%"
        img.style.height="auto"
        li.appendChild(img)
        listtitles.appendChild(li)
        document.getElementsByTagName('li')[0].style.color = "#F9E0BB"
        li.addEventListener('click',function(){
          
          for(let i=0;c=document.getElementsByTagName('li').length,i<c;i++){
            document.getElementsByTagName('li')[i].style.color = "#fff"
          }
          this.style.color = '#F9E0BB'
          const apiUrl = `https://api.enime.moe/source/${data[index].sources[0].id}`;
          frame.poster = data[index].image
          fetch(apiUrl)
          .then(response => {
            if (!response.ok) {
              throw new Error(`Network response was not ok: ${response.status}`);
            }
            return response.json(); // Parse the response body as JSON
          })
          .then(data => {
                  if (Hls.isSupported()) {
    var hls = new Hls();
    hls.on(Hls.Events.MEDIA_ATTACHED, function () {
      console.log('video and hls.js are now bound together !');
    });
    hls.on(Hls.Events.MANIFEST_PARSED, function (event, data) {
      console.log(
        'manifest loaded, found ' + data.levels.length + ' quality level',
      );
    });
    hls.loadSource(data.url);
    // bind them together
    hls.attachMedia(frame);
  }

          })
          .catch(error => {
            console.error('Fetch error:', error);
          });
        })
    })
  })
  .catch(error => {
    console.error('Fetch error:', error);
  });
  
  
  
  
  
   </script>
  
</body>

</html>