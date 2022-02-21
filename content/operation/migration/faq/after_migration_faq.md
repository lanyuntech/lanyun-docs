---
title: "迁移后 FAQ"
date: 2021-05-21T00:38:25+09:00
description: 本小节主要介绍迁移后可能出现的问题及解决方法。
draft: false
weight: 2
keyword: 云计算, 迁移中心, V2V
---

## 系统启动问题

### 迁移后虚拟机无法启动

**处理方法**：

联系售前售后人员处理。

## 业务连续性问题

### Windows虚拟机迁移后安装/更新virtio驱动

**处理方法**：

若硬盘控制器类型设置为 vd：virtio 和 sd：scsi，需额外驱动支持，详细操作请参考[更新virtio驱动](/operation/migration/manual/check_server#更新virtio驱动)。

若硬盘控制器类型设置为 hd:ide，则无需额外安装驱动。

### 开机后提示 ：Booting from Hard Disk

**原因**：

平台不兼容部分参数。

**处理方法**：

1. 登录宿主节点（hyper节点）服务器。

2. 执行如下命令，查看 webservice 节点：

   ```
   # cat /pitrix/conf/nodes/webservice
   ```

3. 执行如下命令，登录任一 webservice 节点：

   ```
   # ssh xxx
   ```

   **说明：**

   命令行中，xxx为步骤2中查看的webservice节点名称。

4. 执行如下命令，检查配置，更新目标镜像对应控制器类型：

   ```
   python /pitrix/lib/pitrix-scripts/exec_sql.py -d zone -f /pitrix/conf/global/postgresql.yaml -c "update image set block_bus='hd' where image_id = 'img-xxxxxx'"
   ```

   **说明：**

   命令行中 image_id 可通过如下方式获取：

   步骤1：登录云平台，查看云服务器列表。

   步骤2：点击需要操作的云服务器 ID，查看云服务器详情。

   步骤3：点击如图所示位置：

   ![](/operation/migration/_images/after_migration_faq_1.png)

   步骤4：进入镜像详情，即可获取  image_id：

   ![](/operation/migration/_images/after_migration_faq_2.png)

## 开机后的windows虚拟机网卡获取不到IP

**原因**：

系统中相关服务没有开启。

**处理方法**：

选择 “ 我的电脑 > 管理 > 服务 > dhcp client ”，点击 “ 启动服务 ”。
