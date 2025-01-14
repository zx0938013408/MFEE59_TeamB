-- Content from /mnt/data/01_sport_type.sql
-- 建立運動類型 (1: 籃球、 2: 排球、 3: 羽球)

CREATE TABLE sport_type (
id int AUTO_INCREMENT PRIMARY KEY,
sport_name varchar(10) not null
);

desc sport_type;

insert into sport_type(sport_name)
values
("籃球"),
("排球"),
("羽球");

select * from sport_type;

-- Content from /mnt/data/02_citys.sql
-- 建立 全台灣所有縣市
-- 台南 id=14

CREATE TABLE citys (
city_id int AUTO_INCREMENT PRIMARY KEY,
city_name varchar(10) not null
);

##  縣市 citys

INSERT INTO `citys` VALUES (1, '台北市');
INSERT INTO `citys` VALUES (2, '新北市');
INSERT INTO `citys` VALUES (3, '基隆市');
INSERT INTO `citys` VALUES (4, '桃園市');
INSERT INTO `citys` VALUES (5, '新竹市');
INSERT INTO `citys` VALUES (6, '新竹縣');
INSERT INTO `citys` VALUES (7, '苗栗縣');
INSERT INTO `citys` VALUES (8, '台中市');
INSERT INTO `citys` VALUES (9, '彰化縣');
INSERT INTO `citys` VALUES (10, '南投縣');
INSERT INTO `citys` VALUES (11, '嘉義市');
INSERT INTO `citys` VALUES (12, '嘉義縣');
INSERT INTO `citys` VALUES (13, '雲林縣');
INSERT INTO `citys` VALUES (14, '台南市');
INSERT INTO `citys` VALUES (15, '高雄市');
INSERT INTO `citys` VALUES (16, '屏東縣');
INSERT INTO `citys` VALUES (17, '宜蘭縣');
INSERT INTO `citys` VALUES (18, '花蓮縣');
INSERT INTO `citys` VALUES (19, '台東縣');
INSERT INTO `citys` VALUES (20, '澎湖縣');
INSERT INTO `citys` VALUES (21, '金門縣');
INSERT INTO `citys` VALUES (22, '連江縣');

select * from citys;


-- Content from /mnt/data/03_areas.sql
-- 建立 全台灣所有行政區

CREATE TABLE areas (
area_id int AUTO_INCREMENT PRIMARY KEY,
name varchar(10) not null,
city_id int,
foreign key(city_id) references citys(city_id) on delete set null
);

## 台北市
INSERT INTO `areas`(`name`, `city_id`) VALUES('中正區', 1);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大同區', 1);
INSERT INTO `areas`(`name`, `city_id`) VALUES('中山區', 1);
INSERT INTO `areas`(`name`, `city_id`) VALUES('松山區', 1);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大安區', 1);
INSERT INTO `areas`(`name`, `city_id`) VALUES('萬華區', 1);
INSERT INTO `areas`(`name`, `city_id`) VALUES('信義區', 1);
INSERT INTO `areas`(`name`, `city_id`) VALUES('士林區', 1);
INSERT INTO `areas`(`name`, `city_id`) VALUES('北投區', 1);
INSERT INTO `areas`(`name`, `city_id`) VALUES('內湖區', 1);
INSERT INTO `areas`(`name`, `city_id`) VALUES('南港區', 1);
INSERT INTO `areas`(`name`, `city_id`) VALUES('文山區', 1);

## 基隆市
INSERT INTO `areas`(`name`, `city_id`) VALUES('仁愛區', 3);
INSERT INTO `areas`(`name`, `city_id`) VALUES('信義區', 3);
INSERT INTO `areas`(`name`, `city_id`) VALUES('中正區', 3);
INSERT INTO `areas`(`name`, `city_id`) VALUES('中山區', 3);
INSERT INTO `areas`(`name`, `city_id`) VALUES('安樂區', 3);
INSERT INTO `areas`(`name`, `city_id`) VALUES('暖暖區', 3);
INSERT INTO `areas`(`name`, `city_id`) VALUES('七堵區', 3);


## 新北市
INSERT INTO `areas`(`name`, `city_id`) VALUES('萬里區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('金山區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('板橋區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('汐止區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('深坑區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('石碇區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('瑞芳區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('平溪區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('雙溪區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('貢寮區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新店區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('坪林區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('烏來區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('永和區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('中和區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('土城區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('三峽區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('樹林區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('鶯歌區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('三重區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新莊區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('泰山區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('林口區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('蘆洲區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('五股區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('八里區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('淡水區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('三芝區', 2);
INSERT INTO `areas`(`name`, `city_id`) VALUES('石門區', 2);


## 宜蘭縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('宜蘭市', 17);
INSERT INTO `areas`(`name`, `city_id`) VALUES('頭城鎮', 17);
INSERT INTO `areas`(`name`, `city_id`) VALUES('礁溪鄉', 17);
INSERT INTO `areas`(`name`, `city_id`) VALUES('壯圍鄉', 17);
INSERT INTO `areas`(`name`, `city_id`) VALUES('員山鄉', 17);
INSERT INTO `areas`(`name`, `city_id`) VALUES('羅東鎮', 17);
INSERT INTO `areas`(`name`, `city_id`) VALUES('三星鄉', 17);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大同鄉', 17);
INSERT INTO `areas`(`name`, `city_id`) VALUES('五結鄉', 17);
INSERT INTO `areas`(`name`, `city_id`) VALUES('冬山鄉', 17);
INSERT INTO `areas`(`name`, `city_id`) VALUES('蘇澳鎮', 17);
INSERT INTO `areas`(`name`, `city_id`) VALUES('南澳鄉', 17);



## 新竹市
INSERT INTO `areas`(`name`, `city_id`) VALUES('東區', 5);
INSERT INTO `areas`(`name`, `city_id`) VALUES('北區', 5);
INSERT INTO `areas`(`name`, `city_id`) VALUES('香山區', 5);


## 新竹縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('竹北市', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('湖口鄉', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新豐鄉', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新埔鎮', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('關西鎮', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('芎林鄉', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('寶山鄉', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('竹東鎮', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('五峰鄉', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('橫山鄉', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('尖石鄉', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('北埔鄉', 6);
INSERT INTO `areas`(`name`, `city_id`) VALUES('峨嵋鄉', 6);


## 桃園市
INSERT INTO `areas`(`name`, `city_id`) VALUES('中壢區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('平鎮區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('龍潭區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('楊梅區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新屋區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('觀音區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('桃園區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('龜山區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('八德區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大溪區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('復興區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大園區', 4);
INSERT INTO `areas`(`name`, `city_id`) VALUES('蘆竹區', 4);


## 苗栗縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('竹南鎮', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('頭份市', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('三灣鄉', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('南庄鄉', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('獅潭鄉', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('後龍鎮', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('通霄鎮', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('苑裡鎮', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('苗栗市', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('造橋鄉', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('頭屋鄉', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('公館鄉', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大湖鄉', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('泰安鄉', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('銅鑼鄉', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('三義鄉', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('西湖鄉', 7);
INSERT INTO `areas`(`name`, `city_id`) VALUES('卓蘭鎮', 7);


## 台中市
INSERT INTO `areas`(`name`, `city_id`) VALUES('中區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('東區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('南區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('西區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('北區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('北屯區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('西屯區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('南屯區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('太平區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大里區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('霧峰區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('烏日區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('豐原區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('后里區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('石岡區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('東勢區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('和平區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新社區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('潭子區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大雅區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('神岡區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大肚區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('沙鹿區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('龍井區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('梧棲區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('清水區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大甲區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('外埔區', 8);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大安區', 8);


## 彰化縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('彰化市', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('芬園鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('花壇鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('秀水鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('鹿港鎮', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('福興鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('線西鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('和美鎮', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('伸港鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('員林市', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('社頭鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('永靖鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('埔心鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('溪湖鎮', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大村鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('埔鹽鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('田中鎮', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('北斗鎮', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('田尾鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('埤頭鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('溪州鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('竹塘鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('二林鎮', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大城鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('芳苑鄉', 9);
INSERT INTO `areas`(`name`, `city_id`) VALUES('二水鄉', 9);


## 南投縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('南投市', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('中寮鄉', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('草屯鎮', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('國姓鄉', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('埔里鎮', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('仁愛鄉', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('名間鄉', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('集集鎮', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('水里鄉', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('魚池鄉', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('信義鄉', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('竹山鎮', 10);
INSERT INTO `areas`(`name`, `city_id`) VALUES('鹿谷鄉', 10);


## 嘉義市
INSERT INTO `areas`(`name`, `city_id`) VALUES('西區', 11);
INSERT INTO `areas`(`name`, `city_id`) VALUES('東區', 11);

## 嘉義縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('番路鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('梅山鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('竹崎鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('阿里山鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('中埔鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大埔鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('水上鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('鹿草鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('太保市', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('朴子市', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('東石鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('六腳鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新港鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('民雄鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大林鎮', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('溪口鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('義竹鄉', 12);
INSERT INTO `areas`(`name`, `city_id`) VALUES('布袋鎮', 12);

## 雲林縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('斗南鎮', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大埤鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('虎尾鎮', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('土庫鎮', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('褒忠鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('東勢鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('臺西鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('崙背鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('麥寮鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('斗六市', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('林內鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('古坑鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('莿桐鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('西螺鎮', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('二崙鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('北港鎮', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('水林鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('口湖鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('四湖鄉', 13);
INSERT INTO `areas`(`name`, `city_id`) VALUES('元長鄉', 13);


## 台南市
INSERT INTO `areas`(`name`, `city_id`) VALUES('中西區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('東區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('南區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('北區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('安平區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('安南區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('永康區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('歸仁區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新化區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('左鎮區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('玉井區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('楠西區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('南化區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('仁德區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('關廟區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('龍崎區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('官田區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('麻豆區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('佳里區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('西港區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('七股區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('將軍區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('學甲區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('北門區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新營區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('後壁區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('白河區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('東山區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('六甲區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('下營區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('柳營區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('鹽水區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('善化區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大內區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('山上區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新市區', 14);
INSERT INTO `areas`(`name`, `city_id`) VALUES('安定區', 14);



## 高雄市
INSERT INTO `areas`(`name`, `city_id`) VALUES('新興區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('前金區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('芩雅區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('鹽埕區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('鼓山區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('旗津區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('前鎮區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('三民區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('楠梓區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('小港區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('左營區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('仁武區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大社區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('岡山區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('路竹區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('阿蓮區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('田寮區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('燕巢區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('橋頭區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('梓官區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('彌陀區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('永安區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('湖內區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('鳳山區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大寮區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('林園區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('鳥松區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大樹區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('旗山區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('美濃區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('六龜區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('內門區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('杉林區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('甲仙區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('桃源區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('三民區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('那瑪夏區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('茂林區', 15);
INSERT INTO `areas`(`name`, `city_id`) VALUES('茄萣區', 15);


## 澎湖縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('馬公市', 20);
INSERT INTO `areas`(`name`, `city_id`) VALUES('西嶼鄉', 20);
INSERT INTO `areas`(`name`, `city_id`) VALUES('望安鄉', 20);
INSERT INTO `areas`(`name`, `city_id`) VALUES('七美鄉', 20);
INSERT INTO `areas`(`name`, `city_id`) VALUES('白沙鄉', 20);
INSERT INTO `areas`(`name`, `city_id`) VALUES('湖西鄉', 20);


## 屏東縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('屏東市', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('三地門鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('霧臺鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('瑪家鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('九如鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('里港鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('高樹鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('盬埔鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('長治鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('麟洛鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('竹田鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('內埔鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('萬丹鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('潮州鎮', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('泰武鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('來義鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('萬巒鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('崁頂鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新埤鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('南州鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('林邊鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('東港鎮', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('琉球鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('佳冬鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新園鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('枋寮鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('枋山鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('春日鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('獅子鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('車城鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('牡丹鄉', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('恆春鎮', 16);
INSERT INTO `areas`(`name`, `city_id`) VALUES('滿州鄉', 16);


## 台東縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('臺東市', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('綠島鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('蘭嶼鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('延平鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('卑南鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('鹿野鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('關山鎮', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('海端鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('池上鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('東河鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('成功鎮', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('長濱鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('太麻里鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('金峰鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('大武鄉', 19);
INSERT INTO `areas`(`name`, `city_id`) VALUES('達仁鄉', 19);


## 花蓮縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('花蓮市', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('新城鄉', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('秀林鄉', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('吉安鄉', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('壽豐鄉', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('鳳林鎮', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('光復鄉', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('豐濱鄉', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('瑞穗鄉', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('萬榮鄉', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('玉里鎮', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('卓溪鄉', 18);
INSERT INTO `areas`(`name`, `city_id`) VALUES('富里鄉', 18);

## 金門縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('金沙鎮', 21);
INSERT INTO `areas`(`name`, `city_id`) VALUES('金湖鎮', 21);
INSERT INTO `areas`(`name`, `city_id`) VALUES('金寧鄉', 21);
INSERT INTO `areas`(`name`, `city_id`) VALUES('金城鎮', 21);
INSERT INTO `areas`(`name`, `city_id`) VALUES('烈嶼鄉', 21);
INSERT INTO `areas`(`name`, `city_id`) VALUES('烏坵鄉', 21);

## 連江縣
INSERT INTO `areas`(`name`, `city_id`) VALUES('南竿鄉', 22);
INSERT INTO `areas`(`name`, `city_id`) VALUES('北竿鄉', 22);
INSERT INTO `areas`(`name`, `city_id`) VALUES('莒光鄉', 22);
INSERT INTO `areas`(`name`, `city_id`) VALUES('東引鄉', 22);

select * from areas;

-- Content from /mnt/data/04_court_type.sql
-- 建立球場類型 (室內、戶外等)

CREATE TABLE court_type (
id int AUTO_INCREMENT PRIMARY KEY,
court_type varchar(10) not null
);

insert into court_type (court_type)
values
('室內球場'),('戶外球場'),('風雨球場'),('其他');

select * from court_type;

-- Content from /mnt/data/05_court_info.sql
-- 建立球場場館資訊
-- 球場配對運動類型另外建置關聯表 (insert_court_sports)

create table court_info(
id int primary key auto_increment,
name varchar(200) not null,
area_id int not null,
address varchar(200) not null,
type_id int not null,
is_paid boolean not null,
is_reserve boolean not null,
foreign key(area_id) references areas(area_id),
foreign key(type_id) references court_type(id)
);

INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('臺南市立籃球場', 218, '大林路', 3, 0, 0);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('永華國民運動中心', 216, '中華西路二段30號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('臺南高商體育館', 218, '健康路一段327號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('新營體育館', 240, '長榮路二段78號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('新化區體育公園', 224, '公園路110號', 2, 0, 0);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('歸仁區體育公園', 223, '公園路152號', 3, 0, 0);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('南區全民運動中心', 218, '健康路一段327號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('善化區體育公園', 248, '進學路150號', 2, 0, 0);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('永康區忠孝運動公園', 222, '忠孝路250號', 2, 0, 0);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('仁德區運動公園', 229, '仁義路130號', 2, 0, 0);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('六甲沙灘排球場', 244, '和平街479號', 4, 0, 0);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('東山運動場', 243, '中興南路26號', 2, 0, 0);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('小窩排球館', 221, '北安路四段555號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('歐萊-排球小角落', 252, '海寮5之38號C棟', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('新市全民運動中心', 251, '中華路49號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('臺南市立羽球館', 218, '體育路10號之9', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('順天羽球館', 219, '北成路271號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('博鴻羽球館', 217, '東光路一段100號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('佳里羽球館', 234, '安北路196號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('金成羽球館', 220, '光州路36號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('翔友羽球館', 221, '北安路二段538號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('中愛羽球館', 217, '裕豐街214巷', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('藏龍羽球概念館', 229, '中山路50號', 1, 1, 1);
INSERT INTO court_info (name, area_id, address, type_id, is_paid, is_reserve) values('新力羽球南科館', 251, '陽光大道20號', 1, 1, 1);

select * from court_info;

-- Content from /mnt/data/06_insert_court_sports.sql
-- 建立場館資訊配對運動類型

CREATE TABLE court_sports (
sport_id int,
court_id int,
foreign key(sport_id) references sport_type(id),
foreign key(court_id) references court_info(id)
);

insert into	court_sports (sport_id, court_id)
values
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(3, 2),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(3, 22),
(3, 23),
(3, 24);

select * from court_sports;

-- Content from /mnt/data/09_members_no_favorite_sport.sql
-- 建立會員資料
-- 使用 縣市、行政區 為 ForeignKey
-- 運動興趣另外建立 (insert_member_sports)

CREATE TABLE members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    gender ENUM('男', '女', '其他') NOT NULL,
    birthday_date DATE NOT NULL,
    city_id INT NOT NULL,
    area_id INT NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    foreign key(city_id) references citys(city_id),
    foreign key(area_id) references areas(area_id)
);


-- 插入會員資料
INSERT INTO members (name, gender, birthday_date, city_id, area_id, address, phone, email, password, created_at, updated_at) VALUES
('賀怡如', '女', '1999-01-22', 14, 221, '象山17號', '(00) 99676526', 'jiangxia@yahoo.com', 'iTKPDcWE', '2025-01-05 17:11:29', '2025-01-27 22:17:52'),
('常佩君', '其他', '2006-11-12', 14, 222, '忠義1號', '0994315131', 'nalong@gmail.com', 'SJrYsxyc', '2025-01-06 06:29:46', '2025-05-05 04:37:59'),
('胡惠雯', '女', '1994-09-12', 14, 217, '古亭23號', '0995267116', 'leidai@ding.com', 'mSsFVIvG', '2025-01-06 01:31:09', '2025-11-24 03:58:11'),
('賀雅婷', '男', '1990-08-16', 14, 221, '和街3號', '083 36597073', 'yangkong@yao.tw', '9sSogCJ8', '2025-01-09 02:05:18', '2025-05-20 01:45:25'),
('朱怡君', '男', '1988-05-27', 14, 221, '和平33號', '09 2839305', 'qiang92@gmail.com', 'HrH9vLN6', '2025-01-05 23:58:41', '2025-05-30 23:50:10'),
('劉淑華', '男', '1985-04-15', 14, 216, '國凱八德100號', '0923-948101', 'pingpan@gmail.com', 'jAFRMRXE', '2025-01-02 08:47:04', '2025-11-20 09:30:22'),
('胡雅慧', '女', '1985-02-22', 14, 216, '大智85號', '08-2059168', 'guiying73@hotmail.com', 'hnyBqFmN', '2025-01-09 11:28:03', '2025-09-19 20:54:08'),
('余佳玲', '女', '1995-09-22', 14, 222, '昆陽8號', '08-28268056', 'xqiao@ma.org', 'sYtQ2u3j', '2025-01-01 11:18:24', '2025-12-26 14:17:12'),
('唐怡婷', '女', '2001-12-21', 14, 217, '博愛98號', '0974-064267', 'guiyingwen@gmail.com', 'IDYNhF0F', '2025-01-08 20:44:04', '2025-06-20 15:10:25'),
('張雅雯', '男', '2006-12-26', 14, 216, '興61號', '08 6212706', 'cpeng@pan.net', 'PX9DzcvX', '2025-01-03 16:52:58', '2025-08-21 14:18:50'),
('趙慧君', '女', '1993-04-06', 14, 222, '光華87號', '0978-031272', 'junfu@liu.com', 'b7Cj8bPq', '2025-01-05 00:29:20', '2025-01-28 07:52:28'),
('唐佳樺', '其他', '1995-11-09', 14, 221, '光復67號', '(01) 26317176', 'min88@gmail.com', '8Fo6NuU3', '2025-01-07 16:58:08', '2025-06-08 09:18:06'),
('呂俊傑', '女', '1998-08-15', 14, 216, '永安8號', '051 21199820', 'minghou@xue.org', 'HhsQyxzc', '2025-01-03 06:16:38', '2025-03-05 12:29:08'),
('唐怡婷', '其他', '1985-09-04', 14, 221, '關渡8號', '08-8277165', 'ming33@gmail.com', 'jR6hEUA1', '2025-01-04 00:01:07', '2025-12-10 22:00:56'),
('楊佩珊', '其他', '2001-12-22', 14, 221, '永和53號', '(09) 99671828', 'minglai@hao.org', 'CyErWXaf', '2025-01-04 01:50:44', '2025-05-17 17:39:08'),
('李志宏', '男', '2006-10-01', 14, 222, '福安43號', '09 5877648', 'ming29@huang.com', 'qpXLfgCt', '2025-01-08 15:55:02', '2025-12-03 10:03:52'),
('楊慧君', '男', '2002-12-09', 14, 216, '新莊67號', '00 8973021', 'uliao@hotmail.com', 'EfyJvpDY', '2025-01-01 00:38:03', '2025-03-17 07:56:36'),
('翟郁雯', '男', '2004-09-21', 14, 219, '永和64號', '0934248771', 'shaoxiuying@xia.org', 'iroYVKO2', '2025-01-05 09:57:19', '2025-08-03 20:30:00'),
('惠信宏', '男', '1992-08-23', 14, 222, '四維37號', '01 2820479', 'min32@gmail.com', 'w42IIgbE', '2025-01-07 17:25:52', '2025-10-10 20:11:09'),
('畢心怡', '男', '1995-11-02', 14, 219, '景美74號', '0907-799205', 'lmao@hotmail.com', 'zHQfSAMc', '2025-01-04 13:49:16', '2025-02-20 08:31:18'),
('李佳蓉', '女', '1997-10-28', 14, 219, '興12號', '0969440290', 'jungao@pan.com', 'P6mSLu30', '2025-01-04 03:18:35', '2025-11-10 22:04:12'),
('包欣怡', '女', '1989-08-25', 14, 217, '新店83號', '(06) 99995747', 'yangli@wen.com', 'zUTq5Y6d', '2025-01-09 01:51:59', '2025-08-18 18:31:13'),
('王雅惠', '其他', '1987-10-17', 14, 222, '大勇97號', '088 82497948', 'yiyan@gmail.com', 'pyBMAVtJ', '2025-01-05 16:58:36', '2025-04-25 20:09:07'),
('何雅慧', '女', '1992-06-19', 14, 222, '新生71號', '073 68153927', 'yangguo@yahoo.com', 'KnrKWtjW', '2025-01-08 11:31:47', '2025-08-31 01:32:04'),
('趙琬婷', '男', '1994-07-12', 14, 216, '新店66號', '013 58118032', 'echeng@hotmail.com', 'dqAwmV5f', '2025-01-02 12:36:42', '2025-01-04 07:29:41'),
('遊惠婷', '其他', '1992-08-30', 14, 221, '國凱八德89號', '0999685033', 'panlei@yahoo.com', 'QTy8iAdz', '2025-01-09 00:33:51', '2025-03-16 22:01:47'),
('徐雅萍', '女', '2001-08-07', 14, 217, '自由44號', '(01) 38529014', 'xiulan84@yin.tw', 'iDcPpS7K', '2025-01-06 23:09:35', '2025-04-06 01:38:54'),
('艾羽', '女', '1989-07-08', 14, 222, '民富74號', '0904880749', 'nmo@ding.com', 'Gr9OZrBN', '2025-01-08 02:38:54', '2025-05-20 20:44:28'),
('曾怡婷', '女', '1990-05-21', 14, 222, '新興30號', '071 30214053', 'pingdeng@sun.com', '28Eu1Elh', '2025-01-06 12:15:57', '2025-05-17 01:11:04'),
('孫俊宏', '女', '1987-05-12', 14, 221, '建國42號', '09-22760346', 'qianghe@hotmail.com', 'kmqAdAiK', '2025-01-05 05:24:59', '2025-11-12 15:38:31'),
('高淑華', '男', '2006-04-11', 14, 219, '自由3號', '00-58192857', 'xiuyingzhao@yahoo.com', 'SEJqWuVw', '2025-01-05 21:17:21', '2025-01-30 02:03:09'),
('湯雅萍', '男', '2004-04-30', 14, 221, '龍山寺56號', '08-6634700', 'axu@kong.com', '718396ND', '2025-01-06 10:53:55', '2025-07-05 21:26:23'),
('龍靜怡', '其他', '1992-01-27', 14, 222, '民生8號', '01 2406944', 'yan40@bai.com', 'eNdkb3uy', '2025-01-01 05:45:17', '2025-07-31 01:03:29'),
('張雅文', '其他', '1994-05-26', 14, 221,  '自強77號', '08 6904499', 'ypan@hotmail.com', 'siFWpKEv', '2025-01-01 04:49:39', '2025-12-29 02:51:40'),
('張彥廷', '女', '2003-11-06', 14, 222, '芝山73號', '088 55257462', 'ychen@hotmail.com', 'zezwaH6k', '2025-01-10 02:01:30', '2025-07-13 03:02:17'),
('桑雅芳', '男', '1991-06-19', 14, 219, '奇岩16號', '060 94656448', 'shenping@tang.org', 'RvbrU6qj', '2025-01-03 12:57:02', '2025-08-24 00:03:13'),
('楊佳樺', '女', '1998-08-02', 14, 217, '芝山60號', '00-18906863', 'minxia@du.tw', 'eh5O9eHw', '2025-01-01 18:19:24', '2025-10-03 13:54:39'),
('和信宏', '女', '1999-12-15', 14, 221, '學府52號', '082 47999693', 'hgao@hotmail.com', 'oYk2njO2', '2025-01-09 19:48:49', '2025-06-03 09:40:19'),
('鄧冠廷', '其他', '1991-08-06', 14, 219, '自由31號', '08 7647115', 'cyin@kang.tw', 'iJfF0v6y', '2025-01-03 22:45:42', '2025-03-29 22:57:28'),
('尹佩珊', '女', '2005-09-07', 14, 219, '中和53號', '0922-493337', 'pingqiao@yahoo.com', '2sAeZqcG', '2025-01-04 17:31:25', '2025-02-02 15:49:31'),
('楊飛', '男', '1999-01-10', 14, 217, '大勇43號', '0953668618', 'yufang@jiang.com', '9UbURTS8', '2025-01-07 09:24:50', '2025-05-09 16:16:04'),
('任淑慧', '女', '1989-05-05', 14, 216, '大安14號', '04-6364135', 'qingang@yahoo.com', 'GAJP9mMz', '2025-01-08 23:25:58', '2025-07-22 19:35:57'),
('林怡如', '男', '2001-10-16', 14, 221, '和街63號', '05-9717837', 'tianguiying@wen.tw', 'uNoxf3vY', '2025-01-03 11:48:23', '2025-01-08 22:54:08'),
('辛雅惠', '其他', '1985-03-18', 14, 219, '公園18號', '063 19843898', 'tao07@yahoo.com', 'xvViB2hr', '2025-01-07 19:09:33', '2025-09-12 23:07:24'),
('劉佳穎', '其他', '1991-08-06', 14, 222, '區興50號', '0908-913200', 'xuewei@yuan.tw', 'OMqWska9', '2025-01-06 09:01:08', '2025-10-10 07:01:21'),
('趙俊宏', '女', '2000-03-16', 14, 217, '劍潭100號', '057 49059508', 'yan81@feng.tw', 'eFbRpgKg', '2025-01-03 22:17:43', '2025-10-08 16:12:32'),
('鄧心怡', '其他', '1991-05-07', 14, 217, '士林1號', '002 32592379', 'xia50@gong.com', 'bMjtSHFp', '2025-01-06 01:58:07', '2025-10-18 14:30:01'),
('李嘉玲', '其他', '1990-06-13', 14, 216, '國凱八德34號', '(09) 88015044', 'tzhong@yahoo.com', 'gxzLi2YU', '2025-01-02 10:03:23', '2025-07-29 04:33:34'),
('林信宏', '男', '2005-10-13', 14, 222, '廣慈44號', '087 91154358', 'xzou@yahoo.com', '4AEqYx0P', '2025-01-04 22:31:38', '2025-04-09 16:13:17'),
('姜沖', '女', '1997-08-27', 14, 219, '光復10號', '021 25215610', 'qqin@hotmail.com', 'MWgzIwAa', '2025-01-06 14:14:29', '2025-12-02 03:17:06');

select * from members;

-- Content from /mnt/data/10_insert_member_sports.sql

-- 建立會員興趣
-- 建立關聯表 將會員資料與運動類型結合
CREATE TABLE member_sports (
member_id int,
sport_id int,
foreign key(member_id) references members(id),
foreign key(sport_id) references sport_type(id)
);
-- 插入會員與運動類型的關係
-- 假設運動類型的 id 順序為 1 -> 籃球, 2 -> 排球, 3 -> 羽球

-- 賀怡如: 籃球, 羽球, 排球

INSERT INTO member_sports (member_id, sport_id) VALUES
(1, 1), (1, 2), (1, 3);

-- 常佩君: 羽球, 籃球, 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(2, 1), (2, 2), (2, 3);

-- 胡惠雯: 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(3, 2);

-- 賀雅婷: 排球, 籃球, 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(4, 1), (4, 2), (4, 3);

-- 朱怡君: 羽球, 排球, 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(5, 1), (5, 2), (5, 3);

-- 劉淑華: 羽球, 籃球, 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(6, 1), (6, 2), (6, 3);

-- 胡雅慧: 排球, 籃球, 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(7, 1), (7, 2), (7, 3);

-- 余佳玲: 羽球, 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(8, 1), (8, 3);

-- 唐怡婷: 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(9, 2);

-- 張雅雯: 羽球, 排球, 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(10, 1), (10, 2), (10, 3);

-- 趙慧君: 排球, 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(11, 2), (11, 3);

-- 唐佳樺: 羽球, 籃球, 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(12, 1), (12, 2), (12, 3);

-- 呂俊傑: 籃球, 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(13, 1), (13, 2);

-- 唐怡婷: 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(14, 3);

-- 楊佩珊: 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(15, 1);

-- 李志宏: 排球, 籃球, 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(16, 1), (16, 2), (16, 3);

-- 楊慧君: 羽球, 排球, 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(17, 1), (17, 2), (17, 3);

-- 翟郁雯: 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(18, 3);

-- 惠信宏: 籃球, 羽球, 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(19, 1), (19, 2), (19, 3);

-- 畢心怡: 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(20, 2);

-- 李佳蓉: 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(21, 3);

-- 包欣怡: 羽球, 排球, 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(22, 1), (22, 2), (22, 3);

-- 王雅惠: 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(23, 1);

-- 何雅慧: 籃球, 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(24, 1), (24, 3);

-- 趙琬婷: 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(25, 3);

-- 遊惠婷: 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(26, 2);

-- 徐雅萍: 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(27, 1);

-- 艾羽: 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(28, 2);

-- 曾怡婷: 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(29, 3);

-- 孫俊宏: 排球, 羽球, 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(30, 1), (30, 2), (30, 3);

-- 高淑華: 排球, 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(31, 2), (31, 3);

-- 湯雅萍: 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(32, 2);

-- 龍靜怡: 排球, 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(33, 2), (33, 3);

-- 張雅文: 羽球, 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(34, 2), (34, 3);

-- 張彥廷: 排球, 籃球, 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(35, 1), (35, 2), (35, 3);

-- 桑雅芳: 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(36, 1);

-- 楊佳樺: 籃球, 羽球, 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(37, 1), (37, 2), (37, 3);

-- 和信宏: 羽球, 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(38, 2), (38, 3);

-- 鄧冠廷: 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(39, 2);

-- 尹佩珊: 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(40, 3);

-- 楊飛: 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(41, 2);

-- 任淑慧: 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(42, 2);

-- 林怡如: 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(43, 2);

-- 辛雅惠: 羽球, 排球, 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(44, 1), (44, 2), (44, 3);

-- 劉佳穎: 籃球, 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(45, 1), (45, 3);

-- 趙俊宏: 排球, 籃球, 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(46, 1), (46, 2), (46, 3);

-- 鄧心怡: 籃球, 排球
INSERT INTO member_sports (member_id, sport_id) VALUES
(47, 1), (47, 2);

-- 李嘉玲: 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(48, 1);

-- 林信宏: 羽球
INSERT INTO member_sports (member_id, sport_id) VALUES
(49, 3);

-- 姜沖: 排球, 籃球
INSERT INTO member_sports (member_id, sport_id) VALUES
(50, 1), (50, 2);

select * from member_sports;


-- Content from /mnt/data/07_simulated_activity.sql
-- 建立活動列表 (共60筆)

CREATE TABLE activity_list (
    id INT AUTO_INCREMENT PRIMARY KEY,
    activity_name VARCHAR(100) NOT NULL, # 活動名稱
    photo_url varchar(500) NOT NULL DEFAULT "https://example.com/photo.jpg", # 圖片來源
    sport_type_id INT NOT NULL, #運動類型foreign key
    area_id INT NOT NULL, #行政區域foreign key
    court_id  INT NOT NULL,  #場館資訊foreign key
    activity_time TIMESTAMP NOT NULL, #活動時間
    deadline TIMESTAMP NOT NULL, #報名期限
    payment DECIMAL(10,2) NOT NULL DEFAULT 0, #費用: 預設為0
    need_num  INT NOT NULL, #需求人數
    introduction text NOT NULL, #報名簡介 (詳細內容)
    founder_id INT NOT NULL, #創建者foreign key
    create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP, #建立時間
    update_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, #更新時間
    foreign key(sport_type_id) references sport_type(id),
    foreign key(area_id) references areas(area_id),
    foreign key(court_id) references court_info(id),
    foreign key(founder_id) references members(id)
);


    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動93', 'https://example.com/photo.jpg', 2, '251', 15, '2025/6/17 17:11', '2025/5/31 16:04', 277, 21, '大家一起來運動，無論新手或高手，都歡迎參加！', 5, '2025/6/17 17:11', '2025/10/14 04:01');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動98', 'https://example.com/photo.jpg', 3, '229', 23, '2025/1/11 06:46', '2025/1/10 13:32', 343, 19, '大家一起來運動，無論新手或高手，都歡迎參加！', 4, '2025/1/11 06:46', '2025/6/6 07:34');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動30', 'https://example.com/photo.jpg', 2, '221', 13, '2025/10/10 21:34', '2025/10/4 21:49', 402, 29, '大家一起來運動，無論新手或高手，都歡迎參加！', 3, '2025/10/10 21:34', '2025/11/28 00:15');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動23', 'https://example.com/photo.jpg', 3, '234', 19, '2025/4/3 08:43', '2025/2/1 02:06', 427, 20, '大家一起來運動，無論新手或高手，都歡迎參加！', 30, '2025/4/3 08:43', '2025/8/5 15:12');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動62', 'https://example.com/photo.jpg', 1, '240', 4, '2025/12/9 06:43', '2025/7/10 03:41', 276, 23, '大家一起來運動，無論新手或高手，都歡迎參加！', 10, '2025/12/9 06:43', '2025/12/21 15:55');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動13', 'https://example.com/photo.jpg', 3, '217', 18, '2025/7/30 05:38', '2025/6/27 12:13', 454, 14, '大家一起來運動，無論新手或高手，都歡迎參加！', 4, '2025/7/30 05:38', '2025/12/18 20:22');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動96', 'https://example.com/photo.jpg', 3, '219', 17, '2025/6/1 08:09', '2025/4/26 23:01', 227, 5, '大家一起來運動，無論新手或高手，都歡迎參加！', 47, '2025/6/1 08:09', '2025/6/13 20:32');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動50', 'https://example.com/photo.jpg', 3, '216', 2, '2025/10/12 14:25', '2025/9/22 03:31', 370, 11, '大家一起來運動，無論新手或高手，都歡迎參加！', 41, '2025/10/12 14:25', '2025/12/8 08:02');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動95', 'https://example.com/photo.jpg', 3, '229', 23, '2025/12/28 17:29', '2025/10/29 15:51', 106, 21, '大家一起來運動，無論新手或高手，都歡迎參加！', 32, '2025/12/28 17:29', '2025/12/30 18:26');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動49', 'https://example.com/photo.jpg', 2, '218', 7, '2025/2/9 12:05', '2025/2/7 06:28', 398, 7, '大家一起來運動，無論新手或高手，都歡迎參加！', 43, '2025/2/9 12:05', '2025/9/8 14:42');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動33', 'https://example.com/photo.jpg', 2, '251', 15, '2025/12/15 23:27', '2025/11/19 21:22', 134, 8, '大家一起來運動，無論新手或高手，都歡迎參加！', 30, '2025/12/15 23:27', '2025/12/27 16:57');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動81', 'https://example.com/photo.jpg', 3, '217', 18, '2025/11/11 04:46', '2025/11/2 19:13', 144, 12, '大家一起來運動，無論新手或高手，都歡迎參加！', 49, '2025/11/11 04:46', '2025/11/20 04:55');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動6', 'https://example.com/photo.jpg', 2, '229', 10, '2025/5/25 05:37', '2025/4/1 21:03', 270, 28, '大家一起來運動，無論新手或高手，都歡迎參加！', 28, '2025/5/25 05:37', '2025/11/13 02:05');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動98', 'https://example.com/photo.jpg', 1, '216', 2, '2025/11/18 19:02', '2025/3/16 23:13', 150, 23, '大家一起來運動，無論新手或高手，都歡迎參加！', 39, '2025/11/18 19:02', '2025/11/28 18:17');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動59', 'https://example.com/photo.jpg', 1, '222', 9, '2025/6/17 21:27', '2025/5/2 17:04', 386, 6, '大家一起來運動，無論新手或高手，都歡迎參加！', 7, '2025/6/17 21:27', '2025/10/1 08:14');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動84', 'https://example.com/photo.jpg', 3, '229', 23, '2025/4/30 07:48', '2025/4/14 04:11', 468, 17, '大家一起來運動，無論新手或高手，都歡迎參加！', 15, '2025/4/30 07:48', '2025/7/18 03:34');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動75', 'https://example.com/photo.jpg', 3, '251', 24, '2025/4/24 01:20', '2025/1/7 00:45', 489, 30, '大家一起來運動，無論新手或高手，都歡迎參加！', 29, '2025/4/24 01:20', '2025/6/1 05:56');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動11', 'https://example.com/photo.jpg', 1, '218', 1, '2025/5/2 09:04', '2025/3/5 10:47', 307, 16, '大家一起來運動，無論新手或高手，都歡迎參加！', 1, '2025/5/2 09:04', '2025/12/23 04:49');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動60', 'https://example.com/photo.jpg', 1, '229', 10, '2025/2/22 08:57', '2025/2/7 18:55', 457, 9, '大家一起來運動，無論新手或高手，都歡迎參加！', 16, '2025/2/22 08:57', '2025/8/19 18:27');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動28', 'https://example.com/photo.jpg', 3, '216', 2, '2025/9/14 11:22', '2025/9/3 20:11', 276, 25, '大家一起來運動，無論新手或高手，都歡迎參加！', 6, '2025/9/14 11:22', '2025/11/28 08:23');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動72', 'https://example.com/photo.jpg', 1, '240', 4, '2025/2/28 17:58', '2025/1/24 22:21', 291, 19, '大家一起來運動，無論新手或高手，都歡迎參加！', 47, '2025/2/28 17:58', '2025/11/18 19:26');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動26', 'https://example.com/photo.jpg', 3, '217', 22, '2025/1/27 03:49', '2025/1/8 11:28', 293, 15, '大家一起來運動，無論新手或高手，都歡迎參加！', 47, '2025/1/27 03:49', '2025/6/23 06:23');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動14', 'https://example.com/photo.jpg', 1, '222', 9, '2025/3/14 09:06', '2025/2/18 00:04', 387, 13, '大家一起來運動，無論新手或高手，都歡迎參加！', 40, '2025/3/14 09:06', '2025/8/22 18:34');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動2', 'https://example.com/photo.jpg', 2, '243', 12, '2025/7/29 04:17', '2025/5/9 01:48', 129, 10, '大家一起來運動，無論新手或高手，都歡迎參加！', 31, '2025/7/29 04:17', '2025/12/9 04:00');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動62', 'https://example.com/photo.jpg', 2, '222', 9, '2025/11/12 16:09', '2025/11/8 11:04', 311, 19, '大家一起來運動，無論新手或高手，都歡迎參加！', 40, '2025/11/12 16:09', '2025/12/11 14:37');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動37', 'https://example.com/photo.jpg', 1, '229', 10, '2025/6/12 13:00', '2025/2/7 07:05', 463, 23, '大家一起來運動，無論新手或高手，都歡迎參加！', 16, '2025/6/12 13:00', '2025/9/3 15:13');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動15', 'https://example.com/photo.jpg', 2, '229', 10, '2025/1/22 10:32', '2025/1/3 14:09', 160, 10, '大家一起來運動，無論新手或高手，都歡迎參加！', 47, '2025/1/22 10:32', '2025/9/4 13:02');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動82', 'https://example.com/photo.jpg', 2, '243', 12, '2025/10/12 09:51', '2025/9/13 12:59', 425, 16, '大家一起來運動，無論新手或高手，都歡迎參加！', 37, '2025/10/12 09:51', '2025/11/20 01:46');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動77', 'https://example.com/photo.jpg', 3, '229', 23, '2025/4/18 18:14', '2025/2/7 13:17', 163, 30, '大家一起來運動，無論新手或高手，都歡迎參加！', 16, '2025/4/18 18:14', '2025/5/23 15:50');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動26', 'https://example.com/photo.jpg', 2, '251', 15, '2025/8/24 07:35', '2025/2/4 06:31', 221, 30, '大家一起來運動，無論新手或高手，都歡迎參加！', 17, '2025/8/24 07:35', '2025/9/20 08:38');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動1', 'https://example.com/photo.jpg', 1, '216', 2, '2025/3/21 08:24', '2025/2/15 21:06', 269, 18, '大家一起來運動，無論新手或高手，都歡迎參加！', 32, '2025/3/21 08:24', '2025/6/22 22:46');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動99', 'https://example.com/photo.jpg', 2, '224', 5, '2025/10/20 14:43', '2025/1/18 09:39', 179, 22, '大家一起來運動，無論新手或高手，都歡迎參加！', 27, '2025/10/20 14:43', '2025/11/21 17:50');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動17', 'https://example.com/photo.jpg', 1, '229', 10, '2025/2/13 02:09', '2025/1/18 19:41', 408, 21, '大家一起來運動，無論新手或高手，都歡迎參加！', 29, '2025/2/13 02:09', '2025/8/7 20:42');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動24', 'https://example.com/photo.jpg', 1, '222', 9, '2025/2/9 22:08', '2025/2/7 10:05', 288, 11, '大家一起來運動，無論新手或高手，都歡迎參加！', 34, '2025/2/9 22:08', '2025/11/16 19:53');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動80', 'https://example.com/photo.jpg', 2, '221', 13, '2025/10/28 21:18', '2025/3/17 04:34', 131, 23, '大家一起來運動，無論新手或高手，都歡迎參加！', 17, '2025/10/28 21:18', '2025/12/12 14:19');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動10', 'https://example.com/photo.jpg', 3, '251', 24, '2025/1/27 16:14', '2025/1/24 03:45', 346, 13, '大家一起來運動，無論新手或高手，都歡迎參加！', 11, '2025/1/27 16:14', '2025/12/10 00:17');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動86', 'https://example.com/photo.jpg', 3, '251', 24, '2025/5/17 08:36', '2025/3/26 18:41', 177, 28, '大家一起來運動，無論新手或高手，都歡迎參加！', 36, '2025/5/17 08:36', '2025/9/21 08:12');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動78', 'https://example.com/photo.jpg', 1, '222', 9, '2025/9/13 05:17', '2025/5/8 01:04', 242, 21, '大家一起來運動，無論新手或高手，都歡迎參加！', 38, '2025/9/13 05:17', '2025/10/19 06:07');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動42', 'https://example.com/photo.jpg', 2, '223', 6, '2025/6/11 11:47', '2025/3/20 03:57', 135, 18, '大家一起來運動，無論新手或高手，都歡迎參加！', 49, '2025/6/11 11:47', '2025/9/10 13:47');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動47', 'https://example.com/photo.jpg', 3, '217', 18, '2025/5/12 06:51', '2025/3/2 19:15', 198, 26, '大家一起來運動，無論新手或高手，都歡迎參加！', 44, '2025/5/12 06:51', '2025/9/22 20:17');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動100', 'https://example.com/photo.jpg', 3, '229', 23, '2025/11/23 03:41', '2025/3/11 11:24', 135, 8, '大家一起來運動，無論新手或高手，都歡迎參加！', 26, '2025/11/23 03:41', '2025/12/27 21:00');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動64', 'https://example.com/photo.jpg', 2, '221', 13, '2025/11/26 09:19', '2025/1/2 15:31', 468, 10, '大家一起來運動，無論新手或高手，都歡迎參加！', 23, '2025/11/26 09:19', '2025/12/21 07:36');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動99', 'https://example.com/photo.jpg', 2, '223', 6, '2025/12/9 23:18', '2025/11/29 07:10', 164, 9, '大家一起來運動，無論新手或高手，都歡迎參加！', 28, '2025/12/9 23:18', '2025/12/31 19:43');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動64', 'https://example.com/photo.jpg', 1, '216', 2, '2025/5/22 17:39', '2025/3/7 02:48', 205, 9, '大家一起來運動，無論新手或高手，都歡迎參加！', 5, '2025/5/22 17:39', '2025/8/21 17:08');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動13', 'https://example.com/photo.jpg', 1, '218', 1, '2025/3/20 05:39', '2025/1/14 21:56', 367, 8, '大家一起來運動，無論新手或高手，都歡迎參加！', 33, '2025/3/20 05:39', '2025/12/23 03:58');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動92', 'https://example.com/photo.jpg', 1, '224', 5, '2025/12/10 22:31', '2025/5/26 04:07', 364, 19, '大家一起來運動，無論新手或高手，都歡迎參加！', 31, '2025/12/10 22:31', '2025/12/23 08:51');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動60', 'https://example.com/photo.jpg', 2, '244', 11, '2025/2/17 04:50', '2025/1/2 10:17', 254, 18, '大家一起來運動，無論新手或高手，都歡迎參加！', 40, '2025/2/17 04:50', '2025/11/4 05:49');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動5', 'https://example.com/photo.jpg', 1, '223', 6, '2025/1/6 18:56', '2025/1/1 22:40', 146, 29, '大家一起來運動，無論新手或高手，都歡迎參加！', 14, '2025/1/6 18:56', '2025/1/7 21:20');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動65', 'https://example.com/photo.jpg', 2, '222', 9, '2025/12/6 11:05', '2025/9/26 20:58', 127, 15, '大家一起來運動，無論新手或高手，都歡迎參加！', 5, '2025/12/6 11:05', '2025/12/6 20:00');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動7', 'https://example.com/photo.jpg', 2, '218', 7, '2025/6/14 07:05', '2025/3/25 16:02', 340, 9, '大家一起來運動，無論新手或高手，都歡迎參加！', 13, '2025/6/14 07:05', '2025/6/21 03:44');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動40', 'https://example.com/photo.jpg', 2, '224', 5, '2025/5/24 04:58', '2025/3/20 05:21', 353, 9, '大家一起來運動，無論新手或高手，都歡迎參加！', 28, '2025/5/24 04:58', '2025/10/3 02:20');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('排球活動64', 'https://example.com/photo.jpg', 2, '243', 12, '2025/3/27 07:04', '2025/3/7 03:47', 392, 14, '大家一起來運動，無論新手或高手，都歡迎參加！', 44, '2025/3/27 07:04', '2025/6/8 12:44');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動64', 'https://example.com/photo.jpg', 3, '218', 16, '2025/11/25 11:53', '2025/6/13 00:24', 153, 28, '大家一起來運動，無論新手或高手，都歡迎參加！', 8, '2025/11/25 11:53', '2025/12/7 22:48');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動48', 'https://example.com/photo.jpg', 1, '222', 9, '2025/11/28 12:23', '2025/9/12 08:50', 447, 8, '大家一起來運動，無論新手或高手，都歡迎參加！', 10, '2025/11/28 12:23', '2025/12/1 16:27');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動83', 'https://example.com/photo.jpg', 1, '229', 10, '2025/2/28 16:16', '2025/1/14 08:35', 394, 30, '大家一起來運動，無論新手或高手，都歡迎參加！', 3, '2025/2/28 16:16', '2025/5/12 09:33');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動83', 'https://example.com/photo.jpg', 1, '216', 2, '2025/11/7 19:21', '2025/6/28 21:51', 303, 10, '大家一起來運動，無論新手或高手，都歡迎參加！', 30, '2025/11/7 19:21', '2025/12/29 10:56');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('籃球活動30', 'https://example.com/photo.jpg', 1, '229', 10, '2025/8/31 10:33', '2025/7/5 21:04', 232, 22, '大家一起來運動，無論新手或高手，都歡迎參加！', 19, '2025/8/31 10:33', '2025/11/3 08:14');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動2', 'https://example.com/photo.jpg', 3, '216', 2, '2025/2/1 14:10', '2025/1/27 18:46', 463, 25, '大家一起來運動，無論新手或高手，都歡迎參加！', 19, '2025/2/1 14:10', '2025/9/30 21:54');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動1', 'https://example.com/photo.jpg', 3, '229', 23, '2025/7/31 14:36', '2025/2/27 17:16', 187, 25, '大家一起來運動，無論新手或高手，都歡迎參加！', 5, '2025/7/31 14:36', '2025/10/20 02:34');
    

    INSERT INTO activity_list (activity_name, photo_url, sport_type_id, area_id, court_id, activity_time, deadline, payment, need_num, introduction, founder_id, create_time, update_time) 
    VALUES ('羽球活動18', 'https://example.com/photo.jpg', 3, '251', 24, '2025/1/7 13:17', '2025/1/7 04:41', 168, 7, '大家一起來運動，無論新手或高手，都歡迎參加！', 34, '2025/1/7 13:17', '2025/10/3 09:29');
    
    select * from activity_list;

-- Content from /mnt/data/08_simulated_registered.sql
-- 建立 活動報名情形 共 200 筆
-- 會員、活動列表 建立關聯

CREATE TABLE registered (
id int primary key auto_increment,
member_id int not null, #報名者foreign key
activity_id int not null, #所報名的活動foreign key
num DECIMAL(10,0)  not null, #本次報名人數
notes varchar(200), #備註欄 (可不寫)
registered_time datetime DEFAULT CURRENT_TIMESTAMP, #紀錄報名當下的時間
foreign key(member_id) references members(id),
foreign key(activity_id) references activity_list(id)
);

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (40, 16, 6, '1男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (2, 42, 4, '3男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (19, 53, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (40, 6, 6, '2男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (17, 19, 4, '0男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (39, 11, 4, '4男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (40, 18, 3, '3男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (43, 38, 5, '0男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (43, 14, 2, '1男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (48, 24, 2, '2男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (42, 15, 2, '2男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (36, 45, 7, '3男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (21, 6, 3, '0男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (10, 19, 2, '1男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (43, 14, 3, '3男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (25, 15, 1, '0男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (35, 59, 6, '1男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (27, 17, 4, '1男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (31, 12, 5, '4男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (18, 35, 3, '0男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (39, 13, 4, '1男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (44, 24, 4, '1男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (17, 49, 7, '0男7女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (37, 9, 3, '3男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (14, 18, 8, '8男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (18, 52, 7, '6男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (33, 46, 5, '2男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (13, 37, 5, '1男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (7, 59, 3, '2男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (8, 18, 2, '2男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (20, 5, 6, '6男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (4, 57, 4, '3男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (32, 56, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (24, 54, 2, '0男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (35, 46, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (43, 40, 6, '0男6女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (30, 13, 2, '2男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (31, 12, 5, '2男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (27, 28, 7, '0男7女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (3, 55, 3, '2男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (9, 49, 5, '2男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (50, 30, 8, '4男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (48, 38, 4, '1男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (35, 14, 6, '1男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (2, 58, 4, '0男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (33, 22, 5, '3男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (42, 4, 4, '3男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (40, 38, 8, '1男7女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (14, 52, 5, '0男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (39, 48, 4, '0男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (47, 20, 2, '2男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (41, 2, 3, '0男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (10, 2, 2, '2男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (15, 34, 2, '0男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (35, 9, 4, '0男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (6, 60, 2, '0男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (18, 19, 5, '2男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (13, 3, 2, '2男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (50, 4, 8, '2男6女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (28, 12, 3, '3男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (4, 55, 1, '0男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (23, 13, 7, '5男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (44, 20, 4, '4男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (23, 10, 4, '4男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (1, 52, 2, '1男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (22, 52, 7, '1男6女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (15, 6, 2, '2男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (48, 16, 3, '2男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (28, 43, 8, '0男8女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (50, 23, 5, '5男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (27, 26, 2, '2男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (5, 16, 6, '5男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (39, 31, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (47, 25, 8, '3男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (48, 33, 5, '3男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (15, 52, 5, '5男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (8, 8, 8, '5男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (20, 38, 7, '3男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (32, 6, 8, '5男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (28, 28, 2, '0男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (19, 16, 8, '6男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (33, 39, 5, '3男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (3, 34, 2, '1男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (38, 6, 8, '4男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (16, 50, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (24, 7, 3, '1男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (35, 36, 5, '5男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (4, 29, 2, '0男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (49, 58, 7, '2男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (22, 56, 8, '0男8女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (46, 47, 7, '5男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (40, 30, 7, '4男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (28, 51, 5, '2男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (28, 51, 3, '2男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (31, 2, 1, '0男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (30, 6, 4, '1男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (3, 25, 5, '0男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (23, 13, 7, '6男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (25, 23, 8, '8男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (30, 39, 2, '0男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (39, 58, 6, '1男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (39, 3, 3, '1男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (5, 6, 5, '0男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (12, 52, 7, '4男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (10, 48, 3, '0男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (10, 43, 4, '3男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (18, 24, 3, '1男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (11, 13, 5, '4男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (23, 47, 7, '4男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (33, 47, 2, '1男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (34, 20, 5, '4男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (15, 16, 8, '4男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (31, 56, 8, '6男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (26, 27, 2, '1男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (32, 48, 5, '4男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (17, 14, 5, '3男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (18, 55, 4, '0男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (13, 56, 3, '1男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (38, 24, 6, '4男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (11, 26, 5, '1男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (14, 60, 5, '2男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (31, 13, 2, '2男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (43, 47, 8, '6男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (49, 51, 4, '2男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (36, 49, 4, '3男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (15, 38, 6, '2男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (25, 55, 5, '3男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (20, 22, 8, '8男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (38, 7, 2, '1男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (26, 20, 8, '6男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (15, 4, 6, '6男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (15, 45, 3, '1男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (34, 27, 3, '1男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (49, 17, 4, '1男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (44, 52, 7, '3男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (9, 60, 8, '8男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (5, 43, 1, '0男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (48, 39, 5, '3男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (4, 60, 8, '0男8女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (12, 14, 6, '2男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (10, 43, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (41, 19, 3, '1男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (50, 6, 4, '1男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (4, 12, 7, '5男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (5, 49, 7, '4男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (12, 2, 6, '2男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (36, 14, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (21, 42, 2, '1男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (30, 46, 1, '0男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (28, 52, 6, '2男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (4, 44, 5, '2男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (12, 2, 8, '1男7女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (35, 21, 2, '0男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (15, 58, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (3, 9, 8, '1男7女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (34, 4, 4, '0男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (1, 47, 3, '1男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (11, 57, 4, '2男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (16, 12, 1, '0男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (29, 27, 7, '3男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (30, 34, 7, '0男7女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (1, 52, 8, '1男7女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (24, 17, 6, '2男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (7, 38, 7, '3男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (12, 1, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (12, 52, 6, '0男6女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (12, 40, 5, '5男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (42, 28, 8, '1男7女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (9, 41, 7, '3男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (7, 35, 8, '4男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (24, 38, 7, '2男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (17, 3, 4, '2男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (34, 21, 6, '2男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (1, 24, 6, '1男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (47, 11, 7, '1男6女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (36, 3, 4, '2男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (15, 7, 7, '5男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (50, 44, 8, '3男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (34, 22, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (41, 20, 4, '1男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (13, 20, 7, '6男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (14, 30, 8, '4男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (33, 39, 5, '0男5女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (46, 31, 5, '3男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (1, 6, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (25, 47, 8, '7男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (33, 35, 6, '2男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (15, 44, 5, '5男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (40, 26, 3, '2男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (20, 57, 4, '0男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (4, 4, 4, '2男2女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (36, 41, 5, '2男3女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (26, 57, 6, '6男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (21, 4, 4, '0男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (50, 59, 1, '1男0女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (27, 2, 7, '3男4女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (44, 5, 7, '1男6女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (21, 5, 1, '0男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (25, 51, 8, '7男1女');
    

    INSERT INTO registered (member_id, activity_id, num, notes) 
    VALUES (31, 60, 2, '0男2女');
    
    select * from registered;

