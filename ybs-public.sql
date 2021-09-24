/*
Navicat MySQL Data Transfer

Source Server         : mydb
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ybs-public

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-11-28 04:56:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `sample_golongan`
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
-- Table structure for `sample_grup`
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
-- Table structure for `sample_jabatan`
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
-- Table structure for `sample_karyawan`
-- ----------------------------
DROP TABLE IF EXISTS `sample_karyawan`;
CREATE TABLE `sample_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `id_golongan` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
-- Table structure for `sample_subgrup`
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
-- Table structure for `sample_type`
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
-- Table structure for `sys_authorized`
-- ----------------------------
DROP TABLE IF EXISTS `sys_authorized`;
CREATE TABLE `sys_authorized` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) DEFAULT NULL,
  `id_form` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`id`) USING BTREE,
  KEY `ilevel` (`id_level`,`id_form`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=latin1;

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

-- ----------------------------
-- Table structure for `sys_authorized_menu`
-- ----------------------------
DROP TABLE IF EXISTS `sys_authorized_menu`;
CREATE TABLE `sys_authorized_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_authorized_menu
-- ----------------------------
INSERT INTO `sys_authorized_menu` VALUES ('1', '1', '1');
INSERT INTO `sys_authorized_menu` VALUES ('2', '1', '2');
INSERT INTO `sys_authorized_menu` VALUES ('3', '1', '3');
INSERT INTO `sys_authorized_menu` VALUES ('4', '1', '4');
INSERT INTO `sys_authorized_menu` VALUES ('5', '1', '5');
INSERT INTO `sys_authorized_menu` VALUES ('6', '1', '6');

-- ----------------------------
-- Table structure for `sys_complite`
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
-- Table structure for `sys_dashboard`
-- ----------------------------
DROP TABLE IF EXISTS `sys_dashboard`;
CREATE TABLE `sys_dashboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_form` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_user` (`id_user`) USING BTREE,
  KEY `i_id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_dashboard
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_form`
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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

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

-- ----------------------------
-- Table structure for `sys_level`
-- ----------------------------
DROP TABLE IF EXISTS `sys_level`;
CREATE TABLE `sys_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nmlevel` char(50) DEFAULT NULL,
  `opt_status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`id`) USING BTREE,
  KEY `inmlevel` (`nmlevel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_level
-- ----------------------------
INSERT INTO `sys_level` VALUES ('1', 'Configurator', '1');

-- ----------------------------
-- Table structure for `sys_maintenance_ip`
-- ----------------------------
DROP TABLE IF EXISTS `sys_maintenance_ip`;
CREATE TABLE `sys_maintenance_ip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_maintenance_ip
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_maintenance_mode`
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
-- Table structure for `sys_maintenance_schedule`
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_maintenance_schedule
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_menu`
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_menu
-- ----------------------------
INSERT INTO `sys_menu` VALUES ('1', '1', 'Pengaturan', 'fe fe-box', '0');
INSERT INTO `sys_menu` VALUES ('2', '1', 'Dokumentasi', 'fe fe-box', '0');
INSERT INTO `sys_menu` VALUES ('3', '28', 'Sample Icon', 'fe fe-twitter', '2');
INSERT INTO `sys_menu` VALUES ('4', '30', 'Sample Element', 'fa fa-tv', '2');
INSERT INTO `sys_menu` VALUES ('5', '43', 'Petunjuk Penggunaan', 'fa fa-hand-o-up', '2');
INSERT INTO `sys_menu` VALUES ('6', '2', 'Sistem', 'fe fe-activity', '1');

-- ----------------------------
-- Table structure for `sys_show`
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
-- Table structure for `sys_status`
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
-- Table structure for `sys_user`
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nmuser` char(50) CHARACTER SET latin1 DEFAULT NULL,
  `passuser` char(100) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `opt_level` int(11) DEFAULT NULL COMMENT '1=admin',
  `opt_status` int(5) DEFAULT NULL COMMENT '0=nonaktif,1=aktif, 2 = delete',
  `picture` char(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iid` (`id`) USING BTREE,
  KEY `inmuser` (`nmuser`) USING BTREE,
  KEY `ilevel` (`opt_level`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES ('1', 'Dhiya', '85057fb4f917a6f60835fd9ad3e90581', '1', '1', 'default.png');

-- ----------------------------
-- Table structure for `sys_userlogin`
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
INSERT INTO `sys_userlogin` VALUES ('1', '53f7fb5eda18629aafd200cbb6b2ad3e', '1574890918');

-- ----------------------------
-- Table structure for `sys_user_log_accessuri`
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
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_log_accessuri
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_user_log_login`
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
  PRIMARY KEY (`id`),
  KEY `iid` (`id`) USING BTREE,
  KEY `iuser` (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_log_login
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_user_upload`
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_upload
-- ----------------------------

-- ----------------------------
-- Table structure for `sys_user_upload_temp`
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sys_user_upload_temp
-- ----------------------------
