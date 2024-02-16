<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>webapp</title>
  <link rel="stylesheet" href="/css/reset.css">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body id="body">
  <header class="header">
    <div class="header-left">
      <img src="/img/logo.svg" alt="logo">
      <p class="header-week-cnt" id="thisWeek"></p>
    </div>
    <button class="post" id="post">記録・投稿</button>
  </header>
  <main class="main">
    <div class="main-left">
      <section class="study-hours">
        <div class="today-wrapper">
          <div class="study-hours-title">Today</div>
          <div class="study-hours-hour" id="studyHoursToday">{{$todays}}</div>
          <div class="study-hours-unit">hour</div>
        </div>
        <div class="month-wrapper">
          <div class="study-hours-title">Month</div>
          <div class="study-hours-hour" id="studyHoursMonth">{{$months}}</div>
          <div class="study-hours-unit">hour</div>
        </div>
        <div class="total-wrapper">
          <div class="study-hours-title">Total</div>
          <div class="study-hours-hour" id="studyHoursTotal">{{$totals}}</div>
          <div class="study-hours-unit">hour</div>
        </div>
      </section>
      <div class="section-border"></div>
      <section>
        <canvas id="studyHoursGraph">
          Canvas not supported...
        </canvas>
      </section>
    </div>
    <div class="main-right">
      <section class="languages-wrapper">
        <div class="languages-title">学習言語</div>
        <div class="languages-chart" id="languagesChartWrapper">
          <canvas id="languagesPieChart">
            Canvas not supported...
          </canvas>
        </div>
      </section>
      <section class="contents-wrapper">
        <div class="contents-title">学習コンテンツ</div>
        <div class="contents-chart" id="contentsChartWrapper">
          <canvas id="contentsPieChart">
            Canvas not supported...
          </canvas>
        </div>
      </section>
    </div>
    <!-- 以下モーダル -->
    <div id="easyModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <button class="modalClose">✖️</button>
        </div>
        <div class="postComplete">
            <div class="postCompleteContent">
                <p class="completeAwesome">AWESOME!</p>
                <div class="completeCheck">
                    <span class="completeCheckS"></span>
                </div>
                <p class="postCompleteP">記録・投稿完了しました</p>
            </div>
        </div>
        <div class="modal-body" id="modal-body">
        <form action="{{ route('top.store') }}" method="POST">
                @csrf
            <div class="modal-input-content">
                <div class="modal-left">
                    <div class="modal-gakushuDate">
                        <label for="modal-gakushuDateInput" class="modal-headLine">学習日</label>
                        <input type="date" class="modal-date-input" size="10" id="modal-gakushuDateInput">
                    </div>
                    <div class="modal-gakushuContent">
                        <p class="modal-headLine">学習コンテンツ</p>
                        <!-- 学習コンテンツのチェックボックスなどを追加 -->
                        <!-- <select name="content">
                                    @foreach($contents as $content)
                                    <option value="{{$content->id}}" >{{$content->name}}</option>
                                    @endforeach
                        </select> -->
                        @foreach($contents as $content)
                          <label>
                              <input type="checkbox" name="contents[]" value="{{$content->id}}">
                              {{$content->name}}
                          </label>
                      @endforeach
                    </div>
                    <div class="modal-gakushuLang">
                        <p class="modal-headLine">学習言語（複数選択可）</p>
                        <!-- 学習言語のチェックボックスなどを追加 -->
                        <select name="language">
                                @foreach($languages as $language)
                                <option value="{{$language->id}}" >{{$language->name}}</option>
                                @endforeach
                        </select>

                    </div>
                </div>
                <div class="modal-right">
                    <div class="modal-gakushuTime">
                        <label for="modal-gakushuTimeInput" class="modal-headLine">学習時間</label>
                        <input type="text" id="modal-gkushuTimeInput" class="modal-hour-text" name="time">
                    </div>
                    <div class="modal-twitter">
                        <label class="modal-headLine">Twitter用コメント</label>
                        <textarea maxlength="140" id="modal-twitterInput" class="modal-twitter-text"></textarea>
                    </div>
                    <div class="modal-twitterShare">
                        <label class="my-checkboxT">
                            <input type="checkbox" id="js-my-checkboxT">
                            <span class="checkmark" id="twitterCheck"></span>
                            <p>Twitterにシェアする</p>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer" id="modal-footer">
            <button id="modal-record" class="modal-post">記録・投稿</button>
        </div>
    </div>
</div>
</form>
    <!-- 以上モーダル -->
  </main>
  <footer class="footer">
    <div class="one-month-before" id="oneMonthBefore">
      < </div>
        <div id="displayDate"></div>
        <div class="one-month-later" id="oneMonthLater">></div>
  </footer>
  <script src="/js/date.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.1.0"></script>
  <script src="https://kit.fontawesome.com/afb3b2864c.js" crossorigin="anonymous"></script>
  <script src="/js/chart.js"></script>
  <script src="/js/modal.js"></script>
  <script src="/js/common.js"></script>
</body>
</html>