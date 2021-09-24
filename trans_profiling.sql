/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100137
Source Host           : localhost:3306
Source Database       : trans_profiling

Target Server Type    : MYSQL
Target Server Version : 100137
File Encoding         : 65001

Date: 2020-01-21 12:58:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for filter_cache
-- ----------------------------
DROP TABLE IF EXISTS `filter_cache`;
CREATE TABLE `filter_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of filter_cache
-- ----------------------------
INSERT INTO `filter_cache` VALUES ('1', '2018-01-01', '2018-12-31');

-- ----------------------------
-- Table structure for sample_golongan
-- ----------------------------
DROP TABLE IF EXISTS `sample_golongan`;
CREATE TABLE `sample_golongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `golongan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sample_golongan
-- ----------------------------
INSERT INTO `sample_golongan` VALUES ('1', 'I-A');
INSERT INTO `sample_golongan` VALUES ('2', 'I-B');
INSERT INTO `sample_golongan` VALUES ('3', 'I-C');
INSERT INTO `sample_golongan` VALUES ('4', 'I-D');
INSERT INTO `sample_golongan` VALUES ('5', 'I-E');
INSERT INTO `sample_golongan` VALUES ('6', 'I-F');
INSERT INTO `sample_golongan` VALUES ('7', 'II-A');
INSERT INTO `sample_golongan` VALUES ('8', 'II-B');
INSERT INTO `sample_golongan` VALUES ('9', 'II-C');
INSERT INTO `sample_golongan` VALUES ('10', 'II-D');
INSERT INTO `sample_golongan` VALUES ('11', 'II-E');
INSERT INTO `sample_golongan` VALUES ('12', 'II-F');
INSERT INTO `sample_golongan` VALUES ('13', 'III-A');
INSERT INTO `sample_golongan` VALUES ('14', 'III-B');
INSERT INTO `sample_golongan` VALUES ('15', 'III-C');
INSERT INTO `sample_golongan` VALUES ('16', 'III-D');
INSERT INTO `sample_golongan` VALUES ('17', 'III-E');
INSERT INTO `sample_golongan` VALUES ('18', 'III-F');

-- ----------------------------
-- Table structure for sample_grup
-- ----------------------------
DROP TABLE IF EXISTS `sample_grup`;
CREATE TABLE `sample_grup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grup` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sample_grup
-- ----------------------------
INSERT INTO `sample_grup` VALUES ('1', 'SparePart');
INSERT INTO `sample_grup` VALUES ('2', 'Assets');
INSERT INTO `sample_grup` VALUES ('3', 'ATK (Alat Tulis Kantor)');

-- ----------------------------
-- Table structure for sample_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `sample_jabatan`;
CREATE TABLE `sample_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sample_jabatan
-- ----------------------------
INSERT INTO `sample_jabatan` VALUES ('1', 'Staff');
INSERT INTO `sample_jabatan` VALUES ('2', 'Officer');
INSERT INTO `sample_jabatan` VALUES ('3', 'Supervisor');
INSERT INTO `sample_jabatan` VALUES ('4', 'Head');
INSERT INTO `sample_jabatan` VALUES ('5', 'Manager');

-- ----------------------------
-- Table structure for sample_karyawan
-- ----------------------------
DROP TABLE IF EXISTS `sample_karyawan`;
CREATE TABLE `sample_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `id_golongan` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sample_karyawan
-- ----------------------------
INSERT INTO `sample_karyawan` VALUES ('1', 'Dhiya', '15', '5');
INSERT INTO `sample_karyawan` VALUES ('2', 'Yayat', '13', '4');
INSERT INTO `sample_karyawan` VALUES ('3', 'Johanes', '12', '3');
INSERT INTO `sample_karyawan` VALUES ('4', 'Daud', '8', '2');
INSERT INTO `sample_karyawan` VALUES ('5', 'Togar', '8', '2');
INSERT INTO `sample_karyawan` VALUES ('6', 'Eko', '4', '1');
INSERT INTO `sample_karyawan` VALUES ('7', 'Yayunk', '4', '1');
INSERT INTO `sample_karyawan` VALUES ('8', 'Najihul', '4', '1');

-- ----------------------------
-- Table structure for sample_subgrup
-- ----------------------------
DROP TABLE IF EXISTS `sample_subgrup`;
CREATE TABLE `sample_subgrup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_grup` int(11) DEFAULT NULL,
  `subgrup` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sample_subgrup
-- ----------------------------
INSERT INTO `sample_subgrup` VALUES ('1', '1', 'Mobil');
INSERT INTO `sample_subgrup` VALUES ('2', '1', 'Motor');
INSERT INTO `sample_subgrup` VALUES ('3', '1', 'Truck');
INSERT INTO `sample_subgrup` VALUES ('4', '2', 'CPU');
INSERT INTO `sample_subgrup` VALUES ('5', '2', 'Monitor');
INSERT INTO `sample_subgrup` VALUES ('6', '3', 'Kertas');
INSERT INTO `sample_subgrup` VALUES ('7', '3', 'Pulpen');

-- ----------------------------
-- Table structure for sample_type
-- ----------------------------
DROP TABLE IF EXISTS `sample_type`;
CREATE TABLE `sample_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_subgrup` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sample_type
-- ----------------------------
INSERT INTO `sample_type` VALUES ('1', '1', 'Honda');
INSERT INTO `sample_type` VALUES ('2', '1', 'Hyndai');
INSERT INTO `sample_type` VALUES ('3', '1', 'Mitsubishi');
INSERT INTO `sample_type` VALUES ('4', '2', 'Yamaha');
INSERT INTO `sample_type` VALUES ('5', '2', 'Honda');
INSERT INTO `sample_type` VALUES ('6', '2', 'Suzuki');
INSERT INTO `sample_type` VALUES ('7', '3', 'Dyna');
INSERT INTO `sample_type` VALUES ('8', '3', 'Fuso');
INSERT INTO `sample_type` VALUES ('9', '4', 'Lenovo');
INSERT INTO `sample_type` VALUES ('10', '4', 'Acer');
INSERT INTO `sample_type` VALUES ('11', '4', 'Dell');
INSERT INTO `sample_type` VALUES ('12', '5', 'Lenovo');
INSERT INTO `sample_type` VALUES ('13', '5', 'Flatron');
INSERT INTO `sample_type` VALUES ('14', '5', 'Acer');
INSERT INTO `sample_type` VALUES ('15', '5', 'Dell');
INSERT INTO `sample_type` VALUES ('16', '6', 'Kertas A3');
INSERT INTO `sample_type` VALUES ('17', '6', 'Kertas A4');
INSERT INTO `sample_type` VALUES ('18', '7', 'Pulpen Cair');
INSERT INTO `sample_type` VALUES ('19', '7', 'Pulpen Biasa');

-- ----------------------------
-- Table structure for status_call
-- ----------------------------
DROP TABLE IF EXISTS `status_call`;
CREATE TABLE `status_call` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_reason` int(11) DEFAULT NULL,
  `nama_reason` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status_call
-- ----------------------------
INSERT INTO `status_call` VALUES ('1', '1', 'Bertemu Pelanggan', '1');
INSERT INTO `status_call` VALUES ('2', '2', 'RNA', '0');
INSERT INTO `status_call` VALUES ('3', '3', 'Tidak Bertemu Pemilik', '1');
INSERT INTO `status_call` VALUES ('4', '4', 'Salah Sambung', '0');
INSERT INTO `status_call` VALUES ('5', '5', 'Inbound 147', '0');
INSERT INTO `status_call` VALUES ('6', '6', 'Outbound TAM', '0');
INSERT INTO `status_call` VALUES ('7', '7', 'Isolir', '0');
INSERT INTO `status_call` VALUES ('8', '8', 'Mailbox', '0');
INSERT INTO `status_call` VALUES ('9', '9', 'Telepon Sibuk', '0');
INSERT INTO `status_call` VALUES ('10', '10', 'Rejected', '0');
INSERT INTO `status_call` VALUES ('11', '11', 'Decline', '0');
INSERT INTO `status_call` VALUES ('12', '12', 'Follow Up', '1');
INSERT INTO `status_call` VALUES ('13', '13', 'Verified', '1');
INSERT INTO `status_call` VALUES ('14', '14', 'Reject By System', '0');
INSERT INTO `status_call` VALUES ('15', '15', 'Cabut', '0');

-- ----------------------------
-- Table structure for sys_authorized
-- ----------------------------
DROP TABLE IF EXISTS `sys_authorized`;
CREATE TABLE `sys_authorized` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) DEFAULT NULL,
  `id_form` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`id`) USING BTREE,
  KEY `ilevel` (`id_level`,`id_form`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_authorized
-- ----------------------------
INSERT INTO `sys_authorized` VALUES ('30', '1', '1');
INSERT INTO `sys_authorized` VALUES ('1', '1', '2');
INSERT INTO `sys_authorized` VALUES ('2', '1', '3');
INSERT INTO `sys_authorized` VALUES ('3', '1', '4');
INSERT INTO `sys_authorized` VALUES ('4', '1', '5');
INSERT INTO `sys_authorized` VALUES ('5', '1', '6');
INSERT INTO `sys_authorized` VALUES ('6', '1', '7');
INSERT INTO `sys_authorized` VALUES ('7', '1', '8');
INSERT INTO `sys_authorized` VALUES ('8', '1', '9');
INSERT INTO `sys_authorized` VALUES ('9', '1', '10');
INSERT INTO `sys_authorized` VALUES ('10', '1', '11');
INSERT INTO `sys_authorized` VALUES ('11', '1', '12');
INSERT INTO `sys_authorized` VALUES ('12', '1', '13');
INSERT INTO `sys_authorized` VALUES ('13', '1', '14');
INSERT INTO `sys_authorized` VALUES ('14', '1', '15');
INSERT INTO `sys_authorized` VALUES ('15', '1', '16');
INSERT INTO `sys_authorized` VALUES ('16', '1', '17');
INSERT INTO `sys_authorized` VALUES ('17', '1', '18');
INSERT INTO `sys_authorized` VALUES ('18', '1', '19');
INSERT INTO `sys_authorized` VALUES ('19', '1', '20');
INSERT INTO `sys_authorized` VALUES ('20', '1', '21');
INSERT INTO `sys_authorized` VALUES ('21', '1', '22');
INSERT INTO `sys_authorized` VALUES ('22', '1', '23');
INSERT INTO `sys_authorized` VALUES ('23', '1', '24');
INSERT INTO `sys_authorized` VALUES ('24', '1', '25');
INSERT INTO `sys_authorized` VALUES ('25', '1', '26');
INSERT INTO `sys_authorized` VALUES ('27', '1', '28');
INSERT INTO `sys_authorized` VALUES ('28', '1', '29');
INSERT INTO `sys_authorized` VALUES ('29', '1', '30');
INSERT INTO `sys_authorized` VALUES ('31', '1', '31');
INSERT INTO `sys_authorized` VALUES ('32', '1', '32');
INSERT INTO `sys_authorized` VALUES ('33', '1', '33');
INSERT INTO `sys_authorized` VALUES ('34', '1', '34');
INSERT INTO `sys_authorized` VALUES ('35', '1', '35');
INSERT INTO `sys_authorized` VALUES ('36', '1', '36');
INSERT INTO `sys_authorized` VALUES ('37', '1', '37');
INSERT INTO `sys_authorized` VALUES ('38', '1', '38');
INSERT INTO `sys_authorized` VALUES ('39', '1', '39');
INSERT INTO `sys_authorized` VALUES ('40', '1', '40');
INSERT INTO `sys_authorized` VALUES ('41', '1', '41');
INSERT INTO `sys_authorized` VALUES ('42', '1', '42');
INSERT INTO `sys_authorized` VALUES ('43', '1', '43');
INSERT INTO `sys_authorized` VALUES ('44', '1', '44');
INSERT INTO `sys_authorized` VALUES ('45', '1', '45');
INSERT INTO `sys_authorized` VALUES ('46', '1', '46');
INSERT INTO `sys_authorized` VALUES ('47', '1', '47');
INSERT INTO `sys_authorized` VALUES ('48', '1', '48');
INSERT INTO `sys_authorized` VALUES ('49', '1', '49');
INSERT INTO `sys_authorized` VALUES ('50', '1', '50');
INSERT INTO `sys_authorized` VALUES ('51', '1', '51');
INSERT INTO `sys_authorized` VALUES ('52', '1', '52');
INSERT INTO `sys_authorized` VALUES ('53', '1', '53');
INSERT INTO `sys_authorized` VALUES ('54', '1', '54');
INSERT INTO `sys_authorized` VALUES ('55', '1', '55');
INSERT INTO `sys_authorized` VALUES ('56', '1', '56');
INSERT INTO `sys_authorized` VALUES ('57', '1', '57');
INSERT INTO `sys_authorized` VALUES ('58', '1', '58');
INSERT INTO `sys_authorized` VALUES ('59', '1', '59');
INSERT INTO `sys_authorized` VALUES ('60', '1', '60');
INSERT INTO `sys_authorized` VALUES ('61', '1', '61');
INSERT INTO `sys_authorized` VALUES ('62', '1', '62');
INSERT INTO `sys_authorized` VALUES ('63', '1', '63');
INSERT INTO `sys_authorized` VALUES ('64', '1', '64');
INSERT INTO `sys_authorized` VALUES ('65', '1', '65');
INSERT INTO `sys_authorized` VALUES ('66', '1', '66');
INSERT INTO `sys_authorized` VALUES ('67', '1', '67');
INSERT INTO `sys_authorized` VALUES ('68', '1', '68');
INSERT INTO `sys_authorized` VALUES ('69', '1', '69');
INSERT INTO `sys_authorized` VALUES ('70', '1', '70');
INSERT INTO `sys_authorized` VALUES ('71', '1', '71');
INSERT INTO `sys_authorized` VALUES ('72', '1', '72');
INSERT INTO `sys_authorized` VALUES ('73', '1', '73');
INSERT INTO `sys_authorized` VALUES ('74', '1', '74');
INSERT INTO `sys_authorized` VALUES ('75', '1', '75');
INSERT INTO `sys_authorized` VALUES ('92', '1', '76');
INSERT INTO `sys_authorized` VALUES ('93', '1', '76');
INSERT INTO `sys_authorized` VALUES ('101', '1', '76');
INSERT INTO `sys_authorized` VALUES ('94', '1', '77');
INSERT INTO `sys_authorized` VALUES ('102', '1', '77');
INSERT INTO `sys_authorized` VALUES ('95', '1', '78');
INSERT INTO `sys_authorized` VALUES ('103', '1', '78');
INSERT INTO `sys_authorized` VALUES ('96', '1', '79');
INSERT INTO `sys_authorized` VALUES ('97', '6', '76');
INSERT INTO `sys_authorized` VALUES ('98', '6', '77');
INSERT INTO `sys_authorized` VALUES ('99', '6', '78');
INSERT INTO `sys_authorized` VALUES ('100', '6', '79');
INSERT INTO `sys_authorized` VALUES ('104', '7', '76');
INSERT INTO `sys_authorized` VALUES ('105', '7', '77');
INSERT INTO `sys_authorized` VALUES ('106', '7', '78');
INSERT INTO `sys_authorized` VALUES ('107', '8', '78');

-- ----------------------------
-- Table structure for sys_authorized_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_authorized_menu`;
CREATE TABLE `sys_authorized_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_authorized_menu
-- ----------------------------
INSERT INTO `sys_authorized_menu` VALUES ('1', '1', '1');
INSERT INTO `sys_authorized_menu` VALUES ('2', '1', '2');
INSERT INTO `sys_authorized_menu` VALUES ('3', '1', '3');
INSERT INTO `sys_authorized_menu` VALUES ('4', '1', '4');
INSERT INTO `sys_authorized_menu` VALUES ('5', '1', '5');
INSERT INTO `sys_authorized_menu` VALUES ('6', '1', '6');
INSERT INTO `sys_authorized_menu` VALUES ('7', '1', '7');
INSERT INTO `sys_authorized_menu` VALUES ('8', '1', '8');
INSERT INTO `sys_authorized_menu` VALUES ('9', '1', '9');
INSERT INTO `sys_authorized_menu` VALUES ('10', '1', '10');
INSERT INTO `sys_authorized_menu` VALUES ('11', '1', '11');
INSERT INTO `sys_authorized_menu` VALUES ('12', '1', '12');
INSERT INTO `sys_authorized_menu` VALUES ('13', '7', '7');
INSERT INTO `sys_authorized_menu` VALUES ('14', '7', '8');
INSERT INTO `sys_authorized_menu` VALUES ('15', '7', '9');
INSERT INTO `sys_authorized_menu` VALUES ('16', '7', '10');
INSERT INTO `sys_authorized_menu` VALUES ('17', '7', '11');
INSERT INTO `sys_authorized_menu` VALUES ('18', '7', '12');
INSERT INTO `sys_authorized_menu` VALUES ('19', '8', '11');
INSERT INTO `sys_authorized_menu` VALUES ('20', '8', '12');

-- ----------------------------
-- Table structure for sys_complite
-- ----------------------------
DROP TABLE IF EXISTS `sys_complite`;
CREATE TABLE `sys_complite` (
  `id` int(1) NOT NULL,
  `complite` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_complite
-- ----------------------------
INSERT INTO `sys_complite` VALUES ('1', 'COMPLITE');
INSERT INTO `sys_complite` VALUES ('2', 'NOT COMPLITE');
INSERT INTO `sys_complite` VALUES ('3', 'FAILED');

-- ----------------------------
-- Table structure for sys_dashboard
-- ----------------------------
DROP TABLE IF EXISTS `sys_dashboard`;
CREATE TABLE `sys_dashboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_form` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_user` (`id_user`) USING BTREE,
  KEY `i_id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_dashboard
-- ----------------------------

-- ----------------------------
-- Table structure for sys_form
-- ----------------------------
DROP TABLE IF EXISTS `sys_form`;
CREATE TABLE `sys_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(10) DEFAULT NULL,
  `link` char(200) DEFAULT NULL,
  `form_name` char(200) DEFAULT NULL,
  `shortcut` int(2) DEFAULT NULL COMMENT '1=YA, 2=TIDAK\r\nAkses langsung halaman melalui exekusi kode',
  PRIMARY KEY (`id`),
  KEY `iid` (`id`) USING BTREE,
  KEY `icode` (`code`) USING BTREE,
  KEY `ilink` (`link`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_form
-- ----------------------------
INSERT INTO `sys_form` VALUES ('1', '000', '#', '--NO LINK--', '1');
INSERT INTO `sys_form` VALUES ('2', 'SP', 'sistem/Pengaturan', 'SISTEM : Daftar Menu Pengaturan Sistem', '1');
INSERT INTO `sys_form` VALUES ('3', 'SPMM', 'sistem/Pengaturan_tampilan/menu_management', 'SISTEM : Daftar Menu Management', '1');
INSERT INTO `sys_form` VALUES ('4', 'SPMM01', 'sistem/Pengaturan_tampilan/create_menu', 'SISTEM : Form Buat Menu Baru', '1');
INSERT INTO `sys_form` VALUES ('5', 'SPMM02', 'sistem/Pengaturan_tampilan/create_menu_action', 'SISTEM : Action Simpan  Menu Baru', '2');
INSERT INTO `sys_form` VALUES ('6', 'SPMM03', 'sistem/Pengaturan_tampilan/update_menu', 'SISTEM : Form Update Menu', '2');
INSERT INTO `sys_form` VALUES ('7', 'SPMM04', 'sistem/Pengaturan_tampilan/update_action', 'SISTEM : Action Simpan Update Menu', '2');
INSERT INTO `sys_form` VALUES ('8', 'SPMM05', 'sistem/Pengaturan_tampilan/delete_multiple', 'SISTEM : Action Hapus Menu', '2');
INSERT INTO `sys_form` VALUES ('9', 'SPR', 'sistem/Registrasi_form', 'SISTEM : Daftar Registrasi URL', '1');
INSERT INTO `sys_form` VALUES ('10', 'SPR01', 'sistem/Registrasi_form/create', 'SISTEM : Form Buat Registrasi URL Baru', '1');
INSERT INTO `sys_form` VALUES ('11', 'SPR02', 'sistem/Registrasi_form/create_action', 'SISTEM : Actionl Simpan Registrasi URL Baru', '2');
INSERT INTO `sys_form` VALUES ('12', 'SPR03', 'sistem/Registrasi_form/update', 'SISTEM : Form  Update Registrasi', '2');
INSERT INTO `sys_form` VALUES ('13', 'SPR04', 'sistem/Registrasi_form/update_action', 'SISTEM : Action Simpan Update Registrasi', '2');
INSERT INTO `sys_form` VALUES ('14', 'SPR05', 'sistem/Registrasi_form/delete_multiple', 'SISTEM : Action  Hapus Registrasi', '2');
INSERT INTO `sys_form` VALUES ('15', 'SPL', 'sistem/Pengaturan_level', 'SISTEM : Daftar Level', '1');
INSERT INTO `sys_form` VALUES ('16', 'SPL01', 'sistem/Pengaturan_level/create', 'SISTEM : Form  Buat Level Konfigurasi Baru', '1');
INSERT INTO `sys_form` VALUES ('17', 'SPL02', 'sistem/Pengaturan_level/create_action', 'SISTEM : Action Simpan  Level Konfigurasi Baru', '2');
INSERT INTO `sys_form` VALUES ('18', 'SPL03', 'sistem/Pengaturan_level/update', 'SISTEM : Form Update Level', '2');
INSERT INTO `sys_form` VALUES ('19', 'SPL04', 'sistem/Pengaturan_level/update_action', 'SISTEM : Action Simpan Update Level', '2');
INSERT INTO `sys_form` VALUES ('20', 'SPL05', 'sistem/Pengaturan_level/delete_multiple', 'SISTEM : Action Hapus Level', '2');
INSERT INTO `sys_form` VALUES ('21', 'SPU', 'sistem/Pengaturan_pengguna', 'SISTEM : Daftar User', '1');
INSERT INTO `sys_form` VALUES ('22', 'SPU01', 'sistem/Pengaturan_pengguna/create', 'SISTEM : Form Buat User Baru', '1');
INSERT INTO `sys_form` VALUES ('23', 'SPU02', 'sistem/Pengaturan_pengguna/create_action', 'SISTEM : Action Simpan User Baru', '2');
INSERT INTO `sys_form` VALUES ('24', 'SPU03', 'sistem/Pengaturan_pengguna/update', 'SISTEM : Form Update User', '2');
INSERT INTO `sys_form` VALUES ('25', 'SPU04', 'sistem/Pengaturan_pengguna/update_action', 'SISTEM : Action Simpan Update User', '2');
INSERT INTO `sys_form` VALUES ('26', 'SPU05', 'sistem/Pengaturan_pengguna/delete_multiple', 'SISTEM : Action  Hapus User', '2');
INSERT INTO `sys_form` VALUES ('28', 'DSI', 'sistem/Dokumentasi/sample_icon', 'SISTEM DOKUMENTASI : Daftar Sample Icon', '1');
INSERT INTO `sys_form` VALUES ('29', 'DPK', 'sistem/Dokumentasi/petunjuk_penggunaan', 'SISTEM DOKUMENTASI : Petunjuk Penggunaan', '1');
INSERT INTO `sys_form` VALUES ('30', 'DSE', 'sistem/Dokumentasi/sample_element', 'SISTEM DOKUMENTASI : Sample Element', '1');
INSERT INTO `sys_form` VALUES ('31', 'CRUD', 'sistem/Crud_generator', 'SISTEM : CRUD GENERATOR', '1');
INSERT INTO `sys_form` VALUES ('32', 'DSED', 'sistem/Dokumentasi/sample_element_dropzone', 'SISTEM DOKUMENTASI : Sample Element Dropzone', '1');
INSERT INTO `sys_form` VALUES ('33', 'DSEP', 'sistem/Dokumentasi/petunjuk_penggunaan_tahap_lanjut', 'SISTEM DOKUMENTASI : Petunjuk Penggunaan Tahap Lanjut', '1');
INSERT INTO `sys_form` VALUES ('34', 'SECER', 'sistem/Keamanan/error_report', 'SISTEM KEAMANAN: Error Report', '1');
INSERT INTO `sys_form` VALUES ('35', 'SECCSRF', 'sistem/Keamanan/csrf_protection', 'SISTEM KEAMANAN: CSRF Protection', '1');
INSERT INTO `sys_form` VALUES ('36', 'SECINJ', 'sistem/Keamanan/monitoring_injection', 'SISTEM KEAMANAN: Monitoring Injection', '1');
INSERT INTO `sys_form` VALUES ('37', 'SPU06', 'sistem/Pengaturan_pengguna/create_multiple', 'SISTEM : Form Buat User Baru From Excel', '1');
INSERT INTO `sys_form` VALUES ('38', 'SPU07', 'sistem/Pengaturan_pengguna/download_template_user', 'SISTEM : Download Template User', '2');
INSERT INTO `sys_form` VALUES ('39', 'STS', 'sistem/Template_system/style', 'SISTEM : Pengaturan Logo Template', '1');
INSERT INTO `sys_form` VALUES ('40', 'STS01', 'sistem/Template_system/update_login_setting', 'SISTEM : Pengaturan Logo Template  - Update Logo Login', '2');
INSERT INTO `sys_form` VALUES ('41', 'STS02', 'sistem/Template_system/update_template_setting', 'SISTEM : Pengaturan Logo Template  - Update Logo Template', '2');
INSERT INTO `sys_form` VALUES ('42', 'DK01', 'sistem/Dokumentasi_109', 'SISTEM : Dokumentasi 1.0.9', '1');
INSERT INTO `sys_form` VALUES ('43', 'DK02', 'sistem/Dokumentasi_109/general', 'SISTEM : Dokumentasi 1.0.9 - Introduce', '1');
INSERT INTO `sys_form` VALUES ('44', 'DK03', 'sistem/Dokumentasi_109/system_requirtment', 'SISTEM : Dokumentasi 1.0.9 - System Reqruitment', '1');
INSERT INTO `sys_form` VALUES ('45', 'DK04', 'sistem/Dokumentasi_109/pengaturan_menu', 'SISTEM : Dokumentasi 1.0.9 - Pengaturan Menu', '1');
INSERT INTO `sys_form` VALUES ('46', 'DK05', 'sistem/Dokumentasi_109/pengaturan_template', 'SISTEM : Dokumentasi 1.0.9 - Pengaturan Template', '1');
INSERT INTO `sys_form` VALUES ('47', 'DK06', 'sistem/Dokumentasi_109/registrasi_form', 'SISTEM : Dokumentasi 1.0.9 - Registrasi Form', '1');
INSERT INTO `sys_form` VALUES ('48', 'DK07', 'sistem/Dokumentasi_109/level_konfigurasi', 'SISTEM : Dokumentasi 1.0.9 - Level Konfigurasi', '1');
INSERT INTO `sys_form` VALUES ('49', 'DK08', 'sistem/Dokumentasi_109/user_konfigurasi', 'SISTEM : Dokumentasi 1.0.9 - User Konfigurasi', '1');
INSERT INTO `sys_form` VALUES ('50', 'DK09', 'sistem/Dokumentasi_109/crud_generator', 'SISTEM : Dokumentasi 1.0.9 - CRUD Generator', '1');
INSERT INTO `sys_form` VALUES ('51', 'DK10', 'sistem/Dokumentasi_109/error_report', 'SISTEM : Dokumentasi 1.0.9 - Error Report', '1');
INSERT INTO `sys_form` VALUES ('52', 'DK11', 'sistem/Dokumentasi_109/csrf_protection', 'SISTEM : Dokumentasi 1.0.9 - CSRF Protection', '1');
INSERT INTO `sys_form` VALUES ('53', 'DK12', 'sistem/Dokumentasi_109/front_end', 'SISTEM : Dokumentasi 1.0.9 - Front End', '1');
INSERT INTO `sys_form` VALUES ('54', 'DK13', 'sistem/Dokumentasi_109/page_maintenance', 'SISTEM : Dokumentasi 1.0.9 - Page Maintenance', '1');
INSERT INTO `sys_form` VALUES ('55', 'DK14', 'sistem/Dokumentasi_109/panduan_form', 'SISTEM : Dokumentasi 1.0.9 - Panduan Form', '1');
INSERT INTO `sys_form` VALUES ('56', 'DK15', 'sistem/Dokumentasi_109/panduan_form_lanjutan', 'SISTEM : Dokumentasi 1.0.9 - Panduan Form Lanjutan', '1');
INSERT INTO `sys_form` VALUES ('58', 'REGIP', 'sistem/Register_ip', 'SISTEM : Register IP', '1');
INSERT INTO `sys_form` VALUES ('59', 'REGIP01', 'sistem/Register_ip/create', 'SISTEM : Register IP - Form Buat Baru', '1');
INSERT INTO `sys_form` VALUES ('60', 'REGIP02', 'sistem/Register_ip/create_action', 'SISTEM : Register IP - Tombol Simpan Form Buat Baru', '2');
INSERT INTO `sys_form` VALUES ('61', 'REGIP03', 'sistem/Register_ip/update', 'SISTEM : Register IP - Form Update', '2');
INSERT INTO `sys_form` VALUES ('62', 'REGIP04', 'sistem/Register_ip/update_action', 'SISTEM : Register IP - Tombol Simpan Form Update', '2');
INSERT INTO `sys_form` VALUES ('63', 'REGIP05', 'sistem/Register_ip/delete_multiple', 'SISTEM : Register IP - Hapus Data', '2');
INSERT INTO `sys_form` VALUES ('64', 'MNTC01', 'sistem/Maintenance/maintenance_setting_list', 'SISTEM : MAINTENANCE - List Data', '1');
INSERT INTO `sys_form` VALUES ('65', 'MNTC02', 'sistem/Maintenance/create', 'SISTEM : MAINTENANCE - Form Buat Baru', '1');
INSERT INTO `sys_form` VALUES ('66', 'MNTC03', 'sistem/Maintenance/save_n_run', 'SISTEM : MAINTENANCE - Tombo Save n Run Form Buat Baru', '2');
INSERT INTO `sys_form` VALUES ('67', 'MNTC04', 'sistem/Maintenance/download_urlkey', 'SISTEM : MAINTENANCE -  Tombol Download Key', '2');
INSERT INTO `sys_form` VALUES ('68', 'MNTC05', 'sistem/Maintenance/delete_schedule', 'SISTEM : MAINTENANCE -  Delete Schedule', '2');
INSERT INTO `sys_form` VALUES ('69', 'MNTC06', 'sistem/Maintenance/stop_maintenance', 'SISTEM : MAINTENANCE -  Stop Maintenance', '2');
INSERT INTO `sys_form` VALUES ('70', 'SECFRN', 'sistem/Keamanan/access_front_end', 'SISTEM KEAMANAN: Access Front End', '1');
INSERT INTO `sys_form` VALUES ('71', 'SECLOG', 'sistem/User_Log', 'SISTEM KEAMANAN: Login Activity', '1');
INSERT INTO `sys_form` VALUES ('72', 'SECLOG01', 'sistem/User_Log/detail', 'SISTEM KEAMANAN: Login Activity - Detail', '2');
INSERT INTO `sys_form` VALUES ('73', 'SECLOG02', 'sistem/User_Log/delete_multiple', 'SISTEM KEAMANAN: Login Activity - Hapus Log', '2');
INSERT INTO `sys_form` VALUES ('74', 'DK16', 'sistem/Dokumentasi_109/panduan_upload_file', 'SISTEM : Dokumentasi 1.0.9 - Panduan Upload File', '1');
INSERT INTO `sys_form` VALUES ('75', 'CRUD01', 'sistem/Crud_generator/generator_form', 'SISTEM : CRUD GENERATOR - Tombol Generate Form', '2');
INSERT INTO `sys_form` VALUES ('76', 'Status_cal', 'Status_call/Status_call', 'Status_call', '1');
INSERT INTO `sys_form` VALUES ('77', 'Trans_prof', 'Trans_profiling/Trans_profiling', 'Trans_profiling', '1');
INSERT INTO `sys_form` VALUES ('78', 'Report_pro', 'Report_profiling/Report_profiling', 'Report_profiling', '1');

-- ----------------------------
-- Table structure for sys_level
-- ----------------------------
DROP TABLE IF EXISTS `sys_level`;
CREATE TABLE `sys_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nmlevel` char(50) DEFAULT NULL,
  `opt_status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`id`) USING BTREE,
  KEY `inmlevel` (`nmlevel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_level
-- ----------------------------
INSERT INTO `sys_level` VALUES ('1', 'Configurator', '1');
INSERT INTO `sys_level` VALUES ('6', 'Administrator', '1');
INSERT INTO `sys_level` VALUES ('7', 'SV', '1');
INSERT INTO `sys_level` VALUES ('8', 'AGENT', '1');

-- ----------------------------
-- Table structure for sys_maintenance_ip
-- ----------------------------
DROP TABLE IF EXISTS `sys_maintenance_ip`;
CREATE TABLE `sys_maintenance_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_maintenance_ip
-- ----------------------------

-- ----------------------------
-- Table structure for sys_maintenance_mode
-- ----------------------------
DROP TABLE IF EXISTS `sys_maintenance_mode`;
CREATE TABLE `sys_maintenance_mode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mode` int(1) DEFAULT NULL COMMENT '0 = Disable maintenance,\r\n1 = Enable Maintenance',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_maintenance_mode
-- ----------------------------
INSERT INTO `sys_maintenance_mode` VALUES ('1', '0');

-- ----------------------------
-- Table structure for sys_maintenance_schedule
-- ----------------------------
DROP TABLE IF EXISTS `sys_maintenance_schedule`;
CREATE TABLE `sys_maintenance_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` int(11) DEFAULT NULL,
  `desc` varchar(200) DEFAULT NULL,
  `actual_finish` int(11) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `minutes` int(11) DEFAULT NULL,
  `key` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_maintenance_schedule
-- ----------------------------

-- ----------------------------
-- Table structure for sys_menu
-- ----------------------------
DROP TABLE IF EXISTS `sys_menu`;
CREATE TABLE `sys_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_form` int(11) DEFAULT NULL,
  `name` char(50) NOT NULL,
  `icon` char(50) NOT NULL,
  `is_parent` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`id`) USING BTREE,
  KEY `iname` (`name`) USING BTREE,
  KEY `iparent` (`is_parent`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES ('1', '1', 'Pengaturan', 'fe fe-box', '0');
INSERT INTO `sys_menu` VALUES ('2', '1', 'Dokumentasi', 'fe fe-box', '0');
INSERT INTO `sys_menu` VALUES ('3', '28', 'Sample Icon', 'fe fe-twitter', '2');
INSERT INTO `sys_menu` VALUES ('4', '30', 'Sample Element', 'fa fa-tv', '2');
INSERT INTO `sys_menu` VALUES ('5', '43', 'Petunjuk Penggunaan', 'fa fa-hand-o-up', '2');
INSERT INTO `sys_menu` VALUES ('6', '2', 'Sistem', 'fe fe-activity', '1');
INSERT INTO `sys_menu` VALUES ('7', '1', 'Master', 'fe fe-box', '0');
INSERT INTO `sys_menu` VALUES ('8', '76', 'Status Call', 'fe fe-alert-triangle', '7');
INSERT INTO `sys_menu` VALUES ('9', '77', 'Profiling', 'fe fe-users', '0');
INSERT INTO `sys_menu` VALUES ('10', '77', 'Trans Profiling', 'fe fe-users', '9');
INSERT INTO `sys_menu` VALUES ('11', '78', 'Report', 'fe fe-activity', '0');
INSERT INTO `sys_menu` VALUES ('12', '78', 'Report Profiling', 'fe fe-activity', '11');

-- ----------------------------
-- Table structure for sys_show
-- ----------------------------
DROP TABLE IF EXISTS `sys_show`;
CREATE TABLE `sys_show` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `show` char(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ishow` (`show`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_show
-- ----------------------------
INSERT INTO `sys_show` VALUES ('2', 'TIDAK');
INSERT INTO `sys_show` VALUES ('1', 'YA');

-- ----------------------------
-- Table structure for sys_status
-- ----------------------------
DROP TABLE IF EXISTS `sys_status`;
CREATE TABLE `sys_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`id`) USING BTREE,
  KEY `istatus` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_status
-- ----------------------------
INSERT INTO `sys_status` VALUES ('1', 'AKTIF');
INSERT INTO `sys_status` VALUES ('2', 'NON AKTIF');

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nmuser` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `passuser` char(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `opt_level` int(11) DEFAULT NULL COMMENT '1=admin',
  `opt_status` int(5) DEFAULT NULL COMMENT '0=nonaktif,1=aktif, 2 = delete',
  `picture` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `nama` varchar(255) COLLATE latin1_general_cs DEFAULT NULL,
  `agentid` varchar(255) COLLATE latin1_general_cs DEFAULT NULL,
  `kategori` varchar(255) COLLATE latin1_general_cs DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iopt_level` (`opt_level`),
  KEY `iagentid` (`agentid`)
) ENGINE=InnoDB AUTO_INCREMENT=347 DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('1', 'administrator', '6841837e293c824a4d60b4b1217e1d28', '1', '1', 'default.png', 'Ahmad Sadikin', 'A001', 'REG');
INSERT INTO `sys_user` VALUES ('2', 'admin', '31e653dddbc6e1e1c12214a6c996e8bd', '6', '1', 'default.png', null, null, 'REG');
INSERT INTO `sys_user` VALUES ('65', 'sv', 'ba2bd7bd967cd67daa3069d05f77ad8e', '7', '1', 'default.png', 'Ahmad Sadikin', '-', 'REG');
INSERT INTO `sys_user` VALUES ('210', 'AF6540', '0cd02e311680ba280b55b3b3205d0929', '8', '1', 'default.png', 'AFIFATUL AZIZAH ', 'AF6540', null);
INSERT INTO `sys_user` VALUES ('211', 'LE9194', 'e3be8d1aca8cb231977dc6867076c373', '8', '1', 'default.png', 'LISNA PUJIARTI', 'LE9194', null);
INSERT INTO `sys_user` VALUES ('212', 'EG0992', '7c4bc6065155dcd3481d79f4be00e369', '8', '1', 'default.png', 'M. HAFIZ AL FAUZAN', 'EG0992', null);
INSERT INTO `sys_user` VALUES ('213', 'MI1495', 'd7ef69fd738a6a6b861a06cb361f5a30', '8', '1', 'default.png', 'M. INDRA DWI L', 'MI1495', null);
INSERT INTO `sys_user` VALUES ('214', 'DA1096', '4231d85be2f7993ac6f0cad356bab110', '8', '1', 'default.png', 'DIMAS PRADITYA AJI', 'DA1096', null);
INSERT INTO `sys_user` VALUES ('215', 'IN0812', 'f74851f06324f59b9ed62efa8ebb5980', '8', '1', 'default.png', 'MIA RAHMIYATI', 'IN0812', null);
INSERT INTO `sys_user` VALUES ('216', 'RM130994', 'aede56e8d09919b3f59508e9baf806fb', '8', '1', 'default.png', 'NIRA FITRIAH ', 'RM130994', null);
INSERT INTO `sys_user` VALUES ('217', 'RA2708', '8ffd26ac7f91aa3bcbac6c545db94551', '8', '1', 'default.png', 'ANNISA ', 'RA2708', null);
INSERT INTO `sys_user` VALUES ('218', 'VF0194', 'a31642e369928d0bb58d6fe66a983ac6', '8', '1', 'default.png', 'VINA FEBRIANI', 'VF0194', null);
INSERT INTO `sys_user` VALUES ('219', 'AR180293', '0702eb0cb74cfeca4c5ef2e7cc5c26ae', '8', '1', 'default.png', 'ASTI RAMDHIAN', 'AR180293', null);
INSERT INTO `sys_user` VALUES ('220', 'DE7748', 'ae4339000efc7d480a0379b282728df2', '8', '1', 'default.png', 'DENI YUDISTIRA', 'DE7748', null);
INSERT INTO `sys_user` VALUES ('221', 'DR2891', '3875c5f08abae50ececfd985d3ebbcb0', '8', '1', 'default.png', 'DERY SEPTIANA AL RASYID', 'DR2891', null);
INSERT INTO `sys_user` VALUES ('222', 'BDGCTS_026', 'a71007de71a0caa933e74cf854eefa20', '8', '1', 'default.png', 'NUGRAHA NASRULLOH', 'BDGCTS_026', null);
INSERT INTO `sys_user` VALUES ('223', 'BDG_004', 'ddf7bb4473f083ead5bcba29444a8dab', '8', '1', 'default.png', 'RACHMAD MULDANI', 'BDG_004', null);
INSERT INTO `sys_user` VALUES ('224', 'RR0790', '1cf0e4c2cb5007574f9c9bdf1aab74f8', '8', '1', 'default.png', 'RATIH RAHMAWATI', 'RR0790', null);
INSERT INTO `sys_user` VALUES ('225', 'AI0292', '6046ce5d4153fc942e1f38c57380f4db', '8', '1', 'default.png', 'ARIEF IMAN PRASETYO', 'AI0292', null);
INSERT INTO `sys_user` VALUES ('226', 'DH1297', '28c1da774eaeea2c80897210d1a68c67', '8', '1', 'default.png', 'DIDAH HALIYAH', 'DH1297', null);
INSERT INTO `sys_user` VALUES ('227', 'DP0395', 'e0598c8374368eb38ebb0c8b30802897', '8', '1', 'default.png', 'DIKY PERMANA', 'DP0395', null);
INSERT INTO `sys_user` VALUES ('228', 'ME2205', '59a83e986330c7edf6b922385055a327', '8', '1', 'default.png', 'DWINA ANISAH', 'ME2205', null);
INSERT INTO `sys_user` VALUES ('229', 'FS0796', 'bc6e7669ae59186e3f2bcf156ca918a3', '8', '1', 'default.png', 'FIRDA SRI RAHMAYANTI', 'FS0796', null);
INSERT INTO `sys_user` VALUES ('230', 'NI3506', 'd16151907afae71400f925106588bcb9', '8', '1', 'default.png', 'AGHNIA AUDINA N', 'NI3506', null);
INSERT INTO `sys_user` VALUES ('231', 'HA2312', '85c12eed04f6a9a7b7e65b5464c441aa', '8', '1', 'default.png', 'HANNA DELAVINA', 'HA2312', null);
INSERT INTO `sys_user` VALUES ('232', 'BDGCTS_048', '8c717e926b9b5f4d86f4e6318dd6f1c1', '8', '1', 'default.png', 'ISMAYANTI', 'BDGCTS_048', null);
INSERT INTO `sys_user` VALUES ('233', 'AF1204', 'c6b897e423a04a62443f78ebb07ff9a2', '8', '1', 'default.png', 'KARLINA', 'AF1204', null);
INSERT INTO `sys_user` VALUES ('234', 'KA1095', 'dd1e89e5e5eb2c7fd02ead9ae2e8a7ba', '8', '1', 'default.png', 'KARIN ARINDA PRAMUDHYTA', 'KA1095', null);
INSERT INTO `sys_user` VALUES ('235', 'SI0944', '67c1f29d86555d317e401e3bb9321114', '8', '1', 'default.png', 'RIA ANDRIYANI', 'SI0944', null);
INSERT INTO `sys_user` VALUES ('236', 'RA5494', 'bbb145c90a1a7f739606e8c8d2be95a7', '8', '1', 'default.png', 'RAHMAWATI ZAKIYAH', 'RA5494', null);
INSERT INTO `sys_user` VALUES ('237', 'SP2089', 'da4f62c31f793a1a7ff0057ffe176b39', '8', '1', 'default.png', 'ARIEF DHARMA SAPUTRA', 'SP2089', null);
INSERT INTO `sys_user` VALUES ('238', 'GG1090', '1244e4d8fc2e55d797bce43c918680d2', '8', '1', 'default.png', 'GILANG GINANJAR', 'GG1090', null);
INSERT INTO `sys_user` VALUES ('239', 'NI1303', '925b1d06cc6e89a502e205b413966c08', '8', '1', 'default.png', 'GITA BONITA', 'NI1303', null);
INSERT INTO `sys_user` VALUES ('240', 'HH0189', 'e8002c130640c446a675aecdad535599', '8', '1', 'default.png', 'HARY HAIDAR LATIEF', 'HH0189', null);
INSERT INTO `sys_user` VALUES ('241', 'PI1080', '9788be3444d3c8b225a5ccfa71313b01', '8', '1', 'default.png', 'PENDI', 'PI1080', null);
INSERT INTO `sys_user` VALUES ('242', 'BDGCTS_001', 'b5de02e602ced0c97e22d77518dce42a', '8', '1', 'default.png', 'RIZKI NUR FADHILAH', 'BDGCTS_001', null);
INSERT INTO `sys_user` VALUES ('243', 'DH4489', 'd8143d8d93859b81f72bd1db71a87795', '8', '1', 'default.png', 'ROHIMAH', 'DH4489', null);
INSERT INTO `sys_user` VALUES ('244', 'DI2202', 'b7cc25fb9a6a4dcc01edbfd186dd4f77', '8', '1', 'default.png', 'SHERA AMALIA', 'DI2202', null);
INSERT INTO `sys_user` VALUES ('245', 'SI0872', '1f0eb4f5c19e1e0ab49a56e04192ad72', '8', '1', 'default.png', 'SINTA DEWI SETIAWATI ', 'SI0872', null);
INSERT INTO `sys_user` VALUES ('246', 'RF0994', 'b3208b6334fe5ce161f6a911319e4820', '8', '1', 'default.png', 'RIESLA FAUZI RACHMAN', 'RF0994', null);
INSERT INTO `sys_user` VALUES ('247', 'CH1101', '206fe5a9d1e26db28e2ab8fe37a3cdc7', '8', '1', 'default.png', 'SRI LESTARI', 'CH1101', null);
INSERT INTO `sys_user` VALUES ('248', 'TI2508', 'd6e1d2094f409c28dddbcf0062c5c379', '8', '1', 'default.png', 'TISHA AGUSTINA RAHMAWATI', 'TI2508', null);
INSERT INTO `sys_user` VALUES ('249', 'BDGCTS_041', '7dcd38fc95066e4524c5965192de2393', '8', '1', 'default.png', 'ANNISA ZAHRA NASHIROTULHAQ', 'BDGCTS_041', null);
INSERT INTO `sys_user` VALUES ('250', 'IN0394', '7249355a7af0ec7a59c8631470ed7a06', '8', '1', 'default.png', 'IKBAR NUR MUHAMMAD', 'IN0394', null);
INSERT INTO `sys_user` VALUES ('251', 'SS0595', 'd692fc8d5ad6c96bf978e3fbdd1e2486', '8', '1', 'default.png', 'SANDI SARIKA', 'SS0595', null);
INSERT INTO `sys_user` VALUES ('252', 'GI1704', 'e73f284c27af7b2ad17c9f9da3a1b76e', '8', '1', 'default.png', 'GIA NADIA PUTRI', 'GI1704', null);
INSERT INTO `sys_user` VALUES ('253', 'GE0397', '890374d468764be4d6188ba13b541555', '8', '1', 'default.png', 'GINA EKI AGUSTIN', 'GE0397', null);
INSERT INTO `sys_user` VALUES ('254', 'SI8254', '4c33b373bec4b5db650539f61a8e88d7', '8', '1', 'default.png', 'SINTA ROSITA', 'SI8254', null);
INSERT INTO `sys_user` VALUES ('255', 'SR2610', '2a8c4ca7e001785f6c86878bf7940ddf', '8', '1', 'default.png', 'SRI MAWATI AYUNIGUNTARI', 'SR2610', null);
INSERT INTO `sys_user` VALUES ('256', 'NJ1981', 'cd7f14e180903e57cfd03dc93930c77e', '8', '1', 'default.png', 'NUR JAIS', 'NJ1981', null);
INSERT INTO `sys_user` VALUES ('257', 'BDGCTS_025', '0cc5504669c86126ebfb329d494f0755', '8', '1', 'default.png', 'HENI WAHYUNI', 'BDGCTS_025', null);
INSERT INTO `sys_user` VALUES ('258', 'NR1290', 'b3bb60d01a51498889a95e218b1b1c9c', '8', '1', 'default.png', 'NADYA RACHMAWATI', 'NR1290', null);
INSERT INTO `sys_user` VALUES ('259', 'IR1502', 'b1ff79f2ff5a1c07991d80601eb3a6db', '8', '1', 'default.png', 'PUTRI RATNASARI', 'IR1502', null);
INSERT INTO `sys_user` VALUES ('260', 'RE8569', 'c00477976ddbd1e2b7823caf77b34249', '8', '1', 'default.png', 'RESI NURLITA', 'RE8569', null);
INSERT INTO `sys_user` VALUES ('261', 'BDGCTS_046', 'bb8ad6522f49e776ff77b968561dd187', '8', '1', 'default.png', 'RIRI MARDIANA', 'BDGCTS_046', null);
INSERT INTO `sys_user` VALUES ('262', 'SA0592', 'a4ecabe3d08c8b45ba76f479be2c01d0', '8', '1', 'default.png', 'SABILA AINUN HAFSAH', 'SA0592', null);
INSERT INTO `sys_user` VALUES ('263', 'IK0206', 'f26fb0c98c68998bb8bd5397238f3c28', '8', '1', 'default.png', 'SUSILAWATI', 'IK0206', null);
INSERT INTO `sys_user` VALUES ('264', 'SN0895', 'b55163c3c77a6e0400805bd486022b2a', '8', '1', 'default.png', 'SANI NURAHAYU', 'SN0895', null);
INSERT INTO `sys_user` VALUES ('265', 'BDG_008', '976d52b131f9ec469b9bc96eac03bb1e', '8', '1', 'default.png', 'EPPY ROBIATUS S', 'BDG_008', null);
INSERT INTO `sys_user` VALUES ('266', 'BDGCTS_038', '9f75556f813695bb805f62baca4f6533', '8', '1', 'default.png', 'RIKARDO HAREFA', 'BDGCTS_038', null);
INSERT INTO `sys_user` VALUES ('267', 'RO0707', 'd76a1c73c30b5871562b870baa590bb5', '8', '1', 'default.png', 'ROSMILA', 'RO0707', null);
INSERT INTO `sys_user` VALUES ('268', 'AN6527', '83f7829093f1e30e6c317050ae59e3b2', '8', '1', 'default.png', 'VIAN ARAYANI', 'AN6527', null);
INSERT INTO `sys_user` VALUES ('269', 'MU3004', 'b146e5346f2d0910b46428d535b81230', '8', '1', 'default.png', 'VIVIT NOVITASARI', 'MU3004', null);
INSERT INTO `sys_user` VALUES ('270', 'WY0182', 'f4c3cde7e75e1c7df5f511886a4beaad', '8', '1', 'default.png', 'WAHYU', 'WY0182', null);
INSERT INTO `sys_user` VALUES ('271', 'YU0739', 'c332ad01949fbed5f0c9bdfa67552f76', '8', '1', 'default.png', 'YULIANA', 'YU0739', null);
INSERT INTO `sys_user` VALUES ('272', 'BDG_003', '8dad9715581ac3d657ca1e5a803ecd11', '8', '1', 'default.png', 'DIAN DARMAWAN S  MOSS', 'BDG_003', null);
INSERT INTO `sys_user` VALUES ('273', 'RR151291', '9340791560e668a4c16eb47b293726f0', '8', '1', 'default.png', 'SARAH SITI NUR SYAMSIAH  MOSS', 'RR151291', null);
INSERT INTO `sys_user` VALUES ('274', 'IF0710', '9e11b70693c15e7367166a7249fa2851', '8', '1', 'default.png', 'IMAN FIRMANSYAH MOSS', 'IF0710', null);
INSERT INTO `sys_user` VALUES ('275', 'NM0697', '9864e07fe8dd81bb1e225dae838789dc', '8', '1', 'default.png', 'NADYA MAHARANI P MOSS', 'NM0697', null);
INSERT INTO `sys_user` VALUES ('276', 'EM2807', '78f4836d9673ece7ab5240f05df17937', '8', '1', 'default.png', 'RIAN ANDRIANA MOSS', 'EM2807', null);
INSERT INTO `sys_user` VALUES ('277', 'ID1006', 'bdfb410ef4daa7bd10c1f569f47f1008', '8', '1', 'default.png', 'SELVA NURDIN M MOSS', 'ID1006', null);
INSERT INTO `sys_user` VALUES ('278', 'RA4186', 'f85dcabe61bb70e1c83dce078d90cacf', '8', '1', 'default.png', 'SUSILAWATI MOSS', 'RA4186', null);
INSERT INTO `sys_user` VALUES ('279', 'BDG_001', 'a22e59c770b377a350a5e97ee46d1f12', '8', '1', 'default.png', 'VIVIT NOVITASARI MOSS', 'BDG_001', null);
INSERT INTO `sys_user` VALUES ('280', 'BDG_007', 'ee8b3b32cfddf8f16a4dade184b6d1c8', '8', '1', 'default.png', 'GILANG GINANJAR MOSS', 'BDG_007', null);
INSERT INTO `sys_user` VALUES ('281', 'BDG_014', '2b0a47cfd018dc4158b25a43588d3a9e', '8', '1', 'default.png', 'RACHMAD MULDANI MOSS', 'BDG_014', null);
INSERT INTO `sys_user` VALUES ('282', 'BDG_016', '3d3ab79976b8ac443b8cf0d6c2ee2c94', '8', '1', 'default.png', 'TISHA AGUSTINA RAHMAWATI MOSS', 'BDG_016', null);
INSERT INTO `sys_user` VALUES ('283', 'BDG_017', 'f53b096a1af48f72be6e2ad6103dc324', '8', '1', 'default.png', 'LISNA PUJIARTI MOSS', 'BDG_017', null);
INSERT INTO `sys_user` VALUES ('284', 'BDG_018', '6fcb053ce0558310e17322e8973f7306', '8', '1', 'default.png', 'YULIANA MOSS', 'BDG_018', null);
INSERT INTO `sys_user` VALUES ('285', 'BDG_020', '792ec86476178320768f8e408148b9f9', '8', '1', 'default.png', 'GITA BONITA MOSS', 'BDG_020', null);
INSERT INTO `sys_user` VALUES ('286', 'BDG_021', '6d12a074af398a1e66d2b3a925a73b9d', '8', '1', 'default.png', 'SRI LESTARI MOSS', 'BDG_021', null);
INSERT INTO `sys_user` VALUES ('287', 'BDG_022', 'd07140cd3dc34068eff7e1462c72186b', '8', '1', 'default.png', 'AFIFATUL AZIZAH MOSS', 'BDG_022', null);
INSERT INTO `sys_user` VALUES ('288', 'BDG_025', '42767ea58be99b2dc5c33c2cd3fbe276', '8', '1', 'default.png', 'ARIEF IMAN PRASETYO MOSS', 'BDG_025', null);
INSERT INTO `sys_user` VALUES ('289', 'BDG_026', '2ebf1355d23eae0a272b7bb00963971b', '8', '1', 'default.png', 'DWINA ANISAH MOSS', 'BDG_026', null);
INSERT INTO `sys_user` VALUES ('290', 'BDG_027', '343f44fc9f4ab98678da5dd33e9d060f', '8', '1', 'default.png', 'VIAN ARAYANI MOSS', 'BDG_027', null);
INSERT INTO `sys_user` VALUES ('291', 'BDG_028', '4d28a35f3727c2d986474a5625d3cb7f', '8', '1', 'default.png', 'RIAN ANDRIANA MOSS', 'BDG_028', null);
INSERT INTO `sys_user` VALUES ('292', 'BDG_029', '7a91cb252898b25ab14c5ce252abab89', '8', '1', 'default.png', 'EPPY ROBIATUS SADIYAH MOSS', 'BDG_029', null);
INSERT INTO `sys_user` VALUES ('293', 'BDG_030', '83e7d985e4d90af676019fcbfc2af341', '8', '1', 'default.png', 'PUTRI RATNASARI MOSS', 'BDG_030', null);
INSERT INTO `sys_user` VALUES ('294', 'BDG_033', '5de3bdf6060a2e151a5942d9dd698af2', '8', '1', 'default.png', 'SELVA NURDIN M MOSS', 'BDG_033', null);
INSERT INTO `sys_user` VALUES ('295', 'BDG_036', '9db003f38a6bfaa6116c3b6ba9c214fd', '8', '1', 'default.png', 'HARY HAIDAR LATIEF MOSS', 'BDG_036', null);
INSERT INTO `sys_user` VALUES ('296', 'BDG_037', '9bd6bc7847936d3449d98b9e1a4e238b', '8', '1', 'default.png', 'NUGRAHA NASRULLOH MOSS', 'BDG_037', null);
INSERT INTO `sys_user` VALUES ('297', 'BDG_041', '421ebd55dde3f0c4197974d67c02f151', '8', '1', 'default.png', 'DERY SEPTIANA AL RASYID MOSS', 'BDG_041', null);
INSERT INTO `sys_user` VALUES ('298', 'BDG_042', '2893c0c5c918bf67979c5e3ee649ea64', '8', '1', 'default.png', 'RIZKI NUR FADHILAH MOSS', 'BDG_042', null);
INSERT INTO `sys_user` VALUES ('299', 'BDG_043', '09327d4cbbc631b4effa1036944a6f77', '8', '1', 'default.png', 'KARLINA MOSS', 'BDG_043', null);
INSERT INTO `sys_user` VALUES ('300', 'BDG_039', 'cda92f9926df931869e1528d4b119d39', '8', '1', 'default.png', 'WAHYU MOSS', 'BDG_039', null);
INSERT INTO `sys_user` VALUES ('301', 'BDG_040', 'c5c09362b31084032d19245dab38058b', '8', '1', 'default.png', 'ANNISA MOSS', 'BDG_040', null);
INSERT INTO `sys_user` VALUES ('302', 'BDG_046', '649c1b4ab428c0d61fbce1e3ced143dd', '8', '1', 'default.png', 'DENI YUDISTIRA MOSS', 'BDG_046', null);
INSERT INTO `sys_user` VALUES ('303', 'BDG_048', '25bec840681d74adb09303bc7f5a52bd', '8', '1', 'default.png', 'GIA NADIA PUTRI MOSS', 'BDG_048', null);
INSERT INTO `sys_user` VALUES ('304', 'BDG_051', '8b37acc5275bf53e56eb5a5b68bde1b5', '8', '1', 'default.png', 'SINTA DEWI SETIAWATI MOSS', 'BDG_051', null);
INSERT INTO `sys_user` VALUES ('305', 'BDG_052', '4bc886129d1ef5e004a16aaddd2a3e91', '8', '1', 'default.png', 'SINTA ROSITA MOSS', 'BDG_052', null);
INSERT INTO `sys_user` VALUES ('306', 'BDG_053', 'e619a4a5f0c9eaa2c13be214401f37ee', '8', '1', 'default.png', 'AGHNIA AUDINA NUR SOLEHAH MOSS', 'BDG_053', null);
INSERT INTO `sys_user` VALUES ('307', 'BDG_055', '6b5bb4683a44bf5633cfbb954b7c69e7', '8', '1', 'default.png', 'ROHIMAH MOSS', 'BDG_055', null);
INSERT INTO `sys_user` VALUES ('308', 'BDG_056', '1863b8d4cbf11eba5274c03bdd209add', '8', '1', 'default.png', 'RIA ANDRIYANI MOSS', 'BDG_056', null);
INSERT INTO `sys_user` VALUES ('309', 'BDG_057', '161ea2fb1e83001b857af4ced5234c89', '8', '1', 'default.png', 'MIA RAHMIYATI MOSS', 'BDG_057', null);
INSERT INTO `sys_user` VALUES ('310', 'BDG_059', '39d14d972512e7428e554adf5515982b', '8', '1', 'default.png', 'RIRI MARDIANA MOSS', 'BDG_059', null);
INSERT INTO `sys_user` VALUES ('311', 'BDG_060', '8cb8682af6f1785c7ae06fd5aac073f1', '8', '1', 'default.png', 'DIAN DARMAWAN S MOSS', 'BDG_060', null);
INSERT INTO `sys_user` VALUES ('312', 'BDG_061', 'dc42c74f0b2e9a9241bb3263b74848e8', '8', '1', 'default.png', 'SHERA AMALIA MOSS', 'BDG_061', null);
INSERT INTO `sys_user` VALUES ('313', 'BDG_062', 'c3141fb61ee337eaf0ce99e8ba4439b3', '8', '1', 'default.png', 'MUHAMMAD INDRA DWI LAKSANA MOSS', 'BDG_062', null);
INSERT INTO `sys_user` VALUES ('314', 'BDG_064', 'b5d1c1dc4b8c4cd8b269783f14a01145', '8', '1', 'default.png', 'ARIEF DHARMASAPUTRA MOSS', 'BDG_064', null);
INSERT INTO `sys_user` VALUES ('315', 'BDG_066', '206b4a43a325a21c73384a62c82b9d10', '8', '1', 'default.png', 'MOHAMMAD HAFIZ AL FAUZAN MOSS', 'BDG_066', null);
INSERT INTO `sys_user` VALUES ('316', 'BDG_067', '083abfc2bb039f60aebb3d89f2ec670f', '8', '1', 'default.png', 'SRI MAWATI AYUNIGUNTARI MOSS', 'BDG_067', null);
INSERT INTO `sys_user` VALUES ('317', 'BDG_068', 'b6389dd0656a7aabdde6f8e9fec37f63', '8', '1', 'default.png', 'RIKARDO HAREFA MOSS', 'BDG_068', null);
INSERT INTO `sys_user` VALUES ('318', 'BDG_069', '9985be0f32c234c0b99dde8604c1a337', '8', '1', 'default.png', 'ROSMILA MOSS', 'BDG_069', null);
INSERT INTO `sys_user` VALUES ('319', 'BDG_070', '8b51dab01bfbe859664da118fad12c4e', '8', '1', 'default.png', 'RESI NURLITA MOSS', 'BDG_070', null);
INSERT INTO `sys_user` VALUES ('320', 'BDG_071', 'e050e6c82e3e1390356531703d639b68', '8', '1', 'default.png', 'HANNA DELAVINA MOSS', 'BDG_071', null);
INSERT INTO `sys_user` VALUES ('321', 'BDG_072', '3a3c3661b58db0a4f4a37a8f7ec37b27', '8', '1', 'default.png', 'NIRA FITRIAH MOSS', 'BDG_072', null);
INSERT INTO `sys_user` VALUES ('322', 'BDG_073', '6bfccfb7d29d1a6b2eb83cc5e4c1d53a', '8', '1', 'default.png', 'GINA EKI AGUSTIN MOSS', 'BDG_073', null);
INSERT INTO `sys_user` VALUES ('323', 'BDG_074', '084090a6a6adefd99790ee31f1239203', '8', '1', 'default.png', 'ASTI RAMDHIAN MOSS', 'BDG_074', null);
INSERT INTO `sys_user` VALUES ('324', 'BDG_078', '7904259b5d50e8006896aad96189fd64', '8', '1', 'default.png', 'ANNISA ZAHRA NASHIROTULHAQ MOSS', 'BDG_078', null);
INSERT INTO `sys_user` VALUES ('325', 'BDG_079', 'e18dc1660ae8786711230deb786ac2c8', '8', '1', 'default.png', 'ISMAYANTI MOSS', 'BDG_079', null);
INSERT INTO `sys_user` VALUES ('326', 'BDG_082', 'f51ad857183fce17b1f45190fc27ddc5', '8', '1', 'default.png', 'HENI WAHYUNI MOSS', 'BDG_082', null);
INSERT INTO `sys_user` VALUES ('327', 'BDG_083', 'add32bd2a83946bf2ff5e625d1c5fc2e', '8', '1', 'default.png', 'SARAH SITI NUR SYAMSIAH MOSS', 'BDG_083', null);
INSERT INTO `sys_user` VALUES ('328', 'BDG_084', 'a4cf197f2d1acdb1dda8ee673eae62cd', '8', '1', 'default.png', 'DICKY PERMANA', 'BDG_084', null);
INSERT INTO `sys_user` VALUES ('329', 'BDG_085', '74c2e5be7069e75d2d2b8b669fee5a70', '8', '1', 'default.png', 'RATIH RAHMAWATI', 'BDG_085', null);
INSERT INTO `sys_user` VALUES ('330', 'BDG_087', '065fed2679a43b20334657940d24ba04', '8', '1', 'default.png', 'IMAN FIRMANSYAH', 'BDG_087', null);
INSERT INTO `sys_user` VALUES ('331', 'BDG_110', '96bb5b409cc1c0dcda6f610876d50052', '8', '1', 'default.png', 'NADYA MAHARANI ', 'BDG_110', null);
INSERT INTO `sys_user` VALUES ('332', 'BDG_009', '82d93afac8b987fe0d5ba9db1771d169', '8', '1', 'default.png', 'NUR JAIS', 'BDG_009', null);
INSERT INTO `sys_user` VALUES ('333', 'PE1080', '55c6729673ac6a7c5af3fa615a7f707a', '8', '1', 'default.png', 'PENDI', 'PE1080', null);
INSERT INTO `sys_user` VALUES ('334', 'BDG_112', '97ddc0c089de936d90138be6ce7aaea8', '8', '1', 'default.png', 'FIRDA SRI RAHMAYANTI MOSS', 'BDG_112', null);
INSERT INTO `sys_user` VALUES ('335', 'BDG_114', 'b3179a90ee88e3c30bde70300dcd7b36', '8', '1', 'default.png', 'DIMAS PRADITYA AJI', 'BDG_114', null);
INSERT INTO `sys_user` VALUES ('336', 'BDG_115', 'bc9034a537c87ed2a80832489094ca43', '8', '1', 'default.png', 'SANI NURAHAYU', 'BDG_115', null);
INSERT INTO `sys_user` VALUES ('337', 'BDG_116', '2a634d9741a8ef1c1f328a0b08c4be4d', '8', '1', 'default.png', 'NADYA RACHMAWATI MOSS', 'BDG_116', null);
INSERT INTO `sys_user` VALUES ('338', 'BDG_117', 'f602b99c907e6544a81a3c94690a5dd3', '8', '1', 'default.png', 'DIDAH HALIYAH MOSS', 'BDG_117', null);
INSERT INTO `sys_user` VALUES ('339', 'BDG_118', '41b9dbc89775a518ebd80f9426b08934', '8', '1', 'default.png', 'RIESLA FAUZI RACHMAN MOSS', 'BDG_118', null);
INSERT INTO `sys_user` VALUES ('340', 'BDG_119', '77f90bb64d146d324721ed5a36be8c18', '8', '1', 'default.png', 'SANDI SARIKA MOSS', 'BDG_119', null);
INSERT INTO `sys_user` VALUES ('341', 'BDG_120', '9f07d90d8513a692edf1624b72d16d42', '8', '1', 'default.png', 'KRISDIYANTI MOSS', 'BDG_120', null);
INSERT INTO `sys_user` VALUES ('342', 'BDG_111', 'c848e42d7905d4efa4d0105cca9410ac', '8', '1', 'default.png', 'VINA FEBRIANI', 'BDG_111', null);
INSERT INTO `sys_user` VALUES ('343', 'BDG_113', '73a3d5e3f1425cc4c24ee0a65f7ddd6e', '8', '1', 'default.png', 'IKBAR NUR MUHAMMAD', 'BDG_113', null);
INSERT INTO `sys_user` VALUES ('344', 'BDG_109', '661ca8e8d37d42bae1d10169dddafe82', '8', '1', 'default.png', 'RAHMAWATI ZAKIYAH', 'BDG_109', null);
INSERT INTO `sys_user` VALUES ('345', 'BDG_107', '755dcf5332c2df5e1c7cb85a08f96364', '8', '1', 'default.png', 'KARIN ARINDA PRAMUDHYTA', 'BDG_107', null);
INSERT INTO `sys_user` VALUES ('346', 'BDG_108', 'e9a987ba33faedb4ee75ab008fb0439d', '8', '1', 'default.png', 'SABILA AINUN HAFSAH BGD', 'BDG_108', null);

-- ----------------------------
-- Table structure for sys_userlogin
-- ----------------------------
DROP TABLE IF EXISTS `sys_userlogin`;
CREATE TABLE `sys_userlogin` (
  `iduser` int(11) NOT NULL,
  `tokenserial` char(100) NOT NULL,
  `login_time` char(30) DEFAULT NULL,
  PRIMARY KEY (`iduser`),
  KEY `iiduser` (`iduser`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_userlogin
-- ----------------------------
INSERT INTO `sys_userlogin` VALUES ('1', 'af99806199aa000d1e1fe64f0d10fe84', '1579574213');
INSERT INTO `sys_userlogin` VALUES ('2', '44b9a23f7b3527c1b996910629dff4a2', '1578739428');
INSERT INTO `sys_userlogin` VALUES ('65', '38f398a7983e12ca09f6e27d8c374de3', '1579249735');
INSERT INTO `sys_userlogin` VALUES ('210', '31be6cfa5d2cbed442ade8a38d380fc4', '1579246315');
INSERT INTO `sys_userlogin` VALUES ('230', 'ccc3932e1d8fb0e02aab63cddaf568f8', '1579574083');
INSERT INTO `sys_userlogin` VALUES ('306', 'b52ed94477d50518e7984d51e527c5fe', '1579574022');

-- ----------------------------
-- Table structure for sys_user_log_accessuri
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_log_accessuri`;
CREATE TABLE `sys_user_log_accessuri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_login` int(11) DEFAULT NULL,
  `url_access` text,
  `type_request` varchar(10) DEFAULT NULL,
  `os_access` varchar(150) DEFAULT NULL,
  `ip_address_access` varchar(20) DEFAULT NULL,
  `time_access` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`id`) USING BTREE,
  KEY `iid_login` (`id_login`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_log_accessuri
-- ----------------------------

-- ----------------------------
-- Table structure for sys_user_log_login
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_log_login`;
CREATE TABLE `sys_user_log_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `login_time` int(11) DEFAULT NULL,
  `logout_time` int(11) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `browser` varchar(100) DEFAULT NULL,
  `os` varchar(100) DEFAULT NULL,
  `agentid` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`id`) USING BTREE,
  KEY `iuser` (`id_user`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_log_login
-- ----------------------------

-- ----------------------------
-- Table structure for sys_user_upload
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_upload`;
CREATE TABLE `sys_user_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `orig_name` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iuser` (`id_user`,`time`) USING BTREE,
  KEY `iid` (`id`) USING BTREE,
  KEY `iex` (`id_user`,`ext`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_upload
-- ----------------------------

-- ----------------------------
-- Table structure for sys_user_upload_temp
-- ----------------------------
DROP TABLE IF EXISTS `sys_user_upload_temp`;
CREATE TABLE `sys_user_upload_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `file_path` varchar(200) DEFAULT NULL,
  `orig_name` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `ext` varchar(10) DEFAULT NULL,
  `time` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iuser` (`id_user`,`time`) USING BTREE,
  KEY `iid` (`id`) USING BTREE,
  KEY `iex` (`id_user`,`ext`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_upload_temp
-- ----------------------------

-- ----------------------------
-- Table structure for trans_profiling
-- ----------------------------
DROP TABLE IF EXISTS `trans_profiling`;
CREATE TABLE `trans_profiling` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idx` bigint(20) NOT NULL,
  `ncli` varchar(15) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `pstn1` varchar(25) DEFAULT NULL,
  `no_speedy` varchar(25) DEFAULT NULL,
  `kepemilikan` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `verfi_fb` varchar(5) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `verfi_twitter` varchar(5) DEFAULT NULL,
  `relasi` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `verfi_email` varchar(5) DEFAULT NULL,
  `lup_email` datetime DEFAULT NULL,
  `email_lain` varchar(50) DEFAULT NULL,
  `handphone` varchar(25) DEFAULT NULL,
  `verfi_handphone` varchar(5) DEFAULT NULL,
  `lup_handphone` datetime DEFAULT NULL,
  `nama_pastel` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(25) DEFAULT NULL,
  `waktu_psb` varchar(20) DEFAULT NULL,
  `kec_speedy` varchar(20) DEFAULT NULL,
  `billing` varchar(20) DEFAULT NULL,
  `payment` varchar(20) DEFAULT NULL,
  `tgl_lahir` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `profiling_by` int(11) DEFAULT '0',
  `click_sms` int(11) DEFAULT '0',
  `click_email` int(11) DEFAULT '0',
  `ip_address` varchar(20) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hub_pemilik` int(11) DEFAULT '0',
  `veri_distribusi` datetime NOT NULL,
  `veri_count` int(11) DEFAULT '0',
  `veri_status` int(11) DEFAULT '0',
  `veri_call` int(11) DEFAULT '0',
  `veri_keterangan` text,
  `veri_upd` varchar(15) DEFAULT NULL,
  `veri_lup` datetime DEFAULT NULL,
  `lup` timestamp NULL DEFAULT NULL,
  `click_session` varchar(30) NOT NULL,
  `division` varchar(30) DEFAULT NULL,
  `witel` varchar(50) DEFAULT NULL,
  `kandatel` varchar(50) DEFAULT NULL,
  `regional` varchar(5) DEFAULT NULL,
  `veri_system` int(11) DEFAULT '0',
  `nik` varchar(16) DEFAULT NULL,
  `no_kk` varchar(16) DEFAULT NULL,
  `nama_ibu_kandung` varchar(150) DEFAULT NULL,
  `path` varchar(10) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `handphone_lain` varchar(20) DEFAULT NULL,
  `opsi_call` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iidx` (`idx`),
  KEY `iveri_call` (`veri_call`),
  KEY `iveri_upd` (`veri_upd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of trans_profiling
-- ----------------------------
