---
title: "主备回切"
date: 2021-05-21T00:38:25+09:00
description: 本小节主要介绍灾备管理的基本操作。
draft: false
weight: 5
keyword: 主备回切, 灾备管理
---

## 主备回切

主备切换后，可根据实际情况进行主备回切。

**操作步骤：**

1. 进入灾备组详情页面 ，选择 **灾备组拓扑** 页签，点击 **主备回切**，弹出 **主备回切** 对话框：

   ![](/operation/disaster_recovery/_images/switch_back_1.png)

2. 点击 **开始反向同步**，返回灾备组详情页面，根据页面提示，点击灾备中心下方 **准备回切，停止备区业务运行**：

   ![](/operation/disaster_recovery/_images/switch_back_2.png)

3. 在弹出的提示框中输入 **确定**，点击 **确定停止**：

   ![](/operation/disaster_recovery/_images/switch_back_3.png)

4. 备区业务停止后，点击生产中心下 **反向同步中，确定主备回切**，在弹出的提示框中输入 **确定**，点击 **确定回切**：

   ![](/operation/disaster_recovery/_images/switch_back_4.png)

5. 返回灾备组详情页面 ，可查看回切完成，点击生产中心下 **启动主区业务**：

   ![](/operation/disaster_recovery/_images/switch_back_5.png)

6. 进入 **资源启动拓扑** 页面，点击 **全部启动**，启动后点击 **完成启动**：

   ![](/operation/disaster_recovery/_images/switch_back_6.png)

7. 返回灾备组详情页面，可查看到生产中心业务正常运行：

   ![](/operation/disaster_recovery/_images/switch_back_7.png)
