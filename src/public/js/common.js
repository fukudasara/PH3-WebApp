'use strict';

const button = document.getElementById('post');

  // const buttonOpen = document.getElementById('modalOpen');
const modal = document.getElementById('easyModal');
const buttonClose = document.getElementsByClassName('modalClose')[0];
console.log(buttonClose);

// console.log(modal);
// ボタンがクリックされた時
// buttonOpen.addEventListener('click',() => {
// modal.style.display ='block';
// })



// function modalOpen(){
  
//   modal.classList.add('modalBlock');
// }

button.addEventListener('click',modalOpen);
function modalOpen(){
  modal.classList.add('modalBlock');
};

// バツ印がクリックされた時
buttonClose.addEventListener('click', modalClose);
function modalClose() {
  // modal.style.display = 'none';
  modal.classList.remove('modalBlock');
}

// モーダルコンテンツ以外がクリックされた時
addEventListener('click', outsideClose);
function outsideClose(e) {
  if (e.target == modal) {
    modal.style.display = 'none';
  }
}

// 以下ローディングモーダル表示
const loadingOpen = document.getElementById('modal-record');
const loader = document.getElementById('loader');
const loaderBg = document.getElementById('loader-bg');



// ここまでローディング表示

// カレンダー表示
// $('#datepicker').datepicker();

// {
//   const today = new Date();
//   let year = today.getFullYear();
//   let month = today.getMonth();

//   function getCalendarHead() {
//     const dates = [];
//     const d = new Date(year, month, 0).getDate();
//     const n = new Date(year, month, 1).getDay();

//     for (let i = 0; i < n; i++) {
//       // 30
//       // 29, 30
//       // 28, 29, 30
//       dates.unshift({
//         date: d - i,
//         isToday: false,
//         isDisabled: true,
//       });
//     }

//     return dates;
//   }

//   function getCalendarBody() {
//     const dates = []; // date: 日付, day: 曜日
//     const lastDate = new Date(year, month + 1, 0).getDate();


//     for (let i = 1; i <= lastDate; i++) {
//       dates.push({
//         date: i,
//         isToday: false,
//         isDisabled: false,
//       });
//     }

//     if (year === today.getFullYear() && month === today.getMonth()) {
//       dates[today.getDate() - 1].isToday = true;
//     }

//     return dates;
//   }

//   function getCalendarTail() {
//     const dates = [];
//     const lastDay = new Date(year, month + 1, 0).getDay();

//     for (let i = 1; i < 7 - lastDay; i++) {
//       dates.push({
//         date: i,
//         isToday: false,
//         isDisabled: true,
//       });
//     }

//     return dates;
//   }
//   function clearCalendar() {
//     const tbody = document.querySelector('tbody');

//     while (tbody.firstChild) {
//       tbody.removeChild(tbody.firstChild);
//     }
//   }

//   function renderTitle() {
//     const title = `${year}年${String(month + 1).padStart(2, '0')}月`;
//     document.getElementById('title').textContent = title;
//   }
//   // function renderTitle() {
//   //   const title = `${year}/${String(month + 1).padStart(2, '0')}`;
//   //   document.getElementById('title').textContent = title;
//   // }

//   function renderWeeks() {
//     const dates = [
//       ...getCalendarHead(),
//       ...getCalendarBody(),
//       ...getCalendarTail(),
//     ];
//     const weeks = [];
//     const weeksCount = dates.length / 7;

//     for (let i = 0; i < weeksCount; i++) {
//       weeks.push(dates.splice(0, 7));
//     }

//     weeks.forEach(week => {
//       const tr = document.createElement('tr');
//       week.forEach(date => {
//         const td = document.createElement('td');

//         td.textContent = date.date;
//         if (date.isToday) {
//           td.classList.add('today');
//         }
//         if (date.isDisabled) {
//           td.classList.add('disabled');
//         }

//         tr.appendChild(td);
//       });
//       document.querySelector('tbody').appendChild(tr);
//     });
//   }

//   function createCalendar() {
//     clearCalendar();
//     renderTitle();
//     renderWeeks();
//   }

//   document.getElementById('prev').addEventListener('click', () => {
//     month--;
//     if (month < 0) {
//       year--;
//       month = 11;
//     }

//     createCalendar();
//   });

//   document.getElementById('next').addEventListener('click', () => {
//     month++;
//     if (month > 11) {
//       year++;
//       month = 0;
//     }
//     createCalendar();
//   });

//   document.getElementById('today').addEventListener('click', () => {
//     year = today.getFullYear();
//     month = today.getMonth();

//     createCalendar();
//   });

//   createCalendar();

//   const calenderButtonOpen = document.getElementById('modal-gakushuDateInput');
//   const calender = document.getElementById('calenderBox');

//   function calenderOpen(){
  
//     // calender.classList.add('calenderBlock');
//     calender.style.display ="block";
//   }
//   const getTd =  document.getElementsByTagName('td');
//   console.log(`${getTd}`);
//   getTd.addEventListener('click', function() {
//     console.log("クリックでけたよ");
//     calender.style.display ="none";
//     const getDateInput = document.getElementById('modal-gakushuDateInput');
//     const reflectClickedDate = getDateInput.innerHTML(`${this}`);
//   });
// }

// 以下twitter投稿機能
//openTwitter(投稿文、シェアするURL、ハッシュタグ、提供元アカウント)


  

  
  function openTwitter(text) {
    if(text.length < 141){
      var turl = "https://twitter.com/intent/tweet?text="+text;
      // window.open(turl,'_blank');
      window.location.href = turl;
    }
  }

  // 記録・投稿ボタンの取得
  const postTwitter = document.getElementById('modal-record');
  // chk.addEventListener("", function(){
  //   // if (this.checked) {
  //     console.log("twitterにシェアします");
      
  //   },
    
    // );
    postTwitter.addEventListener('click',function(){
      // twitter記入欄の取得
      const twitterInput = document.getElementById('modal-twitterInput');
      const chk = document.getElementById("js-my-checkboxT").checked;
      console.log(chk);
      if(chk===true){
        openTwitter(twitterInput.value)
      }else{
        $(function(){
          //読み込みが完了したら実行する
          // $(loadingOpen).on('click',function(){
            console.log('りんご');
            loader.style.display = 'block';
            loaderBg.style.display = 'flex';
            //ローディングアニメーションをフェードアウト
            $('.loader').delay(3000).fadeOut(600);
            //背景色をフェードアウト
            $('.loader-bg').delay(3000).fadeOut(600);

            const getModalBody = document.getElementById('modal-body');
            const getModalFooter = document.getElementById('modal-footer');
            const getPostComplete = document.getElementsByClassName('postComplete');
            console.log(getPostComplete[0]);

            setTimeout(showComplete, 3200);
            function showComplete(){
            getModalBody.style.display = 'none';
            getModalFooter.style.display = 'none';
            getPostComplete[0].style.display = 'block';
            }
        // });
        
        });
      }
    });


