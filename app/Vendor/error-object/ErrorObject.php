<?php
class ErrorObject {
	const  C_CATEGORY_DUPLICATE 	= 1;
	const C_CATEGORY_NULL 		= 2;
	const C_CATEGORY_SAVE_FAIL 	= 3;
	const C_CATEGORY_NOT_EXIST 	= 4;
	
	static $MESSAGE 	= array(
			self::C_CATEGORY_DUPLICATE 		=> 'Danh mục đã có rồi',
			self::C_CATEGORY_NULL 			=> 'Nhập tên danh mục',
			self::C_CATEGORY_SAVE_FAIL 		=> 'Lưu danh mục không thành công',
			self::C_CATEGORY_NOT_EXIST 		=> 'Không tìm thấy danh mục'
			);
}