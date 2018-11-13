# 初始化
- php artisan migrate                                            初始化数据库
- php artisan db:seed --class=AdvertiserCategoriessTableSeeder   初始化广告商
- php artisan db:seed --class=AdvStylesTableSeeder               初始化广告类型
- php artisan db:seed --class=AdminsTableSeeder                  初始化管理员
- php artisan db:seed --class=RegionsTableSeeder                 初始化国家
- php artisan queue:work redis --queue=show_report               展示队列开启
- php artisan queue:work redis --queue=click_report              点击队列开启
- php artisan queue:work redis --queue=download_report           下载队列开启

# 先整理后删除

- php artisan collect:download                                    统一整理昨天的下载数据
- php artisan collect:visitor                                     统一整理昨天的浏览数据

- php artisan delete:download                                     仅保留最近三天的用户下载数据
- php artisan delete:visitor                                      仅保留最近三天的用户浏览数据
