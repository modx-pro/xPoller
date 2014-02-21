<h3>[[+text]]</h3>
[[+message:notempty=`<p>[[+message]]</p>`]]
<form role="form" action="[[~[[*id]]]]" method="post" class="xPolls">
  <input type="hidden" value="[[+id]]" name="qid">
  [[+options]]
  <button type="submit" name="xp_action" value="answer" class="btn btn-primary">Голосовать</button>
  <button type="submit" name="xp_action" value="abstain" class="btn btn-default">Воздержаться</button>
</form>