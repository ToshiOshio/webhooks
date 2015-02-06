# webhooks
from a web service to another web service

* Contributors: ToshiOshio
* Tags: webhook, backlog, slack

## Description

### Back2Slack viabot (/back2slack)

The test code for webhooks available on [Backlog](http://www.backlog.jp).

BacklogプロジェクトのGitにPushされた内容をSlackの特定チャンネルにSlackbotでpostするWebhook用PHPスクリプトです。

####使い方
1. Slack Teamに[Slackbotを導入する](https://slack.com/integrations)。
2. Add Slackbot IntegrationでTokenを生成する。
3. 通知を投稿するチャンネルを作成する（既存チャンネルも可）。
4. サンプルPHPスクリプトの設定項目を更新し、グローバルなサーバ上に設置する。
5. Backlogプロジェクトの「プロジェクト設定」にある「Git」セクションで対象にしたいリポジトリ編集で、WebフックURLにスクリプトのURLを設定する。

#### Known Issues

- 複数のPushが行われた場合、最初のPushのみPostします。
