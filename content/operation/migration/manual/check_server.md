---
title: "迁移后检查"
date: 2021-05-21T00:38:25+09:00
description: 本小节主要介绍迁移后的检查工作。
draft: false
weight: 3
keyword: 云计算, 迁移中心, V2V
---

迁移任务完成后，可在云服务器页面查看相关资源，需检查相关配置。

## 查看云服务器

1. 登录 **管理控制台**，选择 **产品与服务** > **计算** > **云服务器**，进入 **云服务器** 页面，可查看到迁移成功的云服务器展示在列：

   ![](/operation/migration/_images/check_server_1.png)

2. 点击云服务器 ID 处链接，进入详情页面，可查看当前云服务器的详细信息：

   ![](/operation/migration/_images/check_server_2.png)

3. 点击 ID 后图标，如下所示，检查云服务器是否能正常启动到登录界面：

   ![](/operation/migration/_images/check_server_3.png)

## 检查云服务器时间

登录云服务器，检查云服务器的时间和时区是否与当前时间保持一致。

### Linux系统

1. 登录云服务器。

2. 执行如下命令查看云服务器的系统时间：

   ```
   timedatectl
   ```

### Windows系统

1. 点击 **开始** > **设置**。
2. 选择 **时间和语言** > **日期和时间**，即可查看云服务器的时间和时区。

## 更新virtio驱动

当云服务器系统为 Windows 系统，控制器类型选择 virtio 时，需更新 virtio 驱动。

**操作步骤：**

1. 登录 **服务器迁移中心**，进入 **迁移任务** 页面：

   ![](/operation/migration/_images/check_server_4.png)

2. 点击任务名称处链接，进入任务详情页面，可查看到云服务器所在物理节点：

   ![](/operation/migration/_images/check_server_5.png)

3. 登录该物理节点，拷贝 img.tar.gz 并解压至 `/root` 目录下：

   ```
   tar -zxf img.tar.gz  -C /root
   ```

4. 执行如下命令，进入指定目录：

   ```
   cd img/
   ```

5. 执行如下命令：

   ```
   ./add_disk.sh
   ```

4. 执行后需指定 Instance ID，输入对应云服务器的 Instance ID。

4. 登录云服务器，右键点击 **我的电脑** > **属性** > **设备管理器**。

5. 点击 **磁盘驱动器**，选择要操作的设备，右键选择 **更新驱动程序**。

6. 弹出 **更新驱动程序** 提示框，选择 **浏览我的计算机以查找驱动程序软件**。

10. 选择 virtio-win-0.1.171.zip 驱动所在目录，可参考 [Windows 系统迁移前准备](/operation/migration/manual/preparation#Windows系统迁移前准备)，点击**下一步**。

8. 根据提示完成更新 virtio 驱动。