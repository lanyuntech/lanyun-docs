---
title: "免密登录控制台"
description: 免费登录控制台的工作流
keyword: 云平台, AppCenter, 云应用开发平台, SaaS
draft: false
weight: 50
---

用户界面点击立即访问按钮，前端会获取到当前用户的 token，然后写携带 token 跳转到服务商提供的地址 authUrl?token={usertoken}

> **说明：**
>
> - 跳转到服务商 authUrl 地址后，需校验是否携带 token 参数，如果携带需请求云青接口验证 token 有效性。
> - 如果 token 未携带或无效，需要访问云平台 sso 让用户重新登录来获取 token。
> - 获取了用户 token 后，服务商即可访问云平台 API。

![](/appcenter/dev-platform/_images/um_sec_login.png)

