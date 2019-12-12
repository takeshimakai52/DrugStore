<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8" />
  <title>YTYDrugStore</title>
  <link rel="stylesheet" href="frontEnd_style.css">
</head>
<body>
  <div class="frontEnd_header">
    <span class="YTYTopLink_wrap">
      <a href="http://localhost/php/shop/">YTYDrugStore</a>
    </span>
    <span class="searchByKeyword_wrap">
      <input type="text" name="searchByKeyword_box">
    </span>
    <span class="searchButton_wrap">
      <input type="button" name="searchButton_button" value="検索">
    </span>
    <span>
      <a href="">ログイン</a>
    </span>
  </div>
  <div class="leftCategory_sideMenu">
    <h1>ジャンル</h1>
    <h1>メーカー</h1>
    <h1>ブランド</h1>
  </div>

  <table>
    <?php foreach ($goods as $g) { ?>
      <tr>
        <td>
          <?php echo img_tag($g['code']) ?>
        </td>
        <td>
          <p class="goods"><?php echo $g['name'] ?></p>
          <p><?php echo nl2br($g['comment']) ?></p>
        </td>
        <td width="80">
          <p><?php echo $g['price'] ?> 円</p>
        </td>
      </tr>
    <?php } ?>
  </table>
</body>
</html>
