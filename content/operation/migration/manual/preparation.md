---
title: "迁移前准备"
date: 2021-05-21T00:38:25+09:00
description: 本小节主要介绍迁移前的准备工作。
draft: false
weight: 1
keyword: 云计算, 迁移中心, V2V
---

迁移前，您需要了解以下注意事项。

## Windows系统迁移前准备

获取 virtio-win-0.1.171.zip 驱动，拷贝至源虚拟机的任一目录下，并记录位置。



以下操作针对 Windows server 2003 虚拟机。

**操作步骤：**

步骤1：获取 MergeIDE.zip 安装包。

`  https://yunify.anybox.qingcloud.com/s/Q1GwzAwsKA3Xf9sOSGhpRNqu2UrwtJZ7  `

步骤2：拷贝 MergeIDE.zip 到 Windows server 2003 虚拟机中，进行解压。

步骤3：以管理员身份运行 CMD 窗口，将解压后的 MergelDE 拖到 CMD 窗口，点击回车键执行。

## Linux系统迁移前准备

如果使用盘符等标识符挂载目录，需修改为 UUID 的方式挂载目录，否则迁移后若盘符发生变化，会导致 linux 无法启动。

**操作步骤**

步骤1：登录待迁移的虚拟机。

步骤2：查看索引盘 UUID：

```
# blkid
……
/dev/sda1: UUID="57d2d9f5-0200-4294-bc5d-4931bafd89cf" TYPE="ext4" 
/dev/sda2: UUID="22ad2eda-960c-474f-829b-11e8718425c0" TYPE="swap" 
……
```

步骤2：将索引盘盘符修改为对应的 UUID，格式如下所示：

```
# vim /etc/fstab
……
UUID=57d2d9f5-0200-4294-bc5d-4931bafd89cf  /  ext4    defaults  0       1
UUID=22ad2eda-960c-474f-829b-11e8718425c0 none  swap    sw   0       0
……
```

