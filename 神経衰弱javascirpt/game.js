function shuffle(){
  let number = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13'];
  let hokan;
 for (let i = 0; i < 6; i++) {
  for(let j=0; j<13; j++){
  let a = Math.floor(Math.random() * 13);
    hokan = number[j];
    number[j] = number[a];
    number[a] = hokan;
  }
  }
  return number;
}
let firstCard;
let secondCard;
let line = document.getElementById('line1');
let img = document.createElement('img');
let div= document.createElement('div');
//divの子要素がimg
div.setAttribute("class", "card");
let number1 = shuffle();
let number2 = shuffle();
let check = 0;
let kinds = 0;
let index =0;
let getCard = 0;
for (let i = 0; i < 26; i++) {
  div = div.cloneNode();
  line.append(div);
  element = img.cloneNode();

  //kinds = 0だったらクローバー１だったらスペード

  if(kinds == 0){
    element.setAttribute("src", "./images/trump/back01.png");
    element.setAttribute("id", "c" + number1[index] + "");
    kinds++;
  }else{
    element.setAttribute("src", "./images/trump/back01.png");
    element.setAttribute("id", "s" + number2[index] + "");
    index++;
    kinds=0;
  }

  element.setAttribute("height", "120");
  element.setAttribute("width", "80");

  //イベント付与
  element.addEventListener('click', function (event) {

    if (secondCard != null) {
      //二枚の組み合わせが正しいか判定
      if (firstCard.card != secondCard.card) {
        if (document.getElementById(firstCard.id) == null){
          document.getElementById(secondCard.id).setAttribute("src", "./images/trump/back01.png");
        }else{
          document.getElementById(firstCard.id).setAttribute("src", "./images/trump/back01.png");
          document.getElementById(secondCard.id).setAttribute("src", "./images/trump/back01.png");
        }
        firstCard = null;
        secondCard = null;
      }
      else {
        //同じカードを二回クリックしたときの判定
        if (firstCard.id[0] == secondCard.id[0]) {
          firstCard = null;
        } else {
          img = document.createElement('img');
          let line3 = document.getElementById('line3');
          let element3 = img.cloneNode();
          let id = firstCard.id;
          element3.setAttribute("src", "./images/trump/clover/" + id[1] + id[2] + ".png");
          element3.setAttribute("class", "card");
          line3.append(element3);
          document.getElementById(firstCard.id).remove();
           document.getElementById(secondCard.id).remove();
          firstCard = null;
          secondCard = null;
          getCard++;
        }
      }
    }

    // event.target = クリックして取得した要素
    let element = event.target;
    if (element.id[0] == 'c') {
      element.setAttribute("src", "./images/trump/clover/" + element.id[1] + element.id[2] + ".png");
    } else {
      element.setAttribute("src", "./images/trump/spade/" + element.id[1] + element.id[2] + ".png");
    }
    if (firstCard == null) {
      firstCard = {
        id: element.id,
        card: element.id[1] + element.id[2],
      };
    } else {
      if (getCard == 12) {
        console.log(element.id[0]);
        if (element.id[0] == 'c') {
          element.setAttribute("src", "./images/trump/clover/" + element.id[1] + element.id[2] + ".png");
        } else {
          element.setAttribute("src", "./images/trump/spade/" + element.id[1] + element.id[2] + ".png");
        }
        alert('ゲームクリア');
        location.reload();
      }
      secondCard = {
        id: element.id,
        card: element.id[1] + element.id[2],
      };

    }

  });
  div.append(element);
  check++;
  if(check==13){
    line = document.getElementById('line2');
  }
};
