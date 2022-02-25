---
title: " 云服务器加载 SSH 密钥失败"
description: 云服务器加载 SSH 密钥失败
weight: 20
draft: false
keyword: 云计算, 云服务器，SSH
---

## 问题介绍

使用管理控制台云服务器加载 SSH 密钥失败

## 解决办法

1. 进入主机重启一下 gapd 服务

```
systemctl restart gapd  #Centos
service gapd restart    #Ubuntu
```

2. 在控制台重新加载 SSH 密钥


