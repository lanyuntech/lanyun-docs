---
title: "云应用"
description: 
weight: 10
draft: false
---

AppCenter 应用市场为用户提供了种类丰富的应用。用户可以通过首页推荐和商品搜索功能快速查找应用。

## 应用查找

云平台为用户和服务商提供了以下方式进行应用查看：

1. 登录 AppCenter 应用管理平台，进入应用市场，可查看云平台出品的应用，可根据应用分类和应用搜索查找所需应用。
2. 登录云平台管理控制台，在**产品与服务** > **AppCenter** 的**应用中心**，快速查看所需应用。


### 产品与服务

产品与服务页面为用户陈列了各种类型的应用，用户可直接点击应用查看。

同时，用户可在产品与服务页面进行应用的搜索。

### 应用中心

1. 用户不仅可直接在产品与服务进行应用的查找，同时可点击 AppCenter 进入应用中心，按照应用类型进行筛选或者进行应用的搜索。

   <img src="../../_images/um_cloud_search.png" style="zoom:50%;" />

2. 搜索云应用。

   <img src="../../_images/um_cloud_app.png" style="zoom:50%;" />

3. 您还可以在应用中心查看到**常用应用**，可直接选用应用。

   <img src="../../_images/um_cloud_customapp.png" style="zoom:50%;" />

### 应用详情

1. 应用详情查看

   进入应用中心后，用户选择应用，可点击**查看详情**。

   <img src="../../_images/um_cloud_details.png" style="zoom:50%;" />

   进入应用详情页面后，可查看应用的介绍，价格，信息，版本等信息。

2. 应用介绍查看

   应用详情中，点击**介绍**查看。

   <img src="../../_images/um_cloud_app_details.png" style="zoom:50%;" />

3. 价格查看

   应用详情中，点击**价格**查看应用计费的方案信息。

   <img src="../../_images/um_cloud_billing.png" style="zoom:50%;" />

4. 信息查看

   应用详情中，点击**信息**查看信息来源。

   <img src="../../_images/um_cloud_info.png" style="zoom:50%;" />

5. 版本查看

   应用详情中，点击**版本**可查看应用的不同版本，选择不同版本进行部署。

   ![](../../_images/um_cloud_version.png)

## 应用购买

用户可在应用管理平台的应用市场进行应用的购买，同时还可在控制管理平台的应用中心或者常用应用界面选择应用进行部署购买。

在控制管理平台的应用中心，可以选择应用进行部署购买。

1. 进入AppCenter控制台的应用中心后，选择应用，点击**立即部署**，进入部署页面。

   以云应用 **大数据服务ZooKeeper** 购买为例。

   <img src="../../_images/um_cloud_deploy.png" style="zoom:50%;" />

2. 进入部署页面后，相关参数选择和填写，点击**提交**。

   选择**部署区域**

   <img src="../../_images/um_cloud_zone.png" style="zoom:50%;" />

3. 填写相关参数时，费用根据参数变化，右侧可预览费用，确认填写完毕后，阅读协议且选择后，点击**提交**。

   <img src="../../_images/um_cloud_param.png" style="zoom:50%;" />

## 应用实例

在提交部署后，可在**集群管理**中查看或者在对应的**常用应用**类型中查看。

### 集群管理

对已购买的集群，在集群管理页面可进行快速的启动/关闭。

点击**集群管**理，可查看到已部署的集群，如下界面。

<img src="../../_images/um_cloud_zookeeper_list.png" style="zoom:50%;" />

选择某个集群后，可进行快速的启动，关闭。在更多操作中，系统为用户提供了一系列的快捷操作，如重启集群，对集群配置告警通知策略和绑定标签，同时可把集群加入到某个项目或从项目中移除集群。

<img src="../../_images/um_cloud_zookeeper_more.png" style="zoom:50%;" />

选择节点后，**鼠标右键**，可对已部署的集群进行如下界面所示的操作。

<img src="../../_images/um_cloud_zookeeper_right.png" style="zoom:50%;" />

### 集群详情

1. 集群详情查看

   在集群管理页面，点击已部署的**应用 ID**，进入部署的应用详情查看，如下界面。

   <img src="../../_images/um_cloud_zookeeper_details.png" style="zoom:50%;" />

2. 集群基本操作

   进入详情后，可**点击基本属性右上角的图标**，查看针对本集群的操作，如下界面。

   <img src="../../_images/um_cloud_zookeeper_operation.png" style="zoom:50%;" />

3. 集群节点

   详情右侧可查看节点和对节点进行相关操作，如新增，删除，筛选节点状态，修改节点名称等等，如下界面所示。

   <img src="../../_images/um_cloud_zookeeper_status.png" style="zoom:50%;" />

   可通过在各个资源上点击**右键**来进行常用操作，以及**双击**来修改基本属性。

   <img src="../../_images/um_cloud_zookeeper_modify.png" style="zoom:50%;" />

4. 节点新增

   可点击界面的新增节点，进入节点新增界面，选择对应的相关配置，提交后可查看新增的节点。

   <img src="../../_images/um_cloud_zookeeper_add.png" style="zoom:50%;" />

5. 节点删除

   选择某个节点或多个节点后，可**删除节点**，如下界面所示。

   <img src="../../_images/um_cloud_zookeeper_del.png" style="zoom:50%;" />

6. 集群的监控

   在右侧的节点展示中，可查看相关服务或资源的监控图标，获取相关资源信息。

    <img src="../../_images/um_cloud_zookeeper_monitor.png" style="zoom:50%;" />

   <img src="../../_images/um_cloud_zookeeper_sources.png" style="zoom:50%;" />

7. 配置参数

   当集群有参数配置时，可在右侧的配置参数中对参数进行修改，如下界面。

   <img src="../../_images/um_cloud_zookeeper_config.png" style="zoom:50%;" />

8. 告警

   **绑定和解绑告警策略**

   在告警项中，**选择节点后**，进行相关指标告警策略的绑定或解绑。

   <img src="../../_images/um_cloud_zookeeper_alarm.png" style="zoom:50%;" />

   <img src="../../_images/um_cloud_zookeeper_bind_alarm.png" style="zoom:50%;" />

   告警策略无法满足集群或者无策略时，在绑定弹框中，可以快速的**创建和管理指标告警策略**。

   ![](../../_images/um_cloud_zookeeper_alarm_create.png)

   在集群管理列表配置通知策略后，若当所有指标规则处于告警状态则满足触发条件，不仅在页面的历史信息会展示，同时会对已认证的相关账号发送对应信息。

   ![](../../_images/um_cloud_zookeeper_alarm_monitor.png)

   <img src="../../_images/um_cloud_zookeeper_alarm_list.png" style="zoom:50%;" />

9. 备份

   集群应用部署后，可对集群进行备份；在页面右侧切换到备份，如下界面所示。

   <img src="../../_images/um_cloud_zookeeper_bak.png" style="zoom:50%;" />

   点击**创建备份**，弹出**提示**窗口。

   <img src="../../_images/um_cloud_zookeeper_bak_prompt.png" style="zoom:50%;" />

   备份后，可对备份进行删除或者从备份中再次部署购买集群应用。

   <img src="../../_images/um_cloud_zookeeper_bak_modify.png" style="zoom:50%;" />

10. 服务端口

    集群应用部署后，若有端口的配置，  可查看相关端口信息；若无端口的配置相关，则不展示。

    <img src="../../_images/um_cloud_zookeeper_port.png" style="zoom:50%;" />

11. 租赁信息

    对已部署的应用，可查看具体的租赁扣费信息。

    <img src="../../_images/um_cloud_zookeeper_hire.png" style="zoom:50%;" />

    <img src="../../_images/um_cloud_zookeeper_hire_details.png" style="zoom:50%;" />

12. 操作日志

    对集群应用的操作，可查看具体的操作信息。

    <img src="../../_images/um_cloud_zookeeper_log.png" style="zoom:50%;" />