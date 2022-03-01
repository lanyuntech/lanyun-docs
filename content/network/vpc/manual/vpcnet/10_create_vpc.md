---
title: "创建 VPC 网络"
linkTitle: "创建 VPC 网络"
description: 介绍如何创建 VPC 网络。
keyword: 云计算, VPC, VPC 网络
draft: false
weight: 10
---

## 操作场景

在 VPC 网络中使用云资源前，您必须先创建一个 VPC 网络和初始私有网络。

本章节用于指导您创建一个新的VPC网络。

## 操作步骤

1. 登录 管理控制台。

2. 在控制台导航栏中，选择**产品与服务** > **网络服务** > **VPC 网络**，进入**VPC 网络**页面。

3. 点击**创建 VPC 网络**，弹出**创建 VPC 网络**页面。

   <img src="../../../_images/501010_create_vpc.png" alt="create_vpc" style="zoom:50%;" />

4. 配置 VPC 网络基本信息及初始私有网络信息。

> **说明**：
>
> 创建 VPC 网络时，应至少创建一个初始私有网络，此外，您还可以单击**添加私有网络**创建多个私有网络，一次最多可添加3个私有网络（包含初始私有网络）。



<table>
  <tr>
  	<th style="width: 120px">参数项目</th>
 		<th>参数说明</th>
  </tr>
  <tr>
  	<td>名称</td>
  	<td>VPC 网络的名称。<br>支持自动填充及自定义。名称长度为1~64个字符，须由中文、英文字母、数字、下划线（_）、中划线（-）和点（.）组成。</td>
  </tr>
  <tr>
  	<td>IPv4 地址范围</td>
  	<td>VPC 的 IPv4 网段。<br>VPC 网络创建后，IPv4 网段不可修改。<br></td>
  </tr>
  <tr>
  	<td>基础网络</td>
  	<td>根据实际情况配置基础网络。</td>
  </tr>
   <tr>
  	<td>类型</td>
  	<td>支持小型、中型、大型及超大型，不同类型可支持的管理流量转发能力不同。 <br>
     <div style="background-color: #D8ECDE;padding: 10px 24px; margin: 10px 0;border-left:3px solid #00a971;"><b>说明</b>：若您的云服务器需要上网，需要给私有网络内的云服务器单独绑定公网 IP。</li>
      </div>
   	</td>
  </tr>
 <tr>
  	<td>安全组</td>
    <td>选择安全组。若未创建安全组，可选择默认安全组，也可在下方提示信息中点击<b>新建安全组</b>进行创建，具体操作说明参见<a  href="/security/security_group/manual/sg_create">创建安全组</a>。</td>
  </tr>
</table>


5. 点击**创建**，待创建成功，返回 **VPC 网络**页面。

